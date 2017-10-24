<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question_answers extends Model
{
	protected $fillable = ['answer', 'question_id', 'is_correct'];
}
