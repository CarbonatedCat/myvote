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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/voter', 'VoterController@index')->name('voter')->middleware('voter');
Route::get('/candidate', 'CandidateController@index')->name('candidate')->middleware('candidate');
Route::resource('profile','ProfileController');
Route::resource('candidate_list','CandidateListController');
Route::resource('election','ElectionController');
Route::resource('vote','VoteController');
