@extends('adminlte::page')

@section('title', 'Foranias')

@section('content_header')
    <h1>Foranias</h1>
    <a href="{{ route('foray.create') }}" class="btn btn-success">Novo Cadastro</a>
@stop

@section('content')
    @php
        $heads = ['Nome', 'Cidade', 'Estado', 'Diocese', 'Ações'];

        $config = [
            'data' => $forays,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];
    @endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($config['data'] as $foray)
                    <tr>
                        <td>{{ $foray->name }}</td>
                        <td>{{ $foray->city }}</td>
                        <td>{{ $foray->state }}</td>
                        <td>{{ $foray->diocese }}</td>
                        <td>
                            <a class="btn btn-xs btn-default text-teal mx-1 shadow" href="{{ route('foray.view', $foray->id) }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow" href="{{ route('foray.edit', $foray->id) }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <x-modal url="{{ route('foray.delete', $foray->id) }}" id="{{ $foray->id }}"
                                name="{{ $foray->name }}" />
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
    <x-footer />
@stop
