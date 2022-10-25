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
                                                onchange="alteraTribo(this)"
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
                                                }

                                                @endphp
                                                >
                                                <option value="">Selecione</option>
                                                <option value="red" @selected($camper->group == 'red')>Vermelho</option>
                                                <option value="blue" @selected($camper->group == 'blue')>Azul</option>
                                                <option value="brown" @selected($camper->group == 'brown')>Marrom</option>
                                                <option value="orange" @selected($camper->group == 'orange')>Laranja</option>
                                                <option value="yellow" @selected($camper->group == 'yellow')>Amarelo</option>
                                                <option value="black" @selected($camper->group == 'black')>Preto</option>
                                                <option value="purple" @selected($camper->group == 'purple')>Roxo</option>
                                                <option value="green" @selected($camper->group == 'green')>Verde</option>
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
                <div class="tab-pane fade" id="nav-servants" role="tabpanel" aria-labelledby="nav-profile-tab">Profile</div>
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
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js"
        integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    <script>
        var addCampers = [];
        var campersContent = document.querySelector('#campersContent');
        var csrf = document.getElementsByName('_token')[0].value;

        function adicionar(id) {
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

        function loadNoCampers(search = 0) {
            addCampers = [];
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
                        newHtml += '<a onclick="adicionar(' + "'" + person.id + "'" +
                            ')" style="cursor: pointer;">'
                        newHtml += '<i class="fas fa-lg fa-fw fa-plus text-success" id="camper' + person
                            .id + '"></i>'
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
                        newHtml += '<a onclick="adicionar(' + "'" + person.id + "'" +
                            ')" style="cursor: pointer;">'
                        newHtml += '<i class="fas fa-lg fa-fw fa-plus text-success" id="camper' + person
                            .id + '"></i>'
                        newHtml += '</a>'
                        newHtml += '</div>'
                        newHtml += '</div>'
                        newHtml += '<hr>'
                    });

                    campersContent.innerHTML = newHtml;
                })
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

        function alteraTribo(src) {
            paintSelectedGroup(src);

            let camper_id = src.id.split('group');

            $.post("@php echo route('camper.change-group') @endphp", {
                _token: csrf,
                group: src.value,
                camper_id: camper_id[1]
            });

        }
    </script>
@stop
