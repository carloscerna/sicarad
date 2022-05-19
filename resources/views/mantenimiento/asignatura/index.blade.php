@extends('adminlte::page')

@section('title', 'Sistema - Asignatura')

@section('content_header')
    <h1>Asignaturas</h1>
@stop

@section('content')
@if (session('mensaje'))
    <script>
        Swal.fire{
            'Eliminado!',
            'El Registro ha sido eliminado.',
            'success'
        }
    </script>
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
                        <th>Estatus</th>
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
                        <td>{{
                                @$items->nombre_estatus
                                
                                }}</td>
                        <td><a href="{{route('mantenimiento.asignatura.edit',[$items->id_asignatura])}}" class="btn btn-primary btn-sm">Editar</a></td>
                        <td>
                            <form action="{{route('mantenimiento.asignatura.destroy',[$items->id_asignatura])}}" method="post" class="formulario-eliminar">
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

    <script>
        $(".formulario-eliminar").submit(function(e){
            e.preventDefault();
        
            Swal.fire({
                title: '¿Estas Seguro?',
                text: "!Este Registro se Eliminará!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '!Si, eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    /*Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )*/
                    // ENVIAR FORMULARIO
                    this.submit();
                }
                })
        });

        
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css" class="">
@endsection