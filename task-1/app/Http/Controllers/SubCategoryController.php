<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            "id"  => "exists:categories",
            "category_id" => "exists:sub_categories",
            "name"         => "required",
            "is_active"    => "required",
        ]);

        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->is_active = $request->is_active;
        $subCategory->save();

        return redirect('sub-categories')->with('status','Sub category added!');
    }
}
