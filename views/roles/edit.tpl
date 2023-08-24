<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto}
            <a href="{$_layoutParams.root}roles" class="btn btn-outline-secondary">volver</a>
        </h1>
        <div class="col-md-6">
            {include file="../partials/_messages.tpl"}
            {include file="../roles/form.tpl"}
        </div>
    </div>
</div>