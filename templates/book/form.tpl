{include file="header.tpl"}
<h1>{$title}</h1>
<form action='{$action}' method='post'>
    <div class='form-group'>
        <label for='isbn'>ISBN</label>
        <input type='text' class='form-control' name='isbn' placeholder='' value='{$book->isbn}'>
    </div>
    <div class='form-group'>
        <label for='title'>Título</label>
        <input type='text' class='form-control' name='title' placeholder='' value='{$book->title}'>
    </div>

    <div class='form-group'>
        <label for='id_author'>Autor</label>
        <select class="form-select" aria-label="Default select example" name="id_author">
        {foreach from=$authors item=author}
            <option {if $author->id == $book->id_author}selected{/if} value="{$author->id}">
                {$author->author}
            </option>
        {/foreach}
        </select>
    </div>

    <div>
        <label for='id_genre'>Género</label>
        <select class="form-select" aria-label="Default select example" name="id_genre">
        {foreach from=$genres item=genre}
            {$genre->genre}

            <option {if $genre->id == $book->id_genre}selected{/if} value="{$genre->id}">
                {$genre->genre}
            </option>
        {/foreach}
        </select>
    </div>

    <div class='form-group'>
        <label for='price'>Precio</label>
        <input type='number' class='form-control' name='price' placeholder='' value='{$book->price}' step="any">
    </div>

    <div class='form-group'>
        <label for='url_cover'>URL Tapa</label>
        <input type='text' class='form-control' name='url_cover' placeholder='' value='{$book->url_cover}'>
    </div>    
    
    <button type='submit' class='btn btn-primary'>GUARDAR</button>
    <a href='{$smarty.server.HTTP_REFERER}' class='btn btn-danger'>CANCELAR</a>
</form>

{include file="footer.tpl"}
