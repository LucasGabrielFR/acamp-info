@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    <h1>Cadastro de Pessoas</h1>
    <a href="{{ route('person.create') }}" class="btn btn-success">Novo Cadastro</a>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            #filtros
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Contato</th>
                        <th>Idade</th>
                        <th>Paróquia</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <?php
                        $dataNascimento = $person->date_birthday;
                        $data = new DateTime($dataNascimento);
                        $resultado = $data->diff(new DateTime(date('Y-m-d')));
                        ?>
                        <tr>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->contact }}</td>
                            <td>{{ $resultado->format('%Y anos') }}</td>
                            <td>{{ $person->parish }}</td>
                            <td>
                                <a class="btn btn-dark" href="{{ route('person.view', $person->id) }}">Detalhes</a>
                                <a class="btn btn-warning">Editar</a>
                                <x-modal url="{{ route('person.delete', $person->id) }}" id="{{$person->id}}"  name="{{$person->name}}"/>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $people->links() !!}
        </div>
    </div>
@stop
