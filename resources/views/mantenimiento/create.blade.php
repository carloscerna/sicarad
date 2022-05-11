@extends('adminlte::page')

@section('title', 'Sistema - Nuevo')

@section('content_header')
    <h1>Nuevo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=>'mantenimiento.asignatura.store']) !!}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('codigo', 'Código') !!}
                    {!! Form::text('codigo', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {{ Form::label('LblCodigoCC', 'Calificación o Concepto') }}
                    {!! Form::select('CodigoCC', $catalogo_cc_asignatura, null, ['class' => 'form-control']) !!}

                    {{ Form::label('LblCodigoArea', 'Código Área') }}
                    {!! Form::select('CodigoArea', $catalogo_area_asignatura, null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop