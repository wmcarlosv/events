@extends('adminlte::page')

@section('title', $title)

@include('flash::message')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fullcalendar-4.1.0/packages/core/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fullcalendar-4.1.0/packages/daygrid/main.css') }}">
@stop

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')
    <div class="row">
    	@if(Auth::user()->role == 'administrator')
    	<div class="col-md-6">
    		<div class="info-box">
			  <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Users</span>
			    <span class="info-box-number">{{ $users->count() }}</span>
			  </div>
			</div>
    	</div>
    	<div class="col-md-6">
    		<div class="info-box">
			  <span class="info-box-icon bg-blue"><i class="fa fa-calendar"></i></span>
			  <div class="info-box-content">
			    <span class="info-box-text">Events</span>
			    <span class="info-box-number">{{ $events->count() }}</span>
			  </div>
			</div>
    	</div>
    	@else
    		<div class="col-md-12">
	    		<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-calendar"></i></span>
				  <div class="info-box-content">
				    <span class="info-box-text">Events</span>
				    <span class="info-box-number">{{ $events->count() }}</span>
				  </div>
				</div>
	    	</div>
    	@endif

    	<div class="row">
			<div class="col-md-12">
				<div id='calendar'></div>
			</div>
		</div>
    </div>
@stop

@section('js')
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/core/main.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/core/locales-all.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/interaction/main.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar-4.1.0/packages/daygrid/main.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#flash-overlay-modal').modal();
	});
</script>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid' ],
      editable: true,
      eventLimit: true,
      locale : 'es',
      header : {
      	left : 'prev, next',
      	center : 'title',
      	right : 'dayGridMonth'
      },
      events : [

      	@foreach($events as $event)
      		{ 
      			title: '{{ $event->title }} ({{ $event->status }})',
      			url : '{{ route("events.edit",["id" => $event->id]) }}',
      			start: '{{ $event->event_date }}'
      		},
      	@endforeach

      ]
    });

    calendar.render();
  });
</script>
@stop