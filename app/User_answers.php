<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_answers extends Model
{
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
}
