<?php

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
Route::get('/test', [AuthorController::class, 'test'])->name('test');
Route::get('/authors-ajax-list', [AuthorController::class, 'ajaxGetList']);
Route::get('/items-index-get', [ItemController::class, 'ajaxIndexGet']);


Route::get('/authors-select/{search}', [AuthorController::class, 'authorsSelect'])->name('authorsSelect');
Route::get('/collections-select/{search}', [ItemCollectionController::class, 'collectionsSelect'])->name('collectionsSelect');
Route::get('/subjects-select/{search}', [SubjectController::class, 'subjectsSelect'])->name('subjectsSelect');


Route::get('/', [LangController::class, 'home'])->name('home');
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');


Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/manage', [ItemController::class, 'manage'])->name('items.manage');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items/store', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}/update', [ItemController::class, 'update'])->name('items.update');
Route::put('/items/{item}/status', [ItemController::class, 'changeStatus'])->name('items.status');
Route::delete('/items/{item}/destroy', [ItemController::class, 'destroy'])->name('items.destroy');
Route::get('/items/{item}/show', [ItemController::class, 'show'])->name('items.show');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');
Route::delete('/authors/{author}/destroy', [AuthorController::class, 'destroy'])->name('authors.destroy');
Route::put('/authors/{author}/update', [AuthorController::class, 'update'])->name('authors.update');
Route::get('/authors/{author}/show', [AuthorController::class, 'show'])->name('authors.show');

Route::get('/collections', [ItemCollectionController::class, 'index'])->name('collections.index');
Route::get('/collections/create', [ItemCollectionController::class, 'create'])->name('collections.create');
Route::post('/collections/store', [ItemCollectionController::class, 'store'])->name('collections.store');
Route::get('/collections/manage', [ItemCollectionController::class, 'manage'])->name('collections.manage');
Route::put('/collections/{collection}/status', [ItemCollectionController::class, 'changeStatus'])->name('collections.status');
Route::get('/collections/{collection}/edit', [ItemCollectionController::class, 'edit'])->name('collections.edit');
Route::put('/collections/{collection}/update', [ItemCollectionController::class, 'update'])->name('collections.update');
Route::delete('/collections/{collection}/destroy', [ItemCollectionController::class, 'destroy'])->name('collections.destroy');
Route::get('/collections/{collection}/show', [ItemCollectionController::class, 'show'])->name('collections.show');


Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/manage', [UserController::class, 'manage'])->name('users.manage');
Route::put('/users/{user}/status', [UserController::class, 'changeStatus'])->name('users.status');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::post('/login', [UserController::class, 'authenticate'])->middleware('guest')->name('users.login');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('users.logout');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');


Route::get('/deletions/manage', [DeletionController::class, 'manage'])->name('deletions.manage');
Route::post('/deletions/{deletion}/restore', [DeletionController::class, 'restore'])->name('deletions.restore');
Route::delete('/deletion/{deletion}/destroy',[DeletionController::class, 'destroy'])->name('deletions.destroy');
Route::delete('/deletions/{deletion}/fullDestroy', [DeletionController::class, 'fullDestroy'])->name('deletions.fullDestroy');
Route::get('/deletions/{deletion}', [DeletionController::class, 'show'])->name('deletions.show');
