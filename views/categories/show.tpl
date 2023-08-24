<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
             <a href="{$_layoutParams.root}categories" class="btn btn-outline-secondary">volver</a>
        </h1>
        <div class="col-md-6">
            <table class="table table-hover">
                <tr>
                    <th>Id:</th>
                    <td>{$categoria.id}</td>
                </tr>
                <tr>
                    <th>Nombre:</th>
                    <td>{$categoria.nombre}</td>
                </tr>
                <tr>
                    <th>fecha de creacion:</th>
                    <td>{$categoria.created_at}</td>
                </tr>
                <tr>
                    <th>ultima modificacion:</th>
                    <td>{$categoria.updated_at}</td>
                </tr>
            </table>
        </div>
    </div>
</div>