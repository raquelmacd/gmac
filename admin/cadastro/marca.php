<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //iniciar as variaveis
  $marca = "";

  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "select * from marca
  		where codigo = ? limit 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	//$id - linha 255 do index.php
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	= $dados->codigo;
  	$marca = $dados->descricao;

  } 
?>
<div class="container">
	<h1 class="float-left">Cadastro de Marcas</h1>
	<div class="float-right">
		<a href="cadastro/marca" class="btn btn-success">Novo Registro</a>
		<a href="listar/marca" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<form name="formCadastro" method="post" action="salvar/marca" data-parsley-validate>

		<label for="id">ID</label>
		<input type="text" name="id" id="id" class="form-control" readonly	value="<?=$id;?>">

		<label for="marca">Marca</label>
		<input type="text" name="marca" id="marca"	class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$marca;?>">

		<button type="submit" class="btn btn-success margin">
			<i class="fas fa-check"></i> Gravar Dados
		</button>

	</form>

</div> <!-- container -->