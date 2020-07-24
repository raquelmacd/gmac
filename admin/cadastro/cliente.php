<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  if ( !isset ( $id ) ) $id = "";
  $nome = $cpf = $nascimento = $email = $senha = $cep = $endereco = $bairro = $cidade_codigo = $login = $telefone = $celular = $nome_cidade = $estado =  "";

if(!empty($id)){
    //selecionar dados
    $sql = "SELECT c.*, date_format(c.dataNascimento,'%d/%m/%Y') AS dataNascimento,ci.cidade,ci.estado 
    FROM cliente AS c 
    INNER JOIN cidade AS ci ON(ci.codigo = c.cidade_codigo) 
    WHERE c.codigo = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id",$id);
    $consulta->execute();
    
    $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
    if(empty($dados->codigo)){
        echo "<p class='alert alert-danger'>Cliente não existe! </p>";
        exit;
    }
    
    $id = $dados->codigo;
    $nome = $dados->nome;
    $cpf = $dados->cpf;
    $nascimento = $dados->dataNascimento;
    $email = $dados->email;
    $endereco = $dados->endereco;
    $bairro = $dados->bairro;
    $nome_cidade = $dados->cidade;
    $cep = $dados->cep;
    $telefone = $dados->telefone;
    $celular = $dados->celular;
    $cidade_codigo = $dados->cidade_codigo;
    $senha  = $dados->senha;
    $estado = $dados->estado;
    $login = $dados->login;
    
}
?>
<div class="container">
	<h1 class="float-left">Cadastro de Clientes</h1>
	<div class="float-right">
		<a href="cadastro/cliente" class="btn btn-success">Novo Registro</a>
		<a href="listar/cliente" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<form name="formCadastro" method="post"
	action="salvar/cliente" data-parsley-validate enctype="multipart/form-data">

		<div class="row">
			<div class="col-12 col-md-2">
				<label for="id">ID:</label>
				<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
			</div>
			<div class="col-12 col-md-6">
				<label for="nome">Nome:</label>
				<input type="text" name="nome" id="nome" class="form-control" required data-parsley-required-message="Preencha o nome" 
				value="<?=$nome;?>" placeholder="Digite seu nome completo">
			</div>

			<div class="col-12 col-md-4">
				<label for="cpf">CPF:</label>
				<input type="text" name="cpf" id="cpf" class="form-control" required data-parsley-required-message="Preencha o cpf" value="<?=$cpf;?>" onblur="verificarCpf(this.value)">
			</div>
			<div class="col-12 col-md-4">
				<label for="dataNascimento">Data de Nascimento:</label>
				<input type="text" name="dataNascimento" id="dataNascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" placeholder="Digite a data " value="<?=$nascimento;?>">
			</div>
			<div class="col-12 col-md-4">
				<label for="telefone">Telefone:</label>
				<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone com DDD"
				value="<?=$telefone;?>">
			</div>
			<div class="col-12 col-md-4">
				<label for="celular">Celular:</label>
				<input type="text" name="celular" id="celular" class="form-control" placeholder="Celular com DDD"
				value="<?=$celular;?>" required data-parsley-required-message="Preencha o celular">
			</div>

			<div class="col-12">
				<label for="email">E-mail:</label>
				<input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o e-mail"  placeholder="email@exemplo.com.br"
				data-parsley-type-message="Digite um e-mail válido" onblur="confirmarEmail(this.value)"
				value="<?=$email;?>">
			</div>
			<div class="col12 col-md-4">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$login;?>">
			</div>    
			<div class="col12 col-md-4">
				<label for="senha">Senha:</label>
				<input type="password" name="senha" id="senha" class="form-control" value="<?=$senha?>">
			</div>
			<div class="col12 col-md-4">
				<label for="senha2">Redigite a Senha:</label>
				<input type="password" name="senha2" id="senha2" class="form-control" data-parsley-equalto="#senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$senha?>">
			</div>

			<div class="col-12 col-md-3">
				<label for="cep">CEP:</label>
				<input type="text" name="cep" id="cep" class="form-control" required data-parsley-required-message="Preencha o CEP" value="<?=$cep;?>">
			</div>
			<div class="col-12 col-md-2">
				<label for="cidade_codigo">ID Cidade</label>
				<input type="text" name="cidade_codigo" id="cidade_codigo" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_codigo;?>">
			</div>
			<div class="col-12 col-md-5">
				<label for="nome_cidade">Nome da Cidade:</label>
				<input type="text" id="nome_cidade" class="form-control"
				value="<?=$nome_cidade;?>">
			</div>
			<div class="col-12 col-md-2">
				<label for="estado">Estado:</label>
				<input type="text" id="estado" class="form-control"
				value="<?=$estado;?>">
			</div>

			<div class="col-12 col-md-8">
				<label for="endereco">Endereço</label>
				<input type="text" name="endereco" id="endereco" class="form-control"
				value="<?=$endereco;?>">
			</div>
			<div class="col-12 col-md-4">
				<label for="bairro">Bairro</label>
				<input type="text" name="bairro" id="bairro" class="form-control"
				value="<?=$bairro;?>">
			</div>
		</div>
		<button type="submit" class="btn btn-success margin">
			<i class="fas fa-check"></i> Gravar Dados
		</button>
	</form>
</div>
    
    
	<?php
		//verificar se o id é vazio
		if ( empty ( $id ) ) $id = 0;
	?>
	<script type="text/javascript">
    
        $("#telefone").inputmask("(99)99999-9999");
        $("#celular").inputmask("(99)99999-9999");
        $("#dataNascimento").inputmask("99/99/9999");
        $("#cep").inputmask("99.999-999");
        $("#cpf").inputmask("999.999.999-99");
        
        
        function verificarCpf(cpf) {
            $.get("verificarCpf.php", {cpf:cpf, id:<?=$id;?>}, function(dados){
                if(dados != ""){
                    //mostrar erro retornado
                    alert(dados);
                    //zerar cpf
                    $("#cpf").val("");
                }
            })
          }
                  
        function confirmarEmail(email){
               $.get("verificaEmail.php", {email:email,id:<?=$id;?>}, function(dados){
                   if(dados != ""){
                       alert(dados);
                       $("#email").val("");
                   }
               }) 
            }
                  
		 $("#cep").blur(function(){
                cep = $("#cep").val();
                cep = cep.replace(/\D/g, '');
                //alert(cep);
                if(cep == ""){
                    alert("Preencha o cep");
                } else{
                    //consultar o cep no viacep.com.br
                     $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
                         $("#endereco").val(dados.logradouro);
                         $("#nome_cidade").val(dados.localidade);
                         $("#bairro").val(dados.bairro);
                         $("#estado").val(dados.uf);
                         
                         //buscar id da cidade
                         
                         $.get("buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                             if(dados != "Erro")
                                 $("#cidade_codigo").val(dados);
                             else
                                alert(dados);
                         })
                         //focar no complemento
                         $("#endereco").focus();
                     })
                }
            })
        
	</script>