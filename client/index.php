<?php
	//iniciar a sessao
	session_start();

	//iniciar a variavel pagina
	$pagina = "paginas/login";

	//incluir o arquivo de conexao
	include "../admin/config/conexao.php";

?>
<!doctype html>
<html lang="pt-Br">

<head>
  <title>Gmac - Área do Cliente</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css/util.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/main.css">
</head>

<body>
	<?php
	//completar o nome da página
	$pagina = $pagina.".php";

	//se não esta logado
	//mostrar tela do login
	if ( !isset ( $_SESSION["cliente"]) ){
		//incluir o login
		include $pagina;
	}
	else {

		//mostrar a pagina bonita do template
		
		?>
  <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="white">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="" class="simple-text logo-normal">
          Bem-vindo <?=$_SESSION["cliente"]["nome"];?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="home">
              <i class="material-icons">dashboard</i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item active  ">
            <a class="nav-link" href="cliente">
              <i class="material-icons">account_circle</i>
              <p>Meu Cadastro</p>
            </a>
          </li>
        <li class="nav-item active  ">
            <a class="nav-link" href="404">
              <i class="material-icons">description</i>
              <p>Minhas Ordens</p>
            </a>
          </li>
        <li class="nav-item active  ">
            <a class="nav-link" href="sair.php">
              <i class="material-icons">directions_run</i>
              <p>Sair</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <a class="collapse navbar-collapse" id="botaoVoltar" href="javascript:history.back();">
            <i class="material-icons">reply</i>Voltar  
          </a>  
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Procurar...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
              <a class="navbar-brand" href="sair.php"><i class="material-icons">directions_run</i> Sair</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
        <?php
        //adicionar a programação para abrir a página desejada

            //recuperar o parametro
            $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
            //separar por /
            $area = explode("/", $url);
            $arquivo	= $area[2];
            $pagina = "paginas/$arquivo.php";
            
            $id = $_SESSION["cliente"]["id"];

        
        //verificar se a pagina existe
		        if ( file_exists($pagina) )
		        	include $pagina;
		        else
		        	include "paginas/404.php"
        ?>
        </div>
        </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i>.
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
<!--===============================================================================================-->
    <!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="vendor/jquery/jquery-3.2.1.slim.min.js"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
<script>
    $(document).ready(function(){
        window_width = $(window).width();
        
        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
        
        if (window_width > 767 && fixed_plugin_open == 'Home') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }
        
    })
    </script>
<?php 
    }
    
    ?>
</body>

</html>