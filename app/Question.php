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
}
