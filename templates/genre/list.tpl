{include file="header.tpl"}

<h1>{$title}</h1>
{if isset($smarty.session.USER_ID)}
    <a href="genres/add_form" class="actions">{include file="icon_new.tpl"} Agregar Género</a>
{/if}
{include file="genre/only_list.tpl"}

{include file="footer.tpl"}
