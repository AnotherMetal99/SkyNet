<?php
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PostLikeController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['guest'])->get('/', [WelcomeController::class, 'show'])->name('welcome');


    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard.index');

    Route::get('profile/{user:username}', [ProfileController::class, 'show'])->middleware('auth')->name('profiles.show');

    Route::get('members', [MemberController::class, 'index'])->middleware('auth')->name('members.index');

    Route::prefix('posts')->middleware('auth')->name('posts.')->group(function() {
        Route::post('', [PostController::class, 'store'])->middleware('auth')->name('store');
        Route::delete('/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('destroy');
    });

    Route::prefix('comments')->middleware('auth')->name('comments.')->group(function() {
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('store');
        Route::delete('/{post}/comments', [CommentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('comment-like')->middleware('auth')->name('comment-like.')->group(function() {
        Route::post('/{comment}', [CommentLikeController::class, 'store'])->name('store');
        Route::delete('/{comment}', [CommentLikeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('friends')->middleware('auth')->name('friends.')->group(function() {
        Route::get('', [FriendController::class, 'index'])->name('index');
        Route::post('/{user}', [FriendController::class, 'store'])->name('store');
        Route::patch('/{user}', [FriendController::class, 'update'])->name('update');
        Route::get('/{user}', [FriendController::class, 'deny'])->name('deny');
        Route::delete('/{user}', [FriendController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('post-like')->middleware('auth')->name('post-like.')->group(function() {
        Route::post('/{post}', [PostLikeController::class, 'store'])->name('store');
        Route::delete('/{post}', [PostLikeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('chat/chats')->middleware('auth')->name('chat-chats.')->group(function() {
        Route::get('', [ChatController::class, 'index'])->name('index');
        Route::get('/{chat:slug}', [ChatController::class, 'show'])->name('show');
        Route::post('/{chat:slug}', [ChatController::class, 'update'])->name('update');
        Route::post('/{chat:slug}/messages', [ChatController::class, 'store'])->name('store');
    });


    





