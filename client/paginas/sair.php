<?php
	//iniciar a sessão
	session_start();

	//apagar a sessao
	unset ( $_SESSION["cliente"] );

    header("Location: ../index.php");