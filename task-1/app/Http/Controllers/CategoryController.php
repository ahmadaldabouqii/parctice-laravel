<?php

namespace App\Http\Controllers;

use App\Models\Category;
use File;
use Illuminate\Http\Request;
use Eloquent;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Category
 *
 * @mixin Eloquent
*/

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view("category-views.add-category-form");
    }

    public function displayCategories()
    {
        $categories = new Category();
        return view("category-views.categories", ["categories" => Category::getAllCategories()]);
    }

    public function editCategory($id)
    {
        $categoryID = new Category();
        $category = $categoryID->find($id);
        return view("category-views.edit-category", ["category" => $category]);
    }

    public function insertCategory(Request $request)
    {
        $category = new Category();

        $request->validate([
            "image"        => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "name"         => "required|min:2|max:20",
            "is_active"    => "required",
        ]);

        $image = $request->file("image");
        $input['image'] = strtolower(str_replace(" ", "-", $image->getClientOriginalName()));
        $destinationPath = public_path("storage/uploads");

        if(!file_exists(public_path("storage/uploads/" . $input['image']))) {
            $image->move($destinationPath, $input["image"]);
        }

        $category->image = $input['image'];
        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->save();

        Alert::success("Added!", "category added successfully!");
        return redirect()->route("category.categories");
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::getAllCategories();

        $request->validate([
            "image"        => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "name"         => "required|min:2|max:20",
            "is_active"    => "required",
        ]);

        if($request->hasFile("image")) {
            foreach ($categories as $cloudCategory){
                if(!$cloudCategory->image === $category->image){
                    unlink(public_path("storage/uploads/" . strtolower($category->image)));
                }
            }

            $input["image"] = strtolower(str_replace(" ", "-", $request->file("image")->getClientOriginalName()));
            $request->file("image")->move(public_path("storage/uploads"), $input["image"]);
            $category->image = $input["image"];
        }

        $category->name = $request->get("name");
        $category->is_active = $request->get("is_active");
        $category->save();

        Alert::success("Updated!","Category updated successfully");
        return redirect()->route("category.categories");
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        $categories = Category::getAllCategories();

        if(!$categories) {
            File::cleanDirectory(public_path("storage/uploads"));
        }

        foreach ($categories as $cloudCategory){
            if(!$cloudCategory->image === $category->image){
                unlink(public_path("storage/uploads/" . strtolower($category->image)));
            }
        }

        Alert::success("Deleted!", "Category deleted successfully!");

        if(request()->route()->uri === "/")
            return redirect()->route("/");
        return redirect()->route("category.categories");
    }
}
