<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\User_answers;

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

    public function openQuestions()
    {
        $questions = User_answers::whereNotNull('text')->whereNull('score')->get();
        return view('admin.questions.openQuestions', compact('questions'));
    }

    public function right($id)
    {
        $question = User_answers::findOrFail($id);
        $question->score = 1;
        $question->save();
        return redirect()->back()->with('message', 'score added to studen');
    }

    public function wrong($id)
    {
        $question = User_answers::findOrFail($id);
        $question->score = 0;
        $question->save();
        return redirect()->back()->with('message', 'score added to studen');
    }
}
