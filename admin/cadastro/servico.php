<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //iniciar as variaveis
  $tipo = $descricao = $icone = $valor= "";
    
  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "select * from servico
  		where codigo = ? limit 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	//$id - linha 255 do index.php
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	= $dados->codigo;
    $descricao = $dados->descricao;
    $icone = $dados->icone;
    $valor = $dados->valor;
 } 
?>
<div class="container">
	<h1 class="float-left">Cadastro de Tipo de Serviço</h1>
	<div class="float-right">
		<a href="cadastro/servico" class="btn btn-success">Novo Registro</a>
		<a href="listar/servico" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<form name="formCadastro" method="post" action="salvar/servico" data-parsley-validate>

		<label for="id">ID</label>
		<input type="text" name="id" id="id" class="form-control" readonly	value="<?=$id;?>">

		<label for="descricao">Tipo de Serviço</label>
		<input type="text" name="descricao" id="descricao"	class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$descricao;?>">
        
        <label for="valor">Valor</label>
		<input type="text" name="valor" id="valor"	class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$valor;?>">
        
        <label for="icone">Icone</label>
        <input type="text" name="icone" id="icone" class="form-control" readonly  value="<?=$icone;?>" >
        <iframe name="icone" src="demo.html" width="1000px" ></iframe>
        
		<button type="submit" class="btn btn-success margin">
			<i class="fas fa-check"></i> Gravar Dados
		</button>

	</form>

</div> <!-- container -->
