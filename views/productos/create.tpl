<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto}
            <a href="{$_layoutParams.root}productos" class="btn btn-outline-secondary">volver</a>
        </h1>
        <div class="col-md-6">
            {include file="../partials/_messages.tpl"}
            {include file="../productos/form.tpl"}
        </div>
    </div>
</div>