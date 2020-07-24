<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {

  	//recuperar os dados do formulario
  	$id = $nome = $cpf = $nascimento = $email = $login = $senha = $cep = $endereco = $bairro = $cidade_codigo = $telefone = $celular =  "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}

  	//validar os campos - em branco
  	if ( empty ( $email ) ) {
  		echo '<script>alert("Preencha o email");history.back();</script>';
  		exit;
  	} else if ( empty ( $cpf ) ) {
  		echo '<script>alert("Preencha o cpf");history.back();</script>';
  		exit;
  	} else if ( empty ( $senha ) ) {
  		echo '<script>alert("Preencha a senha");history.back();</script>';
  		exit;
  	}  else if ( empty ( $celular ) ) {
  		echo '<script>alert("Preencha o celular");history.back();</script>';
  		exit;
  	} else if ( empty ( $login ) ) {
  		echo '<script>alert("Preencha o login");history.back();</script>';
  		exit;
  	}


  	//verificar se existe um cadastro com este tipo
  	$sql = "select codigo from cliente 
  		where email = ? limit 1";
  	//usar o pdo / prepare para executar o sql
  	$consulta = $pdo->prepare($sql);
  	//passando o parametro
  	$consulta->bindParam(1, $email);
  	//executar o sql
  	$consulta->execute();
  	//puxar os dados (id)
  	$dados = $consulta->fetch(PDO::FETCH_OBJ);

  	//verificar se esta vazio, se tem algo é pq existe um registro com o mesmo nome
  	if ( !empty ( $dados->email ) ) {
  		echo '<script>alert("Já existe este email cadastrado");history.back();</script>';
  		exit;
  	}

  	//se o id estiver em branco - insert
  	//se o id estiver preenchido - update
  	if ( empty ( $id ) ) {
  		//inserir os dados no banco
  		$sql = "insert into cliente (nome,cpf,dataNascimento,email,login,senha,cep,endereco,bairro,telefone, celular,cidade_codigo)
  		values(:nome, :cpf, :dataNascimento, :email, :login, :senha, :cep, :endereco, :bairro, :telefone, :celular, :cidade_codigo)";
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(':nome', $nome);
        $consulta->bindParam(':cpf', $cpf);
        $consulta->bindParam(':dataNascimento', $nascimento);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':login', $login);
        $consulta->bindParam(':senha', $senha);
        $consulta->bindParam(':cep', $cep);
        $consulta->bindParam(':endereco', $endereco);
        $consulta->bindParam(':bairro', $bairro);
        $consulta->bindParam(':telefone', $telefone);
        $consulta->bindParam(':celular', $celular);
        $consulta->bindParam(':cidade_codigo', $cidade_codigo);
        


  	} else {
  		//atualizar os dados  	
  		$sql = "update cliente set  nome = :nome, cpf = :cpf, dataNascimento = :dataNascimento, email = :email, login = :login, senha = :senha,cep = :cep, endereco = :endereco, bairro = :bairro, cidade_codigo = :cidade_codigo, telefone = :telefone, celular = :celular where codigo = :codigo limit 1";	
  		$consulta = $pdo->prepare($sql);
  		$consulta->bindParam(':nome', $nome);
        $consulta->bindParam(':cpf', $cpf);
        $consulta->bindParam(':dataNascimento', $nascimento);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':login', $login);
        $consulta->bindParam(':senha', $senha);
        $consulta->bindParam(':cep', $cep);
        $consulta->bindParam(':endereco', $endereco);
        $consulta->bindParam(':bairro', $bairro);
        $consulta->bindParam(':telefone', $telefone);
        $consulta->bindParam(':celular', $celular);
        $consulta->bindParam(':cidade_codigo', $cidade_codigo);
        $consulta->bindParam(':codigo', $id);

  	}
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {
  		echo '<script>alert("Registro Salvo");location.href="listar/cliente";</script>';
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