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
			<a class="btn btn-primary pull-right" href="{{route('questions.answer', $question->id)}}">Create Anther Question</a>
		</div>
	</div>

	@if(Session::has('message'))
		<div class="alert alert-success">{{Session::get('message')}}</div>
	@endif
	<section class="panel">
		<table class="table">
			<thead>
				<tr>
					<th>Answers</th>
				</tr>
			</thead>
			<tbody>
				@foreach($question->answers as $answer)
				<tr>
					<td>{{$answer->answer}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
	<br>
</section>

@stop