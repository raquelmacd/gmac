<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }
?>

<div class="container">
	<h1 class="float-left">Listar Ordens de Serviço</h1>
	<div class="float-right">
		<a href="cadastro/ordem" class="btn btn-success">Novo Registro</a>
		<a href="listar/ordem" class="btn btn-info">Listar Registros</a>
	</div>

    <div >
    <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
    </div>
	<div class="clearfix"></div>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<td>Código</td>
				<td>Cliente</td>
                <td>E-mail</td>
                <td>Andamento</td>
                <td>Valor</td>
                <td>Opções</td>
			</tr>
		</thead>
		<tbody id="myTable">
			<?php
				//buscar as editoras alfabeticamente
				$sql = "SELECT o.*,c.nome, c.email, anda.descricao AS andamento
                        FROM ordem AS o 
                        INNER JOIN cliente as c on(o.cliente_codigo = c.codigo)
                        INNER JOIN andamento as anda on(o.andamento_codigo = anda.codigo)
                        WHERE o.operacao_codigo = 2
                        ORDER BY o.codigo";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados
					$id 	= $dados->codigo;
					$nome = $dados->nome;
                    $andamento = $dados->andamento;
                    $valor = $dados->total;
                    $email = $dados->email;
                    $valor = number_format($valor,2,",",".");
					//mostrar na tela
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$nome.'</td>
                        <td>'.$email.'</td>
                        <td>'.$andamento.'</td>
                        <td>R$ '.$valor.'</td>
						<td>
							<a href="cadastro/ordem/'.$id.'" class="btn btn-success btn-sm">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a class="btn btn-outline-danger btn-sm" href="javascript:excluir('.$id.')" >
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>';
				}
			?>
		</tbody>
	</table>

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
   	function excluir(id){

		if (confirm("Deseja mesmo excluir? ")) {
			//ir para exclusao
			location.href="excluir/ordem/"+id;
		}
	}
</script>