<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;

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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//
//});
//
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);


Route::group(['middleware'=>'auth:api'],function (){

    Route::get('user/{user_id?}', [UserController::class,'getUser']);
    Route::post('user', [UserController::class,'postUser']);
    Route::put('user/{user_id?}', [UserController::class,'putUser']);
    Route::delete('user', [UserController::class,'deleteUser']);

    Route::get('profile/{id?}',[UserController::class,'profile']);

   Route::get('post/{post_id?}', [PostController::class,'getPost']);
    Route::post('post', [PostController::class,'addPost']);
   Route::put('post/{post_id?}', [PostController::class,'editPost']);
   Route::delete('post', [PostController::class,'deletePost']);
    Route::get('timeLine',[PostController::class,'timeLine']);

    Route::get('comment/{comment_id?}', [CommentController::class,'getComment']);
    Route::post('comment', [CommentController::class,'addComment']);
    Route::put('comment/{comment_id?}', [CommentController::class,'editComment']);
    Route::delete('comment', [CommentController::class,'deleteComment']);

    Route::get('like/{like_id?}', [LikeController::class,'getLike']);
    Route::post('like', [LikeController::class,'addLike']);
    Route::put('like/{like_id?}', [LikeController::class,'editlike']);
    Route::delete('like', [LikeController::class,'deleteLike']);

});
