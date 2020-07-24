<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

$id = $operacao= $cliente = ""; 
?>

<div class="container">
	<h1 class="float-left">Cadastro de Orçamentos</h1>
	<div class="float-right">
		<a href="cadastro/orcamento" class="btn btn-success">Novo Registro</a>
		<a href="listar/orcamento" class="btn btn-info">Listar Registros</a>
	</div>
	<div class="clearfix"></div>
    <form action="salvar/orcamento" method="post">
        <div class="row">
            <div class="col-md-4">
                <label for="dataemissao">Data de emissão</label>
                <input type="text" class="form-control" name="dataemissao" id="dataemissao" required data-parsley-validate-message="Digite uma data válida" >
            </div>
            <div class="col-md-4">
                <label for="andamento">Status</label>
                <select class="form-control" type="text" name="andamento" id="andamento" value="<?=$andamento;?>">
                    <option value="2" selected>Pendente</option>
                    <option value="1">Finalizada</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="operacao">Operação</label>
                <input type="text" id="operacao" class="form-control" name="operacao" readonly value="1- Orçamento">
            </div>
            <div class="col-md-2">
                <label for="id">ID</label>
                <input type="text" name="id" id="id"class="form-control" readonly value="<?=$id;?>">
            </div>
            <div class="col-md-6">
                <label for="cliente">Cliente</label>
                <input list="clientes" name="cliente"  type="text" id="cliente" class="form-control" value="<?=$cliente;?>">
                <datalist id="clientes">
                    <?php
					$sql = "select codigo, nome from cliente";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();

					while ($d = $consulta->fetch(PDO::FETCH_OBJ)) {
						$cliente_codigo = $d->codigo;
						$cliente_nome = $d->nome;

						echo "<option value='$cliente_codigo - $cliente_nome'>";
					}

					?>
                </datalist>
            </div>
            <div class="col-md-4">
                <label for="colaborador">Colaborador</label>
                <input type="text" name="colaborador" id="colaborador" readonly value="<?=$_SESSION["tcc"]["id"];?> - <?=$_SESSION["tcc"]["nome"];?>" class="form-control">
            </div>
            <div class="col-md-12">
                <label for="observacao">Observação</label>
                <textarea rows="3" class="form-control"></textarea>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="produto-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Produtos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="servico-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Serviços</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Produto TAb -->
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="produto-tab" style="background-color: #FDF5E6;">
                <div class="col-md-12 row" >
                    <div class="col-md-3">
                        <label for="produto">Produto</label>
                        <input type="text" name="produto" id="produto" list="produtos" class="form-control" onblur="preencherProduto(this.value)">
                        <datalist id="produtos">
                        <?php
                        $sql = "select codigo, descricao from produto";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();

                        while ($d = $consulta->fetch(PDO::FETCH_OBJ)) {
                            $pro_codigo = $d->codigo;
                            $pro_descricao = $d->descricao;

                            echo "<option value='$pro_codigo - $pro_descricao'>";
                        }

                        ?>
                    </datalist>
                    </div>
                    <div class="col-md-3">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" name="quantidade" id="quantidade" class="form-control" value="1" onblur="adicionar(this.value,1)">
                    </div>
                    <div class="col-md-3">
                        <label for="valor">Valor</label>
                        <input type="text" name="valor" id="valor" value="" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="subtotal">SubTotal</label>
                        <input type="text" name="subtotal" id="subtotal" class="form-control" >
                    </div>
                    <div id="formProduto"></div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success margin" onclick="formProduto()">
                            <i class="fas fa-plus"></i> Adicionar
                        </button>
                    </div>
                </div>
                </div> <!--FIM  Produto TAb -->
                <!--Servico TAb -->
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="servico-tab" style="background-color: #FDF5E6;">
                    <div class="col-md-12 row">
                    <div class="col-md-3">
                        <label for="servico">Serviço</label>
                        <input type="text" name="servico" id="servico" list="servicos" class="form-control" onblur="preencherServico(this.value)">
                        <datalist id="servicos">
                        <?php
                        $sql = "select codigo, descricao from servico";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();

                        while ($d = $consulta->fetch(PDO::FETCH_OBJ)) {
                            $sv_codigo = $d->codigo;
                            $sv_descricao = $d->descricao;

                            echo "<option value='$sv_codigo - $sv_descricao'>";
                        }

                        ?>
                    </datalist>
                    </div>
                    <div class="col-md-3">
                        <label for="servQtde">Quantidade</label>
                        <input type="text" name="servQtde" id="servQtde" class="form-control" value="1" onfocus="adicionar(1,this.value)">
                    </div>
                    <div class="col-md-3">
                        <label for="servalor">Valor</label>
                        <input type="text" name="servalor" id="servalor" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="sersubtotal">SubTotal</label>
                        <input type="text" name="sersubtotal" id="sersubtotal" class="form-control" >
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-success margin">
                            <i class="fas fa-plus"></i> Adicionar
                        </button>
                    </div>
                </div>
                </div> <!--FIM  Servico TAb -->
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-3">
                    <label for="totalProduto">Total Produtos</label>
                    <input type="text" name="totalProduto" id="totalProduto" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="totalServico">Total Serviços</label>
                    <input type="text" name="totalServico" id="totalServico" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="desconto">Desconto R$</label>
                    <input type="text" name="desconto" id="desconto" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="total">Valor Total</label>
                    <input type="text" name="total" id="total" class="form-control">
                </div>
            </div>
                
        </div>
            <button type="submit" class="btn btn-success margin">
                <i class="fas fa-check"></i> Gravar Dados
            </button>
    </form>
</div>
<script type="text/javascript">    
    $(document).ready(function(){
        $("#dataemissao").val(new Date().toLocaleDateString());
    });
    
    function preencherProduto(produto){
        $.get("buscarValor.php", {produto:produto}, function(dados){
                $("#valor").val(dados);
        })
    }
    function preencherServico(servico){
        $.get("buscarValor.php", {servico:servico}, function(dados){
                $("#servalor").val(dados);
        })
    }
    function adicionar(pqtde,sqtde){
        var valor = $("#valor").val();
        var valorServico = $("#servalor").val();
        $("#subtotal").val(valor * pqtde);
        $("#sersubtotal").val(valorServico * sqtde);
    }
    
</script>