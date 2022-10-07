<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Comentario</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$genres item=genre}
        <tr>
            <td>
                {if $linkToBooks}
                    <a href="books/by_genre/{$genre->id}" class="more_books">{include file="icon_more_books.tpl"} {$genre->genre}</i></a>
                {else}
                    {$genre->genre}
                {/if}
            </td>
            <td>{$genre->note}</td>
            <td class="actions">
                <a href='genres/edit_form/{$genre->id}' class="actions">{include file="icon_edit.tpl"}</a>
                <a href='genres/remove/{$genre->id}' class="actions">{include file="icon_remove.tpl"}</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>