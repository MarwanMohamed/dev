@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">My Exams</div>

                <div class="panel-body">
                    <ul>
                         @if(count(auth()->user()->exams) == 0 )
                            <p>no exams finished yet</p>
                        @else
                        @foreach(auth()->user()->exams as $exam)
                            <li>
                                {{$exam->name}} --- Score Result : 

                                @php $score = []; @endphp
                                @foreach($exam->questions as $question)
                                    @foreach($question->userAnswers as $answer)
                                        @php $score[] = $answer->score; @endphp
                                    @endforeach 
                                @endforeach 
                                {{count($score)}}/ {{count($exam->questions)}}
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
