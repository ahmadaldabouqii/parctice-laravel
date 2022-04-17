<?php

use App\Http\Controllers\AuthController;
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
Route::get('/', [UserController::class, 'welcome'])->name('welcome');

Route::prefix('admin')->controller(UserController::class)->name('admin.')->group(function () {

    Route::get('/' , function (){
//         return Category::with(['subCategory'])->get();
//         return \App\Models\SubCategory::with('category')->get();
         return redirect()->route('admin.user.total');
    });

    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::prefix('user')->controller(UserController::class)->name('user.')->group(function () {
            Route::get('total', 'total')->name('total');
            Route::post('register-form', 'insertUser')->name('register-form');
            Route::get('add_user_form', 'index')->name('add_user_form');
            Route::get('users', 'displayUsers')->name('users');
            Route::post('{user}/deleteUser', 'destroy')->name('deleteUser');
            Route::get('edit-user/{id}', 'edit')->name('edit-user');
            Route::put('update-user/{id}', 'update')->name('update-user');
            Route::post('filterUsers', 'filterUsers')->name('filterUsers');
        });

        Route::prefix('category')->controller(CategoryController::class)->name('category.')->group(function () {
            Route::get('add-category', 'addCategory')->name('add-category');
            Route::post('insert-category', 'insertCategory')->name('insert-category');
            Route::post('filterCategory', 'filterCategory')->name('filterCategory');
            Route::get('categories', 'displayCategories')->name('categories');
            Route::get('edit-category/{id}', 'editCategory')->name('edit-category');
            Route::put('update-category/{id}', 'updateCategory')->name('update-category');
            Route::delete('deleteCategory/{category}', 'destroy')->name('deleteCategory');
        });

        Route::prefix('subCategory')->controller(SubCategoryController::class)->name('subCategory.')->group(function () {
            Route::get('add-sub-category', 'index')->name('add-sub-category');
            Route::post('insert-sub-category', 'insertSubCategory')->name('insert-sub-category');
            Route::get('sub-categories', 'displaySubCategories')->name('sub-categories');
            Route::get('edit-sub-category/{id}', 'editSubCategory')->name('editSubCategory');
            Route::post('deleteSubCategory/{subCategory}', 'deleteSubCategory')->name('deleteSubCategory');
            Route::put('update-sub-category/{sub_category}', 'updateSubCategory')->name('update-sub-category');
            Route::post('filterSubCategory', 'filterSubCategory')->name('filterSubCategory');
        });
    });
});
