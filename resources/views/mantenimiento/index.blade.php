@extends('adminlte::page')

@section('title', 'Sistema - Asignatura')

@section('content_header')
    <h1>Asignaturas</h1>
@stop

@section('content')
@if (session('mensaje'))
    <div class="alert alert-danger">
        <strong>{{session('mensaje')}}</strong>
    </div>
@endif
<div class="card-header">
    <a href="{{route('mantenimiento.asignatura.create')}}" class="btn btn-primary">Nuevo</a>
</div>

        <div class="card body">
            <table class="table" id="TablaAsignaturas">
                <thead>
                    <tr class="bg-info">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Código CC</th>
                        <th>Código Área</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asignatura as $items)
                    <tr>
                        <td>{{$items->id_asignatura}}</td>
                        <td>{{$items->nombre}}</td>
                        <td>{{$items->codigo}}</td>
                        <td>{{$items->nombre_cc}}</td>
                        <td>{{$items->nombre_area}}</td>
                        <td><a href="{{route('mantenimiento.asignatura.edit',[$items->id_asignatura])}}" class="btn btn-primary btn-sm">Editar</a></td>
                        <td>
                            <form action="{{route('mantenimiento.asignatura.destroy',[$items->id_asignatura])}}" method="post">
                                @method('delete')
                                @csrf
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                            </form>    
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Código CC</th>
                        <th>Código Área</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#TablaAsignaturas').DataTable({
                'bSort': false,
                "scrollY":        "200px",
                "scrollCollapse": false,
                "info":           true,
                "paging":         true
            });
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css" class="">
@endsection