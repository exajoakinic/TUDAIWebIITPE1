{include file="header.tpl"}

<h1>{$title}</h1>
{if isAdmin}
    <a href="books/add_form" class="actions">{include file="icon_new.tpl"} Agregar Libro</a>
{/if}

{include file="book/only_list.tpl"}


{include file="footer.tpl"}
