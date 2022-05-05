<form class="d-flex flex-row mb-2" action="actions/actiondatarelatorio.php" method="post">
    <div class="input-group mx-2">
        <span class="input-group-text">Data inicial:</span>
        <input type="date" class="form-control" name="datainicial" value="<?php print(isset($_SESSION["relatorio"]) ? $_SESSION["relatorio"] : date('Y-m-d'))?>">
    </div>
    <button type="submit" class="btn btn-primary w-25">Buscar</button>
</form>
<table class="table table-dark">
    <thead>
    <tr>
        <?php print(isset($_SESSION["relatorio"]) ? "" : "<th class=\"d-md-table-cell d-none\"  scope=\"col\">#</th>")?>
        <th scope="col">Data</th>
        <?php print(isset($_SESSION["relatorio"]) ? "<th scope=\"col\">Valor Total</th>" : "<th scope=\"col\">Valor</th>")?>

    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($_SESSION["relatorio"])):
        $dataInicial = $_SESSION["relatorio"];
        $sql = "SELECT tot.data_venda, SUM(vend.quantidade * prod.preco) as total FROM pdv_total tot
                            INNER JOIN pdv_vendas vend ON tot.id_venda = vend.id_venda
                            INNER JOIN pdv_produtos prod ON vend.id_produto = prod.id
                            WHERE tot.data_venda >= '$dataInicial' GROUP BY tot.data_venda ORDER BY tot.data_venda DESC";
        /** @var TYPE_NAME $conexao */
        $relatorio = $conexao->select($sql, null, true);
        while ($row = $relatorio->fetch(PDO::FETCH_ASSOC)):
            ?>
            <tr>
                <td><?php print(date_format(date_create($row["data_venda"]), 'd/m/Y')) ?></td>
                <td><?php print("R$ " . str_replace(".", ",", $row["total"])) ?></td>
            </tr>
        <?php
        endwhile;
        unset($_SESSION["relatorio"]);
    else:
        $sql = "SELECT tot.*, SUM(vend.quantidade * prod.preco) as total FROM pdv_total tot 
                            INNER JOIN pdv_vendas vend ON tot.id_venda = vend.id_venda
                            INNER JOIN pdv_produtos prod ON vend.id_produto = prod.id
                            GROUP BY tot.id_venda ORDER BY tot.data_venda DESC";
        /** @var TYPE_NAME $conexao */
        $dados = $conexao->select($sql, null, true);
        while ($row = $dados->fetch(PDO::FETCH_ASSOC)):
            ?>
            <tr>
                <th class="d-md-table-cell d-none" scope="row"><?php print($row["id"]) ?></th>
                <td><?php print(date_format(date_create($row["data_venda"]), 'd/m/Y')) ?></td>
                <td><?php print("R$ " . str_replace(".", ",", $row["total"])) ?></td>
            </tr>
        <?php
        endwhile;
    endif;
    ?>
    </tbody>
</table>