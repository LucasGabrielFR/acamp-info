@extends('adminlte::page')

@section('title', 'Edição de Acampamento')

@section('content_header')
    <h1>Edição de Acampamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('camp.update', $camp->id) }}" class="form" method="POST" onsubmit="verifyDate(event)">
                @csrf
                @method('PUT')
                @include('admin.pages.camp._partials.form')
            </form>
        </div>
    </div>
    <x-footer />
@stop
