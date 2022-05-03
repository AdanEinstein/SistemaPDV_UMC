<?php
include_once "includes/header.php";
require "banco/conexBanco.php";
session_start();
$conexao = new DAO();
if (isset($_SESSION["resposta"])) {
    $resposta = $_SESSION["resposta"];
    echo '<div class="alert alert-info alert-dismissible fade show position-absolute" style="right: 10px; top: 10px;" role="alert">' .
        $resposta
        . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    unset($_SESSION["resposta"]);
}
$venda = 0;
if (!isset($_SESSION["vendaid"])) {
    $sql = "SELECT MAX(id_venda) as id FROM pdv_vendas";
    $venda = $conexao->select($sql, null, true)->fetch(PDO::FETCH_ASSOC)["id"];
    if (empty($venda)) {
        $venda = 1;
    }
} else {
    $venda = $_SESSION["vendaid"];
}
?>
    <nav class="navbar navbar-expand-lg navbar-dark mb-md-0 mb-3"
         style="background-color: #1b86ff; box-shadow: 5px 5px 15px -3px #000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="./images/basket-fill.svg" alt="" width="30" height="24"
                     class="d-inline-block align-text-top">
                Home<?php print($venda)?>
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
                        <a href="venderProdutos.php" class="nav-link">Vender</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="bg-light bg-opacity-75 p-md-3 p-2 m-md-3">
        <h2 class="titulo" style="font-weight: bold">
            Pronto para vender? Vamos lá!
        </h2>
        <hr>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pill-lista-vendas" data-bs-toggle="pill"
                        data-bs-target="#pills-lista"
                        type="button" role="tab" aria-controls="pills-lista" aria-selected="true">Lista de Compras
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pill-total-vendas" data-bs-toggle="pill" data-bs-target="#pills-total"
                        type="button" role="tab" aria-controls="pills-total" aria-selected="false">Total de Vendas
                </button>
            </li>
        </ul>
        <div class="tab-content bg-dark text-white p-3" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-lista" role="tabpanel" aria-labelledby="pill-lista-vendas">
                <div class="input-group">
                    <form class="d-flex flex-row w-100" action="actions/actioninserirproduto.php" method="get">
                        <input type="hidden" value="<?php print($venda) ?>"
                               name="idvenda">
                        <select class="form-select w-100" id="inputProduto" name="idproduto">
                            <option selected value="">Escolha....</option>
                            <?php
                            $sql = "SELECT * FROM pdv_produtos";
                            try {
                                $dados = $conexao->select($sql, null, true);
                                if ($dados->rowCount() > 0):
                                    while ($row = $dados->fetch(PDO::FETCH_ASSOC)):
                                        ?>
                                        <option value="<?php print($row["id"]) ?>"><?php print($row["descricao"] . " -> R$ " . str_replace(".", ",", $row["preco"])) ?></option>
                                    <?php
                                    endwhile;
                                endif;
                            } catch (Exception $e) {
                                header("Location: home.php");
                            }
                            ?>
                        </select>
                        <button class="btn btn-primary" type="submit">Adicionar</button>
                    </form>
                </div>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th class="d-md-table-cell d-none" scope="col">ID</th>
                        <th scope="col">Descrição</th>
                        <th class="d-md-table-cell d-none" scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_SESSION["vendaid"])):
                        $sql = "SELECT prod.* FROM pdv_produtos prod INNER JOIN pdv_vendas vend ON prod.id = vend.id_produto WHERE vend.id_venda = '$venda'";
                        $dados = $conexao->select($sql, null, true);
                        while ($row = $dados->fetch(PDO::FETCH_ASSOC)):
                            ?>
                            <tr>
                                <th class="d-md-table-cell d-none" scope="row"><?php print($row["id"])?></th>
                                <td><?php print($row["descricao"])?></td>
                                <td class="d-md-table-cell d-none"><?php print("R$ " . str_replace(".", ",", $row["preco"])) ?></td>
                                <td><input class="form-control w-100" type="number" min="1" name="quantVenda"></td>
                                <td>
                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal"
                                       data-bs-whatever="<?php print($row["id"])?>" data-bs-whatever2="<?php print($row["descricao"])?>">
                                        <img src="images/trash-fill.svg" width="16" height="16" alt="delete">
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <button class="btn btn-success btn-lg position-absolute"
                        style="z-index: 10; bottom: 50px; right: 10px;">Vender!
                </button>
            </div>
            <div class="tab-pane fade" id="pills-total" role="tabpanel" aria-labelledby="pill-total-vendas">
                Aba de Vendas!
            </div>
        </div>
    </main>
    <!--Modal-->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="d-none" type="text" id="idproduto" name="id" readonly>
                            Deseja mesmo deletar o produto: "<span id="descricaoProduto"></span>"
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let modal = document.getElementById('modal')
        modal.addEventListener('show.bs.modal', function (event) {
            let botao = event.relatedTarget
            let produtoid = botao.getAttribute('data-bs-whatever')
            let produtodescricao = botao.getAttribute('data-bs-whatever2')
            let idProduto = modal.querySelector('#idproduto')
            let descricaoModal = modal.querySelector('#descricaoProduto')
            idProduto.value = produtoid
            descricaoModal.innerHTML = produtodescricao
        })
    </script>

<?php
include_once "includes/footer.php";
?>