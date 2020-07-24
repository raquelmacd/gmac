<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }
?>
<div class="container">
	<h1 class="float-left">Listar Usuários</h1>
	<div class="float-right">
		<a href="cadastro/usuario" class="btn btn-success">Novo Registro</a>
		<a href="listar/usuario" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<td>ID</td>
				<td>Nome do Usuário</td>
				<td>Email</td>
                <td>Opções</td>
			</tr>
		</thead>
		<tbody>
			<?php
				//buscar os servicos alfabeticamente
				$sql = "select * from colaborador where situacao_codigo = 1	order by codigo";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados
					$id 	= $dados->codigo;
					$nome 	= $dados->nome;
                    $email = $dados->email;


					//mostrar na tela
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$nome.'</td>
						<td>'.$email.'</td>
                        <td>
							<a href="cadastro/usuario/'.$id.'" class="btn btn-success btn-sm">
								<i class="fas fa-pencil-alt"></i>
							</a>
						</td>
					</tr>';
                }?>
		</tbody>
	</table>