
<div class="container">
    <div class="card">
        <div class="row justify-content-start">
            <div class="col-6 m-3">
                {foreach from=$img item=$imgs}
                    {if $imgs.relevancia == 1}
                        <img src="../../public/img/{$imgs.nombre}" class="d-block w-100" alt="{$producto.nombre}_{$imgs.relevancia}" >
                    {/if}
                {/foreach}
            </div>
            <div class="col-5">
                <div class="card-title">
                    <h1 class="titulo">&emsp;{$producto.nombre}</h1>
                </div>
                <div class="card-body">
                    <p class="categoria">&emsp;{$producto.category.nombre}</p>
                    <div style="margin-bottom:3rem">
                        <p class="descripcion texto">{$producto.descripcion}</p>
                        <p class="textoder texto">precio: ${$producto.precio}</p>
                        <p class="textoizq texto">Stock: {$producto.stock}</p>
                    </div>
                    <button type="button" class="btn btn-warning texto">Agregar al carrito</button>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>

