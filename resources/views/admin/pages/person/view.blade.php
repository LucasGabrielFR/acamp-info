@extends('adminlte::page')

@section('title', 'Informações')

@section('css')
    <style>
        .card-brown>.card-header {
            background: #8B4513;
            color: white;
        }

        .card-black>.card-header {
            background: black;
            color: white;
        }

        .card-salmon>.card-header {
            background: #fa7f72;
            color: black;
        }

        .card-sky-blue>.card-header {
            background: #87ceeb;
            color: black;
        }

        .card-herbal>.card-header {
            background: #2e8b57;
            color: white;
        }

        .card-royal-blue>.card-header {
            background: #7694ce;
            color: white;
        }

        .card-dark-green>.card-header {
            background: #00421a;
            color: white;
        }

        .card-inverted>.card-header {
            background: #2f4f4f;
            color: white;
        }

        .card-white-red>.card-header {
            background: #ff9090;
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

@section('content_header')
    <div class="row">
        <h1>Informações da Pessoa</h1>
        <a class="btn btn-primary mx-1 shadow" href="{{ route('personal.edit') }}">
            Editar
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-auto">
                    <div class="row">
                        <div class="card">
                            <div class="card-body" style="max-width: 33vh;">
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
                <div class="col-md-auto">
                    <h2>
                        Dados Pessoais
                    </h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome*</label>
                                <br>
                                <div class="text-danger">{{ $person->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <br>
                                <div class="text-danger">{{ $person->email }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone*</label>
                                <br>
                                <div class="text-danger">{{ $person->contact }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CPF</label>
                                <br>
                                <div class="text-danger">{{ $person->cpf }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gênero</label>
                                <br>
                                <div class="text-danger">{{ $person->gender == 0 ? 'masculino' : 'feminino' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instagram</label>
                                <br>
                                <div class="text-danger">{{ $person->instagram }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Facebook</label>
                                <br>
                                <div class="text-danger">{{ $person->facebook }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>
                        Endereço
                    </h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Rua</label>
                                <div class="text-danger">{{ $person->street }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bairro</label>
                                <br>
                                <div class="text-danger">{{ $person->district }}</div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Número</label>
                                <br>
                                <div class="text-danger">{{ $person->number }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Complemento</label>
                                <br>
                                <div class="text-danger">{{ $person->complement }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cidade</label>
                                <br>
                                <div class="text-danger">{{ $person->city }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <div class="text-danger">{{ $person->state }}</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Informações</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Religião</label>
                                <div class="text-danger">{{ $person->religion }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paróquia</label>
                                <div class="text-danger">{{ $person->parish }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Participa de alguma pastoral?</label>
                                <br>
                                <div class="text-danger">{{ $person->is_pastoral == 1 ? 'Sim' : 'Não' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pastoral</label>
                                <div class="text-danger">{{ $person->pastoral }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cônjuge é campista?</label>
                                <br>
                                <div class="text-danger">{{ $person->is_spouse_camper == 1 ? 'Sim' : 'Não' }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome do Cônjuge</label>
                                <div class="text-danger">{{ $person->spouse_name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Profissão</label>
                            <div class="text-danger">{{ $person->occupation }}</div>
                        </div>
                    </div>
                    <hr>
                    <h2>Familiares e amigos que fizeram o acampamento</h2>
                    @php
                        if (isset($person->familiar)) {
                            $familiares = json_decode($person->familiar, true);
                        }
                        $i = 1;
                    @endphp
                    @for ($i; $i <= 3; $i++)
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nome</label>
                                <div type="text" class="text-danger">{{ $familiares[$i]['familiar'] ?? '' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label>Grau de Parentesco</label>
                                <div type="text" class="text-danger">{{ $familiares[$i]['relationship'] ?? '' }}</div>
                            </div>
                        </div>
                        <hr>
                    @endfor
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Já fez algum retiro?</label>
                            <div class="text-danger">{{ $person->is_retreatant == 1 ? 'Sim' : 'Não' }}</div>
                        </div>
                        <div class="col-md-8">
                            <label>Retiros</label>
                            <div class="text-danger">{{ $person->retreats }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Possui Algum Vício?</label>
                            <div class="text-danger">{{ $person->is_addicted == 1 ? 'Sim' : 'Não' }}</div>
                        </div>
                        <div class="col-md-8">
                            <label>Vícios</label>
                            <div class="text-danger">{{ $person->addiction ?? '' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label>Restrições Médicas</label>
                            <div class="text-danger">{{ $person->medical_attention }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Como ficou sabendo do acampamento?</label>
                            <div class="text-danger">{{ $person->how_find_camp }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>O que levou você a desejar participar do acampamento?</label>
                            <div class="text-danger">{{ $person->why_camp }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Acampamentos
                    </div>
                    {{-- TIRAR FUTURAMENTE --}}
                    {{-- <div class="text-right">
                        <x-adminlte-button label="+" data-toggle="modal" data-target="#campModal"
                            class="bg-success" />
                    </div> --}}
                    {{-- TIRAR FUTURAMENTE --}}
                </div>
                <div class="card-body">
                    <div class="flex-row">
                        @foreach ($campers as $camper)
                            @php
                                $cardColor = $camper->group;
                                if ($cardColor == 'black') {
                                    $cardColor = 'dark';
                                }
                            @endphp
                            <div class="col-auto">
                                <x-adminlte-card title="{{ $camper->camp_name }}" icon="fas fa-lg fa-campground"
                                    theme="{{ $cardColor }}" collapsible>
                                    @php
                                        $startDate = strtotime($camper->date_start);
                                        $startDate = date('d/m/Y', $startDate);

                                        $endDate = strtotime($camper->date_end);
                                        $endDate = date('d/m/Y', $endDate);
                                    @endphp
                                    <b>{{ $camper->camp_name }}</b>
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
        <div class="col-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Serviços
                    </div>
                </div>
                <div class="card-body">
                    <div class="flex-row">
                        @foreach ($serves as $serve)
                            @php
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
                            @endphp
                            <div class="col-auto">
                                <x-adminlte-card title="{{ $serve->camp_name }} - Servo" icon="fas fa-lg fa-user-tie"
                                    theme="{{ $cardColor }}" collapsible>
                                    @php
                                        $startDate = strtotime($serve->date_start);
                                        $startDate = date('d/m/Y', $startDate);

                                        $endDate = strtotime($serve->date_end);
                                        $endDate = date('d/m/Y', $endDate);
                                    @endphp
                                    <b>{{ $serve->camp_name }}</b>
                                    <br>
                                    Início em: <b>{{ $startDate }}</b>
                                    <br>
                                    Término em: <b>{{ $endDate }}</b>
                                    <br>
                                    Setor: <span class="badge badge-{{ $cardColor }}">{{ $sector }}</span>
                                    <br>
                                    Função:
                                    @switch($serve->hierarchy)
                                        @case('coordenacao')
                                            Coordenação
                                        @break

                                        @case('aux')
                                            Auxiliar
                                        @break

                                        @case('servo')
                                            Servo
                                        @break
                                    @endswitch
                                </x-adminlte-card>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-adminlte-modal id="authorizeModal" title="TERMO DE CONSENTIMENTO PARA USO DE DADOS PESSOAIS" size="xl"
        theme="teal" icon="fas fa-lg fa-bell" v-centered static-backdrop scrollable>
        O Titular autoriza a plataforma AcampAdmin a realizar o tratamento, ou seja, a utilizar os seguintes dados pessoais,
        para a gestão
        dos acampamentos, usando dos seguintes dados:
        <br>
        <br>
        – Nome completo
        <br>
        – Data de nascimento;
        <br>
        – Número do Cadastro de Pessoas Físicas (CPF);
        <br>
        – Fotografia;
        <br>
        – Endereço completo;
        <br>
        – Números de telefone, WhatsApp e endereços de e-mail;
        <br>
        – Redes Sociais;
        <br>
        – Informações de formação cristã católica (Batismo, Primeira Eucaristia, Crisma e Matrimônio);
        <br>
        - Informações sobre a realidade religiosa pessoal;
        <br>
        - Informações sobre serviços paroquiais exercidos;
        <br>
        - Informações sobre estado civil;
        <br>
        - Nome do Cônjuge se for aplicável a situação;
        <br>
        - Profissão exercida;
        <br>
        - Dados acerca de restrições médicas;
        <x-slot name="footerSlot">
            <x-adminlte-button onclick="aceitarTermos()" class="mr-auto" theme="success" label="Aceitar"
                id="authorizeButton" />
            <x-adminlte-button onclick="recusarTermos()" theme="danger" label="Recusar" data-dismiss="modal"
                id="refuseButton" />
        </x-slot>
    </x-adminlte-modal>
    <x-footer />
@stop
@section('js')
    <script>
        var csrf = document.getElementsByName('_token')[0].value;
        @if ($user->is_authorized !== 1)
            $(document).ready(function() {
                $("#authorizeModal").modal('show');
                $("#close-authorizeModal").hide();
            });

            function aceitarTermos() {
                $.post("@php echo route('user.authorize') @endphp", {
                        _token: csrf,
                        user_id: '{{ $user->id }}',
                    })
                    .done(function() {
                        $("#authorizeModal").modal('hide');
                    })
            }

            function recusarTermos() {
                $.post("@php echo route('logout') @endphp", {
                    _token: csrf,
                }, function() {
                    location.reload();
                })
            }
        @endif
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
    </script>
@stop
