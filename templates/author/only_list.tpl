<table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Comentario</th>
            {if isset($smarty.session.USER_ID)}
                <th scope="col">Acciones</th>
            {/if}
        </tr>
    </thead>
    <tbody>
    {foreach from=$authors item=author}
        <tr>
            <td>
                {if $linkToBooks}
                    <a href="books/by_author/{$author->id}" class="more_books">{include file="icon_more_books.tpl"} {$author->author}</a>
                {else}
                    {$author->author}
                {/if}
            </td>
            <td>{$author->note}</td>
            {if isset($smarty.session.USER_ID)}
                <td class="actions">
                    <a href='authors/edit_form/{$author->id}' class="actions">{include file="icon_edit.tpl"}</a>
                    <a href='authors/remove/{$author->id}' class="actions">{include file="icon_remove.tpl"}</a>
                </td>
            {/if}
        </tr>
    {/foreach}
    </tbody>
</table>