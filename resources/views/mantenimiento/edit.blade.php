@extends('adminlte::page')

@section('title', 'Sistema - Tablero')

@section('content_header')
    <h1>EDITAR REGISTRO {{ $asignatura->nombre}}</h1>
@stop

@section('content')
@if (isset($mensaje))
    <div class="alert alert-success">
        <strong>{{$mensaje}}</strong>
    </div>
@endif
<div class="card">
    <div class="card-body">
        {!! Form::model($asignatura, ['route'=>['mantenimiento.asignatura.update', $asignatura->id_asignatura],'method'=>'put'])!!}
            <div class="form-group">
                {!! Form::hidden('id_asignatura', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class'=>'form-control']) !!}

                @error('nombre')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('codigo', 'Código') !!}
                {!! Form::text('codigo', null, ['class'=>'form-control']) !!}

                @error('codigo')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                {{ Form::label('LblCodigoCC', 'Calificación o Concepto') }}
                {!! Form::select('codigo_cc', $catalogo_cc_asignatura, null, ['class' => 'form-control']) !!}

                {{ Form::label('LblCodigoArea', 'Código Área') }}
                {!! Form::select('codigo_area', $catalogo_area_asignatura, null, ['class' => 'form-control']) !!}

                {{ Form::label('LblCodigoServicioEducativo', 'Servicio Educativo') }}
                {!! Form::select('codigo_servicio_educativo', $catalogo_servicio_educativo, null, ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>    
@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop