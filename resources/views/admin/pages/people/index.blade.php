@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    @if ($type == 'noCampers')
        <h1>Fichas disponíveis</h1>
    @endif
    @if ($type == 'campers')
        <h1>Campistas</h1>
    @endif

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
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

        .badge-servant {
            background: #fa7f72;
            border-radius: 10px;
            color: black;
        }
    </style>
@stop

@section('content')
    @php
        $heads = [['label' => 'Foto', 'width' => 15], 'Nome', 'Contato', 'Idade', 'Paróquia', 'Marcadores', 'Ações'];

        $config = [
            'data' => $people,
        ];
    @endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" hoverable with-buttons>
                @foreach ($config['data'] as $person)
                    @php
                        $dataNascimento = $person->date_birthday;
                        $data = new DateTime($dataNascimento);
                        $resultado = $data->diff(new DateTime(date('Y-m-d')));
                    @endphp
                    <tr>
                        <td class="align-middle">
                            @if (isset($person->image))
                                <img src="{{ url("{$person->image}") }}" class="img-fluid img-thumbnail" alt="">
                            @endif
                        </td>
                        <td class="align-middle">{{ $person->name }}</td>
                        <td class="align-middle">{{ $person->contact }}</td>
                        <td class="align-middle">{{ $resultado->format('%Y anos') }}</td>
                        <td class="align-middle">{{ $person->parish }}</td>
                        <td class="align-middle">
                            @php
                                if (isset($person->markers)) {
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
                                }
                                if (isset($person->servers)) {
                                    foreach ($person->servers as $serve) {
                                        $sector = '';
                                        switch ($serve->sector) {
                                            case 'cozinha':
                                                $sector = 'Cozinha';
                                                break;
                                            case 'anjo':
                                                $sector = 'Anjo';
                                                break;
                                            case 'anjo-da-mata':
                                                $sector = 'Anjo da mata';
                                                break;
                                            case 'evangelizacao':
                                                $sector = 'Evangelização';
                                                break;
                                            case 'secretaria':
                                                $sector = 'Secretaria';
                                                break;
                                            case 'coordenacao':
                                                $sector = 'Coordenação';
                                                break;
                                        }

                                        echo '<span class="badge badge-servant ml-1">' . "{$serve->camp_name} - {$sector} </span>";
                                    }
                                }

                            @endphp
                        </td>
                        <td class="align-middle">
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
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
@stop
