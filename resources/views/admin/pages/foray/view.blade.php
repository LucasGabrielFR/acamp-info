@extends('adminlte::page')

@section('title', 'Visualizar Forania')

@section('content_header')
    <h1>Visualizar Forania</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label>Nome: </label>
                <div class="text-danger ml-2">{{ $foray->name }}</div>
            </div>
            <div class="row">
                <label>Diocese: </label>
                <div class="text-danger ml-2">{{ $foray->diocese }}</div>
            </div>
            <div class="row">
                <label>Cidade: </label>
                <div class="text-danger ml-2">{{ $foray->city }}</div>
            </div>
            <div class="row">
                <label>Estado: </label>
                <div class="text-danger ml-2">{{ $foray->state }}</div>
            </div>
        </div>
    </div>
@stop
