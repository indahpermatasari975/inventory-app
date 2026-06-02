<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Route::get('/products', [ProductController::class, 'index']);

// Route untuk testing insert dan delete
// Route::get('/insert', [ProductController::class, 'insert']);
// Route::get('/delete/{id}', [ProductController::class, 'delete']);

// Route CRUD manual
// Route::get('/create', [ProductController::class, 'create']);
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.manual'])->group(function () {

    // Semua user yang sudah login bisa melihat data
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    // Hanya admin yang boleh CRUD
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('products', ProductController::class)
            ->except(['index']);

        Route::resource('categories', CategoryController::class)
            ->except(['index']);
    });
});
