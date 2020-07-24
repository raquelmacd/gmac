<?php
    session_start();
	$op = $produto =  "";
	if ( isset ( $p[1] ) ) $op = trim ( $p[1] );
	if ( isset ( $p[2] ) ) $produto = trim ( $p[2] );

if ( $op == "add" ) {
        
    
        if (isset($_SESSION["carrinho"][$p[2]])){
            $_SESSION["carrinho"][$p[2]]["quantidade"] = $_SESSION["carrinho"][$p[2]]["quantidade"] + 1;
            //print_r($_SESSION["carrinho"][$p[2]]);
        }
		$sql = "select codigo, descricao, valor from produto where codigo = ? limit 1";
		$consulta = $pdo->prepare($sql);
		$consulta->bindParam(1, $produto, PDO::PARAM_INT);
		$consulta->execute();
		$linha 	= $consulta->fetch(PDO::FETCH_OBJ);

		if ( isset ( $linha->codigo ) ) { 
			$id 	= 	$linha->codigo;
			$produto =	$linha->descricao;
			$valor  =	$linha->valor;
            
            
			$_SESSION["carrinho"][$id] = array("codigo"=>$id, "descricao"=>$produto, "valor"=>$valor, "quantidade"=>1);
            //print_r($_SESSION["carrinho"][$id]);
		}

	} else if ( $op == "quantidade" ) {

		$_SESSION["carrinho"][$p[2]]["quantidade"] = $_SESSION["carrinho"][$p[2]]["quantidade"] + 1;
        //print_r($_SESSION["carrinho"][$p[2]]);

	} else if ( $op == "del" ) {

		unset ( $_SESSION["carrinho"][$produto] );

	} else if ( $op == "limpar" ) {

		unset( $_SESSION["carrinho"] );
        echo "<script>location.href='carrinho'</script>";
        exit;
        
	} else if( $op == "retirar" ){       
        $_SESSION["carrinho"][$p[2]]["quantidade"] = $_SESSION["carrinho"][$p[2]]["quantidade"] - 1;
    }

?>
<section class="carrinho contact" id="contact">
    <div class="container">
        <div class="section-title">
            <h2>Carrinho de Orçamento</h2>
        </div>
        <div class="col-lg-12 col-md-12 icon-box">
<?php
	if ( isset ( $_SESSION["carrinho"] ) ) {
		?>
		<form method="post" action="orcamento">  
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<td>Nome do Produto</td>
					<td colspan="2">Quantidade</td>
					<td>Excluir</td>
				</tr>
			</thead>

		<?php
        $total = 0;
        $qtdeTotal = 0;
            foreach ( $_SESSION["carrinho"] as $c ) {

                $id 		= 	$c["codigo"];
                $titulo 	=	$c["descricao"];
                $valor  	=	$c["valor"];
                $quantidade =	$c["quantidade"];
                $subTotal   =  $valor * $quantidade;


                echo "<tr>
                    <td>$titulo</td>
                    <td>
                        <input type='text' value='$quantidade' class='form-control' readonly name 
                        ='quantidade'>
                    </td>
                    <td><a  class='btn' href='javascript:add(".$c["codigo"].")'><i class='bx bxs-plus-circle'></i></a>
                        <a  class='btn' href='javascript:subtrair(".$c["codigo"].")'><i class='bx bxs-minus-circle'></i></a></td>
                    <td><a href='carrinho/del/$id' class='btn btn-danger'>Excluir</a></td>
                </tr>
                ";
                $qtdeTotal +=  $quantidade;
                $total   += $subTotal;
            } 
                $total = number_format($total, 2, ",", ".");

            ?>
			<tfoot>
				<tr>
					<td colspan="3">TOTAL DE PRODUTOS:</td>
                    <td colspan="1"><?=$qtdeTotal;?> unidades</td>
				</tr>
			</tfoot>
		</table>
	        <a href="carrinho/limpar" class="btn btn-danger">Limpar Carrinho</a>
	        <button type="submit" class="btn btn-success">Realizar Orçamento</button>
		</form>
		<?php
	} else {
		echo "<p class=\"alert alert-danger\">Não existem produtos no carrinho</p>";
	}

?>
        </div>
    </div>
</section>
<script>
    const orcamentos = 1;
function add(produto){
    
    location.href="carrinho/quantidade/"+produto;
    
}
function subtrair(produto){

        location.href="carrinho/retirar/"+produto;
}
</script>