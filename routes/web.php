<?php

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
Route::redirect('/', '/login');

Auth::routes();

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('users', 'UsersController');
    Route::resource('faculties', 'FacultiesController');
    Route::resource('departments', 'DepartmentsController');
    Route::resource('semesters', 'SemestersController');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
