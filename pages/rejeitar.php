<?php 

$codigo = $_GET['ordem'];

$sql = "UPDATE ordem SET andamento_codigo = 4 WHERE codigo = $codigo LIMIT 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":codigo",$codigo);
$consulta->execute();

if($consulta->execute()){
    $msg = '<div class="col-12" style="margin-top:10px" > 
            <p class="alert alert-success">Orçamento <strong>aprovado</strong></p>
            </div>';
} else {
    $msg = '<div class="col-12" style="margin-top:10px" > 
            <p class="alert alert-danger">Erro...</p>
            </div>';
}

?>