<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question_answers;
use App\Question;
use App\Exam;
use App\User;

class AnswerController extends Controller
{
    public function create($id)
    {
        $question = Question::findOrFail($id);
      
        if ($question->type == 1) {
            if(count($question->answers) == 2) {
                return redirect()->back()->with('message', 'True or False cant add more than 2 answers');
            }
        } elseif($question->type == 5) {
            return redirect()->back()->with('message', 'Cannot add answer for open question type');
        }
    	return view('admin.answers.create', compact('id', 'question'));
    }

    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'answer' => 'required',
            'question_id' => 'required',
        ]);

        $question = Question::findOrFail($id);
        if ($question->type != 3) {
            foreach ($question->answers as $answer) {
                if ($answer->is_correct == 1 && $request->input('is_correct') !== null) {
                    return redirect()->back()->with('message', 'cannot add two is correct in one question');
                }
            }
        }
        
        Question_answers::create($request->all());
		return redirect()->route('questions', $request->input('question_id'))->with('message', 'Answer added successfully');
    }

    public function usersAnswers($exam_id, $user_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $user = User::findOrFail($user_id);

        foreach($exam->questions as $question) {
            foreach($question->answersByUser($user_id) as $answer)
            {
                // dd($answer->answer);
            }
    
        }
        return view('admin.answers.usersAnswers', compact('exam', 'user'));
    }
}
