  
  {include file="../partials/_messages.tpl"}
<div>
    <a title="Imagen1" href="#"><img src="views/index/img/imagen_1.jpg" alt="Poster 1" width="300rem"><p>Poster 1</p></a> 
</div>
<div>
    <a title="Imagen1" href="#"><img src="views/index/img/imagen_2.jpg" alt="Poster 2" width="300rem"><p>Poster 2</p></a>   
</div>
<div>
    <a title="Imagen1" href="#"><img src="views/index/img/imagen_3.jpg" alt="Poster 3" width="300rem"><p>Poster 3</p></a>   
</div>
<div>
    <a title="Imagen1" href="#"><img src="views/index/img/imagen_4.jpg" alt="Poster 4" width="300rem"><p>Poster 4</p></a>   
</div>
<div>
    <a title="Imagen1" href="#"><img src="views/index/img/imagen_5.jpg" alt="Poster 5" width="300rem"><p>Poster 5</p></a>   
</div>
<div>
    <a title="Imagen1" href="#"><img src="views/index/img/imagen_6.jpg" alt="Poster 6" width="300rem"><p>Poster 6</p></a>   
</div>
   


{if isset($productos) && count($productos)}

    {foreach from=$productos item=producto}
        

        <div href="{$_layoutParams.root}productos/producto/{$producto.id}">
        </div>

        {include file="../productos/producto.tpl"}
        
    {/foreach}
{else}
    <p class="text-info">{$mensaje}</p>
{/if}