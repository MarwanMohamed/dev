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
		<a class="btn btn-primary pull-right" href="{{route('questions.create', $exam->id)}}">Create Anther Question</a>
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
				</tr>
			</thead>
			<tbody>
				@foreach($exam->questions as $question)
				<tr>
					<td><a href="{{route('questions', $question->id)}}">{{$question->question}}</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
	<br>
</section>

@stop