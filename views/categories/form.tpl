<form action="{$_layoutParams.root}{$process}" method="post">
    <div class="mb-3">
        <label for="nombre" class="form-label">{$asunto}</label>
        <div class="mb-4">
            <label for="nombre" class="form-label">Ingrese la categoria</label>
            <input type="text" name="nombre" value="{$categoria.nombre|default:""}" class="form-control" id="nombre" aria-describedby="nombre">
        </div><br>
    </div>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="send" value="{$send}">
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>