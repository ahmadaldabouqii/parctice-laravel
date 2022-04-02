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
        return DB::table('categories')->get()->toArray();
    }
}
