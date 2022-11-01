<div class="row">
    <div class="col-4">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="p-3" id="img-container">
                        @if(isset($person->image))
                            <img src="{{url("{$person->image}")}}"
                            alt="" class="card-img-top" id="image-preview">
                        @endif
                        @if(!isset($person->image))
                            <img src="{{url('img/blank-profile.png')}}"
                            alt="" class="card-img-top" id="image-preview">
                        @endif

                    </div>
                    <div class="mb-3 text-center">
                        <label for="formFile" class="form-label">Foto</label>
                        <input class="form-control" id="img-input" type="file" name="image" accept="image/*">
                        <small>Inserir foto sem maquiagem, óculos de sol ou qualquer enfeite...</small>
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
                    <input class="form-check-input" type="radio" name="is_baptized" id="is_baptized_yes"
                        value="1">
                    <label class="form-check-label" for="is_baptized_yes">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_baptized" id="is_baptized_no" value="0"
                        checked>
                    <label class="form-check-label" for="is_baptized_no">
                        Não
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label>Crismado?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_confirmed" id="is_confirmed_yes"
                        value="1">
                    <label class="form-check-label" for="is_confirmed_yes">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_confirmed" id="is_confirmed_no"
                        value="0" checked>
                    <label class="form-check-label" for="is_confirmed_no">
                        Não
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label>Fez primeira Eucaristia?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_eucharist" id="is_eucharist_yes"
                        value="1">
                    <label class="form-check-label" for="is_eucharist_yes">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_eucharist" id="is_eucharist_no"
                        value="0" checked>
                    <label class="form-check-label" for="is_eucharist_no">
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
                    <input type="text" name="name" class="form-control" placeholder="Nome"
                        value="{{ $person->name ?? '' }}" required>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Data de nascimento*</label>
                    <input type="date" name="date_birthday" class="form-control"
                        value="{{ $person->date_birthday ?? '' }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email"
                        value="{{ $person->email ?? '' }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Telefone*</label>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input id="contact" name="contact" class="form-control" placeholder="XX XXXXX-XXXX"
                            type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                            OnKeyPress="formatar('## #####-####', this)" value="{{ $person->contact ?? '' }}" required>
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
                    <input type="text" name="street" class="form-control" placeholder="Rua"
                        value="{{ $person->street ?? '' }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Bairro</label>

                    <input type="text" name="district" class="form-control" placeholder="Bairro"
                        value="{{ $person->district ?? '' }}">

                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label>Número</label>

                    <input type="number" name="number" class="form-control" placeholder="Nº"
                        value="{{ $person->number ?? '' }}">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" name="city" class="form-control" placeholder="Cidade"
                        value="{{ $person->city ?? '' }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Estado</label>

                    <select class="custom-select" id="state" name="state">
                        <option>Selecione</option>
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
                    <input type="text" name="religion" class="form-control" placeholder="Religião"
                        value="{{ $person->religion ?? '' }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label>Paróquia</label>
                    <input type="text" name="parish" class="form-control" placeholder="Paróquia"
                        value="{{ $person->parish ?? '' }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Participa de alguma pastoral?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_pastoral_yes" name="is_pastoral"
                            id="is_pastoral" value="1" onchange="handleChange(this)">
                        <label class="form-check-label" for="is_pastoral_yes">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_pastoral_no" name="is_pastoral"
                            id="is_pastoral" value="0" onchange="handleChange(this)" checked>
                        <label class="form-check-label" for="is_pastoral_no">
                            Não
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Pastoral</label>
                    <input type="text" name="pastoral" id="pastoral" class="form-control"
                        placeholder="Pastoral" value="{{ $person->pastoral ?? '' }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>É casado(a)?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_married" id="is_married_yes"
                            onchange="handleChange(this)" value="1">
                        <label class="form-check-label" for="is_married_yes">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_married" id="is_married_no"
                            onchange="handleChange(this)" value="0" checked>
                        <label class="form-check-label" for="is_married_no">
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
                            id="is_spouse_camper_yes" value="1" disabled>
                        <label class="form-check-label" for="is_spouse_camper_yes">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_spouse_camper"
                            id="is_spouse_camper_no" value="0" disabled>
                        <label class="form-check-label" for="is_spouse_camper_no">
                            Não
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Nome do Cônjuge</label>
                    <input type="text" name="spouse_name" id="spouse_name" class="form-control"
                        placeholder="Nome do cônjuge" value="{{ $person->spouse_name ?? '' }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Restrições Médicas</label>
                    <textarea class="form-control" name="medical_attention" id="medical_attention" cols="20" rows="5"
                        value="{{ $person->medical_attention ?? '' }}"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Salvar</button>
    </div>
