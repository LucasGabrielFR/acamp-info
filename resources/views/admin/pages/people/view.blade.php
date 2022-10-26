@extends('adminlte::page')

@section('title', 'Informações')

@section('content_header')
    <h1>Informações da Pessoa</h1>
    <style>
        .card-brown>.card-header {
            background: #8B4513;
            color: white;
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


    </style>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="card">
                            <img src="https://images.pexels.com/photos/2246476/pexels-photo-2246476.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="" class="card-img-top">
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
                                <label>É casado(a)?</label>
                                <br>
                                <div class="text-danger">{{ $person->is_married == 1 ? 'Sim' : 'Não' }}</div>
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
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Acampamentos
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($person->markers as $marker)
                    @php
                        $cardColor = $marker->group;
                        if ($cardColor == 'black') {
                            $cardColor = 'dark';
                        }
                    @endphp
                    <div class="col-auto">
                        <x-adminlte-card title="{{ $marker->camp_name }}" icon="fas fa-lg fa-campground"
                            theme="{{ $cardColor }}" collapsible>
                            @php
                                $startDate = strtotime($marker->date_start);
                                $startDate = date('d/m/Y', $startDate);

                                $endDate = strtotime($marker->date_end);
                                $endDate = date('d/m/Y', $endDate);
                            @endphp
                            <b>{{ $marker->camp_name }}</b>
                            <br>
                            Início em: <b>{{ $startDate }}</b>
                            <br>
                            Término em: <b>{{ $endDate }}</b>
                            <br>
                            Tribo: <span class="badge badge-{{ $cardColor }}">
                                @php
                                    switch ($marker->group) {
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
    <x-footer />
@stop
