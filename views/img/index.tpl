<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
            <a href="{$_layoutParams.root}img/create" class="btn btn-outline-secondary">Nueva Imagen</a>
        </h1>
        {include file="../partials/_messages.tpl"}
        {if isset($imagenes) && count($imagenes)}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Archivo</th>
                        <th>producto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$imagenes item=model}
                        <tr>
                            <td>{$model.id}</td>
                            <td>{$model.nombre}</td>
                            <td>{$model.producto.nombre}</td>
                            <td>
                                <a href="{$_layoutParams.root}img/show/{$model.id}"
                                    class="btn btn-success btn-sm">Ver</a>
                                <a href="{$_layoutParams.root}img/edit/{$model.id}" 
                                    class="btn btn-warning btn-sm">Editar</a>
                                <form action="{$_layoutParams.root}img/destroy/{$model.id}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="send" value="{$model}">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
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