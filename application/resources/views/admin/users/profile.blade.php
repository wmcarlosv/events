@extends('adminlte::page')

@section('title', $title)

@section('content')

	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>{{ $title }}</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'edit_profile', 'method' => 'PUT', 'autocomplete' => 'off']) !!}
    			<div class="form-group">
    				<label for="name">Name: </label>
    				<input type="text" name="name" id="name" value="{{ @$data->name }}" class="form-control" />
    			</div>
    			<div class="form-group">
    				<label for="email">Email: </label>
    				<input type="text" name="email" id="email" value="{{ @$data->email }}" class="form-control" />
    			</div>
    			<button class="btn btn-success"><i class="fa fa-floppy-o"></i> Update</button>
    		{!! Form::close() !!}
    	</div>
    </div>

    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>Change Password</h2>
    	</div>
    	<div class="panel-body">
    		{!! Form::open(['route' => 'change_password', 'method' => 'PUT', 'autocomplete' => 'off']) !!}
    			<div class="form-group">
    				<label for="password">Password: </label>
    				<input type="password" name="password" id="password" class="form-control" />
    			</div>
    			<div class="form-group">
    				<label for="password_confirmation">Repeat Password: </label>
    				<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
    			</div>
    			<button class="btn btn-success"><i class="fa fa-floppy-o"></i> Change</button>
    		{!! Form::close() !!}
    	</div>
    </div>
@stop