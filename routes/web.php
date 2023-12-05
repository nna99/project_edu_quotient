<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {

    // dashboard item list
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    Route::get('add/item',[PostController::class,'addItem'])->name('add#item');
    Route::get('edit/itemPage/{id}',[PostController::class,'editItemPage'])->name('edit#itemPage');
    Route::post('update/item',[PostController::class,'updateItem'])->name('update#item');
    Route::get('delete/item/{id}',[PostController::class,'deleteItem'])->name('delete#item');
    Route::get('ajax/item/changeStatus',[PostController::class,'itemChangeStatus'])->name('ajax#changeItemStatus');
    // add item
    Route::post('add/newItem',[PostController::class,'addNewItem'])->name('add#newItem');

    // profile
    Route::get('profile',[AuthController::class,'profile'])->name('profile');
    Route::post('profile/update',[AuthController::class,'updateProfile'])->name('profile#update');

    // category
    Route::get('category/page',[CategoryController::class,'categoryPage'])->name('category');
    Route::get('category/addPage',[CategoryController::class,'categoryAddPage'])->name('category#addPage');
    Route::post('category/add',[CategoryController::class,'addCategory'])->name('category#add');
    Route::get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('category#delete');
    Route::get('category/editPage/{id}',[CategoryController::class,'categoryEditPage'])->name('category#editPage');
    Route::post('category/update',[CategoryController::class,'categoryUpdate'])->name('category#update');
    // ajax
    Route::get('ajax/category/changeStatus',[CategoryController::class,'categoryChangeStatus'])->name('ajax#changeCategoryStatus');

});
