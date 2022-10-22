@extends('adminlte::page')

@section('title', 'Acampamentos')

@section('content_header')
    <h1>Acampamentos</h1>
    <a href="{{ route('camp.create') }}" class="btn btn-success">Novo Acampamento</a>
@stop

@section('content')
    @php
        $heads = ['Nome', 'Data de Início', 'Data de Término', 'Modalidade', 'Ações'];

        $config = [
            'data' => $camps,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];
    @endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach ($config['data'] as $camp)
                    @php
                        $dataInicio = new DateTime($camp->date_start);
                        $dataTermino = new DateTime($camp->date_end);
                    @endphp
                    <tr>
                        <td>{{ $camp->name }}</td>
                        <td>{{ $dataInicio->format('d/m/Y') }}</td>
                        <td>{{ $dataTermino->format('d/m/Y') }}</td>
                        <td>{{ $camp->type->name }}</td>
                        <td>
                            <a class="btn btn-xs btn-default text-teal mx-1 shadow"
                                href="{{ route('camp.view', $camp->id) }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow"
                                href="{{ route('camp.edit', $camp->id) }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <x-modal url="{{ route('camp.delete', $camp->id) }}" id="{{ $camp->id }}"
                                name="{{ $camp->name }}" />
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
