@extends('adminlte::page')

@section('title', 'Visualizar Acampamento')

@section('content_header')
    <h1>Visualizar Acampamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <b>Informações</b>
        </div>
        <div class="card-body">
            <div class="row">
                <label>Nome: </label>
                <div class="text-danger ml-2">{{ $camp->name }}</div>
            </div>
            <div class="row">
                <label>Modalidade: </label>
                <div class="text-danger ml-2">{{ $camp->type->name }}</div>
            </div>
            <div class="row">
                <label>Data de Início: </label>
                <div class="text-danger ml-2">{{ $camp->date_start }}</div>
            </div>
            <div class="row">
                <label>Data de Término: </label>
                <div class="text-danger ml-2">{{ $camp->date_end }}</div>
            </div>
        </div>
    </div>
    <hr>
    <div class="card">
        <div class="card-header">
            <b>Relação de Pessoas</b>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-campers-tab" data-toggle="tab" data-target="#nav-campers"
                        type="button" role="tab" aria-controls="nav-campers" aria-selected="true">Campistas</button>
                    <button class="nav-link ml-2" id="nav-servants-tab" data-toggle="tab" data-target="#nav-servants"
                        type="button" role="tab" aria-controls="nav-servants" aria-selected="false">Equipe de
                        servos</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-campers" role="tabpanel" aria-labelledby="nav-home-tab">
                    @php
                        $heads = ['Nome', 'Contato', 'Idade', 'Paróquia', 'Tribo', 'Ações'];

                        $config = [
                            'data' => $campers,
                            'order' => [[1, 'asc']],
                            'columns' => [null, null, null, null, null, ['orderable' => false]],
                        ];
                    @endphp
                    <div class="card">
                        <div class="card-header">
                            <b>Campistas</b>
                            <x-adminlte-button onclick="loadNoCampers()" label="Adicionar Campistas" data-toggle="modal"
                                data-target="#campersModal" class="bg-teal" />
                            <x-adminlte-button onclick="downloadCampistasXlsx()" label="Planilha de campistas"
                                class="bg-success float-right" icon="fas fa-lg fa-table" id="planilhaCampistas" />
                        </div>
                        <div class="card-body">
                            <x-adminlte-datatable id="table1" :heads="$heads" class="">
                                @foreach ($config['data'] as $camper)
                                    @php
                                        $dataNascimento = $camper->date_birthday;
                                        $data = new DateTime($dataNascimento);
                                        $resultado = $data->diff(new DateTime(date('Y-m-d')));
                                    @endphp
                                    <tr>
                                        <td>{{ $camper->name }}</td>
                                        <td>{{ $camper->contact }}</td>
                                        <td>{{ $resultado->format('%Y anos') }}</td>
                                        <td>{{ $camper->parish }}</td>
                                        <td>
                                            <select id="group{{ $camper->id }}" class="custom-select"
                                                onchange="alteraTribo(this, 0)" onclick="adicionaOptions(this, 0)"
                                                onblur="removeOptions(this, 0)"
                                                @php
