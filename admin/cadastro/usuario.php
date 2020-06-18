<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //iniciar as variaveis
  $nome = $senha = $login = $email= "";

  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "select * from usuario 
  		where id = ? limit 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	//$id - linha 255 do index.php
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	= $dados->id;
  	$nome 	= $dados->nome;
  	$senha 	= $dados->senha;
    $email = $dados->email;
    $login = $dados->login;
      
  } 
?>
<div class="container">
	<h1 class="float-left">Cadastro de Usuário</h1>
	<div class="float-right">
		<a href="cadastro/usuario" class="btn btn-success">Novo Registro</a>
		<a href="listar/usuario" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<form name="formCadastro" method="post" action="salvar/usuario" data-parsley-validate>

		<label for="id">ID</label>
		<input type="text" name="id" id="id"	class="form-control" readonly	value="<?=$id;?>">

		<label for="nome">Nome do Usuário</label>
		<input type="text" name="nome" id="nome" class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$nome;?>">
        
        <label for="email">E-mail</label>
		<input type="email" name="email" id="email" class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$email;?>">
        
        <label for="login">Login</label>
		<input type="text" name="login" id="login" class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$login;?>">

		<label for="senha">Senha</label>
		<input type="password" name="senha" id="senha"	class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$senha;?>">
        
        <label for="confirmaSenha">Confirmar senha</label>
		<input type="password" name="confirmaSenha" id="confirmaSenha"	class="form-control" required data-parsley-equalto="#senha" data-parsley-required-message="Preencha este campo, por favor">

		<button type="submit" class="btn btn-success margin">
			<i class="fas fa-check"></i> Gravar Dados
		</button>

	</form>

</div> <!-- container -->