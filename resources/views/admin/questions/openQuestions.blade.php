@extends('admin.layout')
@section('content')

 <section class="content-header">
    <div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-tags"></i> Questions</h3>
			<ol class="breadcrumb">
				<li><i class="fa fa-home"></i><a href="{{ Url('/admin') }}">Home</a></li>
				<li><i class="fa fa-tags"></i>Questions</li>                          
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
					<th>Answer</th>
					<th>Right ?</th>
					<th>Wrong ?</th>
				</tr>
			</thead>
			<tbody>
				@foreach($questions as $question)
					<td>{{$question->question->question}}</td>
					<td>{{$question->text}}</td>
					<td><a href="{{route('right.question', $question->id)}}">Right</a></td>
					<td><a href="{{route('wrong.question', $question->id)}}">Wrong</a></td>
				@endforeach
			</tbody>
		</table>
	</section>
	<br>
</section>

@stop