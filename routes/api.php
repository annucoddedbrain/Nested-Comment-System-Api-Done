<?php
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
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

Route::post('createPost' , [PostController::class , 'createPost']);

Route::post('showPost' , [PostController::class , 'showPostDetail']);

Route::post('create' , [UserController::class , 'create']);

Route::post('find' , [UserController::class , 'index']);

Route::post('createComment' , [CommentController::class , 'createComment']);

Route::post('getAllCommentByPost_id' , [CommentController::class , 'getAllCommentByPost_id']);


Route::post('createLike' , [LikeController::class , 'createLike']);
