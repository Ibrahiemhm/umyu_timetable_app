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

    // Exam Timetable Route
    Route::get('exam-timetable/view', 'ExamTimetableController@showTimetable')->name('exam-timetable.view');
    Route::resource('exam-timetable', 'ExamTimetableController');
    Route::post('exam-timetable/check-duplicates', 'ExamTimetableController@checkForDuplicates')->name('exam-timetable.checkDuplicates');

    // Lecture Timetable Route
    Route::get('lecture-timetable/view', 'LectureTimetableController@showTimetable')->name('lecture-timetable.view');
    Route::resource('lecture-timetable', 'LectureTimetableController');
    Route::post('lecture-timetable/check-duplicates', 'LectureTimetableController@checkForDuplicates')->name('lecture-timetable.checkDuplicates');

});
