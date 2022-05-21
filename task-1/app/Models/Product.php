<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Product
 *
 * @mixin Eloquent
 */

class Product extends Model
{
    use HasFactory;

    public static function getAllProducts()
    {
        return Product::get();
    }
}
