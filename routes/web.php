<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PublishersConrller;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UsersController;
use App\Models\User;
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
Route::post('book/{book}/rate' , [BooksController::class , 'rate'])->name('book.rate');

Route::get('/category/{category}' , [CategoriesController::class , 'result'])->name('category.books.show');
Route::get('/categories' , [CategoriesController::class , 'list'])->name('all_categories');
Route::get('categories/search' , [CategoriesController::class , 'search'])->name('gallery.category.search');

Route::get('/publishers' , [PublishersConrller::class , 'list'])->name('gallery.publishers');
Route::get('/publishers/{publisher}' , [PublishersConrller::class , 'result'])->name('gallery.publisher.show');
Route::get('publishers/search' , [PublishersConrller::class , 'search'])->name('gallery.publisher.search');

Route::get('/authors',[AuthorsController::class , 'list'])->name('gellery.authors');
Route::get('/authors/{author}' , [AuthorsController::class , 'result'])->name('gallery.author.show');
Route::get('/author/search' , [AuthorsController::class , 'search'])->name('gallery.author.search');

Route::prefix('/admin')->middleware('can:update-book')->group(function(){

    Route::get('/', [AdminsController::class , 'index'] )->name('admin.index')->middleware('can:update-book');
    // Route::get('/admin/book' ,[BooksController::class , 'index' ])->name('book.index')->middleware('can:update-book');
    Route::resource('/book', BooksController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/authors', AuthorsController::class);
    Route::resource('/publishers' , PublishersConrller::class);
    Route::resource('/users' , UsersController::class)->middleware('can:update-user');
});

Route::post('/cart' ,[CartController::class , 'addTocart'] )->name('cart.add');
Route::get('/cart' , [CartController::class , 'veiwCart'])->name('cart.view');
Route::post('/cart/{book}' , [CartController::class , 'removeOne'])->name('cart.removeOne');
Route::post('/carts/{book}' , [CartController::class , 'removeAll'])->name('cart.remaveAll');

Route::get('/checkout' , [PurchaseController::class , 'CreditCheckout'])->name('credit.checkout');
Route::post('/checkout' , [PurchaseController::class , 'purchase'])->name('products.purchase');

Route::get('myproducts' , [PurchaseController::class , 'myProduct'])->name('my.product');

