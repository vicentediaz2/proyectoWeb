<a href="{$_layoutParams.root}productos/detalleproducto/{$producto.id}">
    <div>
        <div class="producto">
            <p><b>{$producto.nombre}</b></p>
            <img src="/axiomaframe/public/img/{$imgs.nombre}" alt="{$producto.nombre}">
            <p>{$producto.category.nombre}</p>
            <div>
                <p>{$producto.precio}&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;{$producto.stock}</p>
            </div>
        </div>
    </div>
</a>
