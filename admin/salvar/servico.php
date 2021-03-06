<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {

  	//recuperar os dados do formulario
  	$id  = $descricao = $valor = $icone ="";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}
      //print_r($_POST);

  	//validar os campos - em branco
  	if ( empty ( $descricao ) ) {
  		echo '<script>alert("Preencha o tipo");history.back();</script>';
  		exit;
  	}else if ( empty ( $valor ) ) {
  		echo '<script>alert("Preencha o valor");history.back();</script>';
  		exit;
  	} else if ( empty ( $icone ) ) {
  		echo '<script>alert("Selecione o icone");history.back();</script>';
  		exit;
  	}


  	//verificar se existe um cadastro com este tipo
  	$sql = "select codigo from servico 
  		where descricao = ? and codigo <> ? limit 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $tipo);
  	$consulta->bindParam(2, $id);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if ( !empty ( $dados->id ) ) {
  		echo '<script>alert("Já existe um tipo de quadrinho com este nome registrada");history.back();</script>';
  		exit;
  	}

  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
  		//inserir os dados no banco
  		$sql = "insert into servico (descricao, valor, icone)
  		values(?, ?, ?)";
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(1, $descricao);
        $consulta->bindParam(2, $valor);
        $consulta->bindParam(3, $icone);

  	} else {
  		//atualizar os dados  	
  		$sql = "update servico set descricao = ?, valor = ?, icone = ? where codigo = ? limit 1";	
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(1, $descricao);
        $consulta->bindParam(2, $valor);
        $consulta->bindParam(3, $icone);
  		$consulta->bindParam(4, $id);
  	}
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
  		echo '<script>alert("Registro Salvo");location.href="listar/servico";</script>';
  	} else {
  		echo '<script>alert("Erro ao salvar");history.back();</script>';
  		exit;
  	}

  } else {
  	//mensagem de erro
  	//javascript - mensagem alert
  	//retornar hostory.back
  	echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
  }