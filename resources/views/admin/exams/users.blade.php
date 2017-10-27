@extends('admin.layout')
@section('content')

 <section class="content-header">
    <div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-tags"></i> Exams</h3>
			<ol class="breadcrumb">
				<li><i class="fa fa-home"></i><a href="{{ Url('/admin') }}">Home</a></li>
				<li><i class="fa fa-tags"></i>Exams</li>                          
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
					<th>Users Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td><a href="{{route('exam.users.answers', [$exam->id, $user->id])}}">{{$user->name}}</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
	<br>
</section>

@stop