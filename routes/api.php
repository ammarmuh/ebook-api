<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('Book', BookController::class)-> except('create','edit');
    Route::POST('/books', [BookController::class, 'store']);


Route::PUT('/books/{id}', [BookController::class, 'update']);

Route::DELETE('/books/{id}', [BookController::class, 'delete']);
Route::POST('/author', [AuthorController::class, 'store']);

Route::PUT('author/{id}', [AuthorController::class, 'update']);
Route::DELETE('author/{id}', [AuthorController::class, 'destroy']);

});


Route::GET('/books', [BookController::class, 'index']);


// AuthorController
Route::GET('/author', [AuthorController::class, 'index']);
Route::GET('author/{id}', [AuthorController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

