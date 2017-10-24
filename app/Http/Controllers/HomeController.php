<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::orderBy('id', 'DESC')->get();
        return view('home', compact('exams'));
    }

    public function start($id)
    {
        $exam = Exam::findOrFail($id);
        return view('exams.start', compact('exam'));
    }
}
