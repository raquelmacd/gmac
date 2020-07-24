
<div class="container">
    <div></div>
    <div class="col-9 align-self-center">   
        <table class="table table-light"  id="orcamento">
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
                    <td>ID: | </td>
                    <td>x </td>
                    <td></td>
                    <td>x</td>
                </tr>
                
            </tbody>
            </table>
    </div> 
            <i>Impresso em : <script>document.write(new Date().toLocaleDateString());</script></i>
            <p><strong>A validade deste orçamento é 45 dias após gerado.</strong></p>
    
    <button class="btn btn-info" onclick="imprimir()">Imprimir</button>
    </div>
<script>
    function imprimir(){
        window.print();
    }
</script>