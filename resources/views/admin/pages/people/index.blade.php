@extends('adminlte::page')

@section('title', 'Pessoas')

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable();
            table.order([1, 'asc']).draw();
        });
    </script>
@stop

@section('content_header')
    @if ($type == 'noCampers')
        <h1>Fichas disponíveis</h1>
        <a href="{{ route('person.create') }}" class="btn btn-success">Novo Cadastro</a>
    @endif
    @if ($type == 'campers')
        <h1>Campistas</h1>
    @endif

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">

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

        .badge-sky-blue {
            background: #87ceeb;
            color: black
        }

        .badge-herbal {
            background: #2e8b57;
            color: white
        }

        .badge-pink {
            background: #e83e8c;
            color: white
        }

        .badge-salmon {
            background: #fa7f72;
            color: black;
        }

        .badge-royal-blue {
            background: #7694ce;
            color: black;
        }

        .badge-dark-green {
            background: #00421a;
            color: white;
        }

        .badge-inverted {
            background: #2f4f4f;
            color: white;
        }

        .badge-gray {
            background: gray;
            color: white;
        }

        .badge-white-red {
            background: #ff9090;
            color: black;
        }

        .badge-black {
            background: black;
            color: white;
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
                                if (isset($person->camps)) {
                                    foreach ($person->camps as $camper) {
                                        switch ($camper->group) {
                                            case 'red':
                                                echo '<span class="badge badge-red ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            case 'blue':
                                                echo '<span class="badge badge-blue ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            case 'brown':
                                                echo '<span class="badge badge-brown ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            case 'orange':
                                                echo '<span class="badge badge-orange ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            case 'yellow':
                                                echo '<span class="badge badge-yellow ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            case 'black':
                                                echo '<span class="badge badge-dark ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            case 'purple':
                                                echo '<span class="badge badge-purple ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            case 'green':
                                                echo '<span class="badge badge-green ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                            default:
                                                echo '<span class="badge badge-light ml-1">' . $camper->camp->name . '</span>';
                                                break;
                                        }
                                    }
                                }
                                if (isset($person->serves)) {
                                    foreach ($person->serves as $serve) {
                                        $sector = '';
                                        switch ($serve->sector) {
                                            case 'cozinha':
                                                $sector = 'Cozinha';
                                                $cardColor = 'red';
                                                break;
                                            case 'anjo':
                                                $sector = 'Anjo/Líder/Padrinho';
                                                $cardColor = 'blue';
                                                break;
                                            case 'evangelizacao':
                                                $sector = 'Evangelização';
                                                $cardColor = 'brown';
                                                break;
                                            case 'secretaria':
                                                $sector = 'Secretaria';
                                                $cardColor = 'orange';
                                                break;
                                            case 'coordenacao':
                                                $sector = 'Coordenação';
                                                $cardColor = 'yellow';
                                                break;
                                            case 'cantinho-mariano':
                                                $sector = 'Cantinho Mariano';
                                                $cardColor = 'sky-blue';
                                                break;
                                            case 'capela':
                                                $sector = 'Capela';
                                                $cardColor = 'royal-blue';
                                                break;
                                            case 'diretor-espiritual':
                                                $sector = 'Diretor Espiritual';
                                                $cardColor = 'herbal';
                                                break;
                                            case 'farmacia':
                                                $sector = 'Farmácia';
                                                $cardColor = 'white-red';
                                                break;
                                            case 'animacao':
                                                $sector = 'Animação';
                                                $cardColor = 'pink';
                                                break;
                                            case 'ligacao':
                                                $sector = 'Ligação';
                                                $cardColor = 'purple';
                                                break;
                                            case 'manutencao':
                                                $sector = 'Manutenção';
                                                $cardColor = 'dark-green';
                                                break;
                                            case 'musica':
                                                $sector = 'Música';
                                                $cardColor = 'gray';
                                                break;
                                            case 'pregacao':
                                                $sector = 'Pregação';
                                                $cardColor = 'inverted';
                                                break;
                                            case 'teatro':
                                                $sector = 'Teatro';
                                                $cardColor = 'salmon';
                                                break;
                                            case 'tropa-de-elite':
                                                $sector = 'Tropa de Elite';
                                                $cardColor = 'black';
                                                break;
                                        }

                                        $hierarchy = null;
                                        switch ($serve->hierarchy) {
                                            case 'coordenacao':
                                                $hierarchy = "Coordenação";
                                                break;
                                            case 'aux':
                                                $hierarchy = "Auxiliar";
                                                break;
                                            case 'servo':
                                                $hierarchy = "Servo";
                                                break;
                                        }

                                        echo '<span class="badge badge-' . $cardColor . ' ml-1">' . "{$serve->camp->name} - {$sector} - {$hierarchy} </span>";
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
