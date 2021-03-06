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
Route::get('/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return 'Cleared!';
});
Route::get('/', "QuestionsController@index");

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();



//answer Route start
//Route::post('questions/{question}/answers','AnswerConrtoller@store')->name('answers.store');
//Answer Resource ,this  is nested resoure route
Route::resource('questions.answers','AnswerController')->except(['create','show']);
//the artisan command php artisan make:controller AnswerController -r -m Answer
//answer route end

//Question route
Route::resource('questions','QuestionsController')->except('show');
Route::get('/questions/{slug}','QuestionsController@show')->name('questions.show');
//Question route end

//Answer accepted
Route::post('/answers/{answer}/accept','AcceptAnswerController')->name('answers.accept');
//end answer accepted

//Favorite
Route::post('/questions/{question}/favorites','FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorites','FavoritesController@destroy')->name('questions.unfavorite');
//endFavorite

//vote question
Route::post('/questions/{question}/vote','VoteQuestionController');

//end vote question

//vote answer
Route::post('/answers/{answer}/vote','VoteAnswerController');
//end vote answer
