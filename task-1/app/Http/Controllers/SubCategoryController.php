<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get()->toArray();
        return view('add-sub-category', ['categories' => $categories]);
    }

    public function displaySubCategories()
    {
        $sub_categories = new SubCategory();
        return view('sub-categories', ['sub_categories' => $sub_categories->getAllSubCategories()]);
    }

    public function insertSubCategory(Request $request)
    {
        $subCategory = new SubCategory();

        $request->validate([
            "id" => "exists:categories",
            "name"         => "required",
            "is_active"    => "required",
        ]);

        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->is_active = $request->is_active;
        $subCategory->save();

        Alert::success('Added!', 'Sub category added successfully!');
        return redirect('sub-categories');
    }

    public function editSubCategory($id)
    {
        $categories = DB::table('categories')->get()->all();
        $subCategory = SubCategory::find($id);
        return view('edit-sub-category', [
            'subCategory' => $subCategory,
            'categories' => $categories
        ]);
    }

    public function updateSubCategory(Request $request, $id)
    {
        $request->validate([
            "id" => "exists:categories",
            "name"         => "required",
            "is_active"    => "required",
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->name = $request->input('name');
        $subCategory->is_active = $request->is_active;

        $subCategory->update();
        Alert::success("Updated!", "Sub category updated successfully!");
        return redirect("sub-categories");
    }

    public function deleteSubCategory(SubCategory $subCategory)
    {
        $subCategory->delete();
        Alert::success('Deleted!', "Sub category deleted successfully!");
        return redirect('sub-categories');
    }
}
