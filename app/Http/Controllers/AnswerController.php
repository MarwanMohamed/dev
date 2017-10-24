<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question_answers;

class AnswerController extends Controller
{
    public function create($id)
    {
    	return view('admin.answers.create', compact('id'));
    }

    public function save(Request $request, $id)
    {
    	$this->validate($request, [
    		'answer' => 'required',
    		'question_id' => 'required',
    	]);
		Question_answers::create($request->all());

		return redirect()->route('questions', $request->input('question_id'))->with('message', 'Answer added successfully');
    }
}
