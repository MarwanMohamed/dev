<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question_answers;
use App\User_answers;
use App\User_exams;
use App\Exam;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $exams = Exam::orderBy('id', 'DESC')->get();
        return view('home', compact('exams'));
    }

    public function start($id)
    {
        $exam = Exam::findOrFail($id);
        $examBefore = User_exams::where('exam_id', $id)->where('user_id',  auth()->user()->id)->first();
        if (! $examBefore) {
            User_exams::create(['exam_id' => $id, 'user_id' => auth()->user()->id]);
        }
        return view('exams.start', compact('exam'));
    }

    public function usersNextQuestion($exam_id)
    {
        $exam           = Exam::findOrFail($exam_id);
        $questions      = $exam->questions->pluck('id')->toArray(); //array of que. IDs
        $userAnswers    = User_answers::where('user_id', auth()->user()->id)->pluck('question_id');

        
        $userAnswersArray = $userAnswers->toArray();
        //check if user answers array have elements of questions IDs Array
        $i                      = 0;
        $answeredQuestionsArray = [];
        foreach ($questions as $question) {
            if(in_array($question,$userAnswers->toArray()))
            {
                $answeredQuestionsArray[$i] = $question;               
                $i++;
            }
        }
        $unanswered = array_diff($questions,$answeredQuestionsArray);
        if(count($unanswered) == 0 )
            return  0;//redirect(Url('exam/'.$exam->id.'/congratulations'));
        //now we need to remove the answered questions from questions array
        return array_values($unanswered)[0];
    }

    public function renderExam($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $question = $exam->questions()->first();

        return view('exams.question', compact('exam', 'question'));
    }

    public function saveQuestion(Request $request, $exam_id,$question_id)
    {
        $exam = Exam::findOrFail($exam_id);
        //$question_id = $request->input('question_id');
        $answer_id = $request->input('answer');
        $is_correct = Question_answers::where('id', $answer_id)->where('question_id', $question_id)->pluck('is_correct')->first();
        $saveAnswer = new User_answers;
        $saveAnswer->question_id = $question_id;
        $saveAnswer->answer_id = $answer_id;
        $saveAnswer->user_id = auth()->user()->id;
        $saveAnswer->text = $request->input('text');

        if ($is_correct == 1) {
            $saveAnswer->score = 1;
        }
        $saveAnswer->save();
        $question = $this->usersNextQuestion($exam_id);
        if($question ==  0)
        {
            return redirect(Url('exam/'.$exam->id.'/congratulations'));
        }
        return redirect(Url("exam/$exam->id/question/$question"));
    }

    public function renderQuestion($exam_id,$qestion_id)
    {
        $expectedQuestionId = $this->usersNextQuestion($exam_id);
        if($expectedQuestionId != $qestion_id)
        {
            return redirect(Url("exam/$exam_id/question/$expectedQuestionId"));
        }

        $question           = \App\Question::findOrFail($qestion_id);
        $exam               = $question->exam;
        return view('exams.question', compact('exam', 'question'));
    }

    public function nextQuestion($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $oldQuestions = User_answers::where('user_id', auth()->user()->id)->get()->pluck('question_id');
        return $exam->questions()->whereNotIn('id', $oldQuestions)->first();
    }

    public function congratulations(Exam $exam)
    {
        return view('exams.congratulations',compact('exam'));
    }

    public function userExams()
    {
        $exams = auth()->user()->exams;
        return view('exams.myExam', compact('exams'));
    }
}