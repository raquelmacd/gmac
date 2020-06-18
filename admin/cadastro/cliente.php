<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //iniciar as variaveis
  $nome = $cpf = $nascimento = $email = $senha = $cep = $endereco = $bairro =  $msg = $telefone= $complemento=  "";
    $cidade = "Selecione um estado..";
  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "select * from cliente 
  		where id = ? limit 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	//$id - linha 255 do index.php
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	= $dados->id;
  	$nome 	= $dados->nome;
  	$cpf 	= $dados->cpf;
    $cep = $dados->cep;
    $endereco = $dados->endereco;
    $complemento = $dados->complemento;
    $bairro = $dados->bairro;
    $cidade = $dados->cidade_id;
    $email = $dados->email;
      $nascimento = $dados->datanascimento;
      $telefone = $dados->telefone;
      
  } 
  include "functions.php";
  if (!isset($cpf)) {
    $msg = validaCPF($cpf);
    if ( $msg != 1 ) echo $msg; //deu erro
  }


?>
<div class="container">
  <h1 class="float-left">Cadastro de Clientes</h1>
  <div class="float-right">
    <a href="cadastro/cliente" class="btn btn-success">Novo Registro</a>
    <a href="listar/cliente" class="btn btn-info">Listar Registros</a>
  </div>

  <div class="clearfix"></div>

  <form name="formCadastro" method="post" action="salvar/cliente" data-parsley-validate>
    <div class="row">
      <div class="col-md-4">
        <label for="id">ID</label>
        <input type="text" name="id" id="id"
        class="form-control" readonly   value="<?=$id;?>">
        </div>
      </div>
      <div class="row">
      <div class="col-md-8">  
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome"  class="form-control" required  data-parsley-required-message="Preencha este campo, por favor"value="<?=$nome;?>">
      </div>
      <div class="col-md-4">
        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" id="telefone" class="form-control" data-parsley-type="integer" value="<?=$telefone;?>">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" data-parsley-maxlength="11" class="form-control" required data-parsley-required-message="Preencha este campo, por favor" value="<?=$cpf;?>">
        <?=$msg;?>
        </div>
      <div class="col-md-4">
        <label for="email">E-mail</label>
        <input  name="email" id="email" class="form-control" required data-parsley-type="email"  data-parsley-required-message="Digite um e-mail válido" value="<?=$email;?>">
      </div>
      <div class="col-md-4">
        <label for="nascimento">Data de nascimento</label>
        <input type="date" name="nascimento" id="nascimento" class="form-control" value="<?=$nascimento;?>">
        </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <label for="cep">CEP</label>
        <input type="text" data-parsley-type="integer" name="cep" id="cep" data-parsley-maxlength="8" class="form-control" value="<?=$cep;?>"> 
      </div>
      <div class="col-md-6">
        <label for="endereco">Endereço</label>
        <input type="endereco" name="endereco" id="endereco" class="form-control" value="<?=$endereco;?>">
      </div>
      <div class="col-md-4">
        <label for="bairro">Bairro</label>
        <input type="text" name="bairro" id="bairro" class="form-control" value="<?=$bairro;?>">
      </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="complemento">Complemento</label>
            <input type="text" name="complemento" id="complemento" class="form-control" value="<?=$complemento;?>"> 
        </div>
    <div class="col-md-8"> 
         <label for="cidade">Cidade</label>
          <input list="cidades" name="cidade" class="form-control" placeholder="<?=$cidade?>">
            <datalist id="cidades"> 
              <?php
            //mostrar as editoras
            $sql = "select id, cidade, estado from cidade
              order by cidade";
            
            //executar
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            //separar os dados por linha
            while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

              //separar os dados
              $id   = $linha["id"];
              $cidade   = $linha["cidade"];
                $estado = $linha["estado"];
              //montar o link
              echo "<option value='$id'>$cidade | $estado</option>";
            }
            ?>
          </datalist>
      </div>
    </div>

    <button type="submit" class="btn btn-success margin">
      <i class="fas fa-check"></i> Gravar Dados
    </button>

  </form>

</div> <!-- container -->