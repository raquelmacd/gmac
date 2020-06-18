<?php

foreach ( $_SESSION["carrinho"] as $c ) {
			
			$id 		= 	$c["id_produto"];
			$titulo 	=	$c["produto"];
			$valor  	=	$c["preco"];
			$quantidade =	$c["quantidade"];
            $subTotal   =  $valor * $quantidade; 
		} 
            $total   = $total + $subTotal;

?>

<div class="container">
    <iframe src="pages/pdf.php" width="1010px" height="560px" style="margin-top: 20px" ></iframe>
</div>