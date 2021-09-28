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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('/tasks', 'TaskController');
Route::resource('/customers', 'CustomerController');
Route::resource('/projects', 'ProjectController');
Route::resource('/users', 'UserController');

/* TASK */
Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::get('/tasks/create', 'TaskController@create')->middleware(['auth'])->name('tasks.create');
Route::post('/tasks/create', 'TaskController@store')->middleware(['auth'])->name('tasks.create.store');
Route::get('/tasks/{id}edit', 'TaskController@edit')->middleware(['auth'])->name('tasks.edit');
Route::post('/tasks/{id}/edit', 'TaskController@update')->middleware(['auth'])->name('tasks.edit.update');
Route::post('/tasks/{id}', 'TaskController@destroy')->middleware(['auth'])->name('tasks.destroy');

/* CUSTOMER */
Route::get('/customers', 'CustomerController@index')->name('customers');;
Route::get('/customers/create', 'CustomerController@create')->middleware(['auth'])->name('customers.create');
Route::post('/customers/create', 'CustomerController@store')->middleware(['auth'])->name('customers.create.store');
Route::get('/customers/{id}edit', 'CustomerController@edit')->middleware(['auth'])->name('customers.edit');
Route::post('/customers/{id}/edit', 'CustomerController@update')->middleware(['auth'])->name('customers.edit.update');
Route::post('/customers/{id}', 'CustomerController@destroy')->middleware(['auth'])->name('customers.destroy');

/* PROJECT */
Route::get('/projects', 'ProjectController@index')->name('projects');;
Route::get('/projects/create', 'ProjectController@create')->middleware(['auth'])->name('projects.create');
Route::post('/projects/create', 'ProjectController@store')->middleware(['auth'])->name('projects.create.store');
Route::get('/projects/{id}edit', 'ProjectController@edit')->middleware(['auth'])->name('projects.edit');
Route::post('/projects/{id}/edit', 'ProjectController@update')->middleware(['auth'])->name('projects.edit.update');
Route::post('/projects/{id}', 'ProjectController@destroy')->middleware(['auth'])->name('projects.destroy');

/* USER */
Route::get('/users', 'UserController@index')->name('users');;
Route::get('/users/create', 'UserController@create')->middleware(['auth'])->name('users.create');
Route::post('/users/create', 'UserController@store')->middleware(['auth'])->name('users.create.store');
Route::get('/users/{id}edit', 'UserController@edit')->middleware(['auth'])->name('users.edit');
Route::post('/users/{id}/edit', 'UserController@update')->middleware(['auth'])->name('users.edit.update');
Route::post('/users/{id}', 'UserController@destroy')->middleware(['auth'])->name('users.destroy');

/* GLOBAL */
Route::get('/globals', 'GlobalController@index');

require __DIR__.'/auth.php';