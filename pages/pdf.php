<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title> GMAC - Orçamento</title>
      <style>   
        #orcamento{
            padding-top: 200px;
            padding-left: 80px;
            background-position: top center;
            background-image: url('../assets/img/orcamentoPdf.jpg');
            background-repeat: no-repeat;
            background-size:  1020px 790px;
        }
      </style>
  </head>
  <body>
<div class="container" id="id_imprimir">
    <div></div>
    <div class="col-9 align-self-center">   
        <table class="table table-bordered table-light">
            <thead >
                <tr>
                    <td>Produto</td>
                    <td>Quantidade</td>
                    <td>Valor</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID:<?=$id?> | <?=$titulo?></td>
                    <td>x </td>
                    <td><?=$valor?> </td>
                    <td>x</td>
                </tr>
                
            </tbody>
            </table>
    </div> 
            <i>Impresso em : <script>document.write(new Date().toLocaleDateString());</script></i>
            <p><strong>A validade deste orçamento é 45 dias após gerado.</strong></p>
    
    <button class="btn btn-info" onclick="window.print()">Imprimir</button>
    </div>
      <script>
      </script>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </body>
</html>