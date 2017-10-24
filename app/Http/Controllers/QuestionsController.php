<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionsController extends Controller
{

	public function show($id)
	{
		$question = Question::findOrFail($id);
		return view('admin.answers.index', compact('question'));
	}

    public function create($id)
    {
    	return view('admin.questions.create', compact('id'));
    }

    public function save(Request $request, $id)
    {
    	$this->validate($request, [
    		'question' => 'required',
    		'type' => 'required',
    		'time' => 'required|integer',
    		'exam_id' => 'required',
    	]);
		$question = Question::create($request->all());
		return redirect()->route('questions.answer', $question->id)->with('message', 'Question added successfully');
    }
}
