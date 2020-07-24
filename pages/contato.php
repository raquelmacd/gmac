<?php
$msg = NULL;
$nome = $telefone = $mensagem = $email = "";
  //verificar se existem dados no POST
  if ( $_POST) {

  	//recuperar os dados do formulario

    $nome     = $_POST['nome'] ;
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'];
    $email    = $_POST['email'];

    $sql = "insert into mensagem (nome,telefone,email,mensagem,leitura)
    values( :nome, :telefone, :email, :mensagem,'N')";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":nome", $nome);
    $consulta->bindParam(":telefone", $telefone);
    $consulta->bindParam(":email", $email);
    $consulta->bindParam(":mensagem", $mensagem);

  	//executar e verificar se deu certo
    if($consulta->execute()){
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">Mensagem enviada!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                </div>';
    }else{
         $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro ao enviar!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                </div>';
    }

  }


?>
<!-- ======= Contact Section ======= -->
<section id="contato" class="contact">
  <div class="container">
    <div class="section-title">
      <h2>Contato</h2>
      <p><h3>Não encontrou os produtos que deseja?</h3>
          <h4>Estou sempre aberto a sugestões. Me envie uma mensagem.</h4></p>
    </div>
    <!-- Alerta de msg enviada...-->

    <div class="col-12 col-md-5">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mensagemModal">Escreva uma mensagem clicando aqui</button>
        <?=$msg;?>
    </div>
      <div class="col-lg-5">
        <div class="info">
          <div class="address">
            <i class="icofont-google-map"></i>
            <h4>Localização:</h4>
            <p>Umuarama, Paraná - Brasil</p>
          </div>

          <div class="email">
            <i class="icofont-envelope"></i>
            <h4>Email:</h4>
            <p>tec.gmac@outlook.com</p>
          </div>

          <div class="phone">
            <i class="icofont-phone"></i>
            <h4>Para serviços:</h4>
            <p>+55 44 9 9999-9999</p>
          </div>
        </div>
      </div>
</section>
<!-- End Contact Section -->

<!--MODAL MENSAGEM -->
<div class="modal fade" id="mensagemModal" tabindex="-1" role="dialog" aria-labelledby="mensagemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mensagemModalLabel">Nova Mensagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="formCadastro" method="post">
            <div class="form-group">
                <label for="nome" class="col-form-label">Seu nome:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="telefone" class="col-form-label">Seu telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="form-group">
                <label for="email" class="col-form-label">Seu e-mail:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="mensagem" class="col-form-label">Mensagem:</label>
                <textarea class="form-control" id="mensagem" name="mensagem"></textarea>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" >Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

</script>