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

Route::post('register-form', [UserController::class, 'insertUser']);

Route::get('add-user-form', [UserController::class, 'index']);
Route::get('users', [UserController::class, 'displayUsers']);
Route::post('{user}/deleteUser', [UserController::class , "destroy"])->name("deleteUser");
Route::get('edit-user/{id}', [UserController::class, 'edit']);
Route::put('update-user/{id}', [UserController::class, 'update']);

Route::get('add-category', [CategoryController::class, 'addCategory']);
Route::post('insert-category', [CategoryController::class, 'insertCategory']);
Route::get('categories',[CategoryController::class, 'displayCategories']);
Route::get('edit-category/{id}', [CategoryController::class, 'editCategory'])->name("edit-category");
Route::put('update-category/{id}',[CategoryController::class, 'updateCategory']);
Route::post('deleteCategory/{category}',[CategoryController::class, 'destroy'])->name("deleteCategory");

Route::get('add-sub-category', [SubCategoryController::class, 'index']);
Route::post('insert-sub-category', [SubCategoryController::class, 'insertSubCategory']);
Route::get('sub-categories', [SubCategoryController::class, 'displaySubCategories']);

Route::get('edit-sub-category/{id}', [SubCategoryController::class, 'editSubCategory'])->name('editSubCategory');
Route::post('deleteSubCategory/{subCategory}',[SubCategoryController::class, 'deleteSubCategory'])->name('deleteSubCategory');
Route::put('update-sub-category/{id}', [SubCategoryController::class, 'updateSubCategory']);
