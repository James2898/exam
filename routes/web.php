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
use App\Http\Controllers\ExamineeController;
use App\Http\Controllers\SubjectController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('dashboard');
    });

    // Admin Only
    Route::group(['middleware' => 'role:0'], function() {
        Route::get('/users',[UserController::class, 'index'])->name('users');
        Route::get('/users/add',[UserController::class, 'create'])->name('users.create');
        Route::post('/users/add',[UserController::class, 'store'])->name('users.store');
        Route::get('/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/edit',[UserController::class, 'update'])->name('users.update');
        Route::get('/users/{id}',[UserController::class, 'delete'])->name('users.delete');
    });

    // Adming and Staff
    Route::group(['middleware' => 'role:0,1'], function() {
        // Examinee
        Route::get('/examinees',[ExamineeController::class, 'index'])->name('examinees');
        Route::get('/examinees/add',[ExamineeController::class, 'create'])->name('examinees.create');
        Route::post('/examinees/add',[ExamineeController::class, 'store'])->name('examinees.store');
        Route::get('/examinees/edit/{id}',[ExamineeController::class, 'edit'])->name('examinees.edit');
        Route::put('/examinees/edit',[ExamineeController::class, 'update'])->name('examinees.update');
        Route::get('/examinees/{id}',[ExamineeController::class, 'delete'])->name('examinees.delete');

        // Subject
        Route::get('/subjects',[SubjectController::class, 'index'])->name('subjects');
        Route::get('/subjects/view',[SubjectController::class, 'view'])->name('subjects.view');
        Route::get('/subjects/activate/{id}',[SubjectController::class, 'activate'])->name('subjects.activate');
        Route::get('/subjects/deactivate/{id}',[SubjectController::class, 'deactivate'])->name('subjects.deactivate');
        Route::get('/subjects/add',[SubjectController::class, 'create'])->name('subjects.create');
        Route::post('/subjects/add',[SubjectController::class, 'store'])->name('subjects.store');
        Route::get('/subjects/edit/{id}',[SubjectController::class, 'edit'])->name('subjects.edit');
        Route::put('/subjects/edit',[SubjectController::class, 'update'])->name('subjects.update');
        Route::get('/subjects/{id}',[SubjectController::class, 'delete'])->name('subjects.delete');
    });
});

require __DIR__.'/auth.php';
