<?php

$produto = $_GET["produto"] ?? "";
$servico = $_GET["servico"] ?? "";

include "config/conexao.php";
if(empty($servico)){
    $sqlproduto = "select valor from produto where codigo = :codigo limit 1";

    $consulta = $pdo->prepare($sqlproduto);
    $consulta->bindParam(":codigo",$produto);
    $consulta->execute();
} else if(empty($produto)){
    $sqlproduto = "select valor from servico where codigo = :codigo limit 1";

    $consulta = $pdo->prepare($sqlproduto);
    $consulta->bindParam(":codigo",$servico);
    $consulta->execute();
}
$d = $consulta->fetch(PDO::FETCH_OBJ);


if(empty($d->valor)) echo "Erro";
else echo $d->valor;