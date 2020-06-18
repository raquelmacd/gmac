<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }
?>
<div class="container">
	<h1 class="float-left">Listar Clientes</h1>
	<div class="float-right">
		<a href="cadastro/cliente" class="btn btn-success">Novo Registro</a>
		<a href="listar/cliente" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<td>ID</td>
				<td>Nome</td>
                <td>CPF</td>
                <td>Endereço</td>
                <td>E-mail</td>
                <td>Foto</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
			<?php
				//buscar os servicos alfabeticamente
				$sql = "select cliente.id,cliente.nome,cliente.cpf,cliente.cep,cliente.endereco,cliente.complemento,cliente.bairro,cliente.email,cliente.foto,cidade.cidade,cidade.estado FROM cliente INNER JOIN cidade ON cliente.cidade_id= cidade.id";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados
					$id 	= $dados->id;
					$nome 	= $dados->nome;
                    $cpf = $dados->cpf;
                    $cep = $dados->cep;
                    $endereco = $dados->endereco;
                    $complemento = $dados->complemento;
                    $bairro = $dados->bairro;
                    $cidade = $dados->cidade;
                    $estado = $dados->estado;
                    $email = $dados->email;
                    $foto = $dados->foto;

					//mostrar na tela
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$nome.'</td>
                        <td>'.$cpf.'</td>
                        <td>'.$endereco.','.$complemento.','.$bairro.' - '.$cidade.'/'.$estado.'</td>
						<td>'.$email.'</td>
                        <td>'.$foto.'</td>
                        <td>
							<a href="cadastro/cliente/'.$id.'" class="btn btn-success btn-sm">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a class="btn btn-outline-danger btn-sm"  href="javascript:excluir('.$id.')">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>';
                }?>
            </tbody>
	</table>

</div>
<script>
	function excluir(id){

		if (confirm("Deseja mesmo excluir? ")) {
			//ir para exclusao
			location.href="excluir/cliente/"+id;
		}
	}
</script>