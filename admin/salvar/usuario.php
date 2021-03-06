<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {

  	//recuperar os dados do formulario
  	$id = $nome =$email= $login = $senha = "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}
      
      //senha criptografada!!!!!!!!
    $senha = crypt($senha);  
  	//validar os campos - em branco
  	if ( empty ( $nome ) ) {
  		echo '<script>alert("Preencha o nome");history.back();</script>';
  		exit;
  	}

  	//verificar se existe um cadastro com este nome
  	$sql = "select codigo from colaborador 
  		where login = ? and codigo <> ? limit 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $login);
  	$consulta->bindParam(2, $id);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if ( !empty ( $dados->codigo ) ) {
  		echo '<script>alert("Já existe um usuario com este nome ");history.back();</script>';
  		exit;
  	}

  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
  		//inserir os dados no banco
  		$sql = "insert into colaborador (nome, login,senha, email, situacao_codigo)
  		values( ?,?,?,?,1 )";
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(1, $nome);
  		$consulta->bindParam(2, $login);
        $consulta->bindParam(3, $senha);
        $consulta->bindParam(4, $email);    

  	} else {
  		//atualizar os dados  	
  		$sql = "update colaborador set nome = :nome, login = :login, senha = :senha, email = :email , situacao_codigo = 1 WHERE codigo = :codigo limit 1";	
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(":nome", $nome);
  		$consulta->bindParam(":login", $login);
        $consulta->bindParam(":senha", $senha);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":codigo", $id);
        
  	}
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
  		echo '<script>alert("Registro Salvo");location.href="listar/usuario";</script>';
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