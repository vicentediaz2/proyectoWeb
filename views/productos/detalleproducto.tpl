
<div class="container">
    <div class="card">
        <div class="row justify-content-start">
            <div class="col-6 m-3">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-indicators">
                        {foreach from=$img item=$imgs}
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{$imgs.relevancia - 1}" {if $imgs.relevancia == 1} class="active" aria-current="true" {/if} aria-label="Slide {$imgs.relevancia}"></button>
                        {/foreach}
                    </div>
                    <div class="carousel-inner">
                        {foreach from=$img item=$imgs}
                        <div class="carousel-item {if $imgs.relevancia == 1} active {/if}">
                                <img src="{$_layoutParams.root}public/img/{$imgs.nombre}" class="d-block w-100" alt="{$producto.nombre}">
                            </div>
                        {/foreach}
                    </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
             
            </div>
            <div class="col-5">
                <div class="card-title">
                    <h1 class="titulo mt-5">&emsp;{$producto.nombre}</h1>
                </div>
                <div class="card-body">
                    <p class="categoria">&emsp;{$producto.category.nombre}</p>
                    <div style="margin-bottom:3rem">
                        <p class="descripcion texto">{$producto.descripcion}</p>
                        <p class="textoder texto">precio: ${$producto.precio}</p>
                        <p class="textoizq texto">Stock: {$producto.stock}</p>
                    </div>
                    <button type="button" class="btn btn-warning texto mt-5">Agregar al carrito</button>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>

