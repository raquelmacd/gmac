<section id="ordens" class="services">
  <div class="container">

    <div class="section-title">
      <h2>Consulta de Ordem de Serviços</h2>
      <p>Nesta sessão você pode consultar o andamento das suas ordens de serviço.<br>
        <strong>Consulta feita pelo número da ordem e a senha enviada pelo técnico.</strong></p>
    </div>
    <div class="row">
        <form action="resultadoConsulta" method="post">
            <div class="input-group col-md-12">
              <input type="text" id="numeroOrdem" name="numeroOrdem" class="form-control" placeholder="Número da ordem" aria-describedby="consulta">
               <input type="text" id="senhaOs" name="senhaOs" class="form-control" placeholder="Senha" aria-describedby="consulta">
              <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary" id="consulta" >Consultar</button>
              </div>
            </div>
        </form>
      </div>
  </div>
</section><!-- End ORdens Section -->