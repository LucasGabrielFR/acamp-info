@extends('adminlte::page')

@section('title', 'Informações')

@section('css')
    <style>
        .card-brown>.card-header {
            background: #8B4513;
            color: white;
        }

        .card-servant>.card-header {
            background: #fa7f72;
            color: black;
        }

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

@section('content_header')
    <div class="row">
        <h1>Informações da Pessoa</h1>
        <a class="btn btn-primary mx-1 shadow" href="{{ route('person.edit', $person->id) }}">
            Editar
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-3">
                                    @if (isset($person->image))
                                        <img src="{{ url("{$person->image}") }}" alt="" class="card-img-top">
                                    @endif
                                    @if (!isset($person->image))
                                        <img src="{{ url('img/blank-profile.png') }}" alt="" class="card-img-top">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Formação</h2>
                    <hr>
                    <div class="row">
                        <div class="form-group">
                            <label>Batizado?</label>
                            <br>
                            <b class="text-danger">{{ $person->is_baptized == 1 ? 'Sim' : 'Não' }}</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Crismado?</label>
                            <br>
                            <b class="text-danger">{{ $person->is_confirmed == 1 ? 'Sim' : 'Não' }}</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Fez primeira Eucaristia?</label>
                            <br>
                            <b class="text-danger">{{ $person->is_eucharist == 1 ? 'Sim' : 'Não' }}</b>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <h2>
                        Dados Pessoais
                    </h2>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Nome*</label>
                                <br>
                                <div class="text-danger">{{ $person->name }}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Data de nascimento*</label>
                                <br>
                                @php
                                    $birthdayDate = strtotime($person->date_birthday);
                                    $birthdayDate = date('d/m/Y', $birthdayDate);

                                    $dataNascimento = $person->date_birthday;
                                    $date = new DateTime($dataNascimento);
                                    $age = $date->diff(new DateTime(date('Y-m-d')));
                                @endphp
                                <div class="text-danger">{{ $birthdayDate }} - {{ $age->format('%Y anos') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Email</label>
                                <br>
                                <div class="text-danger">{{ $person->email }}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Telefone*</label>
                                <br>
                                <div class="text-danger">{{ $person->contact }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>CPF</label>
                                <br>
                                <div class="text-danger">{{ $person->cpf }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>
                        Endereço
                    </h2>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Rua</label>
                                <div class="text-danger">{{ $person->street }}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Bairro</label>
                                <br>
                                <div class="text-danger">{{ $person->district }}</div>

                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Número</label>
                                <br>
                                <div class="text-danger">{{ $person->number }}</div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Cidade</label>
                                <br>
                                <div class="text-danger">{{ $person->city }}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <div class="text-danger">{{ $person->state }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Informações</h2>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Religião</label>
                                <div class="text-danger">{{ $person->religion }}</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Paróquia</label>
                                <div class="text-danger">{{ $person->parish }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Participa de alguma pastoral?</label>
                                <br>
                                <div class="text-danger">{{ $person->is_pastoral == 1 ? 'Sim' : 'Não' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Pastoral</label>
                                <div class="text-danger">{{ $person->pastoral }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Estado Civil</label>
                                <br>
                                <div class="text-danger">
                                    @php
                                        switch ($person->marital_status) {
                                            case 0:
                                                echo 'Solteiro';
                                                break;
                                            case 1:
                                                echo 'Casado';
                                                break;
                                            case 2:
                                                echo 'Separado';
                                                break;
                                            case 3:
                                                echo 'Divorciado';
                                                break;
                                            case 4:
                                                echo 'Viúvo';
                                                break;
                                            case 5:
                                                echo 'Amasiado';
                                                break;
                                            case 6:
                                                echo 'Padre';
                                                break;
                                            case 7:
                                                echo 'Freira';
                                                break;
                                        }
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Cônjuge é campista?</label>
                                <br>
                                <div class="text-danger">{{ $person->is_spouse_camper == 1 ? 'Sim' : 'Não' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nome do Cônjuge</label>
                                <div class="text-danger">{{ $person->spouse_name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Restrições Médicas</label>
                                <div class="text-danger">{{ $person->medical_attention }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Observações</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="timeline">

                                @foreach ($person->observations as $observation)
                                    @php
                                        $createdAt = $observation->created_at;
                                        $createdAt = new DateTime($createdAt);
                                    @endphp
                                    <div class="time-label">
                                        <span class="bg-red">{{ $createdAt->format('d/m/Y') }}</span>
                                    </div>

                                    <div>
                                        <i class="fas fa-info bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time text-white"><i class="fas fa-clock"></i>
                                                {{ $createdAt->format('H:i') }}</span>
                                            <h3 class="timeline-header bg-info">
                                                <b>{{ $observation->camp->name }}</b>
                                            </h3>
                                            <div class="timeline-body">
                                                {{ $observation->observation }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Acampamentos
                    </div>
                    <div class="text-right">
                        <x-adminlte-button label="+" data-toggle="modal" data-target="#campModal"
                            class="bg-success" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($person->camps as $camper)
                            @php
                                $cardColor = $camper->group;
                                if ($cardColor == 'black') {
                                    $cardColor = 'dark';
                                }
                            @endphp
                            <div class="col-auto">
                                <x-adminlte-card title="{{ $camper->camp->name }}" icon="fas fa-lg fa-campground"
                                    theme="{{ $cardColor }}" collapsible>
                                    @php
                                        $startDate = strtotime($camper->camp->date_start);
                                        $startDate = date('d/m/Y', $startDate);

                                        $endDate = strtotime($camper->camp->date_end);
                                        $endDate = date('d/m/Y', $endDate);
                                    @endphp
                                    <b>{{ $camper->camp->name }}</b>
                                    <br>
                                    Início em: <b>{{ $startDate }}</b>
                                    <br>
                                    Término em: <b>{{ $endDate }}</b>
                                    <br>
                                    Tribo: <span class="badge badge-{{ $cardColor }}">
                                        @php
                                            switch ($camper->group) {
                                                case 'red':
                                                    echo 'Vermelha';
                                                    break;
                                                case 'blue':
                                                    echo 'Azul';
                                                    break;
                                                case 'brown':
                                                    echo 'Marrom';
                                                    break;
                                                case 'orange':
                                                    echo 'Laranja';
                                                    break;
                                                case 'yellow':
                                                    echo 'Amarela';
                                                    break;
                                                case 'black':
                                                    echo 'Preta';
                                                    break;
                                                case 'purple':
                                                    echo 'Roxa';
                                                    break;
                                                case 'green':
                                                    echo 'Verde';
                                                    break;
                                            }
                                        @endphp
                                    </span>
                                </x-adminlte-card>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Serviços
                    </div>
                    <div class="text-right">
                        <x-adminlte-button label="+" data-toggle="modal" data-target="#serveModal"
                            class="bg-success" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            @foreach ($person->serves as $serve)
                                <div class="col-auto">
                                    <x-adminlte-card title="{{ $serve->camp->name }} - Servo"
                                        icon="fas fa-lg fa-user-tie" theme="servant" collapsible>
                                        @php
                                            $startDate = strtotime($serve->camp->date_start);
                                            $startDate = date('d/m/Y', $startDate);

                                            $endDate = strtotime($serve->camp->date_end);
                                            $endDate = date('d/m/Y', $endDate);
                                        @endphp
                                        <b>{{ $serve->camp->name }}</b>
                                        <br>
                                        Início em: <b>{{ $startDate }}</b>
                                        <br>
                                        Término em: <b>{{ $endDate }}</b>
                                        <br>
                                        Setor: <span class="badge badge-servant">
                                            @php
                                                switch ($serve->sector) {
                                                    case 'cozinha':
                                                        $sector = 'Cozinha';
                                                        break;
                                                    case 'anjo':
                                                        $sector = 'Anjo/Líder/Padrinho';
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
                                                    case 'cantinho-mariano':
                                                        $sector = 'Cantinho Mariano';
                                                        break;
                                                    case 'capela':
                                                        $sector = 'Capela';
                                                        break;
                                                    case 'diretor-espiritual':
                                                        $sector = 'Diretor Espiritual';
                                                        break;
                                                    case 'farmacia':
                                                        $sector = 'Farmácia';
                                                        break;
                                                    case 'animacao':
                                                        $sector = 'Animação';
                                                        break;
                                                    case 'ligacao':
                                                        $sector = 'Ligação';
                                                        break;
                                                    case 'manutencao':
                                                        $sector = 'Manutenção';
                                                        break;
                                                    case 'musica':
                                                        $sector = 'Música';
                                                        break;
                                                    case 'pregacao':
                                                        $sector = 'Pregação';
                                                        break;
                                                    case 'teatro':
                                                        $sector = 'Teatro';
                                                        break;
                                                    case 'tropa-de-elite':
                                                        $sector = 'Tropa de Elite';
                                                        break;
                                                }
                                                echo $sector;
                                            @endphp
                                        </span>
                                    </x-adminlte-card>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <x-adminlte-modal id="campModal" title="Campista" size="lg" theme="teal" icon="fas fa-lg fa-campground"
        v-centered static-backdrop scrollable>
        <div class="row">
            <label>Acampamento que foi campista</label>
            <select class="custom-select" id="acampamento-camper">
                <option value="">Selecionar</option>
                @foreach ($camps as $camp)
                    <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                @endforeach
            </select>
            <div class="alert alert-danger mt-1" role="alert" id="acampamento-camper-error" style="display: none">
                Selecione uma opção
            </div>
        </div>
        <div class="row">
            <label>Tribo</label>
            <select class="custom-select" id="camp-tribo" onchange="paintSelectedGroup(this)">
                <option value="">Selecionar</option>
                <option value="red">Vermelho</option>
                <option value="blue">Azul</option>
                <option value="brown">Marrom</option>
                <option value="orange">Laranja</option>
                <option value="yellow">Amarelo</option>
                <option value="black">Preto</option>
                <option value="purple">Roxo</option>
                <option value="green">Verde</option>
            </select>
            <div class="alert alert-danger mt-1" role="alert" id="tribo-error" style="display: none">
                Selecione uma opção
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button onclick="signCamper()" class="mr-auto" theme="success" label="Adicionar"
                id="addCamp" />
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelCamp" />
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-modal id="serveModal" title="Servir" size="lg" theme="teal" icon="fas fa-lg fa-campground"
        v-centered static-backdrop scrollable>
        <div class="row">
            <label>Acampamento que foi servo</label>
            <select class="custom-select" id="acampamento-serve">
                <option value="">Selecionar</option>
                @foreach ($camps as $camp)
                    <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                @endforeach
            </select>
            <div class="alert alert-danger mt-1" role="alert" id="acampamento-serve-error" style="display: none">
                Selecione uma opção
            </div>
        </div>
        <div class="row">
            <label>Setor</label>
            <select class="custom-select" id="camp-sector">
                <option value="">Selecione</option>
                <option value="animacao">Animação</option>
                <option value="anjo">Anjo/Líder/Padrinho</option>
                <option value="cantinho-mariano">Cantinho Mariano</option>
                <option value="capela">Capela</option>
                <option value="coordenacao">Coordenação</option>
                <option value="cozinha">Cozinha</option>
                <option value="diretor espiritual">Diretor Espiritual</option>
                <option value="evangelizacao">Evangelização</option>
                <option value="farmacia">Farmácia</option>
                <option value="ligacao">Ligação</option>
                <option value="manutencao">Manutenção</option>
                <option value="musica">Música</option>
                <option value="pregacao">Pregação</option>
                <option value="secretaria">Secretaria</option>
                <option value="teatro">Teatro</option>
                <option value="tropa-de-elite">Tropa de Elite</option>
            </select>
            <div class="alert alert-danger mt-1" role="alert" id="sector-error" style="display: none">
                Selecione uma opção
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button onclick="signServe()" class="mr-auto" theme="success" label="Adicionar"
                id="addServe" />
            <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancelServe" />
        </x-slot>
    </x-adminlte-modal>
    <x-footer />
@stop
@section('js')
    <script>
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

        function signCamper() {
            let valido = true;
            var csrf = document.getElementsByName('_token')[0].value;
            const acampamentoCamper = document.getElementById('acampamento-camper');
            const campTribo = document.getElementById('camp-tribo');
            if (acampamentoCamper.value.length < 3) {
                $('#acampamento-camper-error').css({
                    display: "block"
                });
                valido = false;
            } else {
                $('#acampamento-camper-error').css({
                    display: "none"
                });
            }
            if (campTribo.value.length < 3) {
                $('#tribo-error').css({
                    display: "block"
                });
                valido = false;
            } else {
                $('#tribo-error').css({
                    display: "none"
                });
            }
            if (valido) {
                $('#addCamp').prop('disabled', true);
                $('#cancelCamp').prop('disabled', true);
                $.post("@php echo route('camp.add-camper') @endphp", {
                    _token: csrf,
                    person_id: '{{ $person->id }}',
                    camp_id: acampamentoCamper.value,
                    tribo: campTribo.value,
                }, function(msg) {
                    $('#addCamp').prop('disabled', false);
                    $('#cancelCamp').prop('disabled', false);
                    window.location.reload(true);
                })
            }

        }

        function signServe() {
            let valido = true;
            var csrf = document.getElementsByName('_token')[0].value;
            const acampamentoServe = document.getElementById('acampamento-serve');
            const campSector = document.getElementById('camp-sector');
            if (acampamentoServe.value.length < 3) {
                $('#acampamento-serve-error').css({
                    display: "block"
                });
                valido = false;
            } else {
                $('#acampamento-serve-error').css({
                    display: "none"
                });
            }
            if (campSector.value.length < 3) {
                $('#sector-error').css({
                    display: "block"
                });
                valido = false;
            } else {
                $('#sector-error').css({
                    display: "none"
                });
            }
            if (valido) {
                $('#addServe').prop('disabled', true);
                $('#cancelServe').prop('disabled', true);
                $.post("@php echo route('camp.add-serve') @endphp", {
                    _token: csrf,
                    person_id: '{{ $person->id }}',
                    camp_id: acampamentoServe.value,
                    sector: campSector.value,
                }, function(msg) {
                    $('#addServe').prop('disabled', false);
                    $('#cancelServe').prop('disabled', false);
                    window.location.reload(true);
                })
            }

        }
    </script>
@stop
