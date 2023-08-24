<div class="card">
    <div class="card-body">
        <form action="{$_layoutParams.root}{$process}" method="post">
            {include file="../partials/_messages.tpl"}
            <div class="mb-3 card">
            <label for="rol" class="form-label">{$asunto}</label><br>
                <div class="mb-4">
                    <label for="email" class="form-label">Ingrese el correo</label>
                    <input type="text" name="email" value="" class="form-control" id="email" aria-describedby="email">
                </div><br>
                <div class="mb-4">
                    <label for="passw" class="form-label">Ingrese la contraseña</label>
                    <input type="text" name="passw" value="" class="form-control" id="passw" aria-describedby="password">
                </div><br>
            </div>
            <input type="hidden" name="send" value="{$send}">
            <button type="submit" class="btn btn-primary">Iniciar</button>
        </form>
    </div>
</div>