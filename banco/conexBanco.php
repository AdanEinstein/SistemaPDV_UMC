<?php

echo "<h2>conexao com banco de dados </h2>";

$host = "localhost";
$user = "root";
$pass = "";
$bd = "crudphp";
$driver = "mysql";
try{
    $conexao = new PDO("{$driver}:host={$host};dbname={$bd}",$user,$pass);
}
catch(PDOException $e){
    switch ($e->getCode()) {
        case 2002:
            echo 'Erro no servidor, Host não encontrado';
            break;
        case 1049:
            echo 'Erro no servidor, banco não encontrado';
            break;
        case 1044:
            echo 'Erro no servidor, erro de usuário';
            break;
            default:
                'Erro no servidor';
            break;
    }
}


//tabela teste:
$sql = $conexao->prepare("SELECT * FROM clientes");
$sql->execute();

foreach($sql->fetchAll() as $lista):
    echo "<br> Nome: ".$lista['nome'];
endforeach;


?>
