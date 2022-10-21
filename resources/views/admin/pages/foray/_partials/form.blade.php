<div class="row">
    <div class="col-4">
        <label for="name" class="form-label">Nome*</label>
        <input class="form-control" type="text" name="name" id="name" required value="{{ $foray->name ?? '' }}">
    </div>
    <div class="col-4">
        <label for="name" class="form-label">Diocese*</label>
        <input class="form-control" type="text" name="diocese" id="diocese" required
            value="{{ $foray->diocese ?? '' }}">
    </div>
</div>
<div class="row mt-1">
    <div class="col-4">
        <label for="name" class="form-label">Cidade*</label>
        <input class="form-control" type="text" name="city" id="city" required
            value="{{ $foray->city ?? '' }}">
    </div>
    <div class="col-4">
        <label for="name" class="form-label">Estado*</label>
        <select class="custom-select" id="state" name="state" required>
            <option value="">Selecione</option>
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
<div class="row mt-3">
    <div class="col-2">
        <button type="submit" class="btn btn-dark">Salvar</button>
    </div>
</div>
<script>
    @php
    if(isset($foray)){ @endphp
        window.onload = function exampleFunction() {
            const selected = document.querySelector('#state');
            const value = "@php echo $foray->state @endphp";
            selected.value = value;
        }
    @php } @endphp
</script>
