<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    PostController,
    UserController,
    CommentsController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix("posts")->group(function () {
    Route::name("posts.")->group(function () {
        Route::post("/", [PostController::class, 'store']);
        Route::get("/{post_id}/comments", [PostController::class, 'getComments'])->name("comments");
    });
});

Route::prefix("comments")->group(function () {
    Route::name("comments.")->group(function () {
        Route::post("/", [CommentsController::class, 'store']);
    });
});

Route::prefix("feed")->group(function () {
    Route::name("feed.")->group(function () {
        Route::get("/", [HomeController::class, 'feed']);
    });
});

Route::prefix("users")->group(function () {
    Route::name("users.")->group(function () {
        Route::get("/profiles", [UserController::class, 'index']);
        Route::post("/{user_id}/follow", [UserController::class, 'follow']);
        Route::post("/{user_id}/unfollow", [UserController::class, 'unfollow']);
    });
});

Route::get("/user", [UserController::class, "show"]);