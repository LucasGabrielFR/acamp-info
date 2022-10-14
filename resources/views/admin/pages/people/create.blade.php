@extends('adminlte::page')

@section('title', 'Cadastrar Nova Pessoa')

@section('content_header')
    <h1>Cadastro de Pessoa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="" class="form">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="card">
                                <img src="https://images.pexels.com/photos/2246476/pexels-photo-2246476.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                    alt="" class="card-img-top">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Foto</label>
                                        <input class="form-control" id="formFile" type="file" name="image">
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
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_baptized"
                                        id="is_baptized" value="yes">
                                    <label class="form-check-label">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_baptized"
                                        id="is_baptized" value="no" checked>
                                    <label class="form-check-label">
                                        Não
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Crismado?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_confirmed"
                                        id="is_confirmed" value="yes">
                                    <label class="form-check-label">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_confirmed"
                                        id="is_confirmed" value="no" checked>
                                    <label class="form-check-label">
                                        Não
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label>Fez primeira Eucaristia?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_eucharist"
                                        id="is_eucharist" value="yes">
                                    <label class="form-check-label">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_eucharist"
                                        id="is_eucharist" value="no" checked>
                                    <label class="form-check-label">
                                        Não
                                    </label>
                                </div>
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
                                    <input type="text" name="name" class="form-control" placeholder="Nome">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Data de nascimento*</label>
                                    <input type="date" name="date_birthday" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Telefone*</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="contact" name="contact" class="form-control"
                                            placeholder="XX XXXXX-XXXX" type="text" maxlength="13"
                                            pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                                            OnKeyPress="formatar('## #####-####', this)">
                                    </div>

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
                                    <input type="text" name="street" class="form-control" placeholder="Rua">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Bairro</label>

                                    <input type="text" name="district" class="form-control" placeholder="Bairro">

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Número</label>

                                    <input type="number" name="number" class="form-control" placeholder="Nº">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" name="city" class="form-control" placeholder="Cidade">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Estado</label>

                                    <select class="custom-select" id="state" name="state">
                                        <option selected>Selecione</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espirito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h2>Informações</h2>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Religião</label>
                                    <input type="text" name="religion" class="form-control" placeholder="Religião">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Paróquia</label>
                                    <input type="text" name="parish" class="form-control" placeholder="Paróquia">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Participa de alguma pastoral?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_pastoral"
                                            id="is_pastoral" value="yes">
                                        <label class="form-check-label">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_pastoral"
                                            id="is_pastoral" value="no" checked>
                                        <label class="form-check-label">
                                            Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Pastoral</label>
                                    <input type="text" name="pastoral" class="form-control" placeholder="Pastoral"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>É casado(a)?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_married"
                                            id="is_married" value="yes">
                                        <label class="form-check-label">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_married"
                                            id="is_married" value="no" checked>
                                        <label class="form-check-label">
                                            Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Cônjuge é campista?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_spouse_camper"
                                            id="is_spouse_camper" value="yes" disabled>
                                        <label class="form-check-label">
                                            Sim
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="is_spouse_camper"
                                            id="is_spouse_camper" value="no" disabled>
                                        <label class="form-check-label">
                                            Não
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nome do Cônjuge</label>
                                    <input type="text" name="spouse_name" class="form-control" placeholder="Nome do cônjuge"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Restrições Médicas</label>
                                    <textarea class="form-control" name="medical_attention" id="medical_attention" cols="20" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
        function formatar(mascara, documento) {
            var i = documento.value.length;
            var saida = mascara.substring(0, 1);
            var texto = mascara.substring(i);

            if (texto.substring(0, 1) != saida) {
                documento.value += texto.substring(0, 1);
            }

        }
    </script>
@stop
