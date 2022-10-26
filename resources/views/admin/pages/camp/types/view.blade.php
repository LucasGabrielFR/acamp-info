@extends('adminlte::page')

@section('title', 'Visualizar Modalidade')

@section('content_header')
    <h1>Visualizar Modalidade</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label>Nome: </label>
                <div class="text-danger ml-2">{{ $type->name }}</div>
            </div>
            <div class="row">
                <label>Idade Mínima: </label>
                <div class="text-danger ml-2">{{ $type->min_age }}</div>
            </div>
            <div class="row">
                <label>Idade Máxima: </label>
                <div class="text-danger ml-2">{{ $type->max_age }}</div>
            </div>
        </div>
    </div>
    <x-footer />
@stop
