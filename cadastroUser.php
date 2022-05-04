<?php
include_once "includes/header.php";
session_start();
?>
<div class="container d-flex align-items-center mt-5 flex-column p-3" style="background-color: rgba(204,204,204,0.63); border-radius: 10px;">
    <h2 class="text-center text-black mb-5">Cadastre-se aqui!</h2>
    <form action="actions/actioncadastraruser.php" method="post" class="w-75">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="user" name="user">
            <label for="user">User</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email">
            <label for="email">Enter your email:</label>
            
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="confirPassword" name="confirmPassword">
            <label for="confirPassword">Confirm Password</label>
        </div>
        <?php
        if (isset($_SESSION["resposta"])) {
            $resposta = $_SESSION["resposta"];
            echo '<br><div class="alert alert-primary" role="alert">'.
                $resposta
                .'</div><br>';
            unset($_SESSION["resposta"]);
        }
        ?>
        <div class="d-flex justify-content-end">
            <a style="width: 70%" href="index.php" class="btn bg-danger me-2 text-white">Voltar</a>
            <button style="width: 70%" class="btn bg-success text-white" type="submit">Cadastrar</button>
        </div>
    </form>
</div>
<?php
include_once "includes/footer.php"
?>