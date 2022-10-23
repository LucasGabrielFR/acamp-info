{{-- @section('plugins.Summernote', true) --}}
<div class="row">
    <div class="col-4">
        <label for="name" class="form-label">Nome do Acampamento*</label>
        <input class="form-control" type="text" name="name" id="name" required value="{{ $camp->name ?? '' }}">
    </div>
    <div class="col-4">
        <label for="name" class="form-label">Modalidade*</label>
        <select class="custom-select" id="type_id" name="type_id" required>
            <option value="">Selecione</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach

        </select>
    </div>
</div>
<div class="row mt-1">
    <div class="col-4">
        <label for="name" class="form-label">Data de Início*</label>
        <input class="form-control" type="date" name="date_start" id="date_start" required
            value="{{ $camp->date_start ?? '' }}">
    </div>
    <div class="col-4">
        <label for="name" class="form-label">Data de Término*</label>
        <input class="form-control" type="date" name="date_end" id="date_end" required
            value="{{ $camp->date_end ?? '' }}">
    </div>
</div>
<div class="row mt-1">
    <div class="col-12">
        <label for="name" class="form-label">Informações</label>
        <textarea class="form-control" name="informations" id="informations" cols="30" rows="10"></textarea>
    </div>
</div>
<div class="row mt-3">
    <div class="col-2">
        <button type="submit" class="btn btn-dark">Salvar</button>
    </div>
</div>
<script>
     @php
    if(isset($camp)){ @endphp
        window.onload = function exampleFunction() {
            const selected = document.querySelector('#type_id');
            const value = "@php echo $camp->type_id @endphp";
            selected.value = value;
        }
    @php } @endphp

    function verifyDate(event) {
        var date_start = document.querySelector("#date_start");
        var date_end = document.querySelector("#date_end");
        if (date_end.value < date_start.value) {
            event.preventDefault();
            date_end.focus();
            alert("A data de término deve ser maior que a data de início")
        }
    }
</script>
