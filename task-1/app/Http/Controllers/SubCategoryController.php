<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
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
        $categories = Category::getAllCategories();
        return view("admin.subCategory-views.add-sub-category", ["categories" => $categories]);
    }

    public function displaySubCategories()
    {
        $categories = Category::get(["id", "name"]);
        return view("admin.subCategory-views.sub-categories",
            [
                "sub_categories" => SubCategory::getAllSubCategories(),
                "categories"     => $categories
            ]
        );
    }

    public function insertSubCategory(Request $request)
    {
        $subCategory = new SubCategory;

        $request->validate([
            "id"           => "exists:categories",
            "name"         => "required",
            "is_active"    => "required",
        ]);

        if(!$request->category_id){
            Alert::error("Oops!!", "You need to select category!");
            return redirect()->route("admin.subCategory.add-sub-category");
        }

        $subCategory->name        = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->is_active   = $request->is_active;
        $subCategory->save();

        Alert::success("Added!", "Sub category added successfully!");
        return redirect()->route("admin.subCategory.sub-categories");
    }

    public function editSubCategory($id)
    {
        $categories = Category::get();
        $subCategory = SubCategory::findOrFail($id);
        return view("admin.subCategory-views.edit-sub-category",
            [
                "subCategory" => $subCategory,
                "categories"  => $categories
            ]
        );
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
        return redirect()->route("admin.subCategory.sub-categories");
    }

    public function filterSubCategory(Request $request)
    {
        $filter = $request->filter;
        $categories = Category::get(["id", "name"]);
        $all = [];

        foreach ($categories as $category) {
            if ($filter === $category->name) {
                $all = SubCategory::where('category_id', '=', $category->id)->get();
            }else{
                switch ($filter){
                    case 'active': $all = SubCategory::activeSubCategory();
                        break;
                    case 'Inactive': $all = SubCategory::inActiveSubCategory();
                        break;
                    case '': $all = SubCategory::getAllSubCategories();
                }
            }
        }

        return view('admin.subCategory-views.sub-categories',
            [
                'sub_categories' => $all,
                'categories'     => $categories
            ]
        );
    }

    public function deleteSubCategory(SubCategory $subCategory)
    {
        $subCategory->delete();
        Alert::success("Deleted!", "Sub category deleted successfully!");
        return redirect()->route("admin.subCategory.sub-categories");
    }
}
