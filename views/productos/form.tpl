<form action="{$_layoutParams.root}{$process}" method="post">
    <div class="mb-3">
        <label for="producto" class="form-label">{$asunto}</label>
        <div class="mb-4">
            <label for="nombre" class="form-label">Ingrese el nombre del producto</label>
            <input type="text" name="nombre" value="{$producto.nombre|default:""}" class="form-control" id="rol" aria-describedby="rol">
        </div><br>
        <div class="mb-4">
            <label for="descripcion" class="form-lable">Ingrese la descripcion</label>
            <input type="text" name="descripcion" value="{$producto.descripcion|default:""}" class="form-control" id="rol" aria-describedby="rol">
        </div><br>
        <div class="mb-4">
            <label for="precio" class="form-lable">Ingrese el precio</label>
            <input type="text" name="precio" value="{$producto.precio|default:""}" class="form-control" id="precio" aria-describedby="precio">         
        </div><br>
        <div class="mb-4">
            <label for="stock" class="form-lable">Ingrese el stock</label>
            <input type="text" name="stock" value="{$producto.stock|default:""}" class="form-control" id="stock" aria-describedby="stock">  
        </div><br>
        <div class="mb-4">
            <label for="category" class="form-lable">Ingrese la categoria</label>
            <select name="category" class="form-select" aria-label="Default select example" 
            {if $pagina==edit}disabled{/if}>
            
            {* combobox de categorias *}
            <option selected value="{$producto.category_id|default:"0"}">{$producto.category.nombre|default:"Seleccione una categoria"}</option>
            {foreach from=$categorias item=category}
                <option value="{$category.id}">{$category.nombre}</option>
            {/foreach}
            </select>
        </div><br>
        <div class="mb-4">
            <label for="usuario" class="form-lable">Ingrese el autor</label>
            <select name="usuario" class="form-select" aria-label="Default select example"
            {if $pagina==edit}disabled{/if}>
            
            {* combobox de usuarios *}
            <option selected value="{$producto.usuario_id|default:"0"}">{$producto.usuarios.nombre|default:"Seleccione el autor"}</option>
            {foreach from=$usuarios item=usuario}
                <option value="{$usuario.id}">{$usuario.nombre}</option>
            {/foreach}
            </select>
        </div><br>

        
    </div>
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="send" value="{$send}">
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>