<?php

Route::middleware(['admin'])->prefix('/admin')->group(function () {
    
    Route::get('/', function(){
    	return view('admin.dashboard');
    });

	Route::get('/exams', 'ExamController@index')->name('exams.index');
	Route::get('/exam/create', 'ExamController@create')->name('create.exam');
	Route::post('/exam/create', 'ExamController@save')->name('save.exam');
	Route::get('/exam/{id}', 'ExamController@show')->name('exam');
	Route::get('/exam/{id}/users', 'ExamController@users')->name('users.list');
	Route::get('/exam/{id}/users/{uid}', 'AnswerController@usersAnswers')->name('exam.users.answers');
	Route::get('/exam/{id}/question/create', 'QuestionsController@create')->name('questions.create');
	Route::post('/exam/{id}/question/create', 'QuestionsController@save')->name('save.qestion');
	Route::get('/question/{id}/answer', 'AnswerController@create')->name('questions.answer');
	Route::post('/question/{id}/answer', 'AnswerController@save')->name('save.answer');
	Route::get('/question/{id}', 'QuestionsController@show')->name('questions');
	Route::get('/questions', 'QuestionsController@openQuestions')->name('open.qestions');
	Route::get('/questions/right/{id}', 'QuestionsController@right')->name('right.question');
	Route::get('/questions/wrong/{id}', 'QuestionsController@wrong')->name('wrong.question');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/start/exam/{id}', 'HomeController@start')->name('start');
Route::post('/exam/{id}', 'HomeController@renderExam')->name('go.exam');
Route::post('/exam/{exam_id}/{question_id}/next', 'HomeController@saveQuestion')->name('next.question');
Route::get('/exam/{exam_id}/question/{question_id}', 'HomeController@renderQuestion');
Route::get('test/{id}','HomeController@usersNextQuestion');
Route::get('exam/{exam}/congratulations','HomeController@congratulations')->name('exam.congratulations');

Route::get('/user/exam', 'HomeController@userExams')->name('user.exam');

Auth::routes();

