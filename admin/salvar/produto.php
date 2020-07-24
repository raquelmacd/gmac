<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

  //verificar se existem dados no POST
  if ( $_POST ) {
      include "functions.php";
  	//recuperar os dados do formulario
  	$id =  $nome  = $valor = $img = $marca = $categoria = $situacao= "";

  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
  		//$id
  	}

      print_r($_POST);
      print_r($_FILES);
  	//validar os campos - em branco
  	if ( empty( $valor ) ) {
  		echo '<script>alert("Preencha o valor");history.back();</script>';
  		exit;
  	}

    //iniciar uma transacao
    
    $pdo->beginTransaction();    
    
    $valor = formatarValor($valor);
      
    $arquivo = time()."-".$_SESSION["tcc"]["id"];
    
    if(empty($id)){
        //inserir
        $sql= "INSERT INTO produto(descricao, marca_codigo, valor, categoria_codigo, situacao_codigo, img) VALUES (:descricao, :marca_codigo, :valor, :categoria_codigo, :situacao_codigo, :img)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':descricao',$nome);
        $consulta->bindParam(':marca_codigo',$marca);
        $consulta->bindParam(':valor',$valor);
        $consulta->bindParam(':categoria_codigo',$categoria);
        $consulta->bindParam(':situacao_codigo',$situacao);
        $consulta->bindParam(':img',$arquivo);
        
    } else{
        //qual arquivo sera gravado
        if(!empty( $_FILES["img"]["name"])){
            $img = $arquivo;
        }
        //update
        $sql= "UPDATE produto SET descricao = :descricao, marca_codigo = :marca_codigo, valor = :valor, categoria_codigo = :categoria_codigo, situacao_codigo = :situacao_codigo, img = :img WHERE codigo = :id ";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':descricao',$nome);
        $consulta->bindParam(':marca_codigo',$marca);
        $consulta->bindParam(':valor',$valor);
        $consulta->bindParam(':categoria_codigo',$categoria);
        $consulta->bindParam(':situacao_codigo',$situacao);
        $consulta->bindParam(':img',$img);
        $consulta->bindParam(':id',$id);
    }
    
    if($consulta->execute()){
        //verificar se o arquivo nao está sendo enviado 
        if( empty($_FILES["img"]["type"]) and (!empty($id)) ){
            //a capa deve estar vazia e ID nao estiver vazio
            //gravar no banco 
            $pdo->commit();
            echo "<script>alert('Registro Salvo');location.href='listar/produto';</script>";
            
        }
        //veririfcar tipo imagem
        if($_FILES["img"]["type"]  !=  "image/jpeg"){
            echo "<script>alert('Seleciona uma imagem Jpeg');history.back();</script>";
            exit;
        }
        if ( move_uploaded_file($_FILES["img"]["tmp_name"], "../assets/storage/".$_FILES["img"]["name"])){
            
            $pastaFotos = "../assets/storage/";
            $nome = $arquivo;
            $imagem = $_FILES["img"]["name"];
            redimensionarImagem($pastaFotos,$imagem,$nome);
            
            //gravar no banco - se tudo deu certo
            $pdo->commit();
            echo "<script>alert('Registro Salvo');location.href='listar/produto';</script>";
        }
        
        //erro ao gravar
        echo "<script>alert('Erro ao gravar no servidor');history.back();</script>";
        exit;
    }
    
    //echo consulta->errorInfo()[2];
    exit;

  } else {
  	//mensagem de erro
  	//javascript - mensagem alert
  	//retornar hostory.back
  	echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
  }