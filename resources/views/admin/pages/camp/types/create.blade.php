@extends('adminlte::page')

@section('title', 'Cadastrar Nova Modalidade')

@section('content_header')
    <h1>Cadastro de Modalidade</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('acamp-type.store') }}" class="form" method="POST">
                @csrf
                @include('admin.pages.camp.types._partials.form')
            </form>
        </div>
    </div>
    <x-footer />
@stop
