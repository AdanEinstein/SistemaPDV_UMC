<?php
include_once "includes/header.php";
require_once(__DIR__."/controller/api/ProdutoApi.php");
session_start();
$dados = 0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $produto = ProdutoApi::getProdutoById($id);
}
?>
<?php if (isset($_SESSION["usuario"])):
    include_once "includes/nav.php";
    ?>
    <main>
        <div class="container d-flex align-items-center mt-5 flex-column p-3"
             style="background-color: rgba(204,204,204,0.63); border-radius: 10px;">
            <h2 class="text-center text-white mb-3 fw-bolder">Altere o produto!</h2>
            <form action="controller/actionalterarproduto.php" method="post" class="w-75">
                <div class="form-floating mb-3">
                    <input type="hidden" class="form-control" id="id" value="<?php print($produto->id)?>" name="id" readonly>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="descricao" value="<?php print($produto->descricao)?>" name="descricao">
                    <label for="descricao">Descrição</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="preco" name="preco" value="<?php print($produto->preco)?>">
                    <label for="preco">Preço (R$)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php print($produto->quantidade)?>" min="0">
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
                    <button class="btn bg-warning text-black w-100" type="submit">Atualizar Produto</button>
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
