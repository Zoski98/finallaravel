<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CommunityController;
use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Api\WorldController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::prefix('admin')->middleware(['auth'])->group(function() {

//     Route::get('dashboard', [UserController::class, 'index']);

// });

//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('posts', [WorldController::class, 'index']);
Route::get('posts', [FeedController::class, 'index']);
Route::get('posts', [CommunityController::class, 'index']);



//EDIT AND SHOW//



//Protecting Routes
Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group(function () {

    Route::get('/checkAuthenticated', function () {
        return response()->json(['message' => 'You are in', 'status' => 200], 200);
    });

    Route::get('world/posts', [WorldController::class, 'index']);
    Route::get('feed/posts', [FeedController::class, 'index']);
    Route::get('community/posts', [CommunityController::class, 'index']);

    Route::post('/community/create/post', [CommunityController::class, 'post']);
    Route::post('/feed/create/post', [FeedController::class, 'post']);
    Route::post('/world/create/post', [WorldController::class, 'post']);

    
    Route::delete('delete-post/{id}', [PostController::class, 'destroy']);
    Route::get('show-post/{id}', [PostController::class, 'show']);
    Route::post('/comment/{id}', [CommentController::class, 'create']);
    Route::get('show-comment/{id}', [CommentController::class, 'show']);
    Route::delete('delete-comment/{id}', [CommentController::class, 'destroy']);

    Route::put('approve/{id}', [PostController::class, 'approve']);





    Route::post('logout', [AuthController::class, 'logout']);
});




Route::middleware(['auth:sanctum', 'isAPIUser'])->group(function () {

    Route::get('/checkIfAuthenticated', function () {
        return response()->json(['message' => 'You are in', 'status' => 200], 200);
    });

    // Route::get('world/posts', [WorldController::class, 'index']);
    // Route::get('feed/posts', [FeedController::class, 'index']);
    // Route::get('community/posts', [CommunityController::class, 'index']);

    // Route::post('/community/create/post', [CommunityController::class, 'post']);
    // Route::post('/feed/create/post', [FeedController::class, 'post']);
    // Route::post('/world/create/post', [WorldController::class, 'post']);

    // Route::post('/comment/{id}', [CommentController::class, 'create']);
    // Route::delete('delete-post/{id}', [PostController::class, 'destroy']);
    // Route::get('show-post/{id}', [PostController::class, 'show']);
    // Route::get('show-comment/{id}', [CommentController::class, 'show']);

    // Route::delete('delete-comment/{id}', [CommentController::class, 'destroy']);




    Route::post('logout', [AuthController::class, 'logout']);
});















// Route::post('register',[UserController::class, 'store']);
Route::get('users', [UserController::class, 'index']);
Route::post('create-user', [UserController::class, 'store']);
Route::get('edit-user/{id}', [UserController::class, 'edit']);
Route::put('update-user/{id}', [UserController::class, 'update']);
Route::delete('delete-user/{id}', [UserController::class, 'destroy']);
