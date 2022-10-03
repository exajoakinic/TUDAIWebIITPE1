<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Comentario</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$authors item=$author}
        <tr>
            <td>
            {$author->author|truncate:50}
                {if $linkToBooks}
                    <a href="books/by_author/{$author->id}">VER LIBROS</a>
                {/if}
            </td>
            <td>{$author->note}</td>
            <td>
                <a href='authors/edit/{$author->id}'>EDITAR</a>
                <a href='authors/remove/{$author->id}'>ELIMINAR</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>