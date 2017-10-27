<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exam;
use App\User;

class ExamController extends Controller
{
	public function index()
	{
		$exams = Exam::orderBy('id', 'Desc')->get();
    	return view('admin.exams.index', compact('exams'));
	}

	public function show($id)
	{
        $exam = Exam::findOrFail($id);
    	return view('admin.questions.index', compact('exam'));
	}

    public function create()
    {
    	return view('admin.exams.create');
    }

    public function save(Request $request)
    {
    	$this->validate($request, ['name' => 'required']);
		$exam = Exam::create($request->all());
		return redirect()->route('questions.create', $exam->id)->with('message', 'Exam added successfully');
    }

    public function users($id)
    {
        $exam = Exam::findOrFail($id);
        $users = $exam->users;
        return view('admin.exams.users', compact('exam', 'users'));
    }
}
