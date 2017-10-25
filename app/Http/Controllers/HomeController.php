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

    public function renderExam($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $question = $exam->questions()->first();

        return view('exams.question', compact('exam', 'question'));
    }

    public function saveQuestion(Request $request, $exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $question_id = $request->input('question_id');
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
        if ($saveAnswer->save()) {
            $question = $this->nextQuestion($exam_id);
        }
        if ($question) {
            return view('exams.question', compact('exam', 'question'));
        } else {

        }
    }

    public function nextQuestion($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $oldQuestions = User_answers::where('user_id', auth()->user()->id)->get()->pluck('question_id');
        return $exam->questions()->whereNotIn('id', $oldQuestions)->first();
    }
}
