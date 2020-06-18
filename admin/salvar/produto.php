<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {

  	//recuperar os dados do formulario
  	$id =  $nome  = $valor = $img = $marca = $categoria = "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}

  	//validar os campos - em branco
  	if ( empty( $valor ) ) {
  		echo '<script>alert("Preencha o valor");history.back();</script>';
  		exit;
  	}


  	//verificar se existe um cadastro com este tipo
  	$sql = "select produto from produtos 
  		where produto = ? and id <> ? limit 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $nome);
  	$consulta->bindParam(2, $id);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if ( !empty ( $dados->produto ) ) {
  		echo '<script>alert("Já existe um produto registrado com este nome");history.back();</script>';
  		exit;
  	}

  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
  		//inserir os dados no banco
  		$sql = "insert into produtos (produto,id_marca,descricao,preco,img,categoria)
  		values( ?,?,'Descricao',?,?,?)";
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(1, $nome);
  		$consulta->bindParam(2, $marca);
        $consulta->bindParam(3,$preco);
        $consulta->bindParam(4,$img);
        $consulta->bindParam(5,$categoria);

  	} else {
  		//atualizar os dados  	
  		$sql = "update rpodutos set tipo = ?, descricao = ?where id = ? limit 1";	
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(1, $tipo);

  	}
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
  		echo '<script>alert("Registro Salvo");location.href="listar/produto";</script>';
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