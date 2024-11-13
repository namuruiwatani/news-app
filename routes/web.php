<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TopicController as AdminTopicController;
use App\Http\Controllers\ContentMaker\TopicController as ContentMakerTopicController;
use App\Http\Controllers\Client\TopicController as ClientTopicController;
use App\Http\Controllers\ContentMaker\ContentMakerController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\ContentMaker\ProfileController as ContentMakerProfileController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Client\TopicLikeController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\CommentLikeController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\ContentMaker\MakerCommentController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::post('/locale', LocaleController::class)->name('locale.change');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/welcome', [AdminController::class, 'welcome'])->name('admin.welcome');
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('admin.profile.show');
        Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

        Route::resource('topics', AdminTopicController::class)->except(['show']);
        Route::get('/topics', [AdminTopicController::class, 'index'])->name('admin.topics.index');
        Route::get('/topics/create', [AdminTopicController::class, 'create'])->name('admin.topics.create');
        Route::post('/topics', [AdminTopicController::class, 'store'])->name('admin.topics.store');
        Route::get('/topics/{id}', [AdminTopicController::class, 'showTopic'])->name('admin.topics.show');
        Route::get('/topics/{topic}/edit', [AdminTopicController::class, 'edit'])->name('admin.topics.edit');
        Route::put('/topics/{topic}', [AdminTopicController::class, 'update'])->name('admin.topics.update');
        Route::delete('/topics/{topic}', [AdminTopicController::class, 'destroy'])->name('admin.topics.destroy');

        Route::get('/topics/{topic}', [AdminCommentController::class, 'show'])->name('admin.topics.show');
        Route::post('/topics/{topic}/comments', [AdminCommentController::class, 'store'])->name('admin.comments.store');
        Route::put('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('admin.comments.approve');
        Route::put('/comments/{comment}/reject', [AdminCommentController::class, 'reject'])->name('admin.comments.reject');
        Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');

        Route::resource('users', UserController::class)->only(['index', 'destroy'])->names('admin.users');
        Route::put('users/{user}/restore', [UserController::class, 'restore'])->name('admin.users.restore');
        Route::put('users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('admin.users.toggle-role');

        Route::get('/tags', [TagController::class, 'index'])->name('admin.tags.index');
        Route::post('/tags', [TagController::class, 'store'])->name('admin.tags.store');
        Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('admin.tags.destroy');

        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    Route::prefix('content-maker')->group(function () {
        Route::get('/welcome', [ContentMakerTopicController::class, 'index'])->name('content-maker.welcome');
        Route::get('/topics', [ContentMakerTopicController::class, 'index'])->name('content-maker.topics.index');
        Route::get('/topics/create', [ContentMakerTopicController::class, 'create'])->name('content-maker.topics.create');
        Route::post('/topics', [ContentMakerTopicController::class, 'store'])->name('content-maker.topics.store');
        Route::get('/topics/{topic}', [ContentMakerTopicController::class, 'show'])->name('content-maker.topics.show');
        Route::get('/topics/{topic}/edit', [ContentMakerTopicController::class, 'edit'])->name('content-maker.topics.edit');
        Route::put('/topics/{topic}', [ContentMakerTopicController::class, 'update'])->name('content-maker.topics.update');
        Route::delete('/topics/{topic}', [ContentMakerTopicController::class, 'destroy'])->name('content-maker.topics.destroy');

        Route::get('/profile', [ContentMakerProfileController::class, 'show'])->name('content-maker.profile.show');
        Route::post('/profile/update', [ContentMakerProfileController::class, 'update'])->name('content-maker.profile.update');

        Route::get('/topics/{topic}', [MakerCommentController::class, 'show'])->name('content-maker.topics.show');
        
        Route::post('/topics/{topic}/comments', [MakerCommentController::class, 'store'])->name('content-maker.comments.store');
    });

    Route::prefix('client')->group(function () {
        Route::get('/news', [ClientTopicController::class, 'index'])->name('client.topics.index');
        Route::get('/news/{id}', [ClientTopicController::class, 'show'])->name('client.topics.show');

        Route::post('/topics/{id}/like', [TopicLikeController::class, 'like'])->name('client.topics.like');
        Route::post('/topics/{id}/dislike', [TopicLikeController::class, 'dislike'])->name('client.topics.dislike');

        Route::get('/profile', [ClientProfileController::class, 'show'])->name('client.profile.show');
        Route::post('/profile/update', [ClientProfileController::class, 'update'])->name('client.profile.update');

        Route::get('/topics/{topic}', [CommentController::class, 'show'])->name('client.topics.show');
        Route::post('/topics/{topic}/comments', [CommentController::class, 'store'])->name('client.comments.store');

        Route::post('/comments/{comment}/like', [CommentLikeController::class, 'like'])->name('client.comments.like');
        Route::post('/comments/{comment}/dislike', [CommentLikeController::class, 'dislike'])->name('client.comments.dislike');

        Route::post('/topics/{id}/favorite', [ClientTopicController::class, 'toggleFavorite'])->name('topics.toggleFavorite');
        Route::get('/favorites', [ClientTopicController::class, 'favorites'])->name('topics.favorites');

        Route::get('/search/topic', [SearchController::class, 'searchTopicsForm'])->name('client.search.topics');
        Route::get('/search/category', [SearchController::class, 'searchCategoriesForm'])->name('client.search.categories');

        Route::get('/search/topic/result', [SearchController::class, 'searchTopics'])->name('client.search.topics.result');
        Route::get('/search/category/result', [SearchController::class, 'searchCategories'])->name('client.search.categories.result');
    });
});
