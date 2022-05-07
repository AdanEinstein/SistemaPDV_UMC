<?php
include_once "includes/header.php";
session_start();
?>
<?php if (isset($_SESSION["usuario"])):
    include_once "includes/nav.php";
    ?>

    <main>
        <div class="container d-flex align-items-center mt-5 flex-column p-3"
             style="background-color: rgba(204,204,204,0.63); border-radius: 10px;">
            <h2 class="text-center text-white fw-bolder mb-3">Cadastre o seu produto!</h2>
            <form action="actions/actioncadastrarproduto.php" method="post" class="w-75">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="descricao" name="descricao">
                    <label for="descricao">Descrição</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="preco" name="preco">
                    <label for="preco">Preço (R$)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="quantidade" name="quantidade" min="0">
                    <label for="quantidade">Quantidade</label>
                </div>
                <?php
                if (isset($_SESSION["resposta"])) {
                    $resposta = $_SESSION["resposta"];
                    echo '<br><div class="alert alert-info" role="alert">'.
                        $resposta
                        .'</div><br>';
                    unset($_SESSION["resposta"]);
                }
                ?>

                <div class="d-flex justify-content-end mb-3">
                    <button class="btn bg-success text-white w-100" type="submit">Cadastrar Produto</button>
                </div>
            </form>
        </div>
    </main>
<?php
else:
    include_once "includes/notfound.php";
endif;

include_once "includes/footer.php"
?>
