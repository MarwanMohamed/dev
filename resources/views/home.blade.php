@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Take Exam</div>

                <div class="panel-body">
                    <ul>
                        @if(count($exams) == 0 )
                            <p>no exams available now</p>
                        @else
                            @foreach($exams as $exam)
                                <li>
                                    <a href="{{route('start', $exam->id)}}">{{$exam->name}}</a>
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
