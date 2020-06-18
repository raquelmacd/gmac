<?php
    //verificar se não está logado
    if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
    }
    //iniciar as variaveis
    $nome  = $valor = $img = $marca = $categoria= "";

    //se nao existe o id
    if ( !isset ( $id ) ) $id = "";
    if ( !empty ( $id ) ) {
        //selecionar os dados do banco
        $sql = "select * from produtos 
            where id = ? limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(1, $id); 
        //$id - linha 255 do index.php
        $consulta->execute();
        $dados  = $consulta->fetch(PDO::FETCH_OBJ);

        //separar os dados
        $id 	= $dados->id_produto;
        $nome	= $dados->produto;
        $valor = $dados->preco;
        $img = $dados->img;
        $categoria = $dados->categoria;
        $marca = $dados->marca;
        

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
                <label for="nome">Nome do Produto</label>
                <input type="text" name="nome" id="nome" class="form-control" required	data-parsley-required-message="Preencha este campo, por favor"	value="<?=$nome;?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="marca">Marca</label>
                <select id="marca" class="form-control" name="marca">
                  <option value="<?=$marca;?>"></option>
                  <?php
                    //mostrar as editoras
                    $sql = "select * from marcas where status = 'S'
                      order by marca";
                    //executar
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();
                    //separar os dados por linha
                    while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {
                      //separar os dados
                      $id = $linha["id_marca"];
                      $marca   = $linha["marca"];
                      //montar o link
                      echo "<option value='$id'>$marca</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="categoria">Categoria</label>
                <select id="categoria" class="form-control" name="categoria">
                  <option value="<?=$categoria;?>"></option>
                  <option value="Acessorio">Acessório</option>
                    <option value="Peca">Peças</option>
                    <option value="Computador">Computador</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="img">Imagem do produto</label>
                <input type="file" name="img" id="img" class="form-control" accept=".jpg" value="<?=$img?>">
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
    $(document).ready(function() {
      $('#valor').maskMoney({
          thousands: ".",
          decimal: ",",
          prefix: "R$ "
      });
        
    });
</script>
