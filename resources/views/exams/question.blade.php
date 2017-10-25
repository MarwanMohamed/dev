@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Exam {{$exam->name}} <span class="pull-right">Time left = <span id="timer"></span></span></div>
                    <p class="text-center">{{$question->question}}</p>   
                <input type="hidden" name="time" id="time" value="{{$question->time}}">
                <div class="panel-body">

                    <form method="post" action="{{route('next.question', [$exam->id,$question->id])}}" id="saveQuestion">

                        {{ csrf_field() }}
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        @if($question->type == 1)
                            @foreach($question->answers as $answer)
                            <label for="{{$answer->answer}}">{{$answer->answer}}</label>
                                <input id='{{$answer->answer}}' type="radio" name="answer" value="{{$answer->id}}"><br>
                            @endforeach

                        @elseif($question->type == 2)
                            @foreach($question->answers as $answer)
                                <label for="{{$answer->answer}}">{{$answer->answer}}</label>
                                <input id='{{$answer->answer}}' type="radio" name="answer" value="{{$answer->id}}"><br>
                            @endforeach
                        @elseif($question->type == 3)
                            @foreach($question->answers as $answer)
                                <label for="{{$answer->answer}}">{{$answer->answer}}</label>
                                <input id='{{$answer->answer}}' type="checkbox" name="answer" value="{{$answer->id}}"><br>
                            @endforeach
                        @elseif($question->type == 4)
                        <ul id="sortable">
                            @foreach($question->answers as $answer)
                                <label>Sort: Drag and Drop</label>
                            <li class="ui-state-default"><i class="fa fa-sort" aria-hidden="true"></i> {{$answer->answer}}</li>
                            @endforeach
                           
                        </ul>

                        @elseif($question->type == 5)
                            <textarea name="text" class="form-control" required></textarea><br>
                        @endif

                        <button class="btn btn-primary pull-right">Next</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
      } );
    </script>

    <script>
        var time = $('#time').val();
        document.getElementById('timer').innerHTML =  time + ":" + 00;
        startTimer();

    function startTimer() {
        var presentTime = document.getElementById('timer').innerHTML;
        var timeArray = presentTime.split(/[:]+/);
        var m = timeArray[0];
        var s = checkSecond((timeArray[1] - 1));
        if(s == 59){ m = m-1 }

        if (m ==0 && s == 0) { 
            $('#saveQuestion').submit();
        }

      document.getElementById('timer').innerHTML =
        m + ":" + s;

      setTimeout(startTimer, 1000);
    }

    function checkSecond(sec) {
      if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
      if (sec < 0) {sec = "59"};
      return sec;
    }
    </script>
@endsection