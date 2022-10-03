<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Comentario</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$genres item=$genre}
        <tr>
            <td>
                {if $linkToBooks}
                    <a href="books/by_genre/{$genre->id}">{include file="show_more_books.tpl"}</i></a>
                {/if}
                {$genre->genre}
            </td>
            <td>{$genre->note}</td>
            <td>
                <a href='genres/edit/{$genre->id}'>EDITAR</a>
                <a href='genres/remove/{$genre->id}'>ELIMINAR</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>