switch ($camper->group) {
                                                        case 'red':
                                                            echo 'style="background: red; color: white"';
                                                            break;
                                                        case 'blue':
                                                            echo 'style="background: blue; color: white"';
                                                            break;
                                                        case 'brown':
                                                            echo 'style="background: brown; color: white"';
                                                            break;
                                                        case 'orange':
                                                            echo 'style="background: orange; color: black"';
                                                            break;
                                                        case 'yellow':
                                                            echo 'style="background: yellow; color: black"';
                                                            break;
                                                        case 'black':
                                                            echo 'style="background: black; color: white"';
                                                            break;
                                                        case 'purple':
                                                            echo 'style="background: purple; color: white"';
                                                            break;
                                                        case 'green':
                                                            echo 'style="background: green; color: white"';
                                                            break;
                                                    } @endphp>
                                                @if ($camper->group)
                                                    <option value="{{ $camper->group }}" selected>
                                                        @switch($camper->group)
                                                            @case('red')
                                                                Vermelho
                                                            @break

                                                            @case('blue')
                                                                Azul
                                                            @break

                                                            @case('brown')
                                                                Marrom
                                                            @break

                                                            @case('orange')
                                                                Laranja
                                                            @break

                                                            @case('yellow')
                                                                Amarelo
                                                            @break

                                                            @case('black')
                                                                Preto
                                                            @break

                                                            @case('purple')
                                                                Roxo
                                                            @break

                                                            @case('green')
                                                                Verde
                                                            @break
                                                        @endswitch
                                                    </option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <x-modal url="{{ route('camp.delete-camper', $camper->id) }}"
                                                id="{{ $camper->id }}" name="{{ $camper->name }}" />
                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="nav-servants" role="tabpanel" aria-labelledby="nav-profile-tab">
                    @php
                        $heads = ['Nome', 'Contato', 'Idade', 'Paróquia', 'Setor', 'Função', 'Ações'];

                        $config = [
                            'data' => $servants,
                            'order' => [[1, 'asc']],
                            'columns' => [null, null, null, null, null, ['orderable' => false]],
                        ];
                    @endphp
                    <div class="card">
                        <div class="card-header">
                            <b>Servos</b>
                            <x-adminlte-button onclick="loadNoServants()" label="Adicionar Servos" data-toggle="modal"
                                data-target="#servantsModal" class="bg-teal" />
                            <x-adminlte-button onclick="downloadServosXlsx()" label="Planilha de Servos"
                                class="bg-success float-right" icon="fas fa-lg fa-table" id="planilhaServos" />
                        </div>
                        <div class="card-body">
                            <x-adminlte-datatable id="table2" :heads="$heads" class="">
                                @foreach ($config['data'] as $servant)
                                    @php
                                        $dataNascimento2 = $servant->date_birthday;
                                        $data2 = new DateTime($dataNascimento2);
                                        $resultado2 = $data2->diff(new DateTime(date('Y-m-d')));
                                    @endphp
                                    <tr>
                                        <td>{{ $servant->name }}</td>
                                        <td>{{ $servant->contact }}</td>
                                        <td>{{ $resultado2->format('%Y anos') }}</td>
                                        <td>{{ $servant->parish }}</td>
                                        <td>
                                            <select id="sector{{ $servant->id }}" class="custom-select"
                                                onchange="alteraSetor(this, 1)" onclick="adicionaOptions(this, 1)"
                                                onblur="removeOptions(this, 1)">
                                                @if ($servant->sector)
                                                    <option value="{{ $servant->sector }}" selected>
                                                        @switch($servant->sector)
                                                            @case('animacao')
                                                                Animação
                                                            @break

                                                            @case('anjo')
                                                                Anjo/Líder/Padrinho
                                                            @break

                                                            @case('cantinho-mariano')
                                                                Cantinho Mariano
                                                            @break

                                                            @case('capela')
                                                                Capela
                                                            @break

                                                            @case('coordenacao')
                                                                Coordenação
                                                            @break

                                                            @case('cozinha')
                                                                Cozinha
                                                            @break

                                                            @case('diretor-espiritual')
                                                                Diretor Espiritual
                                                            @break

                                                            @case('evangelizacao')
                                                                Evangelização
                                                            @break

                                                            @case('farmacia')
                                                                Farmácia
                                                            @break

                                                            @case('ligacao')
                                                                Ligação
                                                            @break

                                                            @case('manutencao')
                                                                Manutenção
                                                            @break

                                                            @case('musica')
                                                                Música
                                                            @break

                                                            @case('pregacao')
                                                                Pregação
                                                            @break

                                                            @case('secretaria')
                                                                Secretaria
                                                            @break

                                                            @case('teatro')
                                                                Teatro
                                                            @break

                                                            @case('tropa-de-elite')
                                                                Tropa de Elite
                                                            @break
                                                        @endswitch
                                                    </option>
                                                @endif
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            @php
                                                if (!isset($servant->hierarchy)) {
                                                    $servant->hierarchy = '';
                                                }
                                            @endphp
                                            <select id="hierarchy{{ $servant->id }}" class="custom-select"
                                                onchange="alteraHierarquia(this)">
                                                <option>Selecione</option>
                                                <option value="coordenacao" @selected($servant->hierarchy === 'coordenacao')>Coordenação
                                                </option>
                                                <option value="aux" @selected($servant->hierarchy === 'aux')>Auxiliar</option>
                                                <option value="servo" @selected($servant->hierarchy === 'servo')>Servo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <x-modal url="{{ route('camp.delete-servant', $servant->id) }}"
                                                id="{{ $servant->id }}" name="{{ $servant->name }}" />
                                        </td>
                                    </tr>
                                @endforeach
                            </x-adminlte-datatable>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <x-adminlte-modal id="campersModal" title="Adicionar Campista" size="lg" theme="teal" icon="fas fa-user-plus"
        v-centered static-backdrop scrollable>
        @csrf
        <div class="row">
            <div class="col-4">
                <input class="form-control" type="search" name="searchNoCampers" id="searchNoCampers"
                    placeholder="Buscar" onkeyup="loadNoCampers(this)">
            </div>
        </div>
        <hr>
        <div id="campersContent">
            <b>Carregando...</b>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button onclick="signCampers()" class="mr-auto" theme="success" label="Adicionar" />
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>

    <x-adminlte-modal id="servantsModal" title="Adicionar Servos" size="lg" theme="teal" icon="fas fa-users"
        v-centered static-backdrop scrollable>
        @csrf
        <div class="row">
            <div class="col-4">
                <input class="form-control" type="search" name="searchNoServants" id="searchNoServants"
                    placeholder="Buscar" onkeyup="loadNoServants(this)">
            </div>
        </div>
        <hr>
        <div id="servantsContent">
            <b>Carregando...</b>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button onclick="signServants()" class="mr-auto" theme="success" label="Adicionar" />
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" />
        </x-slot>
    </x-adminlte-modal>
    <x-footer />
