<div class="row">
    <div class="col-4">
        <label for="name" class="form-label">Nome*</label>
        <input class="form-control" type="text" name="name" id="name" required value="{{ $type->name ?? '' }}">
    </div>
</div>
<div class="row mt-1">
    <div class="col-2">
        <label for="name" class="form-label">Idade Mínima*</label>
        <input class="form-control" type="number" name="min_age" id="min_age" required value="{{ $type->min_age ?? '' }}">
    </div>
    <div class="col-2">
        <label for="name" class="form-label">Idade Máxima</label>
        <input class="form-control" type="number" name="max_age" id="max_age" value="{{ $type->max_age ?? '' }}">
    </div>
</div>
<div class="row mt-3">
    <div class="col-2">
        <button type="submit" class="btn btn-dark">Salvar</button>
    </div>
</div>

