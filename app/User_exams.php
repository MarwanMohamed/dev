<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_exams extends Model
{
	protected $fillable = ['exam_id', 'user_id'];
}
