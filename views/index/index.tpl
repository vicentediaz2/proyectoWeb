  
  {include file="../partials/_messages.tpl"}

{if isset($productos) && count($productos)}
    {foreach from=$productos item=$producto}
        {foreach from=$img item=$imgs}
            {if $imgs.producto_id == $producto.id}
                {include file="../productos/producto.tpl"}
            {/if}
        {/foreach}
    {/foreach}
{else}
    <p class="text-info">{$mensaje}</p>
{/if}
