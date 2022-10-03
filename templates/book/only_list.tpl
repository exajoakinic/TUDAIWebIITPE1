<table class="table">
    <thead>
        <tr>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Género</th>
            <th scope="col">Precio</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$books item=$book}
        <tr>
            <td>{$book->title}</td>
            <td>
                {$book->author}
                <a href="books/by_author/{$book->id_author}">{include file="show_more_books.tpl"}</a>
            </td>
            <td>
            {$book->genre}
                <a href="books/by_genre/{$book->id_genre}">{include file="show_more_books.tpl"}</a>
            </td>
            <td>$ {$book->price|number_format:2:",":"."}</td>
            <td>
                <a href='books/edit/{$book->id}'>EDITAR</a>
                <a href='books/remove/{$book->id}'>ELIMINAR</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>