@extends('adminlte::page')

@section('title', 'Cadastrar Novo Acampamento')

@section('content_header')
    <h1>Cadastro de Acampamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('camp.store') }}" class="form" method="POST" onsubmit="verifyDate(event)">
                @csrf
                @include('admin.pages.camp._partials.form')
            </form>
        </div>
    </div>
    <x-footer />
@stop
