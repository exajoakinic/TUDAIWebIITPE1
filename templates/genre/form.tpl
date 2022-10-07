{include file="header.tpl"}
<h1>{$title}</h1>
<form action='{$action}' method='post'>
    <div class='form-group'>
        <label for='genre'>Nombre</label>
        <input type='text' class='form-control' name='genre' placeholder='' value='{$genre->genre}'>
    </div>
    <div class='form-group'>
        <label for='note'>Nota</label>
        <input type='text' class='form-control' name='note' placeholder='' value='{$genre->note}'>
    </div>
    <button type='submit' class='btn btn-primary'>GUARDAR</button>
    <a href='{$smarty.server.HTTP_REFERER}' class='btn btn-danger'>CANCELAR</a>
</form>

{include file="footer.tpl"}
