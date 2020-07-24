<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {
      include "functions.php";
  	//recuperar os dados do formulario
  	$id = $operacao= $cliente = "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}
    //substr retorna parte de uma string
    //uniqid retorna 13 caracteres
    //essa funcao retorna 6 caracteres do uniqid
    $senhaOrdem_cliente = substr(uniqid(),rand(0,5),6);
      
    print_r($_POST);
    echo $senhaOrdem_cliente;
  }