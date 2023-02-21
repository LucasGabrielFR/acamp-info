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
                <input class="form-control" type="search" name="searchNoCampers" id="searchNoCampers" placeholder="Buscar"
                    onkeyup="loadNoCampers(this)">
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
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js"
        integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>

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
            let waitingHtml = '<b>Carregando...</b>'
            campersContent.innerHTML = waitingHtml;
            if (search == 0) {
                $.get("@php echo route('camp.no-campers', $camp->id) @endphp", function(resultado) {
                    let newHtml = '';
                    if (resultado.length < 1) {
                        newHtml = 'Nenhum Resultado encontrado';
                    }
                    resultado.forEach(person => {
                        newHtml += '<div class="row mt-1">'
                        newHtml += '<div class="col-6">'
                        newHtml += person.name
                        newHtml += '</div>'
                        newHtml += '<div class="col-4">'
                        newHtml += calculaIdade(new Date(person.date_birthday), new Date())
                        newHtml += '</div>'
                        newHtml += '<div class="col-2 text-right">'
                        newHtml += '<a onclick="adicionarCampista(' + "'" + person.id + "'" +
                            ')" style="cursor: pointer;">'
                        if (addCampers.includes(person.id)) {
                            newHtml += '<i class="fas fa-lg fa-fw fa-check text-success" id="camper' +
                                person
                                .id + '"></i>'
                        } else {
                            newHtml += '<i class="fas fa-lg fa-fw fa-plus text-success" id="camper' + person
                                .id + '"></i>'
                        }
                        newHtml += '</a>'
                        newHtml += '</div>'
                        newHtml += '</div>'
                        newHtml += '<hr>'
                    });

                    campersContent.innerHTML = newHtml;
                })
            } else {
                $.post("@php echo route('camp.no-campers-search', $camp->id) @endphp", {
                    _token: csrf,
                    search: search.value,
                }, function(resultado) {
                    let newHtml = '';
                    if (resultado.length < 1) {
                        newHtml = 'Nenhum Resultado encontrado';
                    }
                    resultado.forEach(person => {
                        newHtml += '<div class="row mt-1">'
                        newHtml += '<div class="col-6">'
                        newHtml += person.name
                        newHtml += '</div>'
                        newHtml += '<div class="col-4">'
                        newHtml += calculaIdade(new Date(person.date_birthday), new Date())
                        newHtml += '</div>'
                        newHtml += '<div class="col-2 text-right">'
                        newHtml += '<a onclick="adicionarCampista(' + "'" + person.id + "'" +
                            ')" style="cursor: pointer;">'
                        if (addCampers.includes(person.id)) {
                            newHtml += '<i class="fas fa-lg fa-fw fa-check text-success" id="camper' +
                                person
                                .id + '"></i>'
                        } else {
                            newHtml += '<i class="fas fa-lg fa-fw fa-plus text-success" id="camper' + person
                                .id + '"></i>'
                        }
                        newHtml += '</a>'
                        newHtml += '</div>'
                        newHtml += '</div>'
                        newHtml += '<hr>'
                    });

                    campersContent.innerHTML = newHtml;
                })
            }
        }

        // function loadNoServants(search = 0) {
        //     let waitingHtml = '<b>Carregando...</b>'
        //     servantsContent.innerHTML = waitingHtml;
        //     if (search == 0) {
        //         $.get("@php echo route('camp.no-servants', $camp->id) @endphp", function(resultado) {
        //             let newHtml = '';
        //             if (resultado.length < 1) {
        //                 newHtml = 'Nenhum Resultado encontrado';
        //             }
        //             resultado.forEach(person => {
        //                 newHtml += '<div class="row mt-1">'
        //                 newHtml += '<div class="col-6">'
        //                 newHtml += person.name
        //                 newHtml += '</div>'
        //                 newHtml += '<div class="col-4">'
        //                 newHtml += calculaIdade(new Date(person.date_birthday), new Date())
        //                 newHtml += '</div>'
        //                 newHtml += '<div class="col-2 text-right">'
        //                 newHtml += '<a onclick="adicionarServo(' + "'" + person.id + "'" +
        //                     ')" style="cursor: pointer;">'
        //                 if (addServants.includes(person.id)) {
        //                     newHtml += '<i class="fas fa-lg fa-fw fa-check text-success" id="servant' +
        //                         person.id + '"></i>'
        //                 } else {
        //                     newHtml += '<i class="fas fa-lg fa-fw fa-plus text-success" id="servant' +
        //                         person.id + '"></i>'
        //                 }
        //                 newHtml += '</a>'
        //                 newHtml += '</div>'
        //                 newHtml += '</div>'
        //                 newHtml += '<hr>'
        //             });

        //             servantsContent.innerHTML = newHtml;
        //         })
        //     } else {
        //         $.post("@php echo route('camp.no-servants-search', $camp->id) @endphp", {
        //             _token: csrf,
        //             search: search.value,
        //         }, function(resultado) {
        //             let newHtml = '';
        //             if (resultado.length < 1) {
        //                 newHtml = 'Nenhum Resultado encontrado';
        //             }
        //             resultado.forEach(person => {
        //                 newHtml += '<div class="row mt-1">'
        //                 newHtml += '<div class="col-6">'
        //                 newHtml += person.name
        //                 newHtml += '</div>'
        //                 newHtml += '<div class="col-4">'
        //                 newHtml += calculaIdade(new Date(person.date_birthday), new Date())
        //                 newHtml += '</div>'
        //                 newHtml += '<div class="col-2 text-right">'
        //                 newHtml += '<a onclick="adicionarServo(' + "'" + person.id + "'" +
        //                     ')" style="cursor: pointer;">'
        //                 if (addServants.includes(person.id)) {
        //                     newHtml += '<i class="fas fa-lg fa-fw fa-check text-success" id="servant' +
        //                         person.id + '"></i>'
        //                 } else {
        //                     newHtml += '<i class="fas fa-lg fa-fw fa-plus text-success" id="servant' +
        //                         person.id + '"></i>'
        //                 }
        //                 newHtml += '</a>'
        //                 newHtml += '</div>'
        //                 newHtml += '</div>'
        //                 newHtml += '<hr>'
        //             });

        //             servantsContent.innerHTML = newHtml;
        //         })
        //     }
        // }

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
                    imageUrl
                } = person;
                const checkIcon = addServants.includes(id) ? 'check' : 'plus';
                newHtml += `
                            <div class="row mt-1">
                                <div class="col-12 col-sm-3"><img src="${imageUrl}" alt="${name}" width="100"></div>
                                <div class="col-12 col-sm-9">${name}</div>
                                <div class="col-12 col-sm-6">${calculaIdade(new Date(date_birthday), new Date())}</div>
                                <div class="col-12 col-sm-3 text-right">
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
    </script>
@stop
