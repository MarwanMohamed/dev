@extends('admin.layout')
@section('content')

 <section class="content-header">
    <div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-tags"></i> Quesions</h3>
			<ol class="breadcrumb">
				<li><i class="fa fa-home"></i><a href="{{ Url('/admin') }}"> Home</a></li>
				<li><i class="fa fa-plus"></i> Create qestion</li>                          
			</ol>
		</div>
	</div>
	@if(Session::has('message'))
		<div class="alert alert-success">{{Session::get('message')}}</div>
	@endif
	<section class="panel">
		<div class="panel-body">
			<form role='form' method="post" action="{{route('save.qestion', $id)}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="exam_id" value="{{ $id }}">
				
					<div class="form-group">
						<label for="title"> Question:</label>
						<input type="text" name="question" required class="form-control">
					</div>

					<div class="form-group">
						<label for="title"> type:</label>
						<select name="type" class="form-control">
							<option value="1">True-False</option>
							<option value="2">One choice</option>
							<option value="3">multiple choices</option>
							<option value="5">Open answer</option>
						</select>
					</div>

					<div class="form-group">
						<label for="title"> Time by minutes:</label>
						<input type="number" name="time" required class="form-control">
					</div>

				
            	<button type="submit" class="btn btn-primary">Create qestion</button>
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