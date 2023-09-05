<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PublishersConrller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('dashboard');
});


Route::get('/', [GalleryController::class , 'index'])->name('gallery.index');
Route::get('/search',[GalleryController::class , 'search'] )->name('search');

Route::get('/book/{book}', [BooksController::class , 'details'])->name('book.details');
Route::get('/category/{category}' , [CategoriesController::class , 'result'])->name('category.books.show');

Route::get('/categories' , [CategoriesController::class , 'list'])->name('all_categories');
Route::get('categories/search' , [CategoriesController::class , 'search'])->name('gallery.category.search');

Route::get('/publishers' , [PublishersConrller::class , 'list'])->name('gallery.publishers');
Route::get('/publishers/{publisher}' , [PublishersConrller::class , 'result'])->name('gallery.publisher.show');
Route::get('publishers/search' , [PublishersConrller::class , 'search'])->name('gallery.publisher.search');

Route::get('/authors',[AuthorsController::class , 'list'])->name('gellery.authors');
Route::get('/authors/{author}' , [AuthorsController::class , 'result'])->name('gallery.author.show');
Route::get('/author/search' , [AuthorsController::class , 'search'])->name('gallery.author.search');

Route::get('/admin', [AdminsController::class , 'index'] )->name('admin.index')->middleware('auth');
Route::get('/admin/book' ,[BooksController::class , 'index' ])->name('book.index')->middleware('auth');

Route::resource('admin/book', BooksController::class)->middleware('auth');
Route::resource('admin/categories', CategoriesController::class)->middleware('auth');
Route::resource('admin/author', AuthorsController::class)->middleware('auth');