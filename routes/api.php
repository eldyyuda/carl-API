<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ArticleController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('articles/{article}', [ArticleController::class, 'show']);
Route::get('articles', [ArticleController::class, 'index']);
// Route::prefix('api')->group(function () {
Route::post('register', [RegisterController::class, '__invoke']);
Route::post('login', [LoginController::class, '__invoke']);
Route::post('logout', [LogoutController::class, '__invoke']);
Route::get('user', [UserController::class, '__invoke']);
// });

Route::middleware('auth:api')->group(function () {
    Route::post('create-new-article', [ArticleController::class, 'store']);
    Route::patch('update-the-selected-article/{article}', [ArticleController::class, 'update']);
    Route::delete('delete-the-selected-article/{article}', [ArticleController::class, 'destroy']);
});
