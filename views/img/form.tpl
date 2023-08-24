<form action="{$_layoutParams.root}{$process}" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="rol" class="form-label">{$asunto}</label>
        {if $pagina==edit}
            <div class="mb-4">
                <label for="relevancia" class="form-lable"> Nombre</label>
                <input type="text" name="nombre" value="{$imgs.nombre|default:""}" class="form-control" id="nombre" aria-describedby="nombre" disabled>    
            </div><br>
        {/if}

        <div class="mb-4">
            <label for="relevancia" class="form-lable">Ingrese la relevancia</label>
            <select name="relevancia" class="form-select" aria-label="relevancia">
            <option selected value="{$imgs.relevancia|default:null}">{$imgs.relevancia|default:"Seleccione la relevancia"}</option>
            <option value="1">Primera</option>
            <option value="2">Segunda</option>
            <option value="3">Tercera</option>
            <option value="4">Cuarta</option>
            <option value="5">Quinta</option>
            </select>
        </div><br>

        <div class="mb-4">
            <label for="producto" class="form-lable">Ingrese el Producto</label>
            <select name="producto" class="form-select" aria-label="producto">
            
            {* combobox de producto *}
            <option selected value="{$imgs.producto_id|default:null}">{$imgs.producto.nombre|default:"Seleccione el Producto"}</option>
            {foreach from=$productos item=producto}
                <option value="{$producto.id}">{$producto.nombre}</option>
            {/foreach}
            </select>
        </div><br>

        <div class="mb-4">
            <label for="imagen">Selecciona una imagen (formato .jpg .jpeg o .png)</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div><br>

    </div>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="send" value="{$send}">
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

{if $pagina==edit}    
    <div class="mt-5">
        <img src="../../public/img/{$imgs.nombre}" alt="{$imgs.nombre}" width="200rem">
    </div><br>
{/if}

{if $pagina==edit}
    <form action="{$_layoutParams.root}img/destroy/{$imgs.id}" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-outline-warning">Eliminar</button>
    </form><br>
{/if}