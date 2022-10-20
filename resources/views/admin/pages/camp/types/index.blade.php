@extends('adminlte::page')

@section('title', 'Modalidades de Acampamento')

@section('content_header')
    <h1>Modalidades de Acampamentos</h1>
    <a href="{{ route('acamp-type.create') }}" class="btn btn-success">Novo Cadastro</a>
@stop

@section('content')
    @php
        $heads = ['Nome', 'Idade Mínima', 'Idade Máxima', 'Ações'];

        $config = [
            'data' => $types,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($config['data'] as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->min_age }}</td>
                        <td>{{ $type->max_age }}</td>
                        <td>
                            <a class="btn btn-xs btn-default text-teal mx-1 shadow" href="{{ route('acamp-type.view', $type->id) }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow" href="{{ route('acamp-type.edit', $type->id) }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <x-modal url="{{ route('acamp-type.delete', $type->id) }}" id="{{ $type->id }}"
                                name="{{ $type->name }}" />
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
        {{-- <div class="card-footer">
            {!! $people->links() !!}
        </div> --}}
    </div>
@stop
