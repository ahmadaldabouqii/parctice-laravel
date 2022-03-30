<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        return view('add-category-form');
    }

    public function displayCategories()
    {
        $categories = new Category();
        return view('categories', ['categories' => $categories->getAllCategories()]);
    }

    public function editCategory($id)
    {
        $categoryID = new Category();
        $category = $categoryID->find($id);
        return view('edit-category', ['category' => $category]);
    }

    public function insertCategory(Request $request)
    {
        $category = new Category();

        $request->validate([
            "image"        => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "name"         => "required|min:2|max:20",
            "is_active"    => "required",
        ]);

        $image = $request->file('image');
        $input['image'] = str_replace(" ", "-", $image->getClientOriginalName());
        $destinationPath = public_path('storage/uploads');
        $image->move($destinationPath, strtolower($input['image']));

        $category->image = $input['image'];
        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->save();

        Alert::success('Added!', 'category added successfully!');
        return redirect('categories');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            "image"        => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "name"         => "required|min:2|max:20",
            "is_active"    => "required",
        ]);

        if($request->hasFile('image')) {
            if ($category->image)
                $oldImage = unlink(public_path('storage/uploads/' . strtolower($category->image)));

            $input['image'] = strtolower(str_replace(" ", "-", $request->file('image')->getClientOriginalName()));
            $image = $request->file('image')->move(public_path('storage/uploads'), $input['image']);
            $category->image = $input['image'];
        }

        // $category->image = $request->file('image');
        $category->name = $request->get('name');
        $category->is_active = $request->get('is_active');
        $category->save();

        Alert::success('Updated!','Category updated successfully');
        return redirect('categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        $removeLocalImage = unlink(public_path('storage/uploads/' . strtolower($category->image)));
        Alert::success('Deleted', 'Category deleted successfully!');
        return redirect('categories');
    }
}
