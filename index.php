<?php
	$site 	= $_SERVER['SERVER_NAME'];
	$porta  = $_SERVER['SERVER_PORT'];
	$url	= $_SERVER['SCRIPT_NAME'];
	
	$h = "http";


	if( isset($_SERVER['HTTPS']) ) {

    	$h = "https";

	}
	//$h 		= $_SERVER['REQUEST_SCHEME'];

	// http://localhost:8888/hqs/admin/index.php
	//site localhost
	//porta 8888
	//url /hqs/admin/index.php
	$base 	= "$h://$site:$porta/$url";
    //recuperar o parametro
    $pagina = "home";
	if ( isset ( $_GET["parametro"] ) )
	{
		$pagina = trim( $_GET["parametro"]);

		//quebra uma string a partir de um caracter
		$p = explode("/", $pagina); 
		
		//print_r($p);
		 //$p[0] - nome da pagina
		 //$p[1] - id do registro
		$pagina = $p[0];
        //echo '<div class="float-right">'.$pagina.'</div>';
    
	}
//verificar qual pagina ira carregar
	if ( $pagina == "sobre" )
		$titulo = "Sobre";
	else if ( $pagina == "contato" )
		$titulo = "Entre em Contato";
	else if ( $pagina == "servicos" )
		$titulo = "Serviços";
	else if ( $pagina == "produtos" ) 
		$titulo = "Produtos";
	else if ( $pagina == "carrinho" )
		$titulo = "Carrinho";
	else
		$titulo = "Página Inicial";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gmac - <?=$titulo;?></title>
  <meta content="" name="description">
  <base href="<?=$base;?>">

  <!-- Favicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

 <!-- Vendor CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

 <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio - v1.1.0
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<!-- ======= Header ======= -->
<header id="header">
    <div class="d-flex flex-column">
      <div class="profile">
        <img src="assets/img/profile.jpg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="home">Gmac</a></h1>
      </div>

    <nav class="nav-menu">
        <ul>
            <li><a href="home" class="dropdown-item"><i class="bx bx-home"></i> Home</a></li>
            <li><a href="sobre" class="dropdown-item"><i class="bx bx-user"></i> Sobre</a></li>
            <li><a href="produtos" class="dropdown-item"><i class="bx bx-book-content"></i> Produtos</a></li>
            <li><a href="servicos" class="dropdown-item"><i class="bx bx-server"></i> Serviços</a></li>
            <li><a href="contato" class="dropdown-item"><i class="bx bx-envelope"></i> Contato</a></li>
            <li><a href="carrinho" class="dropdown-item"><i class="bx bx-cart"></i> Carrinho de Orçamento</a></li>
        </ul>
    </nav>
   </div>
</header><!-- End Header -->
  
<main id="main"> 
    <?php 
    //conexao com o banco
        include "admin/config/conexao.php";
		//configurar a pagina que ira ser incluida
		$pagina = "pages/".$pagina.".php";
    
		//verificar se a págian existe
		if ( file_exists($pagina) ) {
            //incluir pagina
			include $pagina;
		} else{
            //se nao incluir pagina de erro
			include "pages/404.php";
		}
		?>
</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
         Copyright &copy;
      </div>
      <div class="credits">
        Designed by Raquel <a href="https://github.com/raquelmacd"><i class="fa fa-github" style="font-size:24px"></i></a>
      </div>
    </div>
  </footer><!-- End  Footer -->
    <script type="text/javascript">
    var width = screen.width;
        if(width >= 800){
            
        }
    </script>
    
  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- selecionar o servico -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="assets/js/typed.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
    <!--CARRINHO  jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>