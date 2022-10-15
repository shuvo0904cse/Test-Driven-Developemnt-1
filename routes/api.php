<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(BookController::class)->group(function(){
    Route::get("books", 'index')->name("books.index");
    Route::get("books/{book}", 'show')->name("books.show");
    Route::post("books", 'store')->name("books.store");
    Route::put("books/{book}", 'update')->name("books.update");
    Route::delete("books/{book}", 'destroy')->name("books.destroy");
});


Route::controller(AuthorController::class)->group(function(){
    Route::get("authors", 'index')->name("authors.index");
    Route::get("authors/{book}", 'show')->name("authors.show");
    Route::post("authors", 'store')->name("authors.store");
    Route::put("authors/{author}", 'update')->name("authors.update");
    Route::delete("authors/{author}", 'destroy')->name("authors.destroy");
});

