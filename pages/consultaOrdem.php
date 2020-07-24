<?php

$id = $msg = $senha = NULL;

if($_POST){
$id = $_POST["numeroOrdem"];
$senha = $_POST["senhaOs"];
$msg = "";

$sql = "SELECT * FROM ordem  WHERE codigo = :id AND senha = :senha AND andamento_codigo = 2 LIMIT 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":id",$id);
$consulta->bindParam(":senha",$senha);
$consulta->execute();

$dados = $consulta->fetch(PDO::FETCH_OBJ);

if(empty($dados->codigo)){
    $msg = '<div class="col-12" style="margin-top:10px" > 
            <p class="alert alert-danger">Não há registros <strong>pendentes</strong> com esse número.</p>
            </div>';
} else $msg = 1;

}

?>
<style>
    fieldset {
      background-color: floralwhite;
    }

    legend {
      background-color: gray;
      color: white;
    }

</style>
<section id="ordens" class="services">
  <div class="container">

    <div class="section-title">
      <h2>Consulta de Ordem de Serviços</h2>
      <p>Nesta sessão você pode consultar o andamento das suas ordens de serviço.<br>
        <strong>Consulta feita pelo número da ordem e a senha enviada pelo técnico.</strong></p>
    </div>
    <div class="row" id="msg">
        <?php if($msg != 1)echo $msg ;?>
        <form method="post" class="form-inline">
            <div class="input-group col-md-12">
              <div class="form-group mb-2">
                <label for="numeroOrdem" class="sr-only">N° Ordem</label>
                <input type="text" class="form-control" name="numeroOrdem" placeholder="Número da Ordem">
              </div>
               <div class="form-group mx-sm-3 mb-2">
                <label for="senhaOs" class="sr-only">Senha</label>
                <input type="password" class="form-control" name="senhaOs" placeholder="Senha">
              </div>
                <button type="submit" class="btn btn-outline-secondary">Consultar</button>
            </div>
        </form>
      </div>
  </div>
</section><!-- End ORdens Section -->
<div class='clearfix'></div>
                   <?php 
                    if($msg == 1) {
                        ?>
<fieldset>
<legend>Ordem N° <?=$id;?></legend>
<div class="container">

<table class='table table-hover'>
  <thead>
    <tr>
      <td scope='col'>Produtos</td>
      <td scope='col'>Valor</td>
      <td scope='col'>Qtde</td>
      <td scope='col'>Total</td>
    </tr>
  </thead>
  <tbody>
      <?php 
      $select = 'SELECT op.*,p.descricao FROM ordemproduto AS op 
      INNER JOIN produto as p on(op.produto_codigo = p.codigo)
      WHERE ordem_codigo = :ordem';
      $ordemprodutos = $pdo->prepare($select);
      $ordemprodutos->bindParam(":ordem",$id);
      $ordemprodutos->execute();
      $totalprodutos = 0;
      while ($produtos = $ordemprodutos->fetch(PDO::FETCH_OBJ)){
        ?>
    <tr>
      <td scope='row'><?=$produtos->descricao;?></td>
      <td><?php echo number_format($produtos->valorUnit,2,",",".");?></td>
      <td><?=$produtos->qtde;?></td>
      <td><?php echo number_format($produtos->valorTotal,2,",",".");?></td>
    </tr>
      <?php
          $totalprodutos += $produtos->valorTotal;
      }
      ?>
      <tr>
      <td scope='row' colspan="3">Total dos Produtos</td>
      <td> R$ <?php echo number_format($totalprodutos,2,",",".");?></td>
      </tr>
  </tbody>
</table>
<table class='table table-hover'>
  <thead>
    <tr>
      <td scope='col'>Serviços</td>
      <td scope='col'>Valor</td>
      <td scope='col'>Qtde</td>
      <td scope='col'>Total</td>
    </tr>
  </thead>
  <tbody>
      <?php 
      $select2 = 'SELECT op.*,s.descricao FROM ordemservico AS op 
      INNER JOIN servico as s on(op.servico_codigo = s.codigo)
      WHERE ordem_codigo = :ordem';
      $ordemservicos = $pdo->prepare($select2);
      $ordemservicos->bindParam(":ordem",$id);
      $ordemservicos->execute();
      $totalservicos = 0;
      while ($servicos = $ordemservicos->fetch(PDO::FETCH_OBJ)){
        ?>
    <tr>
      <td scope='row'><?=$servicos->descricao;?></td>
      <td><?php echo number_format($servicos->valorUnit,2,",",".");?></td>
      <td><?=$servicos->qtde;?></td>
      <td><?php echo number_format($servicos->valorTotal,2,",",".");?></td>
    </tr>
      <?php
          $totalservicos += $servicos->valorTotal;
      }
      ?>
      <tr>
        <td scope='row' colspan="3">Total dos Serviços</td>
        <td> R$ <?php echo number_format($totalservicos,2,",",".");?></td>
      </tr>
      <br>
      <tr>
        <th colspan="3">Total do Orçamento</th>
<?php $totalOrcamento = $totalservicos + $totalprodutos;?>
          <th>R$ <?php echo number_format($totalOrcamento,2,",",".");?></th>
      </tr>
  </tbody>
</table>
<div class='col-md'>
    <button class='btn btn-secondary'data-toggle='modal' data-target='#aprovar'>Aprovar</button>
    <button class='btn btn-outline-danger' data-toggle='modal' data-target='#rejeitar'>Rejeitar</button>
</div>  
<?php } ?>
    
</div>
</fieldset>
<!-- Modal REJEITAR -->
    <div class="modal fade" id="rejeitar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Rejeitar Orçamento?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Deseja mesmo rejeitar orçamento??<br>
            OBS.: Após rejeição, não poderá mais alterar. 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <a type="button" class="btn btn-outline-danger" href="rejeitar?ordem=<?=$id;?>">Rejeitar Orçamento</a>
          </div>
        </div>
      </div>
    </div>
<!-- Modal  APROVAR-->
    <div class="modal fade" id="aprovar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Aprovar!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Deseja aprovar o orçamento??<br>
            OBS.: Após confirmar, não poderá mais alterar. 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-outline-success" href="aprovar?ordem=<?=$id;?>" >Confirmar</a>
          </div>
        </div>
      </div>
    </div>