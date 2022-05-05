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
                    {!! Form::label($for, $text, [$options]) !!}
                    {!! Form::text($name, $value, [$options]) !!}
                </div>
            {!! Form::close()} !!}
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop