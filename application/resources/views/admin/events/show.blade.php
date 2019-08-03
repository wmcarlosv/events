@extends('adminlte::page')

@section('title', $title)

@section('content')
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h2>{{ $title }}</h2>
    	</div>
    	<div class="panel-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td><b>Titulo</b></td>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Descripci&oacute;n</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>{!! $data->description !!}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Cover</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if(!empty($data->cover))
                            <img src="{{ asset('application/storage/app/'.$data->cover) }}" class="img-thumbnail" width="200" height="200">
                            @else
                                <label class="label label-danger">Sin Imagen</label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Fecha: </b></td>
                        <td>{{ date('d-m-Y',strtotime($data->event_date)) }}</td>
                    </tr>
                    <tr>
                        <td><b>Hora: </b></td>
                        <td>{{ date('H:s',strtotime($data->event_time)) }}</td>
                    </tr>
                    <tr>
                        <td><b>Estatus: </b></td>
                        <td>
                            @if($data->status == 'open')
                                <label class="label label-success">Abierto</label>
                            @else
                                <label class="label label-danger">Cerrado</label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><a class="btn btn-info" href="{{ route('home') }}"><i class="fa fa-arrow-left"></i> Volver</a></td>
                    </tr>
                </tbody>
            </table>
    	</div>
    </div>
@stop