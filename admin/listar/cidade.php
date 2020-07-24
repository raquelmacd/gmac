<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

/******* 
LISTAR USANDO PHP PURO
********/
//total de registros por página
$registroPg = "25";

if(!isset($p[3])){
    $pc = 1;
} else $pc = $p[3];

//echo $pc;

$inicio = $pc - 1;
$inicio = $inicio * $registroPg;
$limite = "SELECT * FROM cidade LIMIT $inicio, $registroPg";
$todos =  "SELECT * FROM cidade ORDER BY codigo";
$tr    = "SELECT max(codigo) as id FROM cidade";
$totalReg = $pdo->prepare($tr);
$totalReg->execute();
$tr = $totalReg->fetch(PDO::FETCH_OBJ);
$tp = $tr->id / $registroPg;
//echo $tp;

// agora vamos criar os botões "Anterior e próximo"
$anterior = $pc -1;
$proximo = $pc + 1;
$disabledA = $disabledP = "";
if ($pc == 1) {
$disabledA = "disabled";
}
if ($pc == round($tp)) {
$disabledP = "disabled";
}
                              
?>
<div class="container">
	<h1 class="float-left">Listar Cidade</h1>
	<div class="float-right">
		<a href="cadastro/cidade" class="btn btn-success">Novo Registro</a>
		<a href="listar/cidade" class="btn btn-info">Listar Registros</a>
	</div>
	<div class="clearfix"></div>
    

    <div class="row">   
        <div class="col-md-8">
            <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
        </div>
        <div class="col-md-4 float-right">
            <a href='listar/cidade/0/1'class="btn btn-outline-secondary"><i class="fa fa-fast-backward"></i></a>
            <a href='listar/cidade/0/<?=$anterior;?>'  class='btn btn-secondary <?=$disabledA;?>'> Anterior </a> | 
            <a href='listar/cidade/0/<?=$proximo;?>' class='btn btn-secondary <?=$disabledP;?>'>Próxima </a> 
            <a href='listar/cidade/0/<?=round($tp);?>' class="btn btn-outline-secondary"><i class="fa fa-fast-forward"></i></a>
        </div>
    </div>
    
	<table class="table table-striped table-bordered" id="myTable">
		<thead>
			<tr>
				<td>ID</td>
				<td>Cidade</td>
                <td>Estado</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody >
			<?php
     
            echo "";
				//buscar os servicos alfabeticamente
				$consulta = $pdo->prepare($limite);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados
					$id 	= $dados->codigo;
					$cidade	= $dados->cidade;
                    $estado = $dados->estado;


					//mostrar na tela
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$cidade.'</td>
                        <td>'.$estado.'</td>
                        <td>
							<a href="cadastro/cidade/'.$id.'" class="btn btn-success btn-sm">
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
        <p>Mostrando <?=$pc;?> de <?=round($tp);?> páginas.</p>

</div>
<script>
	function excluir(id){

		if (confirm("Deseja mesmo excluir? ")) {
			//ir para exclusao
			location.href="excluir/cidade/"+id;
		}
	};
    $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>