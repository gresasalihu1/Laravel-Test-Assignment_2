<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Like\LikeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\AuthController;
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

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'auth',
], function () {
    Route::get('getprofile', [AuthController::class, 'getProfile']);
    Route::post('updateprofile', [AuthController::class, 'updateProfile']);
    Route::post('updatepassword', [AuthController::class, 'updatePassword']);
    Route::apiResource('/posts', PostController::class);
    Route::apiResource('/comments', CommentController::class);
    Route::post('likes/posts/{post}', [LikeController::class, 'likePost']);
    Route::post('likes/comments/{comment}', [LikeController::class, 'likeComment']);
});
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
