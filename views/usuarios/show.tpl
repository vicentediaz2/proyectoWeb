<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
             <a href="{$_layoutParams.root}usuarios" class="btn btn-outline-secondary">volver</a>
        </h1>
        <div class="col-md-6">
            <table class="table table-hover">
                <tr>
                    <th>Id:</th>
                    <td>{$usuario.id}</td>
                </tr>
                <tr>
                    <th>Nombre:</th>
                    <td>{$usuario.nombre}</td>
                </tr>
                <tr>
                    <th>Correo:</th>
                    <td>{$usuario.email}</td>
                </tr>   
                <tr>
                    <th>Estado:</th>
                    {if $usuario.activo==1}
                        <td>Activo</td>
                    {else}
                        <th>Inactivo</th>
                    {/if}
                </tr>       
                <tr>
                    <th>Rol:</th>
                    <td>{$usuario.role.nombre}</td>
                </tr>                                          
                <tr>
                    <th>fecha de creacion:</th>
                    <td>{$usuario.created_at}</td>
                </tr>
                <tr>
                    <th>ultima modificacion:</th>
                    <td>{$usuario.updated_at}</td>
                </tr>
            </table>
        </div>
    </div>
</div>