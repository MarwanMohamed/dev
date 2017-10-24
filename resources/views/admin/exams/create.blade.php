@extends('admin.layout')
@section('content')

 <section class="content-header">
    <div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-tags"></i> Exams</h3>
			<ol class="breadcrumb">
				<li><i class="fa fa-home"></i><a href="{{ Url('/admin') }}"> Home</a></li>
				<li><i class="fa fa-plus"></i> Create Exam</li>                          
			</ol>
		</div>
	</div>
	@if(Session::has('message'))
		<div class="alert alert-success">{{Session::get('message')}}</div>
	@endif

	<section class="panel">
		<div class="panel-body">
			<form role='form' method="post" action="{{route('save.exam')}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
					<div class="form-group">
						<label for="title"> name:</label>
						<input type="text" name="name" required class="form-control">
					</div>
				
            	<button type="submit" class="btn btn-primary">Create Exam</button>
			</form>
		</div>

		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
	</section>
</section>
    
@stop