@extends('admin.layout')
@section('content')

 <section class="content-header">
    <div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-tags"></i> Answers</h3>
			<ol class="breadcrumb">
				<li><i class="fa fa-home"></i><a href="{{ Url('/admin') }}">Home</a></li>
				<li><i class="fa fa-tags"></i>Answers</li>                          
			</ol>
		</div>
	</div>

	@if(Session::has('message'))
		<div class="alert alert-success">{{Session::get('message')}}</div>
	@endif
	<section class="panel">
		<table class="table">
			<thead>
				<tr>
					<th>Question</th>
					<th>User Answers</th>
				</tr>
			</thead>
			<tbody>
				@foreach($exam->questions as $question)
				<tr>
					<td>{{$question->question}}</td>
				<td>
				@foreach($question->answersByUser($user->id) as $answer)
				@if(isset($answer->answer))
					{{$answer->answer->answer}}
				@else
					{{$answer->text}}
				@endif
				@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
	<br>
</section>

@stop