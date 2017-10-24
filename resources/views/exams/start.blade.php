@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Exam Details</div>

                <div class="panel-body">
                    <p>Exam Question : {{count($exam->questions)}}</p>
                    @php $time = []; @endphp
                    @foreach($exam->questions as  $question)
                        @php $time[] = $question->time; @endphp
                    @endforeach
                    <p>Exam Question : {{array_sum($time)}}</p>

                    <a class="btn btn-primary">Star</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
