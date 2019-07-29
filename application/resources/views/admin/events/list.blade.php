@extends('adminlte::page')

@section('title', $title)

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>{{ $title }}</h2>
    	</div>
    	<div class="panel-body">
            @foreach($data as $event)
                <div class="col-md-12">
                    <a href="{{ route('events.show',$event->id) }}"><div class="info-box">
                      <span class="info-box-icon bg-blue"><i class="fa fa-calendar"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">{{ $event->title }}</span>
                        <span class="info-box-number">{{ date('d-m-Y',strtotime($event->event_date)) }}</span>
                      </div>
                    </div></a>
                </div>
            @endforeach
            <a class="btn btn-info" href="{{ route('home') }}"><i class="fa fa-arrow-left"></i> Volver</a>
    	</div>
    </div>
@stop