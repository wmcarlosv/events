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
            @if($action == 'create')
    		  {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'autocomplete' => 'off']) !!}
            @else
              {!! Form::open(['route' => ['users.update', @$data->id], 'method' => 'PUT', 'autocomplete' => 'off']) !!}
            @endif
    			<div class="form-group">
                    <label for="name">Name: </label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ @$data->name }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ @$data->email }}" />
                </div>
                <div class="form-group">
                    <label for="role">Role: </label>
                    <select class="form-control" name="role" id="role">
                        <option value="administrator">Administrator</option>
                        <option value="operator" @if(@$data->role == 'operator') selected='selected' @endif>Operator</option>
                    </select>
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                <a class="btn btn-danger" href="{{ route('users.index') }}"><i class="fa fa-times"></i> Cancel</a>
    		{!! Form::close() !!}
    	</div>
    </div>
@stop