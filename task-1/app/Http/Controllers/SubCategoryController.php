<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function insertSubCategory(Request $request)
    {
        $request->validate([
            "category_id"  => "required|exists:sub_categories",
            "name"         => "required",
            "is_active"    => "required",
        ]);

        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->is_active = $request->is_active;

        $subCategory->save();

        return redirect('add-sub-category')->with('status','Sub category added!');
    }
}
