<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
            <a href="{$_layoutParams.root}productos/create" class="btn btn-outline-secondary">Nuevo Producto</a>
        </h1>
        {include file="../partials/_messages.tpl"}
        {if isset($productos) && count($productos)}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>categoria</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$productos item=model}
                        <tr>
                            <td>{$model.id}</td>
                            <td>{$model.nombre}</td>
                            <td>{$model.precio}</td>
                            <td>{$model.stock}</td>
                            <td>{$model.category.nombre}</td>
                            <td>{$model.usuarios.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}productos/show/{$model.id}"
                                    class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}productos/edit/{$model.id}" 
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