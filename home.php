<?php
include_once "includes/header.php"
?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1b86ff; box-shadow: 5px 5px 15px -3px #000000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="./images/basket-fill.svg" alt="" width="30" height="24"
                     class="d-inline-block align-text-top">
                Home
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
    <main class="bg-light bg-opacity-75 p-3 m-5">
        <h2>Bem vindo ao seu sistema de Vendas!</h2>
        <p>Para começar a vender você deve cadastrar os seus produtos clique em <span>Cadastrar Produtos</span></p>
    </main>
<?php
include_once "includes/footer.php"
?>