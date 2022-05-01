<?php
include_once "includes/header.php";
session_start();
require 'banco/conexBanco.php';
$dados = 0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $param = [":id" => $id];
    $conexao = new DAO();
    $dados = $conexao->selectParam($sql, $param);
}
?>
    <nav class="navbar navbar-expand-lg navbar-dark"
         style="background-color: #1b86ff; box-shadow: 5px 5px 15px -3px #000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="./images/basket-fill.svg" alt="" width="30" height="24"
                     class="d-inline-block align-text-top">
                Home
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="listaDeProdutos.php" class="nav-link">Listar produtos</a>
                    </li>
                    <li class="nav-item">
                        <a href="cadastroProduto.php" class="nav-link">Cadastrar Produto</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Vender</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container d-flex align-items-center mt-5 flex-column p-3"
             style="background-color: rgba(204,204,204,0.63); border-radius: 10px;">
            <h2 class="text-center text-black mb-3">Cadastre o seu produto!</h2>
            <form action="actions/actionalterarproduto.php" method="post" class="w-75">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="id" value="<?php print($dados["id"])?>" name="id" readonly>
                    <label for="id">ID</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="descricao" value="<?php print($dados["descricao"])?>" name="descricao">
                    <label for="descricao">Descrição</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="preco" name="preco" value="<?php print($dados["preco"])?>">
                    <label for="preco">Preço (R$)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php print($dados["quantidade"])?>" min="0">
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
include_once "includes/footer.php"
?>