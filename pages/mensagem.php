<?php
  //verificar se existem dados no POST
  if ( isset($_POST) ) {

  	//recuperar os dados do formulario
    $nome = $telefone = $mensagem = "";

    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $mensagem = $_POST["mensagem"];
      

  	//validar os campos - em branco
  	if ( empty ( $telefone ) ) {
  		echo '<script>alert("Preencha os dados corretamente");history.back();</script>';
  		exit;
  	}

    $sql = "insert into mensagem (nome,telefone,mensagem,leitura)
    values( ?,?,?,'N' )";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1, $nome);
    $consulta->bindParam(2, $telefone);
    $consulta->bindParam(3, $mensagem);

  	//executar e verificar se deu certo
      
    if($consulta->execute()){
        echo ' <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="msgEnviada">
                <strong>Enviado com sucesso!</strong> Fique atento ao seu e-mail, irei respondê-lo assim que possível.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> <div><a class="btn btn-primary" href="contato">Voltar<a></div> </div> ';
    }else{
        echo '<div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="msgErro">
                <strong>Erro ao enviar!</strong> Verifique os campos necessários ao enviar a mensagem.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> <div><a class="btn btn-primary" href="contato">Voltar<a></div> </div>';
    }

  } else {
  	//mensagem de erro
  	//javascript - mensagem alert
  	//retornar hostory.back
  	echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
  }