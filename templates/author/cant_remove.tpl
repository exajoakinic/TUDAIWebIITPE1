{include file="header.tpl"}

<h1>NO SE PUEDE ELIMINAR EL AUTOR</h1>
<p>Para poder eliminar el autor '{$author->author}' primero debe quitar la referencia a éste de los siguientes libros:<p>

{include file="book/only_list.tpl"}

{include file="footer.tpl"}
