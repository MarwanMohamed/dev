<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = ['question', 'time', 'exam_id', 'type'];

	public function answers()
	{
		return $this->hasMany(Question_answers::class);
	}
	
	public function exam()
	{
		return $this->belongsTo('App\Exam','exam_id');
	}

	public function userAnswers()
	{
		return $this->hasMany(User_answers::class)->where('score', 1)->get();
	}

	public function answersByUser($id)
	{
		return $this->hasMany(User_answers::class)->where('user_id', $id)->get();
	}
}
