<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
             <a href="{$_layoutParams.root}productos" class="btn btn-outline-secondary">volver</a>
        </h1>
        <div class="col-md-6">
            <table class="table table-hover">
                <tr>
                    <th>Id:</th>
                    <td>{$producto.id}</td>
                </tr>
                <tr>
                    <th>Nombre:</th>
                    <td>{$producto.nombre}</td>
                </tr>
                <tr>
                    <th>descripcion:</th>
                    <td>{$producto.descripcion}</td>
                </tr>
                <tr>
                    <th>Autor:</th>
                    <td>{$producto.usuarios.nombre}</td>
                </tr>
                <tr>
                    <th>precio:</th>
                    <td>{$producto.precio}</td>
                </tr>
                <tr>
                    <th>stock:</th>
                    <td>{$producto.stock}</td>
                </tr>
                <tr>
                    <th>categorias:</th>
                    <td>{$producto.category.nombre}</td>
                </tr>
                <tr>
                    <th>fecha de creacion:</th>
                    <td>{$producto.created_at}</td>
                </tr>
                <tr>
                    <th>ultima modificacion:</th>
                    <td>{$producto.updated_at}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div>

</div>

<div>
    <div class="cardImg">
        <p>{$producto.nombre}</p>
        <img src="../../public/img/{$img.nombre}" alt="{$producto.nombre}">
        <p>{$producto.category.nombre}</p>
        <div>
            <p>${$producto.precio}&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;{$producto.stock}</p>
        </div>
    </div>
</div>

<div>
    <div class="cardImg">
        <p>{$producto.nombre}</p>
        <img src="../../public/img/{$img.nombre}" alt="{$producto.nombre}">
        <p>{$producto.category.nombre}</p>
        <div>
            <p>${$producto.precio}&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;{$producto.stock}</p>
        </div>
    </div>
</div>

