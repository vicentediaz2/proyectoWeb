<div class="card col-md-10">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto} 
             <a href="{$_layoutParams.root}img" class="btn btn-outline-secondary">volver</a>
        </h1>
        <div class="col-md-10">
            <table class="table table-hover">
                <tr>
                    <th>Id:</th>
                    <td>{$img.id}</td>
                </tr>
                <tr>
                    <th>Nombre:</th>
                    <td>{$img.nombre}</td>
                </tr>
                <tr>
                    <th>producto:</th>
                    <td>{$img.producto.nombre}</td>
                </tr>
                <tr>
                    <th>relevancia:</th>
                    {if $img.relevancia==1}
                        <td>Primera</td>
                    {else}{if $img.relevancia==2}
                        <td>Segunda</td>
                    {else}{if $img.relevancia==3}
                        <td>Tercera</td>
                    {else}{if $img.relevancia==4}
                        <td>Cuarta</td>
                    {else}{if $img.relevancia==5}
                        <td>Quinta</td>
                    {/if}
                    {/if}
                    {/if}
                    {/if}
                    {/if}
                </tr>
                <tr>
                    <th>fecha de creacion:</th>
                    <td>{$img.created_at}</td>
                </tr>
                <tr>
                    <th>ultima modificacion:</th>
                    <td>{$img.updated_at}</td>
                </tr>
            </table>
            <img src="../../public/img/{$img.nombre}" alt="{$img.producto.nombre}" width="500rem">
        </div>
    </div>
</div>