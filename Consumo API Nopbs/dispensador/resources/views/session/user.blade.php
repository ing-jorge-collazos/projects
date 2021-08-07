@extends('adminlte::page')

@section('title', 'Suministro API')

@section('content_header')
<h1 class="text-center">Resumen</h1>
@stop

@section('content')
<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card card-body">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="align-middle" scope="col">Proceso</th>
                                    <th class="align-middle" scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>                               
                                @if (count($resumen) > 0) 
                                    @foreach($resumen as $item)
                                        <tr>
                                            <td class="align-middle" scope="col">{{$item->process_type}}</td>
                                            <td class="align-middle" scope="col">{{$item->count}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h5 class="text-center">No hay registros asociados</h5>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop