<?php
  //verificar se não está logado
  if ( !isset ( $pagina ) ){
    exit;
  }

  $msg = NULL;

  //verificar se foi dado um POST
  if ( $_POST ) {
    //iniciar as variaveis
    $login = $senha = "";
    //recuperar o login e a senha digitados
    if ( isset ( $_POST["login"] ) )
      $login = trim ( $_POST["login"] );
    
    if ( isset ( $_POST["senha"] ) )
      $senha = trim ( $_POST["senha"] );

    //verificar se os campos estao em branco
    if ( empty ( $login ) )
      $msg = '<p class="alert alert-danger">Preencha o campo Login</p>';
    else if ( empty ( $senha ) ) 
      $msg = '<p class="alert alert-danger">Preencha o campo Senha</p>';
    else {
      //verificar se o login existe
      $sql = "select * from colaborador where (login = ? or email = ?) and situacao_codigo = 1 limit 1";
      //apontar a conexao com o banco
      //preparar o sql para execução
      $consulta = $pdo->prepare($sql);
      //passar o parametro para o sql
      $consulta->bindParam(1, $login);
        $consulta->bindParam(2, $login);
      //executar o sql
      $consulta->execute();
      //puxar os dados do resultado
      $dados = $consulta->fetch(PDO::FETCH_OBJ);

      //verificar se existe usuario
      if ( empty ( $dados->codigo ) ) 
        $msg = '<p class="alert alert-danger">Dados incorretos ou o usuário está bloqueado.</p>';
      //verificar se a senha esta correta
      else if ( !password_verify($senha, $dados->senha) )
        $msg = '<p class="alert alert-danger">O usuário ou senha incorretos</p>';
      //se deu tudo certo
      else {
        //registrar este usuário na sessao
        $_SESSION["tcc"] = 
          array("id"  => $dados->codigo,
                "nome"=> $dados->nome);
        //redirecionar para o home
        $msg = 'Deu certo!';
        //javascript para redirecionar
        echo '<script>location.href="paginas/home";</script>';
        exit;

      }


    }
  }
?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class=" col-lg-5 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h1 text-gray-900 mb-5"><img src="img/admin.png" width="98" height="98">Admin</h1>
                  </div>
                  <?=$msg;?>
                  <form class="user" name="login" method="post" data-parsley-validate>
                    <div class="form-group">
                      <input type="text" name="login" class="form-control form-control-user" id="login" placeholder="Digite o seu login ou email" required data-parsley-required-message="Preencha com o email ou login">

                    </div>
                    <div class="form-group">
                      <input type="password" name="senha" class="form-control form-control-user" id="senha" placeholder="Digite sua senha" required data-parsley-required-message="Preencha a senha">
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>