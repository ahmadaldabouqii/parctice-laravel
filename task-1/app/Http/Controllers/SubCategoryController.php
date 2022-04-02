<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Eloquent;

/**
 * SubCategory
 *
 * @mixin Eloquent
 */
class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table("categories")->get()->toArray();
        return view("subCategory-views.add-sub-category", ["categories" => $categories]);
    }

    public function displaySubCategories()
    {
        $categories = DB::table("categories")->get(["id", "name"]);
        $sub_categories = new SubCategory();
        return view("subCategory-views.sub-categories", [
            "sub_categories" => $sub_categories->getAllSubCategories(),
            "categories" => $categories
        ]);
    }

    public function insertSubCategory(Request $request)
    {
        $subCategory = new SubCategory();

        if(!$request->category_id){
            Alert::error("Oops!!", "You need to select category!");
            return redirect()->route("subCategory.add-sub-category");
        }

        $request->validate([
            "id"           => "exists:categories",
            "name"         => "required",
            "is_active"    => "required",
        ]);

        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->is_active = $request->is_active;
        $subCategory->save();

        Alert::success("Added!", "Sub category added successfully!");
        return redirect()->route("subCategory.sub-categories");
    }

    public function editSubCategory($id)
    {
        $categories = DB::table("categories")->get()->all();
        $subCategory = SubCategory::find($id);
        return view("subCategory-views.edit-sub-category", [
            "subCategory" => $subCategory,
            "categories" => $categories
        ]);
    }

    public function updateSubCategory(Request $request, SubCategory $sub_category)
    {
        $request->validate([
            "category_id" => "exists:categories,id",
            "name"         => "required",
            "is_active"    => "required",
        ]);

        $sub_category->name = $request->input("name");
        $sub_category->category_id = $request->get("category_id");
        $sub_category->is_active = $request->is_active;

        $sub_category->save();
        Alert::success("Updated!", "Sub category updated successfully!");
        return redirect()->route("subCategory.sub-categories");
    }

    public function deleteSubCategory(SubCategory $subCategory)
    {
        $subCategory->delete();
        Alert::success("Deleted!", "Sub category deleted successfully!");
        return redirect()->route("subCategory.sub-categories");
    }
}
