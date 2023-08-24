<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
            <a href="{$_layoutParams.root}categories/create" class="btn btn-outline-secondary">Nueva Categoria</a>
        </h1>
        {include file="../partials/_messages.tpl"}
        {if isset($categoria) && count($categoria)}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>categoria</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$categoria item=model}
                        <tr>
                            <td>{$model.id}</td>
                            <td>{$model.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}categories/show/{$model.id}"
                                    class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}categories/edit/{$model.id}" 
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