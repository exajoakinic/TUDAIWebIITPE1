{include file="header.tpl"}

{if !empty($message)}
    {include file="generic_mesagge_box.tpl"}
{/if}

<h1>{$title}</h1>
{if AuthHelper::isAdmin()}
    <a href="authors/add_form" class="actions">{include file="icon_new.tpl"} Agregar Autor</a>
{/if}



{include file="author/only_list.tpl"}

{include file="footer.tpl"}
