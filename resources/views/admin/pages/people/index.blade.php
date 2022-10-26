@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    <h1>Cadastro de Pessoas</h1>
    <a href="{{ route('person.create') }}" class="btn btn-success">Novo Cadastro</a>
    <style>
        .badge-brown {
            background: #8B4513;
            color: white
        }

        .badge-yellow {
            background: #ffc107;
        }

        .badge-orange {
            background: #fd7e14;
        }

        .badge-blue {
            background: #007bff;
            color: white
        }

        .badge-green {
            background: #28a745;
            color: white
        }

        .badge-purple {
            background: #6f42c1;
            color: white
        }

        .badge-red {
            background: #dc3545;
            color: white
        }
    </style>
@stop

@section('content')
    @php
        $heads = ['Nome', 'Contato', 'Idade', 'Paróquia', 'Marcadores', 'Ações'];

        $config = [
            'data' => $people,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false]],
        ];
    @endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach ($config['data'] as $person)
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
                            @php
                                foreach ($person->markers as $marker) {
                                    switch ($marker->group) {
                                        case 'red':
                                            echo '<span class="badge badge-red ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        case 'blue':
                                            echo '<span class="badge badge-blue ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        case 'brown':
                                            echo '<span class="badge badge-brown ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        case 'orange':
                                            echo '<span class="badge badge-orange ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        case 'yellow':
                                            echo '<span class="badge badge-yellow ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        case 'black':
                                            echo '<span class="badge badge-dark ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        case 'purple':
                                            echo '<span class="badge badge-purple ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        case 'green':
                                            echo '<span class="badge badge-green ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                        default:
                                            echo '<span class="badge badge-light ml-1">' . $marker->camp_name . '</span>';
                                            break;
                                    }
                                }
                            @endphp
                        </td>
                        <td>
                            <a class="btn btn-xs btn-default text-teal mx-1 shadow"
                                href="{{ route('person.view', $person->id) }}">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow"
                                href="{{ route('person.edit', $person->id) }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <x-modal url="{{ route('person.delete', $person->id) }}" id="{{ $person->id }}"
                                name="{{ $person->name }}" />
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
    <x-footer />
@stop
