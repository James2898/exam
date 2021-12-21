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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamineeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AdminExamController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\CriteriaController;

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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
        Route::get('/examinees/approve/{id}',[ExamineeController::class,'approve'])->name('examinees.approve');

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

        // Questions
        Route::get('/questions/identification/{id}',[QuestionController::class, 'identification'])->name('questions.identification');
        Route::get('/questions/multiple/{id}',[QuestionController::class, 'multiple'])->name('questions.multiple');
        Route::get('/questions/view',[QuestionController::class, 'view'])->name('questions.view');
        Route::get('/questions/add/{id}',[QuestionController::class, 'create'])->name('questions.create');
        Route::post('/questions/add',[QuestionController::class, 'store'])->name('questions.store');
        Route::get('/questions/edit/{id}',[QuestionController::class, 'edit'])->name('questions.edit');
        Route::put('/questions/edit',[QuestionController::class, 'update'])->name('questions.update');
        Route::get('/questions/delete/{id}',[QuestionController::class, 'delete'])->name('questions.delete');

        Route::get('/admin/exam',[AdminExamController::class, 'index'])->name('admin.exams');
        Route::get('/admin/exam/forms/{id}',[AdminExamController::class, 'forms'])->name('admin.exams.forms');
        Route::get('/admin/exam/toggle',[AdminExamController::class, 'toggleAssign'])->name('admin.exams.toggleAssign');
        Route::get('/admin/exam/add',[AdminExamController::class, 'create'])->name('admin.exams.create');
        Route::post('/admin/exam/add',[AdminExamController::class, 'store'])->name('admin.exams.store');
        Route::get('/admin/exam/edit/{id}',[AdminExamController::class, 'edit'])->name('admin.exams.edit');
        Route::put('/admin/exam/edit',[AdminExamController::class, 'update'])->name('admin.exams.update');
        Route::get('/admin/exam/toggleExaminee',[AdminExamController::class, 'toggleExaminee'])->name('admin.exams.toggleExaminee');
        Route::get('/admin/exam/{id}',[AdminExamController::class, 'delete'])->name('admin.exams.delete');
        Route::get('/admin/exam/examinees/{exam_id}',[AdminExamController::class, 'exam_examinees'])->name('admin.exams.exam_examinees');
        //Results
        Route::get('/results/{id}',[AdminExamController::class, 'results'])->name('exam.results');
        Route::get('/publish/{id}',[AdminExamController::class, 'publish'])->name('admin.exams.publish');
        Route::get('/examinee/results/{id}',[ExamineeController::class, 'examinee_results'])->name('examinee.results');

        Route::get('/criterias',[CriteriaController::class,'index'])->name('criterias');
        Route::get('/criterias/edit',[CriteriaController::class,'edit'])->name('criterias.edit');
        Route::post('/criterias/update',[CriteriaController::class,'update'])->name('criterias.update');
    });

    Route::group(['middleware' => 'role:2'], function() {
        // Examinee
        Route::get('/exams',[ExamController::class, 'index'])->name('exams');
        Route::get('/exams/answer/',[ExamController::class, 'answer'])->name('exams.answer');
        Route::get('/exams/{id}',[ExamController::class, 'questions'])->name('exams.questions');
    });

});

require __DIR__.'/auth.php';
