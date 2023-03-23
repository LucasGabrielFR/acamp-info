<div class="row">
    <div class="col-md-auto">
        <div class="row">
            <div class="card">
                <div class="card-body" style="max-width: 33vh;">
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
                        <input class="form-control" id="img-input" type="file" name="image" accept="image/*" @if(!isset($person->image)) required @endif>
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
                        value="1" required>
                    <label class="form-check-label" for="is_baptized_yes">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_baptized" id="is_baptized_no" value="0"
                        checked required>
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
                        value="1" required>
                    <label class="form-check-label" for="is_confirmed_yes">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_confirmed" id="is_confirmed_no"
                        value="0" checked required>
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
                        value="1" required>
                    <label class="form-check-label" for="is_eucharist_yes">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_eucharist" id="is_eucharist_no"
                        value="0" checked required>
                    <label class="form-check-label" for="is_eucharist_no">
                        Não
                    </label>
                </div>
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
                    <label>Nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome"
                        value="{{ $person->name ?? '' }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Data de nascimento</label>
                    <input type="date" name="date_birthday" class="form-control"
                        value="{{ $person->date_birthday ?? '' }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email"
                        value="{{ $person->email ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Telefone</label>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input id="contact" name="contact" class="form-control" placeholder="XX XXXXX-XXXX"
                            type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                            OnKeyPress="formatar('## #####-####', this)" value="{{ $person->contact ?? '' }}" required>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>CPF</label>
                    <input id="cpf" name="cpf" class="form-control" placeholder="XXX.XXX.XXX-XX"
                            type="text" maxlength="14"
                            OnKeyPress="formatar('###.###.###-##', this)" value="{{ $person->cpf ?? '' }}" required>
                    <div class="alert alert-danger mt-1" role="alert" id="cpf-error" style="display: none">
                        CPF incorreto ou inválido!
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gênero</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender_male"
                            value="1" required>
                        <label class="form-check-label" for="gender_male">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender_fem"
                            value="0" checked required>
                        <label class="form-check-label" for="gender_fem">
                            Feminino
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="instagram"><b>Instagram:</b></label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                    </div>
                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="{{ $person->instagram ?? '' }}">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="facebook"><b>Facebook:</b></label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fab fa-facebook"></i></div>
                    </div>
                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="{{ $person->facebook ?? '' }}">
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
                    <input type="text" name="street" class="form-control" placeholder="Rua"
                        value="{{ $person->street ?? '' }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Bairro</label>

                    <input type="text" name="district" class="form-control" placeholder="Bairro"
                        value="{{ $person->district ?? '' }}" required>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Número</label>

                    <input type="number" name="number" class="form-control" placeholder="Nº"
                        value="{{ $person->number ?? '' }}" required>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Complemento</label>

                    <input type="complement" name="complement" class="form-control" placeholder="Complemento"
                        value="{{ $person->complement ?? '' }}">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" name="city" class="form-control" placeholder="Cidade"
                        value="{{ $person->city ?? '' }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Estado</label>

                    <select class="custom-select" id="state" name="state" required>
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
            <div class="col-md-4">
                <div class="form-group">
                    <label>Religião</label>
                    <input type="text" name="religion" class="form-control" placeholder="Religião"
                        value="{{ $person->religion ?? '' }}" required>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Paróquia</label>
                    <input type="text" name="parish" class="form-control" placeholder="Paróquia"
                        value="{{ $person->parish ?? '' }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Pastoral</label>
                    <input type="text" name="pastoral" id="pastoral" class="form-control"
                        placeholder="Pastoral" value="{{ $person->pastoral ?? '' }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Estado Civil</label>
                    <select name="marital_status" id="marital_status" class="custom-select" onchange="handleChange(this)" required>
                        <option>Selecione</option>
                        <option value="0">Solteiro</option>
                        <option value="1">Casado</option>
                        <option value="2">Separado</option>
                        <option value="3">Divorciado</option>
                        <option value="4">Viúvo</option>
                        <option value="5">Amasiado</option>
                        <option value="6">Padre</option>
                        <option value="7">Freira</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nome do Cônjuge</label>
                    <input type="text" name="spouse_name" id="spouse_name" class="form-control"
                        placeholder="Nome do cônjuge" value="{{ $person->spouse_name ?? '' }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Profissão</label>
                <input type="text" name="occupation" id="occupation" class="form-control"
                placeholder="Profissão" value="{{ $person->occupation ?? '' }}" required>
            </div>
        </div>
        <hr>
            <h2>Familiares</h2>
            @php
            if(isset($person->familiar)){
                $familiares = json_decode($person->familiar, true);
            }
            $i = 1;
            @endphp
            @for ($i; $i <= 3; $i++)
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="familiar_{{$i}}" class="form-control" placeholder="Familiar"
                            value="{{ $familiares[$i]['familiar'] ?? '' }}" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Grau de Parentesco</label>
                            <input type="text" name="relationship_{{$i}}" class="form-control" placeholder="Grau de parentesco"
                            value="{{ $familiares[$i]['relationship'] ?? '' }}" >
                        </div>
                    </div>
                </div>
                <hr>
            @endfor
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Já fez algum retiro?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_retreatant_yes" name="is_retreatant"
                            value="1" onchange="handleChange(this)">
                        <label class="form-check-label" for="is_retreatant_yes">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_retreatant_no" name="is_retreatant"
                            value="0" onchange="handleChange(this)" checked>
                        <label class="form-check-label" for="is_retreatant_no">
                            Não
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Retiros</label>
                    <textarea class="form-control" name="retreats" id="retreats" cols="20" rows="5"
                        disabled>{{ $person->retreats ?? '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Possui Algum Vício?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_addicted_yes" name="is_addicted"
                            value="1" onchange="handleChange(this)" required>
                        <label class="form-check-label" for="is_addicted_yes">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_addicted_no" name="is_addicted"
                            value="0" onchange="handleChange(this)" checked required>
                        <label class="form-check-label" for="is_addicted_no">
                            Não
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Vícios</label>
                    <textarea class="form-control" name="addiction" id="addiction" cols="20" rows="5"
                        disabled>{{ $person->addiction ?? '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Possui Restrições Médicas?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_medical_attention_yes" name="is_medical_attention"
                            value="1" onchange="handleChange(this)">
                        <label class="form-check-label" for="is_medical_attention_yes">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="is_medical_attention_no" name="is_medical_attention"
                            value="0" onchange="handleChange(this)" checked>
                        <label class="form-check-label" for="is_medical_attention_no">
                            Não
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Restrições Médicas</label>
                    <textarea class="form-control" name="medical_attention" id="medical_attention" cols="20" rows="5"
                        disabled>{{ $person->medical_attention ?? '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Como ficou sabendo do acampamento?</label>
                    <textarea class="form-control" name="how_find_camp" id="how_find_camp" cols="20" rows="5">{{ $person->how_find_camp ?? '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>O que levou você a desejar participar do acampamento?</label>
                    <textarea class="form-control" name="why_camp" id="why_camp" cols="20" rows="5">{{ $person->why_camp ?? '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Está aguardando por qual acampamento?</label>
                    @if($person->max == 0)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="modality_mirim" name="modality"
                            value="0" onchange="handleChange(this)" required>
                        <label class="form-check-label" for="modality_mirim">
                            Mirim
                        </label>
                    </div>
                    @endif
                    @if($person->max < 1)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="modality_fac" name="modality"
                            value="1" onchange="handleChange(this)" required>
                        <label class="form-check-label" for="modality_fac">
                            FAC
                        </label>
                    </div>
                    @endif
                    @if($person->max < 2)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="modality_juvenil" name="modality"
                            value="2" onchange="handleChange(this)" required>
                        <label class="form-check-label" for="modality_juvenil">
                            Juvenil
                        </label>
                    </div>
                    @endif
                    @if($person->max < 3)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="modality_senior" name="modality"
                            value="3" onchange="handleChange(this)" required>
                        <label class="form-check-label" for="modality_senior">
                            Sênior
                        </label>
                    </div>
                    @endif
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="modality_casais" name="modality"
                            value="4" onchange="handleChange(this)" required>
                        <label class="form-check-label" for="modality_casais">
                            Casais
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="modality_none" name="modality"
                            value="9" onchange="handleChange(this)" required>
                        <label class="form-check-label" for="modality_none">
                            Nenhum
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark" id="btn-submit">Salvar</button>
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
                const state = document.querySelector('#state');
                const stateValue = "@php echo $person->state; @endphp";
                state.value = stateValue;

                const maritalStatus = document.querySelector('#marital_status');
                const maritalStatusValue = "@php echo $person->marital_status; @endphp";
                maritalStatus.value = maritalStatusValue;

                @if(isset($person->is_baptized))
                const is_baptized = @php echo $person->is_baptized; @endphp;
                if(is_baptized == 1){
                    const is_baptized_yes = document.querySelector('#is_baptized_yes');
                    is_baptized_yes.checked = true;
                }else{
                    const is_baptized_no = document.querySelector('#is_baptized_no');
                    is_baptized_no.checked = true;
                }
                @endif

                const is_confirmed = @php echo $person->is_confirmed; @endphp;
                if(is_confirmed == 1){
                    const is_confirmed_yes = document.querySelector('#is_confirmed_yes');
                    is_confirmed_yes.checked = true;
                }else{
                    const is_confirmed_no = document.querySelector('#is_confirmed_no');
                    is_confirmed_no.checked = true;
                }

                const is_eucharist = @php echo $person->is_eucharist; @endphp;
                if(is_eucharist == 1){
                    const is_eucharist_yes = document.querySelector('#is_eucharist_yes');
                    is_eucharist_yes.checked = true;
                }else{
                    const is_eucharist_no = document.querySelector('#is_eucharist_no');
                    is_eucharist_no.checked = true;
                }

                @if(isset($person->is_pastoral))
                const is_pastoral = @php echo $person->is_pastoral; @endphp;
                if(is_pastoral == 1){
                    const is_pastoral_yes = document.querySelector('#is_pastoral_yes');
                    const pastoral = document.querySelector('#pastoral');
                    is_pastoral_yes.checked = true;
                    pastoral.disabled = false;
                    pastoral.required = true;
                }else{
                    const is_pastoral_no = document.querySelector('#is_pastoral_no');
                    is_pastoral_no.checked = true;
                }
                @endif

                @if(isset($person->gender))
                const gender = @php echo $person->gender; @endphp;
                if(gender == 0){
                    const gender_male = document.querySelector('#gender_male');
                    gender_male.checked = true;
                }else if(gender == 1){
                    const gender_fem = document.querySelector('#gender_fem');
                    gender_fem.checked = true;
                }
                @endif

                @if(isset($person->is_retreatant))
                const is_retreatant = @php echo $person->is_retreatant; @endphp;
                if(is_retreatant == 0){
                    const is_retreatant_no = document.querySelector('#is_retreatant_no');
                    is_retreatant_no.checked = true;
                }else {
                    const is_retreatant_yes = document.querySelector('#is_retreatant_yes');
                    const retreats = document.querySelector('#retreats');
                    is_retreatant_yes.checked = true;
                    retreats.disabled = false;
                }
                @endif

                @if(isset($person->is_addicted))
                const is_addicted = @php echo $person->is_addicted; @endphp;
                if(is_addicted == 0){
                    const is_addicted_no = document.querySelector('#is_addicted_no');
                    is_addicted_no.checked = true;
                }else {
                    const is_addicted_yes = document.querySelector('#is_addicted_yes');
                    const addiction = document.querySelector('#addiction');
                    is_addicted_yes.checked = true;
                    addiction.disabled = false;
                }
                @endif

                @if(isset($person->modality))
                const modality = @php echo $person->modality; @endphp;
                switch(modality) {
                    case 0:
                        const modality_mirim = document.querySelector('#modality_mirim');
                        modality_mirim.checked = true;
                        break;
                    case 1:
                        const modality_fac = document.querySelector('#modality_fac');
                        modality_fac.checked = true;
                        break;
                    case 2:
                        const modality_juvenil = document.querySelector('#modality_juvenil');
                        modality_juvenil.checked = true;
                        break;
                    case 3:
                        const modality_senior = document.querySelector('#modality_senior');
                        modality_senior.checked = true;
                        break;
                    case 4:
                        const modality_casais = document.querySelector('#modality_casais');
                        modality_casais.checked = true;
                        break;
                    default:
                        const modality_none = document.querySelector('#modality_none');
                        modality_none.checked = true;
                        break;
                }
                @endif

                const medical_attention = "@php if(isset($person->medical_attention)) echo $person->medical_attention; else echo '';@endphp"

                if(medical_attention.length > 2){
                    const is_medical_attention_yes = document.querySelector('#is_medical_attention_yes');
                    const medical_attention = document.querySelector('#medical_attention');
                    is_medical_attention_yes.checked = true;
                    medical_attention.disabled = false;
                    medical_attention.required = true;
                }

                const marital_status = @php if(isset($person->marital_status)) echo $person->marital_status;
                else echo '0';
                @endphp;
                if(marital_status == 1 || marital_status == 5){

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

                }
            }

        @php } @endphp

        function formatar(mascara, documento) {
            var i = documento.value.length;
            var saida = mascara.substring(0, 1);
            var texto = mascara.substring(i);

            if(isNaN(documento.value[i-1])){ // impede entrar outro caractere que não seja número
                documento.value = documento.value.substring(0, i-1);
                return;
            }

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
                    pastoral.required = true;
                }
            }
            if (src.name == 'is_medical_attention'){
                var medicalAttention = document.querySelector("#medical_attention");
                if (src.value == 0) {
                    medicalAttention.disabled = true;
                    medicalAttention.value = '';
                } else {
                    medicalAttention.disabled = false;
                    medicalAttention.required = true;
                }
            }
            if (src.name == 'is_retreatant'){
                var retreats = document.querySelector("#retreats");
                if (src.value == 0) {
                    retreats.disabled = true;
                    retreats.value = '';
                } else {
                    retreats.disabled = false;
                    retreats.required = true;
                }
            }
            if (src.name == 'is_addicted'){
                var addiction = document.querySelector("#addiction");
                if (src.value == 0) {
                    addiction.disabled = true;
                    addiction.value = '';
                } else {
                    addiction.disabled = false;
                    addiction.required = true;
                }
            }
            if (src.name == 'marital_status') {
                var spouse_name = document.querySelector("#spouse_name");
                var is_spouse_camper_yes = document.querySelector("#is_spouse_camper_yes");
                var is_spouse_camper_no = document.querySelector("#is_spouse_camper_no");
                if (src.value != 1 && src.value != 5) {
                    spouse_name.disabled = true;
                    spouse_name.required = false;
                    spouse_name.value = '';
                    is_spouse_camper_yes.disabled = true;
                    is_spouse_camper_no.disabled = true;
                    is_spouse_camper_yes.checked = false;
                    is_spouse_camper_no.checked = false;
                } else {
                    spouse_name.disabled = false;
                    spouse_name.required = true;
                    is_spouse_camper_yes.disabled = false;
                    is_spouse_camper_no.disabled = false;
                }
            }
        }

        $('input').keyup(function () {
            if(this.type != 'date'){
                this.value = this.value.toUpperCase();
            }
        })

        $('form').submit(function (event) {
            const cpf = document.getElementById('cpf');
            const btnSubmit = document.getElementById('btn-submit');
            btnSubmit.disabled = true;

            if(!validaCPF(cpf.value)){
                event.preventDefault();
                $('#cpf').focus();
                $('#cpf-error').css({display: "block"});
                btnSubmit.disabled = false;
            }
        })

        $('#cpf').blur(function () {
            if(!validaCPF(this.value)){
                $('#cpf').css({border: "solid 1px red"});
                $('#cpf-error').css({display: "block"});
            }else{
                $('#cpf').css({border: ""});
                $('#cpf-error').css({display: "none"});
            }
        })

        function validaCPF(strCPF) {
            var Soma;
            var Resto;
            Soma = 0;
            strCPF = strCPF.replaceAll('.','');
            strCPF = strCPF.replaceAll('-','');
            if (strCPF == "00000000000") return false;

            for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

            Soma = 0;
                for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
                Resto = (Soma * 10) % 11;

                if ((Resto == 10) || (Resto == 11))  Resto = 0;
                if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
                return true;
            }
    </script>

@endsection
