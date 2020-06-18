<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }
?>
<div class="container">
	<h1 class="float-left">Listar Marcas</h1>
	<div class="float-right">
		<a href="cadastro/marca" class="btn btn-success">Novo Registro</a>
		<a href="listar/marca" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<td>ID</td>
				<td>Marcas</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
			<?php
				//buscar os servicos alfabeticamente
				$sql = "select * from marcas where status= 'S' 
				order by id_marca";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados
					$id 	= $dados->id_marca;
					$marca 	= $dados->marca;


					//mostrar na tela
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$marca.'</td>
                        <td>
							<a href="cadastro/marca/'.$id.'" class="btn btn-success btn-sm">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a class="btn btn-outline-danger btn-sm"  href="javascript:excluir('.$id.')">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>';
                }?>
                    
                    <!-- Modal  

colocar no botao de excluir (a) = data-toggle="modal" data-target="#staticBackdrop"

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
                           Deseja mesmo excluir este serviço??
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-outline-danger" >Excluir</button>
                          </div>
                        </div>
                      </div>
                    </div>  -->
		</tbody>
	</table>

</div>
<script>
	function excluir(id){

		if (confirm("Deseja mesmo excluir? ")) {
			//ir para exclusao
			location.href="excluir/marca/"+id;
		}
	}
</script>