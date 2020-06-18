<?php

  	//selecionar os dados do banco
  	$sql = "select * from servico where status = 'S'";
  	$consulta = $pdo->prepare($sql);
  	//$id - linha 255 do index.php
  	$consulta->execute();

?>

<!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Serviços</h2>
          <p>Nesta sessão você pode encontrar alguns serviços que faço. Fique a vontade para entrar em contato.</p>
        </div>
        <div class="row">
          <?php 
             while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados

					$tipo 	= $dados->tipo;
                    $descricao = $dados->descricao;
                    $icone = $dados->icone;

					//mostrar na tela
					echo'<div class="col-lg-4 col-md-6 icon-box">
                <div class="icon"><i class="'.$icone.'"></i></div>
                <h4 class="title"><a >'.$tipo.'</a></h4>
                <p class="description">'.$descricao.'</p>
            </div>';
             } ?>
        </div>
        <div class="row" style="margin-left: 10px" > 
            <a href="consultaOrdem" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Consulte aqui o andamento das suas ordens">
            Consultar Ordem de Serviço</a>
        </div>
      </div>
    </section><!-- End Services Section -->