<?php

$id = $_POST["numeroOrdem"];
$senha = $_POST["senhaOs"];
$msg = "";

$sql = "SELECT * FROM ordem  WHERE id = :id AND senha = :senha LIMIT 1";
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":id",$id);
$consulta->bindParam(":senha",$senha);
$consulta->execute();

$dados = $consulta->fetch(PDO::FETCH_OBJ);

if(!empty($dados->id)){
    $msg = 1;
}
//substr retorna parte de uma string
//uniqid retorna 13 caracteres
//essa funcao retorna 6 caracteres do uniqid
$aleatorio = substr(uniqid(),rand(0,5),6);

?>
<div class='clearfix'></div>
                   <?php 
                    if($msg == 1){
                        ?>
<div class="container">

<table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>Item</th>
      <th scope='col'>Produtos</th>
      <th scope='col'>Custo</th>
      <th scope='col'>Qtde</th>
      <th scope='col'>Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope='row'>1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Otto</td>
    </tr>
    <tr>
      <th scope='row'>2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>Otto</td>
    </tr>
  </tbody>
</table>
<div class='col-md'>
    <button class='btn btn-outline-success'>Aprovar</button>
    <button class='btn btn-outline-warning' data-toggle='modal' data-target='#staticBackdrop'>Rejeitar</button>
</div>  
<?php } else { ?>
    <div class='col-12' style='margin-top:10px' > 
        <p class='alert alert-danger'>Não há registros com esse número. Por favor, verifique.</p>
    </div>
</div>
        <?php  }?>
<!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-outline-danger" href="">Excluir</button>
          </div>
        </div>
      </div>
    </div>