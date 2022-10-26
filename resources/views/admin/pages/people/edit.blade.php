@extends('adminlte::page')

@section('title', 'Edição de cadastro')

@section('content_header')
    <h1>Edição de cadastro</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('person.update', $person->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.pages.people._partials.form')
            </form>
        </div>
    </div>
    <x-footer />
@stop
