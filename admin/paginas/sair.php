<?php
		//iniciar sessao
		session_start();

		//apagar a sessao
		unset($_SESSION["tcc"]);

		//redirecionar
		header("Location: index.php");

?>