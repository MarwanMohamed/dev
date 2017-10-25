<?php

Route::middleware(['admin'])->prefix('/admin')->group(function () {
    
    Route::get('/', function(){
    	return view('admin.dashboard');
    });

	Route::get('/exams', 'ExamController@index')->name('exams.index');
	Route::get('/exam/create', 'ExamController@create')->name('create.exam');
	Route::post('/exam/create', 'ExamController@save')->name('save.exam');
	Route::get('/exam/{id}', 'ExamController@show')->name('exam');
	Route::get('/exam/{id}/question/create', 'QuestionsController@create')->name('questions.create');
	Route::post('/exam/{id}/question/create', 'QuestionsController@save')->name('save.qestion');
	Route::get('/question/{id}/answer', 'AnswerController@create')->name('questions.answer');
	Route::post('/question/{id}/answer', 'AnswerController@save')->name('save.answer');
	Route::get('/question/{id}', 'QuestionsController@show')->name('questions');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/start/exam/{id}', 'HomeController@start')->name('start');
Route::post('/exam/{id}', 'HomeController@renderExam')->name('go.exam');
Route::post('/exam/{exam_id}/{question_id}/next', 'HomeController@saveQuestion')->name('next.question');
Route::get('/exam/{exam_id}/question/{question_id}', 'HomeController@renderQuestion');
Route::get('test/{id}','HomeController@usersNextQuestion');
Route::get('exam/{exam}/congratulations','HomeController@congratulations')->name('exam.congratulations');

Auth::routes();

