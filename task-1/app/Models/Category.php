<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model {
    use HasFactory;
    public array $categories = [];

    public function getAllCategories()
    {
        $this->categories = DB::table('categories')->get()->toArray();
        return $this->categories;
    }
}
