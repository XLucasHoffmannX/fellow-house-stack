<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::get('user', [UserController::class, 'get']);

Route::post('/user/register', [AuthController::class, 'store']);

/* architecture fellow */
Route::group(['prefix' => 'fellow'], function(){
    Route::resource('posts', '\App\Http\Controllers\Posts\PostsController');

    Route::resource('like', '\App\Http\Controllers\Likes\LikesController');

    Route::resource('comment', '\App\Http\Controllers\Comments\CommentsController');
});