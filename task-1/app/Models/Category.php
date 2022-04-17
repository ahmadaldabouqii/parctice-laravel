<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Eloquent;

/**
 * Category
 *
 * @mixin Eloquent
*/

class Category extends Model {
    use HasFactory;

    public static function getAllCategories()
    {
        return Category::get();
    }

    public static function getActiveCategory(){
        return Category::where('is_active','=', 1)->get();
    }

    public static function getInActiveCategory(){
        return Category::where('is_active','=', 0)->get();
    }

    public function subCategory()
    {
        // Retrieve all categories and there childes.
        // return $this->belongsTo(SubCategory::class);
        return $this->hasMany(SubCategory::class);
    }
}
