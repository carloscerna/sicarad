@extends('adminlte::page')

@section('title', 'Sistema - Asignatura')

@section('content_header')
    <h1>Asignaturas</h1>
@stop

@section('content')
<div class="card-header">
    <a href="{{route('mantenimiento.asignatura.create')}}" class="btn btn-primary">Nuevo</a>
</div>
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
                            <td>{{$item->nombre_cc}}</td>
                            <td>{{$item->nombre_area}}</td>
                             <td><a href="{{route('mantenimiento.asignatura.edit',$item->id_asignatura)}}" class="btn btn-primary btn-sm">Editar</a></td>
                                <td>
                                <form action="{{route('mantenimiento.asignatura.destroy', $item->id_asignatura)}}" method="POST" class="">
                                @method('delete')
                                @csrf
                                <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                            </form>
                            </td>
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