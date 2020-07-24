<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
    }
    //iniciar as variaveis
    $nome  = $valor = $img = $marca = $categoria= $situacao =  "";

    //se nao existe o id
    if ( !isset ( $id ) ) $id = "";
    if ( !empty ( $id ) ) {
        //selecionar os dados do banco
        $sql = "select * from produto 
            where codigo = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $id); 
        //$id - linha 255 do index.php
        $consulta->execute();
        $dados  = $consulta->fetch(PDO::FETCH_OBJ);

        //separar os dados
        $id 	= $dados->codigo;
        $nome	= $dados->descricao;
        $valor = $dados->valor;
        $img = $dados->img;
        $categoria = $dados->categoria_codigo;
        $marca = $dados->marca_codigo;
        $situacao = $dados->situacao_codigo;
        

    } 

  ?>
  <div class="container">
	<h1 class="float-left">Cadastro de Produtos</h1>
	<div class="float-right">
		<a href="cadastro/produto" class="btn btn-success">Novo Registro</a>
		<a href="listar/produto" class="btn btn-info">Listar Registros</a>
	</div>
	<div class="clearfix"></div>

	<form name="formCadastro" method="post" action="salvar/produto" data-parsley-validate enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label for="id">ID</label>
                <input type="text" name="id" id="id"class="form-control" readonly value="<?=$id;?>">
            </div>
            <div class="col-md-6">
                <label for="situacao">Situação</label>
                <input list="listaSituacao" type="text" id="situacao" class="form-control" name="situacao" value="<?=$situacao;?>">
                <datalist id="listaSituacao">
                    <?php
					$sql = "select * from situacao";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();

					while ($d = $consulta->fetch(PDO::FETCH_OBJ)) {
						$id_status = $d->codigo;
						$descricao = $d->descricao;

						echo "<option value='$id_status - $descricao'>";
					}

					?>
                </datalist>

            </div>
            <div class="col-md-12">		
                <label for="nome">Nome do Produto</label>
                <input type="text" name="nome" id="nome" class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$nome;?>">
            </div>
            <div class="col-md-6">
                <label for="marca">Marca</label>
                <input type="text" list="listaMarca" id="marca" class="form-control" name="marca" value="<?=$marca?>">
                <datalist id="listaMarca">
                  <?php
                    //mostrar as editoras
                    $sql = "select * from marca order by descricao";
                    //executar
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    //separar os dados por linha
                    while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {
                      //separar os dados
                      $id = $linha["codigo"];
                      $marca   = $linha["descricao"];
                      //montar o link
                      echo "<option value='$id - $marca'>";
                    }
                    ?>
                </datalist>
            </div>
            <div class="col-md-6">
                <label for="categoria">Categoria</label>
                <input type="text" list="listaCategoria" id="categoria" class="form-control" name="categoria" value="<?=$categoria;?>" >
                 <datalist id="listaCategoria">
                     <?php
					$sql = "select * from categoria";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();

					while ($d = $consulta->fetch(PDO::FETCH_OBJ)) {
						$id_categoria = $d->codigo;
						$descricao = $d->descricao;

						echo "<option value='$id_categoria - $descricao'>";
					}

					?>
                    </datalist>
            </div>
            <div class="col-md-6">
                <?php 
                //variavel r requerido se ID está vazio
                    $r = ' required ';
                    
                    if(!empty($id)) $r = '';
                ?>
                <label for="img">Imagem do produto</label>
                <input type="file" name="img" id="img" class="form-control" accept=".jpg" <?=$r?>>    
                <input type="hidden" name="img" value="<?=$img?>" class="form-control">
                <?php  
                     
                if( !empty($img)){
                    $foto = "<img src='../assets/storage/".$img."p.jpg' alt='".$nome."' width='150px'>";
                } else{
                    $foto = "";
                }?>
                <div><?php echo $foto ;?></div>
            </div>
            <div class="col-md-6">
                <label for="valor">Valor</label>
                <input type="text" name="valor" id="valor" class="form-control" value="<?=$valor?>">
            </div>
            
        </div>

            <button type="submit" class="btn btn-success margin">
                <i class="fas fa-check"></i> Gravar Dados
            </button>
	</form>

	<div class="clearfix"></div>
</div>
<script>

</script>
