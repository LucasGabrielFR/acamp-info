@extends('adminlte::page')

@section('title', 'Cadastrar Nova Pessoa')

@section('content_header')
    <h1>Cadastro de Pessoa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('person.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.pages.people._partials.form')
            </form>
        </div>
    </div>
    <x-footer />
@stop
