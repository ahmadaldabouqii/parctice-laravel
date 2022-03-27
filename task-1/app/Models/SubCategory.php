<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * SubCategory
 *
 * @mixin Eloquent
 */
class SubCategory extends Model
{
    use HasFactory;
    public array $subCategories = [];

    public function getAllSubCategories()
    {
        $this->subCategories = DB::table('sub_categories')->get()->toArray();
        return $this->subCategories;
    }
}
