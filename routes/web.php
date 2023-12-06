<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('add', [AdminController::class, 'create'])->name('admin.create');
Route::post('store', [AdminController::class, 'store'])->name('admin.store');
Route::get('addgenre', [AdminController::class, 'createGenre'])->name('genre.create');
Route::post('storegenre', [AdminController::class, 'storeGenre'])->name('genre.store');
Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::patch('/admin/softDelete/{id}', [AdminController::class, 'softDelete'])->name('admin.softDelete');
Route::get('/admin/hardDeleteAll', [AdminController::class, 'hardDeleteAll'])->name('admin.hardDeleteAll');
