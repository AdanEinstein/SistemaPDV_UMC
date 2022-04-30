<?php
include_once "includes/header.php"
?>
<div class="container d-flex align-items-center mt-5 flex-column">
    <h2 class="text-center text-white mb-5">Cadastre-se aqui!</h2>
    <form action="#" method="post" class="w-75">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="user">
            <label for="user">User</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="confirPassword">
            <label for="confirPassword">Confirm Password</label>
        </div>
        <div class="d-flex justify-content-end">
            <a href="index.php" class="btn bg-danger me-2 text-white">Cancelar</a>
            <button class="btn bg-success text-white" type="submit">Cadastrar</button>
        </div>
    </form>
</div>
<?php
include_once "includes/footer.php"
?>