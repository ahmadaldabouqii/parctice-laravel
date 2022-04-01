<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [UserController::class, 'welcome']);

Route::prefix("user")->name("user.")->group(function(){
    Route::post('register-form', [UserController::class, 'insertUser'])->name("register-form");
    Route::get('add_user_form', [UserController::class, 'index'])->name("add_user_form");
    Route::get('users', [UserController::class, 'displayUsers'])->name("users");
    Route::post('{user}/deleteUser', [UserController::class , "destroy"])->name("deleteUser");
    Route::get('edit-user/{id}', [UserController::class, 'edit'])->name("edit-user");
    Route::put('update-user/{id}', [UserController::class, 'update'])->name("update-user");
});

Route::prefix("category")->name("category.")->group(function (){
    Route::get('add-category', [CategoryController::class, 'addCategory'])->name("add-category");
    Route::post('insert-category', [CategoryController::class, 'insertCategory'])->name("insert-category");
    Route::get('categories',[CategoryController::class, 'displayCategories'])->name("categories");
    Route::get('edit-category/{id}', [CategoryController::class, 'editCategory'])->name("edit-category");
    Route::put('update-category/{id}',[CategoryController::class, 'updateCategory'])->name("update-category");
    Route::delete('deleteCategory/{category}',[CategoryController::class, 'destroy'])->name("deleteCategory");
});

Route::prefix("subCategory")->name("subCategory.")->group(function(){
    Route::get('add-sub-category', [SubCategoryController::class, 'index'])->name("add-sub-category");
    Route::post('insert-sub-category', [SubCategoryController::class, 'insertSubCategory'])->name("insert-sub-category");
    Route::get('sub-categories', [SubCategoryController::class, 'displaySubCategories'])->name("sub-categories");
    Route::get('edit-sub-category/{id}', [SubCategoryController::class, 'editSubCategory'])->name('editSubCategory');
    Route::post('deleteSubCategory/{subCategory}',[SubCategoryController::class, 'deleteSubCategory'])->name('deleteSubCategory');
    Route::put('update-sub-category/{sub_category}', [SubCategoryController::class, 'updateSubCategory'])->name("update-sub-category");
});
