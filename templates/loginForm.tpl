{include 'header.tpl'}

<div class="mt-5 w-25 mx-auto">
    <form method="POST" action="login">
        <div class="form-group">
            <label for="user">Usuario</label>
            <input type="text" required class="form-control" name="user" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" required class="form-control" id="password" name="password">
        </div>

        {if $error} 
            <div class="alert alert-danger mt-3">
                {$error}
            </div>
        {/if}
        <button type="submit" class="btn btn-primary mt-3">Entrar</button>
    </form>
</div>

{include file='footer.tpl'}

