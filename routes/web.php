<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DeletionController;
use App\Http\Controllers\ItemCollectionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
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
Route::group(['middleware' => 'throttle:100,1'], function() {

    Route::get('/test', [LangController::class, 'test'])->name('test');
    Route::get('/author-check/{search}', [AjaxController::class, 'checkAuthor']);
    Route::get('/subject-check/{search}', [AjaxController::class, 'checkSubject']);


    Route::get('/authors-select/{search}', [AuthorController::class, 'authorsSelect'])->name('authorsSelect');
    Route::get('/collections-select/{search}', [ItemCollectionController::class, 'collectionsSelect'])->name('collectionsSelect');
    Route::get('/subjects-select/{search}', [SubjectController::class, 'subjectsSelect'])->name('subjectsSelect');


// Home and Language Change
    Route::get('/', [LangController::class, 'home'])->name('home');
    Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');


// Item Routes

    Route::middleware('auth')->group(function () {
        Route::get('/items/manage', [ItemController::class, 'manage'])->name('items.manage');
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items/store', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item:slug}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item:slug}/update', [ItemController::class, 'update'])->name('items.update');
        Route::put('/items/{item:slug}/status', [ItemController::class, 'changeStatus'])->name('items.status');
        Route::delete('/items/{item:slug}/destroy', [ItemController::class, 'destroy'])->name('items.destroy');
    });
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/{item:slug}', [ItemController::class, 'show'])->name('items.show');


// Author Routes
    Route::middleware('auth')->group(function () {
        Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
        Route::get('/authors/{author:slug}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
        Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');
        Route::delete('/authors/{author:slug}/destroy', [AuthorController::class, 'destroy'])->name('authors.destroy');
        Route::put('/authors/{author:slug}/update', [AuthorController::class, 'update'])->name('authors.update');
    });
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');


// Collection Routes
    Route::middleware('auth')->group(function () {
        Route::get('/collections/create', [ItemCollectionController::class, 'create'])->name('collections.create');
        Route::post('/collections/store', [ItemCollectionController::class, 'store'])->name('collections.store');
        Route::get('/collections/manage', [ItemCollectionController::class, 'manage'])->name('collections.manage');
        Route::put('/collections/{collection:slug}/status', [ItemCollectionController::class, 'changeStatus'])->name('collections.status');
        Route::get('/collections/{collection:slug}/edit', [ItemCollectionController::class, 'edit'])->name('collections.edit');
        Route::put('/collections/{collection:slug}/update', [ItemCollectionController::class, 'update'])->name('collections.update');
        Route::delete('/collections/{collection:slug}/destroy', [ItemCollectionController::class, 'destroy'])->name('collections.destroy');
    });
    Route::get('/collections', [ItemCollectionController::class, 'index'])->name('collections.index');
    Route::get('/collections/{collection:slug}', [ItemCollectionController::class, 'show'])->name('collections.show');


// User Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/users/manage', [UserController::class, 'manage'])->name('users.manage');
        Route::put('/users/{user}/status', [UserController::class, 'changeStatus'])->name('users.status');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    });
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest')->name('users.login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('users.logout');


// Deletion Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/deletions/manage', [DeletionController::class, 'manage'])->name('deletions.manage');
        Route::post('/deletions/{deletion}/restore', [DeletionController::class, 'restore'])->name('deletions.restore');
        Route::delete('/deletion/{deletion}/destroy', [DeletionController::class, 'destroy'])->name('deletions.destroy');
        Route::delete('/deletions/{deletion}/fullDestroy', [DeletionController::class, 'fullDestroy'])->name('deletions.fullDestroy');
        Route::get('/deletions/{deletion}', [DeletionController::class, 'show'])->name('deletions.show');
    });
});