</div>
@section('js')
    <script>
        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("image-preview").src = e.target.result;
                };
                file.readAsDataURL(this.files[0]);
            }
        }
        document.getElementById("img-input").addEventListener("change", readImage, false);

        @php
        if(isset($person)){ @endphp
            window.onload = function exampleFunction() {
                const selected = document.querySelector('#state');
                const value = "@php echo $person->state @endphp";
                selected.value = value;

                const is_baptized = @php echo $person->is_baptized @endphp;
                if(is_baptized == 1){
                    const is_baptized_yes = document.querySelector('#is_baptized_yes');
                    is_baptized_yes.checked = true;
                }else{
                    const is_baptized_no = document.querySelector('#is_baptized_no');
                    is_baptized_no.checked = true;
                }

                const is_confirmed = @php echo $person->is_confirmed @endphp;
                if(is_confirmed == 1){
                    const is_confirmed_yes = document.querySelector('#is_confirmed_yes');
                    is_confirmed_yes.checked = true;
                }else{
                    const is_confirmed_no = document.querySelector('#is_confirmed_no');
                    is_confirmed_no.checked = true;
                }

                const is_eucharist = @php echo $person->is_eucharist @endphp;
                if(is_eucharist == 1){
                    const is_eucharist_yes = document.querySelector('#is_eucharist_yes');
                    is_eucharist_yes.checked = true;
                }else{
                    const is_eucharist_no = document.querySelector('#is_eucharist_no');
                    is_eucharist_no.checked = true;
                }

                const is_pastoral = @php echo $person->is_pastoral @endphp;
                if(is_pastoral == 1){
                    const is_pastoral_yes = document.querySelector('#is_pastoral_yes');
                    const pastoral = document.querySelector('#pastoral');
                    is_pastoral_yes.checked = true;
                    pastoral.disabled = false;
                }else{
                    const is_pastoral_no = document.querySelector('#is_pastoral_no');
                    is_pastoral_no.checked = true;
                }

                const is_married = @php echo $person->is_married @endphp;
                if(is_married == 1){
                    const is_married_yes = document.querySelector('#is_married_yes');
                    is_married_yes.checked = true;

                    const is_spouse_camper = @php
                    if($person->is_spouse_camper) echo $person->is_spouse_camper;
                    else echo "null";
                    @endphp;
                    const is_spouse_camper_yes = document.querySelector('#is_spouse_camper_yes');
                    const is_spouse_camper_no = document.querySelector('#is_spouse_camper_no');
                    is_spouse_camper_yes.disabled = false;
                    is_spouse_camper_no.disabled = false;

                    if(is_spouse_camper == 1){
                        is_spouse_camper_yes.checked = true;
                    }else{
                        is_spouse_camper_no.checked = true;
                    }

                }else{
                    const is_married_no = document.querySelector('#is_married_no');
                    is_married_no.checked = true;
                }
            }
        @php } @endphp

        function formatar(mascara, documento) {
            var i = documento.value.length;
            var saida = mascara.substring(0, 1);
            var texto = mascara.substring(i);

            if (texto.substring(0, 1) != saida) {
                documento.value += texto.substring(0, 1);
            }

        }

        function handleChange(src) {
            if (src.name == 'is_pastoral') {
                var pastoral = document.querySelector("#pastoral");
                if (src.value == 0) {
                    pastoral.disabled = true;
                    pastoral.value = '';
                } else {
                    pastoral.disabled = false;
                }
            }
            if (src.name == 'is_married') {
                var spouse_name = document.querySelector("#spouse_name");
                var is_spouse_camper_yes = document.querySelector("#is_spouse_camper_yes");
                var is_spouse_camper_no = document.querySelector("#is_spouse_camper_no");
                if (src.value == 0) {
                    spouse_name.disabled = true;
                    spouse_name.value = '';
                    is_spouse_camper_yes.disabled = true;
                    is_spouse_camper_no.disabled = true;
                    is_spouse_camper_yes.checked = false;
                    is_spouse_camper_no.checked = false;
                } else {
                    spouse_name.disabled = false;
                    is_spouse_camper_yes.disabled = false;
                    is_spouse_camper_no.disabled = false;
                }
            }
        }
    </script>

@endsection
