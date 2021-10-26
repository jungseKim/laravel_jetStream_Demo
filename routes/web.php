<?php

use App\Http\Controllers\chatController;
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

Route::post('post/store', [PostController::class, 'store']);

Route::resource('chat', chatController::class);

Route::get('index', [PostController::class, 'index'])->name('post.index');

Route::get('create', [PostController::class, 'create'])->name('post.create');

Route::get('post/{id}/show', [PostController::class, 'show'])->name('post.show');

Route::post('post/{id}/edit', [PostController::class, 'edit']);

// Route::group(['prefix'=> 'posts', 'middleware'=>['ad\dfasdfasdf']], function() {
    
// });