@stop
@section('js')
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        var addCampers = [];
        var addServants = [];
        var campersContent = document.querySelector('#campersContent');
        var servantsContent = document.querySelector('#servantsContent');
        var csrf = document.getElementsByName('_token')[0].value;
        var groups = [{
                cor: "",
                traducao: "Selecione"
            },
            {
                cor: "red",
                traducao: "Vermelho"
            },
            {
                cor: "blue",
                traducao: "Azul"
            },
            {
                cor: "brown",
                traducao: "Marrom"
            },
            {
                cor: "orange",
                traducao: "Laranja"
            },
            {
                cor: "yellow",
                traducao: "Amarelo"
            },
            {
                cor: "black",
                traducao: "Preto"
            },
            {
                cor: "purple",
                traducao: "Roxo"
            },
            {
                cor: "green",
                traducao: "Verde"
            }
        ];

        var sectors = [{
                sector: "",
                label: "Selecione"
            },
            {
                sector: "animcao",
                label: "Animação"
            },
            {
                sector: "anjo",
                label: "Anjo/Líder/Padrinho"
            },
            {
                sector: "cantinho-mariano",
                label: "Cantinho Mariano"
            },
            {
                sector: "capela",
                label: "Capela"
            },
            {
                sector: "coordenacao",
                label: "Coordenação"
            },
            {
                sector: "cozinha",
                label: "Cozinha"
            },
            {
                sector: "diretor-espiritual",
                label: "Diretor Espiritual"
            },
            {
                sector: "evangelizacao",
                label: "Evangelização"
            },
            {
                sector: "pregacao",
                label: "Pregação"
            },
            {
                sector: "manutencao",
                label: "Manutenção"
            },
            {
                sector: "musica",
                label: "Música"
            },
            {
                sector: "secretaria",
                label: "Secretaria"
            },
            {
                sector: "teatro",
                label: "Teatro"
            },
            {
                sector: "tropa-de-elite",
                label: "Tropa de Elite"
            },
        ];

        function adicionarCampista(id) {
            let el = document.getElementById('camper' + id);
            if (el.classList.contains('fa-plus')) {
                el.classList.remove('fa-plus');
                el.classList.add('fa-check');
                addCampers.push(id);
            } else {
                el.classList.remove('fa-check');
                el.classList.add('fa-plus');
                addCampers.splice(addCampers.indexOf(id), 1);
            }
        }

        function adicionarServo(id) {
            let el = document.getElementById('servant' + id);
            if (el.classList.contains('fa-plus')) {
                el.classList.remove('fa-plus');
                el.classList.add('fa-check');
                addServants.push(id);
            } else {
                el.classList.remove('fa-check');
                el.classList.add('fa-plus');
                addServants.splice(addServants.indexOf(id), 1);
            }
        }

        function loadNoCampers(search = 0) {
            const waitingHtml = '<b>Carregando...</b>';
            campersContent.innerHTML = waitingHtml;

            const endpoint = search == 0 ? `@php echo route('camp.no-campers', $camp->id) @endphp` : `@php echo route('camp.no-campers-search', $camp->id) @endphp`;
            const data = search == 0 ? {} : {
                _token: csrf,
                search: search.value
            };


            if (search == 0) {
                $.get(endpoint, data, async function(resultado) {
                    let newHtml = '';

                    if (resultado.length < 1) {
                        newHtml = 'Nenhum Resultado encontrado';
                    }

                    for (const person of resultado) {
                        const personHtml = await buildPersonHtml(person);
                        newHtml += personHtml;
                    }

                    campersContent.innerHTML = newHtml;
                });
            } else {
                $.post(endpoint, data, async function(resultado) {
                    let newHtml = '';

                    if (resultado.length < 1) {
                        newHtml = 'Nenhum Resultado encontrado';
                    }

                    for (const person of resultado) {
                        const personHtml = await buildPersonHtml(person);
                        newHtml += personHtml;
                    }

                    campersContent.innerHTML = newHtml;
                });
            }

        }

        async function buildPersonHtml(person) {
            const addIconClass = addCampers.includes(person.id) ? 'fa-check' : 'fa-plus';
            const addIconHtml = `<i class="fas fa-lg fa-fw ${addIconClass} text-success" id="camper${person.id}"></i>`;
            const parishHtml = person.parish ? `<div class="col-md-3">${person.parish}</div>` :
                '<div class="col-md-3"></div>';
            const cityHtml = person.city ? `<div class="col-md-3">${person.city}</div>` :
                '<div class="col-md-3"></div>';

            return `
                <div class="row mt-1">
                <div class="col-md-3">${person.name}</div>
                ${cityHtml}
                ${parishHtml}
                <div class="col-md-2">${calculaIdade(new Date(person.date_birthday), new Date())}</div>
                <div class="col-md-1 text-right">
                    <a onclick="adicionarCampista('${person.id}')" style="cursor: pointer;">${addIconHtml}</a>
                </div>
                </div>
                <hr>
            `;
        }

        function renderServants(resultado) {
            let newHtml = '';
            if (resultado.length < 1) {
                newHtml = 'Nenhum Resultado encontrado';
            }
            resultado.forEach(person => {
                const {
                    id,
                    name,
                    date_birthday,
                    image
                } = person;

                const checkIcon = addServants.includes(id) ? 'check' : 'plus';
                newHtml += `
                            <div class="row mt-1">
                                <div class="col-md-3">
                                    <img src="http://admin.movimentocampista.com.br/${image}" alt="${name}" class="card-img-top" width="100%" height="100%">
                                </div>
                                <div class="col-md-5 align-self-center">${name}</div>
                                <div class="col-md-2 align-self-center">${calculaIdade(new Date(date_birthday), new Date())}</div>
                                <div class="col-md-2 text-right align-self-center">
                                    <a onclick="adicionarServo('${id}')" style="cursor: pointer;">
                                        <i class="fas fa-lg fa-fw fa-${checkIcon} text-success" id="servant${id}"></i>
                                    </a>
                                </div>
                            </div>
                            <hr>
                        `;
            });

            const servantsContainer = document.getElementById('servantsContent');
            while (servantsContainer.firstChild) {
                servantsContainer.removeChild(servantsContainer.firstChild);
            }
            const fragment = document.createRange().createContextualFragment(newHtml);
            servantsContainer.appendChild(fragment);
        }

        function loadNoServants(search = 0) {
            const waitingHtml = '<b>Carregando...</b>';
            const servantsContent = document.getElementById('servantsContent');
            servantsContent.innerHTML = waitingHtml;
            if (search == 0) {
                $.get(`@php echo route('camp.no-servants', $camp->id) @endphp`, renderServants);
            } else {
                $.post(`@php echo route('camp.no-servants-search', $camp->id) @endphp`, {
                    _token: csrf,
                    search: search.value,
                }, renderServants);
            }
        }

        function calculaIdade(nascimento, hoje) {
            return Math.floor(Math.ceil(Math.abs(nascimento.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
        }

        function signCampers() {
            if (addCampers.length > 0) {
                $.post("@php echo route('camp.add-campers', $camp->id) @endphp", {
                    _token: csrf,
                    campers: addCampers,
                    camp_id: "@php echo $camp->id @endphp"
                }, function(msg) {
                    window.location.reload(true);
                })
                addCampers = [];
            }
        }

        function signServants() {
            if (addServants.length > 0) {
                $.post("@php echo route('camp.add-servants', $camp->id) @endphp", {
                    _token: csrf,
                    servants: addServants,
                    camp_id: "@php echo $camp->id @endphp"
                }, function(msg) {
                    window.location.reload(true);
                })
                addServants = [];
            }
        }

        function paintSelectedGroup(src) {
            if (src.value == 'blue' || src.value == 'brown' || src.value == 'blue' || src.value == 'red' || src.value ==
                'black' || src.value == 'purple' || src.value == 'green') {
                $('#' + src.id).css({
                    'background': src.value,
                    'color': 'white'
                });
            } else {
                $('#' + src.id).css({
                    'background': src.value,
                    'color': 'black'
                });
            }
        }

        function alteraTribo(src, type) {
            paintSelectedGroup(src);

            let camper_id = src.id.split('group');

            $.post("@php echo route('camper.change-group') @endphp", {
                _token: csrf,
                group: src.value,
                camper_id: camper_id[1]
            });
            removeOptions(src, type);
            let divSearch = document.getElementById("table1_filter");
            let search = divSearch.querySelector("input");

            $('#table1').DataTable().destroy();
            let table1 = $('#table1').DataTable({
                "autoWidth": true
            });
            table1.search(search.value).draw();
        }

        function adicionaOptions(src, type) {
            const selectedOption = src.value;
            removeOptions(src, type);
            const arrayOptions = Array.apply(src.options);
            if (type === 0) {
                groups.forEach(cor => {
                    if (selectedOption !== cor.cor) {
                        let newOption = new Option(cor.traducao, cor.cor)
                        src.add(newOption);
                    }
                });
            } else {
                sectors.forEach(sector => {
                    if (selectedOption !== sector.sector) {
                        let newOption = new Option(sector.label, sector.sector);
                        src.add(newOption);
                    }
                });
            }

        }

        function removeOptions(src, type) {
            const selectedOption = src.value;
            while (src.options.length > 0) {
                src.remove(0);
            }
            if (type === 0) {
                groups.forEach(cor => {
                    if (selectedOption === cor.cor) {
                        let newOption = new Option(cor.traducao, cor.cor)
                        src.add(newOption);
                    }
                });
            } else {
                sectors.forEach(sector => {
                    if (selectedOption === sector.sector) {
                        let newOption = new Option(sector.label, sector.sector);
                        src.add(newOption);
                    }
                });
            }

        }

        function alteraSetor(src, type) {

            let servant_id = src.id.split('sector');

            $.post("@php echo route('servant.change-sector') @endphp", {
                _token: csrf,
                sector: src.value,
                servant_id: servant_id[1]
            });
            removeOptions(src, type);

            let divSearch = document.getElementById("table2_filter");
            let search = divSearch.querySelector("input");

            $('#table2').DataTable().destroy();
            let table2 = $('#table2').DataTable({
                "columnDefs": [{
                        "width": "100px",
                        "targets": 0
                    },
                    {
                        "width": "100px",
                        "targets": 1
                    },
                    {
                        "width": "100px",
                        "targets": 2
                    },
                    {
                        "width": "100px",
                        "targets": 3
                    },
                    {
                        "width": "150px",
                        "targets": 4
                    },
                    {
                        "width": "100px",
                        "targets": 5
                    },
                ]
            });
            table2.search(search.value).draw();

        }

        function alteraHierarquia(src) {

            let servant_id = src.id.split('hierarchy');

            $.post("@php echo route('servant.change-hierarchy') @endphp", {
                _token: csrf,
                hierarchy: src.value,
                servant_id: servant_id[1]
            });
        }

        async function downloadCampistasXlsx() {
            $('#planilhaCampistas').attr("disabled", true);
            const wb = XLSX.utils.book_new();

            const nomeArquivo = '{{ $camp->name }}';
            const resultado = await $.get(`@php echo route('camp.campers', $camp->id) @endphp`);

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
                    marital_status,
                    group
                } = person;

                const dataNascimento = moment(date_birthday);
                const idade = hoje.diff(dataNascimento, 'years');
                const sexo = gender === 1 ? 'masculino' : 'feminino';
                const batizado = is_baptized === 1 ? 'sim' : 'não';
                const crismado = is_confirmed === 1 ? 'sim' : 'não';
                const primeiraEucaristia = is_eucharist === 1 ? 'sim' : 'não';
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

                let tribo = '';
                switch (group) {
                    case ('red'):
                        tribo = 'vermelha';
                        break;
                    case ('blue'):
                        tribo = 'azul';
                        break;
                    case ('orange'):
                        tribo = 'laranja';
                        break;
                    case ('yellow'):
                        tribo = 'amarelo';
                        break;
                    case ('green'):
                        tribo = 'verde';
                        break;
                    case ('brown'):
                        tribo = 'marrom';
                        break;
                    case ('black'):
                        tribo = 'preto';
                        break;
                    case ('purple'):
                        tribo = 'roxo';
                        break;
                }

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
                    estadoCivil: estadoCivil,
                    tribo: tribo
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
            $('#planilhaCampistas').attr("disabled", false);
        }

        async function downloadServosXlsx() {
            $('#planilhaServos').attr("disabled", true);
            const wb = XLSX.utils.book_new();

            const nomeArquivo = '{{ $camp->name }}';
            const resultado = await $.get(`@php echo route('camp.servants', $camp->id) @endphp`);

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
                    marital_status,
                    sector,
                    hierarchy
                } = person;

                const dataNascimento = moment(date_birthday);
                const idade = hoje.diff(dataNascimento, 'years');
                const sexo = gender === 1 ? 'masculino' : 'feminino';
                const batizado = is_baptized === 1 ? 'sim' : 'não';
                const crismado = is_confirmed === 1 ? 'sim' : 'não';
                const primeiraEucaristia = is_eucharist === 1 ? 'sim' : 'não';
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

                let setor = '';
                switch (sector) {
                    case ('animacao'):
                        setor = 'Animação';
                        break;
                    case ('anjo'):
                        setor = 'Anjo/Líder/Padrinho';
                        break;
                    case ('cantinho-mariano'):
                        setor = 'Cantinho Mariano';
                        break;
                    case ('capela'):
                        setor = 'Capela';
                        break;
                    case ('coordenacao'):
                        setor = 'Coordenação';
                        break;
                    case ('cozinha'):
                        setor = 'Cozinha';
                        break;
                    case ('diretor-espiritual'):
                        setor = 'Diretor Espiritual';
                        break;
                    case ('evangelizacao'):
                        setor = 'Evangelização';
                        break;
                    case ('farmacia'):
                        setor = 'Farmácia';
                        break;
                    case ('ligacao'):
                        setor = 'Ligação';
                        break;
                    case ('manutencao'):
                        setor = 'Manutenção';
                        break;
                    case ('musica'):
                        setor = 'Música';
                        break;
                    case ('pregacao'):
                        setor = 'Pregação';
                        break;
                    case ('secretaria'):
                        setor = 'Secretaria';
                        break;
                    case ('teatro'):
                        setor = 'Teatro';
                        break;
                    case ('tropa-de-elite'):
                        setor = 'Tropa de Elite';
                        break;
                }

                let hierarquia = '';
                switch (hierarchy) {
                    case ('coordenacao'):
                        hierarquia = 'Coordenação';
                        break;
                    case ('aux'):
                        hierarquia = 'Auxiliar';
                        break;
                    case ('servo'):
                        hierarquia = 'Servo';
                        break;
                }

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
                    estadoCivil: estadoCivil,
                    setor: setor,
                    função: hierarquia,
                };
            });

            const dados = pessoas;

            const ws = XLSX.utils.json_to_sheet(dados);
            wb.SheetNames.push(nomeArquivo);
            wb.Sheets[nomeArquivo] = ws;

            XLSX.writeFile(wb, `${nomeArquivo}.xlsx`, {
                bookType: 'xlsx',
                type: 'binary'
            });
            $('#planilhaServos').attr("disabled", false);
        }
    </script>
@stop
