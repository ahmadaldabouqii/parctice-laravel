<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SubCategory
 *
 * @mixin Eloquent
 */
class SubCategory extends Model
{
    use HasFactory;

    public static function getAllSubCategories()
    {
        return SubCategory::get();
    }

    public function subCategory()
    {
        // Retrieve each subCategory belongsTo related category
        return $this->belongsTo(Category::class);
    }

    public static function activeSubCategory()
    {
        return SubCategory::where('is_active','=',1)->get();
    }

    public static function inActiveSubCategory()
    {
        return SubCategory::where('is_active','=', 0)->get();
    }
}
