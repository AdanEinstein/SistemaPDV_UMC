<?php

echo "<h2>conexao com banco de dados </h2>";

$host = "localhost";
$user = "root";
$pass = "";
$bd = "crudphp";
$driver = "mysql";

$conexao = new PDO("{$driver}:host={$host};dbname={$bd}",$user,$pass);

//tabela teste:
$sql = $conexao->prepare("SELECT * FROM clientes");
$sql->execute();

foreach($sql->fetchAll() as $lista):
    echo "<br> Nome: ".$lista['nome'];
endforeach;


?>
