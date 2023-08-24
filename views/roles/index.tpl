<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
            <a href="{$_layoutParams.root}roles/create" class="btn btn-outline-secondary">Nuevo Rol</a>
        </h1>
        {include file="../partials/_messages.tpl"}
        {if isset($roles) && count($roles)}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$roles item=model}
                        <tr>
                            <td>{$model.id}</td>
                            <td>{$model.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}roles/show/{$model.id}"
                                    class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}roles/edit/{$model.id}" 
                                    class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            <p class="text-info">{$mensaje}</p>
        {/if}
    </div>
</div>