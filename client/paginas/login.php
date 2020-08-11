<?php
  //verificar se não está logado
  if ( !isset ( $pagina ) ){
    exit;
  }

  $msg = NULL;

  //verificar se foi dado um POST
  if ( $_POST ) {
    //iniciar as variaveis
    $email = $senha = "";
    //recuperar o login e a senha digitados
    if ( isset ( $_POST["email"] ) )
      $email = trim ( $_POST["email"] );
    
    if ( isset ( $_POST["senha"] ) )
      $senha = trim ( $_POST["senha"] );
    //verificar se os campos estao em branco
    if ( empty ( $email ) )
      $msg = '<p class="alert alert-danger">Preencha o campo E-mail</p>';
    else if ( empty ( $senha ) ) 
      $msg = '<p class="alert alert-danger">Preencha o campo Senha</p>';
    else {
      //verificar se o login existe
      $sql = "select * from cliente where email = ? limit 1";
      //apontar a conexao com o banco
      //preparar o sql para execução
      $consulta = $pdo->prepare($sql);
      //passar o parametro para o sql
      $consulta->bindParam(1, $email);
      //executar o sql
      $consulta->execute();
      //puxar os dados do resultado
      $dados = $consulta->fetch(PDO::FETCH_OBJ);

      //verificar se existe usuario
      if ( empty ( $dados->codigo ) ) 
        $msg = '<p class="alert alert-danger">Dados incorretos.</p>';
      //verificar se a senha esta correta
     // else if ( !password_verify($senha, $dados->senha) )
        else if( $senha != $dados->senha)
        $msg = '<p class="alert alert-danger">O usuário ou senha incorretos</p>';
      //se deu tudo certo
      else {
        //registrar este usuário na sessao
        $_SESSION["cliente"] = 
          array("id"  => $dados->codigo,
                "nome"=> $dados->login);
        echo '<script>location.href="home"</script>';
        exit;

      }


    }
  }
?>
<!--
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-26">
						Área do Cliente
					</span>
                    
					<div class="wrap-input100 validate-input" data-validate = "Insira um e-mail válido">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="E-mail"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="senha">
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
				</form>
                    <div class="container">
						<div class="wrapper text-center">
							<a class="text-primary" href="../index.php">
								Voltar para o site
							</a>
						</div>
					</div>
			</div>
		</div>
	</div>-->

	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/img/bg5.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Área do Cliente
				</span>
                <?=$msg;?>
				<form class="login100-form validate-form p-b-33 p-t-5" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="E-mail">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="senha" placeholder="Senha">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
                <div class="container-login100-form-btn m-t-32">
                    <a href="../index.php"><h5>Voltar para o site</h5></a>
				</div>
			</div>
		</div>
	</div>
	