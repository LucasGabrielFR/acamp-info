@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    <h1>Cadastro de Pessoas</h1>
    <a href="{{ route('person.create') }}" class="btn btn-success">Novo Cadastro</a>
@stop

@section('content')
    @php
        $heads = ['Nome', 'Contato', 'Idade', 'Paróquia', 'Ações'];

        $config = [
            'data' => $people,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];
    @endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($config['data'] as $person)
                    @php
                        $dataNascimento = $person->date_birthday;
                        $data = new DateTime($dataNascimento);
                        $resultado = $data->diff(new DateTime(date('Y-m-d')));
                    @endphp
                    <tr>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->contact }}</td>
                        <td>{{ $resultado->format('%Y anos') }}</td>
                        <td>{{ $person->parish }}</td>
                        <td>
                            <a class="btn btn-xs btn-default text-teal mx-1 shadow" href="{{ route('person.view', $person->id) }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow" href="{{ route('person.edit', $person->id) }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <x-modal url="{{ route('person.delete', $person->id) }}" id="{{ $person->id }}"
                                name="{{ $person->name }}" />
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
