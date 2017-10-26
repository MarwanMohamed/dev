@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Exam</div>

                <div class="panel-body">
                    @if(isset($expectedQuestionId) && $expectedQuestionId == 0)
                        <p>you have finished the exam Before </p>
                    @else
                        <p>Congratulations you have finished the exam {{$exam->name}} </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


