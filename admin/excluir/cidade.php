<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //se nao existe o id
  if ( !isset ( $id ) )     {
    echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
    exit;
  }

  	//verificar se existe vinculo com cliente
    $sql = "select * from cliente where cidade_codigo = ? limit 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	//$id - linha 255 do index.php
  	$consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    if (!empty($dados->$id)) {
      echo '<script>alert("Não é possível excluir este registro");history.back();</script>';
      exit;
    }

   //excluir editora
    $sql = "delete from cidade where codigo = ? limit 1";
    $verificar = $pdo->prepare($sql);
    $verificar->bindParam(1, $id);
    //verificar se executou
    if (!$verificar->execute()) {
      $erro = $verificar->errorInfo();

      //echo '<script>alert("Erro ao excluir!");history.back();</script>';
      exit;
    }

    echo "<script>location.href='listar/cidade';</script>";

?>