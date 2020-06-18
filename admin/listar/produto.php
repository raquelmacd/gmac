<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }
?>

<div class="container">
	<h1 class="float-left">Listar Produtos</h1>
	<div class="float-right">
		<a href="cadastro/produto" class="btn btn-success">Novo Registro</a>
		<a href="listar/produto" class="btn btn-info">Listar Registros</a>
	</div>

    <div >
    <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
    </div>
	<div class="clearfix"></div>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<td>ID</td>
				<td>Título</td>
				<td>Marca</td>
                <td>Valor</td>
                <td>Imagem</td>
                <td>Opções</td>
			</tr>
		</thead>
		<tbody id="myTable">
			<?php
				//buscar as editoras alfabeticamente
				$sql = "SELECT p.id_produto,p.produto,p.id_marca,p.descricao,p.preco,p.categoria,p.img,m.id_marca,m.marca FROM produtos AS p INNER JOIN marcas AS m ON p.id_marca=m.id_marca";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados
					$id 	= $dados->id_produto;
					$titulo = $dados->produto;
                    $marca = $dados->marca;
                    $valor = $dados->preco;
                    $capa = $dados->img;
                    $valor = number_format($valor,2,",",".");
                    $categoria = $dados->categoria;
					//mostrar na tela
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$titulo.'</td>
                        <td>'.$marca.'</td>
                        <td>R$ '.$valor.'</td>
                        <td>'.$capa.'</td>
						<td>
							<a href="cadastro/produto/'.$id.'" class="btn btn-success btn-sm">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>';
				}
			?>
		</tbody>
	</table>

</div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Excluir cadastro?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           Deseja mesmo excluir este produto??
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-outline-danger" href="excluir/produto/<?=$id?>">Excluir</button>
          </div>
        </div>
      </div>
    </div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>