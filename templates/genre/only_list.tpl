<div class="container">
<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Comentario</th>
            {if AuthHelper::isAdmin()}
                <th scope="col">Acciones</th>
            {/if}
        </tr>
    </thead>
    <tbody>
    {foreach from=$genres item=genre}
        <tr>
            <td>
                <a href="books/by_genre/{$genre->id}/{UrlHelper::toUrl($genre->genre)}" class="more_books">{include file="icon_more_books.tpl"} {$genre->genre}</i></a>
            </td>
            <td>{$genre->note}</td>
            {if AuthHelper::isAdmin()}
            <td class="actions">
                <a href='genres/edit_form/{$genre->id}' class="actions">{include file="icon_edit.tpl"}</a>
                <a href='genres/remove/{$genre->id}' class="actions">{include file="icon_remove.tpl"}</a>
            </td>
            {/if}
        </tr>
    {/foreach}
    </tbody>
</table>
</div>