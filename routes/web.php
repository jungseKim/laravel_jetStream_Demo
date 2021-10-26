<?php

use App\Http\Controllers\chatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\chatList;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// Route::middleware('auth')->get('room_list', [chatList::class, 'index'])
//     ->name('room.list');


// Route::resource('chat', chatController::class);
Route::post('post/store', [PostController::class, 'store']);

Route::get('post/index', [PostController::class, 'index'])->name('post.index');

Route::get('post/create', [PostController::class, 'create'])->name('post.create');

Route::get('post/{id}/show', [PostController::class, 'show'])->name('post.show');
Route::delete('post/{id}', [PostController::class, 'distroy']);

Route::post('post/{id}/edit', [PostController::class, 'edit']);

Route::post('comment/{id}', [CommentController::class, 'create']);

Route::get('comment/{id}', [CommentController::class, 'index']);

// Route::group(['prefix'=> 'posts', 'middleware'=>['ad\dfasdfasdf']], function() {

// });
