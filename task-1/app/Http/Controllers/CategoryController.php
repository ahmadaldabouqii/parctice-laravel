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
        return view("admin.category-views.add-category-form");
    }

    public function displayCategories(Request $request)
    {

        return view("admin.category-views.categories",
            [
                "categories" => Category::where(function($q) use($request){
                    if($request->has('is_active'))
                        return $q->where('is_active', $request->is_active);
                })->get()
            ]
        );
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view("admin.category-views.edit-category", ["category" => $category]);
    }

    public function insertCategory(Request $request)
    {
        $category = new Category();

        $request->validate([
            "image"        => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "name"         => "required|min:2|max:20",
            "is_active"    => "required",
        ]);

        $image           = $request->file("image");
        $input['image']  = strtolower(str_replace(" ", "-", $image->getClientOriginalName()));
        $destinationPath = public_path("storage/uploads");

        if(!file_exists(public_path("storage/uploads/" . $input['image']))) {
            $image->move($destinationPath, $input["image"]);
        }

        $category->image     = $input['image'];
        $category->name      = $request->name;
        $category->is_active = $request->is_active;
        $category->save();

        Alert::success("Added!", "category added successfully!");
        return redirect()->route("admin.category.categories");
    }

    public function updateCategory(Request $request, $id)
    {
        $category   = Category::findOrFail($id);
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

        $category->name      = $request->get("name");
        $category->is_active = $request->get("is_active");
        $category->save();

        Alert::success("Updated!","Category updated successfully");
        return redirect()->route("admin.category.categories");
    }

    public function destroy(Category $category)
    {
//        unlink(public_path("storage/uploads/" . strtolower($category->image)));
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
        return back();
    }
}
