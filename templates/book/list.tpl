{include file="header.tpl"}

{if !empty($message)}
    {include file="generic_mesagge_box.tpl"}
{/if}

    <h1>{$title}</h1>

{if isset($smarty.session.USER_ID)}
    <a href="books/add_form" class="actions">{include file="icon_new.tpl"} Agregar Libro</a>
{/if}

{include file="book/only_list.tpl"}

{include file="footer.tpl"}