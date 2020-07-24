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
   //excluir editora
    $sql = "DELETE FROM produto WHERE codigo = :codigo LIMIT 1";
    $verificar = $pdo->prepare($sql);
    $verificar->bindParam(":codigo", $id);
    //verificar se executou
    if (!$verificar->execute()) {
      echo '<script>alert("Erro ao excluir!");history.back();</script>';
      exit;
    }else{
        echo "<script>alert('Sucesso ao excluir');</script>";
    }

    echo "<script>location.href='listar/produto';</script>";

?>