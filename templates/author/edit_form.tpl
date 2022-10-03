{include file="header.tpl"}

<form action='authors/edit/{$author->id}' method='post'>
    <div class='form-group'>
        <label for='author'>Nombre</label>
        <input type='text' class='form-control' name='author' placeholder='' value='{$author->author}'>
    </div>
    <div class='form-group'>
        <label for='note'>Nota</label>
        <input type='text' class='form-control' name='note' placeholder='' value='{$author->note}'>
    </div>
    <button type='submit' class='btn btn-primary'>GUARDAR</button>
    <a href='authors' class='btn btn-primary'>CANCELAR</a>
</form>

{include file="footer.tpl"}
