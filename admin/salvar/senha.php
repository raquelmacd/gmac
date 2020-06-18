<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {

  	//recuperar os dados do formulario
  	$atual = $nova ="";
    $id = $_SESSION["tcc"]["id"] ;
  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}

  	//verificar se existe um cadastro com este tipo
  	$sql = "select senha from usuario 
  		where id = ? limit 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $id);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if (  $dados->senha === $atual ) {
  		$sql = "update usuario set senha = ? where id = ? limit 1";	
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(1, $aksjhdoasidj);
        $consulta->bindParam(2,$id);
        
        if ( $consulta->execute() ) {
            echo '<script>alert("Registro Salvo");location.href="home";</script>';
        } else {
            echo '<script>alert("Erro ao salvar");history.back();</script>';
            exit;
        }
  	}else{
        echo '<script>alert("Senha atual não está correta.");history.back();</script>';
    }

  } else {
  	//mensagem de erro
  	//javascript - mensagem alert
  	//retornar hostory.back
  	echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
  }