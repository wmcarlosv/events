@extends('adminlte::page')

@section('title', $title)

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
@stop

@include('flash::message')

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
            <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> New</a>
            <br />
            <br />
            <table class="table table-bordered table-striped data-table display responsive no-wrap" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>/</th>
                    </tr>  
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->role }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('users.edit',$d->id) }}"><i class="fa fa-pencil"></i></a>
                                {!! Form::open(['route' => ['users.destroy',$d->id],'method' => 'DELETE', 'style' => 'display:inline']) !!}
                                    <button class="btn btn-danger delete-row"><i class="fa fa-times"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    	</div>
    </div>
@stop
@section('js')
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("table.data-table").DataTable({
            responsive : true
        });

        $('#flash-overlay-modal').modal();
        
        $("body").on('click','button.delete-row', function(){
            if(!confirm('Estas seguro de eliminar este Registro?')){
                return false;
            }
        });

    });
</script>
@stop