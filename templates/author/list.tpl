{include file="header.tpl"}

<h1>{$title}</h1>
{if isAdmin}
    <a href="authors/add_form" class="actions">{include file="icon_new.tpl"} Agregar Autor</a>
{/if}

{include file="author/only_list.tpl"}

{include file="footer.tpl"}
