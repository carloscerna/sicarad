@extends('adminlte::page')

@section('title', 'Sistema - Asignatura')

@section('content_header')
    <h1>Asignaturas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Código CC</th>
                        <th>Código Área</th>
                        <th col='2'></th>
                    </tr>
                </thead>
                <body>
                    @foreach ($Asignatura as $item)
                        <tr>
                            <td>{{$item->id_asignatura}}</td>
                            <td>{{$item->nombre}}</td>
                            <td>{{$item->codigo}}</td>
                            <td>{{$item->codigo_cc}}</td>
                            <td>{{$item->codigo_area}}</td>
                            <td><a href="{{route('mantenimiento.asignatura.edit',$item)}}" class="btn btn-primary">Editar</a></td>
                            <td><a href="{{route('mantenimiento.asignatura.destroy',$item)}}" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                    @endforeach
                </body>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop