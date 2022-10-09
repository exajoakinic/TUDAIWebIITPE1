{if $showTitle}
    <h1>{$title}</h1>
{/if}

{if isset($smarty.session.USER_ID)}
    <a href="books/add_form" class="actions">{include file="icon_new.tpl"} Agregar Libro</a>
{/if}

{include file="book/only_list.tpl"}