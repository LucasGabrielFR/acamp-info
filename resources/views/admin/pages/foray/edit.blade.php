@extends('adminlte::page')

@section('title', 'Editar cadastro de Forania')

@section('content_header')
    <h1>Editar Cadastro de Forania</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('foray.update', $foray->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.foray._partials.form')
            </form>
        </div>
    </div>
@stop
