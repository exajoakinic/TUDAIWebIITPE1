<div class="container">

<table class="table table-striped books">
    <thead>
        <tr>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Género</th>
            <th scope="col">Precio</th>
            {if isset($smarty.session.USER_ID)}
                <th scope="col">Acciones</th>
            {/if}
        </tr>
    </thead>
    <tbody>
    {foreach from=$books item=book}
        <tr>
            <td>
                <a href="book/{$book->id}" class="more_books"><i class="icon-book"></i> {$book->title}</a>
            </td>
            <td>
                <a href="books/by_author/{$book->id_author}" class="more_books">{include file="icon_more_books.tpl"} {$book->author}</a>
            </td>
            <td>
                <a href="books/by_genre/{$book->id_genre}" class="more_books">{include file="icon_more_books.tpl"} {$book->genre}</a>
            </td>
            <td class="price">$ {$book->price|number_format:2:",":"."}</td>

            {if isset($smarty.session.USER_ID)}
                <td class="actions">
                    <a href='books/edit_form/{$book->id}' class="actions">{include file="icon_edit.tpl"}</a>
                    <a href='books/remove/{$book->id}' class="actions">{include file="icon_remove.tpl"}</a>
                </td>
            {/if}
        </tr>
    {/foreach}
    </tbody>
</table>

</div>