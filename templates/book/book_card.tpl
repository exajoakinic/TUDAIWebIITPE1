{include file="header.tpl"}

<div class="bookCard">
    <h1>{$book->title}</h1>
    <div class="bookCard details">
        <div>
            <a href="cover/{$book->id}">
                <img src="{$book->url_cover}" alt="Tapa de libro">
            </a>
        </div>
        <div>
            <ul>
            <li>
                <i>ISBN: </i> {$book->isbn}
            </li>
            <li>
                <i>Título: </i>{$book->title}
            </li>
            <li>
                <i>Autor: </i> <a href="books/by_author/{$book->id_author}" class="more_books">{include file="icon_more_books.tpl"} {$book->author}</a>
            </li>
            <li>
                <i>Género: </i> <a href="books/by_genre/{$book->id_genre}" class="more_books">{include file="icon_more_books.tpl"} {$book->genre}</a>
            </li>
            <li>
                <i>Precio: </i> $ {$book->price|number_format:2:",":"."}
            </li>
            {if isset($smarty.session.USER_ID)}
                <div class="actions">
                <a href='books/edit_form/{$book->id}' class="actions">{include file="icon_edit.tpl"} Editar</a>
                <a href='books/remove/{$book->id}' class="actions">{include file="icon_remove.tpl"} Eliminar</a>
                </div>
            {/if}
            <ul>
        </div>
    </div>
</div>




{include file="footer.tpl"}
