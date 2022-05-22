<?php print(isset($_SESSION["relatorio"]) ? "" : "<h5 class='fw-bolder'>Lista das vendas de hoje...</h5><hr>")?>
<form class="d-flex flex-row mb-2" action="controller/actiondatarelatorio.php" method="post">
    <div class="input-group mx-2">
        <span class="input-group-text">Data inicial:</span>
        <input type="date" class="form-control" name="datainicial" value="<?php print(isset($_SESSION["relatorio"]) ? $_SESSION["relatorio"] : date('Y-m-d'))?>">
    </div>
    <button type="submit" class="btn btn-primary w-25">Buscar</button>
</form>
<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">Data</th>
        <?php print(isset($_SESSION["relatorio"]) ? "<th scope=\"col\">Valor Total</th>" : "<th scope=\"col\">Valor</th>")?>

    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($_SESSION["relatorio"])):
        $dataInicial = $_SESSION["relatorio"];
        foreach (TotalApi::getTotalVendasByDate($dataInicial) as $row):
            ?>
            <tr>
                <td><?php print(date_format(date_create($row->data_venda), 'd/m/Y')) ?></td>
                <td><?php print("R$ " . str_replace(".", ",", $row->total)) ?></td>
            </tr>
        <?php
        endforeach;
        unset($_SESSION["relatorio"]);
    else:
        foreach (TotalApi::getTotalVendasByCurrentDate() as $row):
            ?>
            <tr>
                <td><?php print(date_format(date_create($row->data_venda), 'd/m/Y')) ?></td>
                <td><?php print("R$ " . str_replace(".", ",", $row->total)) ?></td>
            </tr>
        <?php
        endforeach;
    endif;
    ?>
    </tbody>
</table>