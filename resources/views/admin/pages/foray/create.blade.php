@extends('adminlte::page')

@section('title', 'Cadastrar Nova Forania')

@section('content_header')
    <h1>Cadastro de Forania</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('foray.store') }}" class="form" method="POST">
                @csrf
                @include('admin.pages.foray._partials.form')
            </form>
        </div>
    </div>
    <x-footer />
@stop
