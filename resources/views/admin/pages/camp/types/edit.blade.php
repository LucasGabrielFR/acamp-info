@extends('adminlte::page')

@section('title', 'Editar Modalidade')

@section('content_header')
    <h1>Editar Modalidade</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('acamp-type.update', $type->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.camp.types._partials.form')
            </form>
        </div>
    </div>
    <x-footer />
@stop
