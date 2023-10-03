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

Route::redirect('/', '/login');

Auth::routes();

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Home Controller
    Route::get('/', 'HomeController@index')->name('dashboard');
<<<<<<< Updated upstream
    Route::resource('staffs', 'StaffsController');
});
=======
>>>>>>> Stashed changes

    // Users Controller
    Route::resource('users', 'UsersController');
    
    // Beginning of Configurations Route
    Route::group(['prefix' => 'configurations'], function () {
        Route::resource('faculties', 'FacultiesController');
        Route::resource('departments', 'DepartmentsController');
        Route::resource('semesters', 'SemestersController');
        Route::resource('course-categories', 'CourseCategoriesController');
        Route::resource('academic-sessions', 'AcademicSessionsController');
    });
    // End of Configurations Route

    // Courses Route
    Route::resource('courses', 'CoursesController');

    // Venue Route
    Route::resource('venues', 'VenuesController');

    // Lectures Timetable Route
    Route::resource('lectures-timetable', 'LecturesTimetableController');

    // Exam Timetable Route
    Route::resource('exam-timetable', 'ExamTimetableController');
});