<?php

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

use App\Http\Controllers\UserController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/users',[UserController::class, 'index'])->name('users');
    Route::get('/users/add',[UserController::class, 'create'])->name('users.create');
    Route::post('/users/add',[UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/edit',[UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}',[UserController::class, 'delete'])->name('users.delete');
});

require __DIR__.'/auth.php';
