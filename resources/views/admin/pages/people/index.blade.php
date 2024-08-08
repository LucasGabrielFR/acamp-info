@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    @if ($type == 'noCampers')
        <h1>Fichas disponíveis</h1>
        <a href="{{ route('person.create') }}" class="btn btn-success">Novo Cadastro</a>
        <button class="btn btn-success" onclick="downloadXLSX(this)" id="planilha"><i class="fas fa-lg fa-fw fa-table"></i>
            Baixar
            Planilha</button>
    @endif
    @if ($type == 'campers')
        <h1>Campistas</h1>
        <button class="btn btn-success" onclick="downloadXLSX(this)" id="planilha"><i class="fas fa-lg fa-fw fa-table"></i>
            Baixar
            Planilha</button>
    @endif
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
        if ($type == 'noCampers') {
            $heads = ['Data da pré-ficha', 'Nome', 'Contato', 'Idade', 'Paróquia', 'Cidade', 'Aguardando Acampamento', 'Ações'];
        } else {
            $heads = [['label' => 'Foto', 'width' => 15], 'Nome', 'Contato', 'Idade', 'Paróquia', 'Cidade', 'Marcadores', 'Ações'];
        }

        $config = [
            'data' => $people,
        ];
    @endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads" hoverable>
                @foreach ($config['data'] as $person)
                    @php
                        $dataNascimento = $person->date_birthday;
                        $data = new DateTime($dataNascimento);
                        $resultado = $data->diff(new DateTime(date('Y-m-d')));

                        $dataEnvio = '';

                        if (isset($person->waiting_date)) {
                            $dataEnvio = $person->waiting_date;
                        } else {
                            $dataEnvio = $person->created_at;
                        }
                    @endphp
                    <tr>
                        <td class="align-middle">
                            @if ($type == 'noCampers')
                                <span style="display:none;">{{ strtotime($dataEnvio) }}</span>
                                {{ date('d/m/Y H:i:s', strtotime($dataEnvio)) }}
                            @endif
                            @if (isset($person->image) && $type == 'campers')
                                <img src="{{ url("{$person->image}") }}" class="img-fluid img-thumbnail" alt="">
                            @endif
                        </td>
                        <td class="align-middle">{{ $person->name }}</td>
                        <td class="align-middle">{{ $person->contact }}</td>
                        <td class="align-middle">{{ $resultado->format('%Y anos') }}</td>
                        <td class="align-middle">{{ $person->parish }}</td>
                        <td class="align-middle">{{ $person->city }}</td>
                        <td class="align-middle">
                            @if ($type == 'campers')
                                @php
                                    if (isset($person->camps)) {
                                        foreach ($person->camps as $camper) {
                                            switch ($camper->group) {
                                                case 'red':
                                                    echo '<span class="badge badge-red ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                case 'blue':
                                                    echo '<span class="badge badge-blue ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                case 'brown':
                                                    echo '<span class="badge badge-brown ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                case 'orange':
                                                    echo '<span class="badge badge-orange ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                case 'yellow':
                                                    echo '<span class="badge badge-yellow ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                case 'black':
                                                    echo '<span class="badge badge-dark ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                case 'purple':
                                                    echo '<span class="badge badge-purple ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                case 'green':
                                                    echo '<span class="badge badge-green ml-1">' . $camper->camp_name . '</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-light ml-1">' . $camper->camp_name . '</span>';
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
                                                    $hierarchy = 'Coordenação';
                                                    break;
                                                case 'aux':
                                                    $hierarchy = 'Auxiliar';
                                                    break;
                                                case 'servo':
                                                    $hierarchy = 'Servo';
                                                    break;
                                            }

                                            echo '<span class="badge badge-' . $cardColor . ' ml-1">' . "{$serve->camp_name} - {$sector} - {$hierarchy} </span>";
                                        }
                                    }

                                @endphp
                            @endif
                            @if ($type == 'noCampers')
                                @php
                                    if (isset($person->modality)) {
                                        $campName = '';
                                        switch ($person->modality) {
                                            case '0':
                                                $campName = 'Mirim';
                                                $cardColor = 'green';
                                                break;
                                            case '1':
                                                $campName = 'FAC';
                                                $cardColor = 'orange';
                                                break;
                                            case '2':
                                                $campName = 'Juvenil';
                                                $cardColor = 'blue';
                                                break;
                                            case '3':
                                                $campName = 'Sênior';
                                                $cardColor = 'red';
                                                break;
                                            case '4':
                                                $campName = 'Casais';
                                                $cardColor = 'yellow';
                                                break;
                                        }
                                        echo '<span class="badge badge-' . $cardColor . ' ml-1">' . "{$campName}</span>";
                                    }
                                @endphp
                            @endif
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
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.2/sorting/date-euro.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable();

            table.order([0, 'asc']).draw();
        });

        async function downloadXLSX(btn) {
            $('#planilha').attr("disabled", true);
            const wb = XLSX.utils.book_new();

            @if ($type == 'noCampers')
                const nomeArquivo = 'Lista de pré-fichas';
                const resultado = await $.get(`@php echo route('person.waiting-list') @endphp`);
            @endif

            @if ($type == 'campers')
                const nomeArquivo = 'Lista de campistas';
                const resultado = await $.get(`@php echo route('person.campers-list') @endphp`);
            @endif


            const hoje = moment();
            const pessoas = resultado.map((person) => {
                const {
                    name,
                    contact,
                    cpf,
                    email,
                    instagram,
                    facebook,
                    gender,
                    street,
                    district,
                    number,
                    complement,
                    city,
                    state,
                    date_birthday,
                    parish,
                    religion,
                    is_baptized,
                    is_confirmed,
                    is_eucharist,
                    is_pastoral,
                    pastoral,
                    marital_status,
                    modality,
                    waiting_date,
                    created_at
                } = person;

                const dataNascimento = moment(date_birthday);
                const idade = hoje.diff(dataNascimento, 'years');

                const dataEnvioFicha = waiting_date != null ? waiting_date : created_at;

                const sexo = gender === 1 ? 'feminino' : 'masculino';
                const batizado = is_baptized === 1 ? 'sim' : 'não';
                const crismado = is_confirmed === 1 ? 'sim' : 'não';
                const primeiraEucaristia = is_eucharist === 1 ? 'sim' : 'não';
                const participaPastoral = is_pastoral === 1 ? 'sim' : 'não';
                const estadoCivil = [
                    'solteiro',
                    'casado',
                    'separado',
                    'divorciado',
                    'viúvo',
                    'amasiado',
                    'padre',
                    'freira'
                ][marital_status];
                const aguardandoAcampamento = [
                    'mirim',
                    'FAC',
                    'Juvenil',
                    'Sênior',
                    'Casais'
                ][modality];

                return {
                    nome: name,
                    contato: contact,
                    cpf: cpf,
                    email: email,
                    instagram: instagram,
                    facebook: facebook,
                    sexo: sexo,
                    rua: street,
                    bairro: district,
                    numero: number,
                    complemento: complement,
                    cidade: city,
                    estado: state,
                    dataNascimento: dataNascimento.format('DD/MM/YYYY'),
                    idade: idade,
                    paroquia: parish,
                    religiao: religion,
                    batizado: batizado,
                    primeiraEucaristia: primeiraEucaristia,
                    crismado: crismado,
                    participaPastoral: participaPastoral,
                    pastoral: pastoral,
                    estadoCivil: estadoCivil,
                    dataEnvioFicha: moment(dataEnvioFicha).format('DD/MM/YYYY'),
                    aguardandoAcampamento: aguardandoAcampamento
                };
            });

            const dados = pessoas;

            const ws = XLSX.utils.json_to_sheet(dados);
            wb.SheetNames.push(nomeArquivo);
            wb.Sheets[nomeArquivo] = ws;

            XLSX.writeFile(wb, `${nomeArquivo }.xlsx`, {
                bookType: 'xlsx',
                type: 'binary'
            });
            $('#planilha').attr("disabled", false);
        }

    </script>
@stop
