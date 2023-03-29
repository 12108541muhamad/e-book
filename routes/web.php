<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

// Route::get('/', function () {
//     return view('index');
// });

// Admin
Route::middleware('isLogin', 'cekRole')->group(function () {
    Route::get('/page', [BookController::class, 'page'])->name('/page');
    Route::get('/admin', [BookController::class, 'admin'])->name('/admin');
    // Ditambah /admin jika ingin memanggil child / route yang ada didalamnya
    Route::middleware('isLogin', 'cekRole')->prefix('/admin')->group(function () {
        Route::get('/category', [BookController::class, 'category'])->name('/category');
        Route::post('/category', [BookController::class, 'categoryCreate'])->name('categoryCreate');
        Route::get('/user', [BookController::class, 'user'])->name('/user');
        Route::get('/book', [BookController::class, 'book'])->name('/book');
        Route::get('/bookCreate', [BookController::class, 'bookCreate'])->name('/bookCreate');
        Route::post('/bookCreate', [BookController::class, 'bookPost'])->name('bookCreate.post');
        Route::delete('/delete/{id}', [BookController::class, 'delete'])->name('delete');
        Route::delete('/deleteCategory/{id}', [BookController::class, 'deleteCategory'])->name('deleteCategory');
        Route::delete('/deleteBook/{id}', [BookController::class, 'deleteBook'])->name('deleteBook');
        Route::get('/edit/{id}', [BookController::class, 'editUser'])->name('editUser'); 
        Route::patch('/edit/{id}', [BookController::class, 'updateUser'])->name('updateUser');
        Route::get('/header', [BookController::class, 'header'])->name('/header');  
        Route::patch('/updateHeader/{id}', [BookController::class, 'updateHeader'])->name('updateHeader');
    });
});


// Belum Login
Route::middleware('isLogin')->group(function () {
    Route::get('/library', [BookController::class, 'library'])->name('library');
    Route::get('/library {category?}', [BookController::class, 'libraryCategory'])->name('library.category');
});

// Udah Login
Route::middleware('isGuest')->group(function () {
    Route::get('/login', [BookController::class, 'login'])->name('/login'); // Tidak bisa akses login
    Route::post('/login', [BookController::class, 'loginAuth'])->name('loginAuth');
    
    Route::get('/register', [BookController::class, 'register'])->name('/register');
    Route::post('/register', [BookController::class, 'registerPost'])->name('registerPost');
});

// Tidak berpengaruh untuk semua yang menggunakan Middleware
Route::get('/', [BookController::class, 'index'])->name('/');
Route::get('error', [BookController::class, 'error'])->name('error');
Route::get('/logout', [BookController::class, 'logout'])->name('/logout');
Route::get('/search', [BookController::class, 'search'])->name('search');