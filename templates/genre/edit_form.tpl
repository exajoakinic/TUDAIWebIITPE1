{include file="header.tpl"}

<form action='genres/edit/{$genre->id}' method='post'>
    <div class='form-group'>
        <label for='genre'>Nombre</label>
        <input type='text' class='form-control' name='genre' placeholder='' value='{$genre->genre}'>
    </div>
    <div class='form-group'>
        <label for='note'>Nota</label>
        <input type='text' class='form-control' name='note' placeholder='' value='{$genre->note}'>
    </div>
    <button type='submit' class='btn btn-primary'>GUARDAR</button>
    <a href='genres' class='btn btn-primary'>CANCELAR</a>
</form>

{include file="footer.tpl"}
