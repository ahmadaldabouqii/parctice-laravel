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
Route::get('add-user-form', [UserController::class, 'index']);
Route::post('register-form', [UserController::class, 'insertUser']);
Route::get('add-category', [CategoryController::class, 'addCategory']);
Route::post('insert-category', [CategoryController::class, 'insertCategory']);
Route::get('add-sub-category', [SubCategoryController::class, 'index']);
Route::post('insert-sub-category', [SubCategoryController::class, 'insertSubCategory']);
Route::get('sub-categories', [SubCategoryController::class, 'displaySubCategories']);
Route::get('users', [UserController::class, 'displayUsers']);
Route::get('categories',[CategoryController::class, 'displayCategories']);
