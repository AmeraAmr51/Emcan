<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Response;
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

Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login']);

//-------------------Admin Reouts----------------------------

Route::middleware('checkRole:Admin')->group(function () {
    Route::post('/posts', [PostsController::class, 'getAllPosts']);
    Route::post('/comments', [CommentController::class, 'getAllComments']);
    Route::post('/users', [UserController::class, 'getUsers']);

    
});

//-------------------Auther Reouts----------------------------

Route::middleware('checkRole:Auther')->group(function () {

    //-------------------Posts Reout----------------------------

    Route::get('/posts/{user_id}', [PostsController::class, 'getAllPostByUser']);
    Route::Post('post', [PostsController::class, 'create']);
    Route::post('post/del/{id}', [PostsController::class, 'delete']);
    Route::post('post/edit/{id}', [PostsController::class, 'update']);


//-------------------Comments Reout----------------------------
    Route::get('/comments/{user_id}', [CommentController::class, 'getAllCommentByUser']);
    Route::Post('/comment', [CommentController::class, 'create']);
    Route::post('comment/edit/{id}', [CommentController::class, 'update']);
    Route::post('comment/del/{id}', [CommentController::class, 'delete']);



   
});
