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
            "image"        => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "name"         => "required|min:2|max:20",
            "is_active"    => "required",
        ]);

        $category = new Category();

        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
            $category->image = '/storage/' . $path;
        }

        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->save();

        return redirect('add-category')->with('status','category added!');
    }
}
