<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question_answers;
use App\User_answers;
use App\User_exams;
use App\Question;
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
        $exam        = Exam::findOrFail($exam_id);
        $questions   = $exam->questions->pluck('id')->toArray();
        $userAnswers = User_answers::where('user_id', auth()->user()->id)->pluck('question_id')->toArray();
        $i = 0;
        $answeredQuestionsArray = [];
        foreach ($questions as $question) {
            if(in_array($question, $userAnswers)) {
                $answeredQuestionsArray[$i] = $question;               
                $i++;
            }
        }
        $unanswered = array_diff($questions, $answeredQuestionsArray);

        if(count($unanswered) == 0)
            return 0;
        
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
        $question  = Question::findOrFail($question_id);
        $exam = Exam::findOrFail($exam_id);
        
        if ($question->type == 3) {
            $correctAnswers = Question_answers::where('question_id', $question_id)->where('is_correct',1)->get()->pluck('id')->toArray();

            if (count(array_diff($correctAnswers,$request->answer)) == 0  && count(array_diff($request->answer,$correctAnswers)) == 0) {
                $score = 1;
            } else {
                $score = 0;            
            }

            $i = 1;

            foreach ($request->answer as $k => $answer) {
                $saveAnswer = new User_answers;
                $saveAnswer->question_id = $question_id;
                $saveAnswer->user_id = auth()->user()->id;
                $saveAnswer->answer_id = $answer;
                if ($score == 1) {
                    if ($i == 1) {
                        $saveAnswer->score = 1;
                    } else {
                        $saveAnswer->score = 0;
                    }
                    $i++;
                }
                $saveAnswer->save();
            }

        }else{
            $saveAnswer = new User_answers;
            $saveAnswer->question_id = $question_id;
            $saveAnswer->user_id = auth()->user()->id;
            $answer_id = $request->input('answer');
            $is_correct = Question_answers::where('id', $answer_id)->where('question_id', $question_id)->pluck('is_correct')->first();
            $saveAnswer->answer_id = $answer_id;
            $saveAnswer->text = $request->input('text');
            if ($is_correct == 1)
                $saveAnswer->score = 1;
            $saveAnswer->save();
        }

        $question = $this->usersNextQuestion($exam_id);
        if($question ==  0) 
            return redirect()->route('exam.congratulations', $exam->id);
        

        return redirect(Url("exam/$exam->id/question/$question"));
    }

    public function renderQuestion($exam_id,$qestion_id)
    {
        $expectedQuestionId = $this->usersNextQuestion($exam_id);
        if($expectedQuestionId == 0)
        return view('exams.congratulations',compact('exam', 'expectedQuestionId'));

        if($expectedQuestionId != $qestion_id) 
            return redirect(Url("exam/$exam_id/question/$expectedQuestionId"));
        
        $question  = Question::findOrFail($qestion_id);
        $exam = $question->exam;
        return view('exams.question', compact('exam', 'question'));
    }

    public function congratulations(Exam $exam)
    {
        return view('exams.congratulations',compact('exam'));
    }

    public function userExams()
    {
        return view('exams.myExam');
    }
}