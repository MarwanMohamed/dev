@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Exam Details</div>

                <div class="panel-body">
                    <p>Exam Questions : {{count($exam->questions)}} Questions</p>
                    @php $time = []; @endphp
                    @foreach($exam->questions as  $question)
                        @php $time[] = $question->time; @endphp
                    @endforeach
                    <p>Exam Time : {{array_sum($time)}} minutes</p>

                    <form method="post" action="{{route('go.exam', [$exam->id])}}">
                        {{ csrf_field() }}
                        <button class="btn btn-primary">Star</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
