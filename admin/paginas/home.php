<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["tcc"]["id"] ) ){
    exit;
  }

    //buscar dados das ordens 
    $sql = "SELECT count(codigo) as num FROM ordem where operacao_codigo = 2";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $numOrdens = $consulta->fetch(PDO::FETCH_OBJ);
    // buscar numero de ordens finalizadas
    $sql = "SELECT count(codigo) as num FROM ordem where andamento_codigo = 1 and operacao_codigo = 2";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $finalizadas = $consulta->fetch(PDO::FETCH_OBJ);
    // buscar o numero de ordens pendentes
    $sql = "SELECT count(codigo) as num FROM ordem where andamento_codigo = 2 and operacao_codigo = 2";
    $consulta = $pdo->prepare($sql);
    $consulta->execute();
    $pendentes = $consulta->fetch(PDO::FETCH_OBJ);
    if($numOrdens->num != 0 ) $porcentagem = ($finalizadas->num * 100) / $numOrdens->num;
    else $porcentagem = 0;
?>
<div class="container" id="home">

    <div class="alert alert-warning" role="alert">
      <h1>Bem-vindo! <?=$_SESSION["tcc"]["nome"]?></h1> 
    </div>
     <!-- Registros de Ordem de serviço -->
    <div id="ordem">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Ordens de Serviço</h1>
          </div>
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registros de Ordens</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$numOrdens->num;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Finalizadas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$finalizadas->num;?></div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?=$porcentagem;?>%" aria-valuenow="<?=$porcentagem;?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pendentes</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$pendentes->num;?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- Content Row -->
            </div>
    </div><!-- Fim do registro de ordem de serviço  -->
    <!-- Registros de orçamentos -->
    <div id="orcamento">
        <?php
            //buscar dados dos orçamentos
            $sql = "SELECT count(codigo) as num FROM ordem where operacao_codigo = 1 ";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            $orcamentos = $consulta->fetch(PDO::FETCH_OBJ);
            // buscar numero de ordens finalizadas
            $sql = "SELECT count(codigo) as num FROM ordem where andamento_codigo = 1 and operacao_codigo = 1";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            $orcaFinalizado = $consulta->fetch(PDO::FETCH_OBJ);
            // buscar o numero de ordens pendentes
            $sql = "SELECT count(codigo) as num FROM ordem where andamento_codigo = 2 and operacao_codigo = 1";
            $consulta = $pdo->prepare($sql);
            $consulta->execute();
            $orcaPendente = $consulta->fetch(PDO::FETCH_OBJ);
            $orcamentoPorc = ($orcaFinalizado->num * 100) / $orcamentos->num;

        ?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Orçamentos</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registros de Orçamentos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$orcamentos->num;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Finalizadas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$orcaFinalizado->num;?></div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?=$orcamentoPorc;?>%" aria-valuenow="<?=$orcamentoPorc;?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pendentes</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$orcaPendente->num;?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- Content Row -->
            </div>
    </div>
</div>