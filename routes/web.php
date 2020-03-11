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

// Landing Page Routes
Route::get('/', 'IndexController@index');

// Authentication Routes
Auth::routes();

// Everyone's Actions
Route::get('/home', 'HomeController@index')->name('home');
Route::get('file/history/{history}', 'HistoryController@index')->name('history');

// User Actions
Route::post('file/upload', 'User\FileActionController@store')->name('upload-action');

// Admin Actions
Route::get('file/pending', 'Admin\MatchPendingController@index')->name('upload-pending');
Route::put('file/pending/{id}', 'Admin\MatchPendingController@match')->name('match-pending');

Route::get('file/disapproved/', 'Admin\DisapprovedController@index')->name('view-disapproved');

Route::get('file/approved/', 'Admin\ApprovedController@index')->name('view-approved');

Route::get('users/list', 'Admin\AttachUserRoleController@index')->name('view-user');
Route::put('users/make/{id}', 'Admin\AttachUserRoleController@user')->name('attach-user');
Route::put('users/admin/{id}', 'Admin\AttachUserRoleController@admin')->name('attach-admin');
Route::put('users/verifier/{id}', 'Admin\AttachUserRoleController@verifier')->name('attach-verifier');

// Verifier Actions
Route::get('file/completed', 'Verifier\CompletedController@index')->name('action-completing');
Route::put('file/completed/approved/{id}', 'Verifier\CompletedController@approve')->name('action-approve');
Route::put('file/completed/disapproved/{id}', 'Verifier\CompletedController@disapprove')->name('action-disapprove');
