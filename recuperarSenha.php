<?php
include_once "includes/header.php";
session_start();
?>

<form action="./actions/actionAtualizarUser.php" method="post">
<div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email">
            <label for="email">Enter your email:</label>
            
        </div>
        <button type="submit">Enviar</button>
        <?php
        if (isset($_SESSION["resposta"])) {
            $resposta = $_SESSION["resposta"];
            echo '<br><div class="alert alert-primary" role="alert">'.
                $resposta
                .'</div><br>';
            unset($_SESSION["resposta"]);
        }
        ?>
        
</form>

<?php
include_once "includes/footer.php"
?>