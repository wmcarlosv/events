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
    		  {!! Form::open(['route' => 'events.store', 'method' => 'POST', 'autocomplete' => 'off', 'files' => true]) !!}
            @else
              {!! Form::open(['route' => ['events.update', @$data->id], 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
            @endif
    			<div class="form-group">
                    <label for="title">Title: </label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ @$data->title }}" />
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    <textarea class="form-control" name="description" id="description">{{ @$data->title }}</textarea>
                </div>
                <div class="form-group">
                    <label for="cover">Cover: </label>
                    @if(!empty(@$data->cover))
                        <br />
                        <br />
                        <img src="{{ asset('application/storage/app/'.@$data->cover) }}" class="img-thumbnail" width="100" height="100" />
                        <br />
                        <br />
                    @endif
                    <input class="form-control" type="file" name="cover" id="cover"/>
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date: </label>
                    <input class="form-control" type="date" name="event_date" id="event_date" value="{{ @$data->event_date }}" />
                </div>
                <div class="form-group">
                    <label for="event_time">Event Time: </label>
                    <input class="form-control" type="time" name="event_time" id="event_time" value="{{ @$data->event_time }}" />
                </div>
                <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
                <a class="btn btn-danger" href="{{ route('events.index') }}"><i class="fa fa-times"></i> Cancel</a>
    		{!! Form::close() !!}
    	</div>
    </div>
@stop