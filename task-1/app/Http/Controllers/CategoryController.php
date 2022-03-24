<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('add-category-form');
    }

    public function insertCategory(Request $request)
    {
        $request->validate([
            "image"        => "required",
            "name"         => "required|min:2|max:20",
            "is_active"    => "required",
        ]);

        $category = new Category();
        $category->image = $request->file('image')->store('image');
        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->save();

        return redirect('add-category')->with('status','category added!');
    }
}
