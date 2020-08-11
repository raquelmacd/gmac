<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["cliente"]["id"] ) ){
    exit;
  }
?>
<div class="container">
	<h1>Página não encontrada!</h1>
</div>