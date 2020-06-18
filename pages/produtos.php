
<!-- ======= Portfolio Section ======= -->
    <section  class="section-bg produtos" >
      <style>
            * {
              box-sizing: border-box;
            }
            h1 {
              font-size: 50px;
              word-break: break-all;
            }

            .row {
              margin: 8px -16px;
            }

            /* Add padding BETWEEN each column (if you want)             */
            .row,
            .row > .column {
              padding: 8px;
            }

              
            /* Create three equal columns that floats next to each other */
            .column {
              float: left;
              width: 33.33%;
              display: none; /* Hide columns by default */
            }

            /* Clear floats after rows */
            .row:after {
              content: "";
              display: table;
              clear: both;
            }

            /* Content */
            .content {
              background-color: white;
              padding: 10px;
            }

            /* The "show" class is added to the filtered elements */
            .show {
              display: block;
            }

            /* Style the buttons */
            .btn {
              border: none;
              outline: none;
              padding: 12px 16px;
              background-color: white;
              cursor: pointer;
            }

            /* Add a grey background color on mouse-over */
            .btn:hover {
              background-color:		#A9A9A9;
              box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);

            }
            .botao{
                  opacity: 0.5;
              }
            .botao:hover{
                 opacity: 1;
              }
            /* Add a dark background color to the active button */
            .btn.active {
              background-color: #173b6c;
               color: white;
            }
          </style>
      <div class="container">
            <div class="section-title">
              <h2>Produtos</h2>
              <p>Aqui você encontra os produtos disponíveis.</p>
            </div>
        <!-- BOSSTRAP PORTFOLIO FILTER-->
        <div id="myBtnContainer">
          <button class="btn active" onclick="filterSelection('all')"> Todos </button>
          <button class="btn" onclick="filterSelection('peca')"> Peças</button>
          <button class="btn" onclick="filterSelection('computador')"> Computadores</button>
          <button class="btn" onclick="filterSelection('acessorio')">Acessorio</button>
        </div>

        <!-- Portfolio Gallery Grid -->
        <div class="row">
            <?php

                $id =  $img =  $categoria ="";
                if ( isset ( $p[1]) ) {
                    $id = trim ( $p[1] );
                }
                //selecionar 4 quadrinhos aleatorios
                $sql = "select id_produto,img, categoria 
                    from produtos order by id_produto ";
                $consulta = $pdo->prepare($sql);
                $consulta->execute();

                while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {
                    $id = $linha["id_produto"];
                    $img = $linha["img"];
                    $categoria = $linha["categoria"];
                
                    if($categoria == "Peca") {       ?>
          <div class="column peca">
            <div class="content">
              <a href="carrinho/add/<?=$id?>"  style="width:100%">
                <img src="assets/storage/<?=$img?>" alt="Peça" class="botao" style="width:100%">
                </a>
            </div>
          </div>
            <?php } 
                if($categoria == "Computador"){           ?>
          <div class="column computador">
            <div class="content">
              <a href="carrinho/add/<?=$id?>" style="width:100%">
                <img src="assets/storage/<?=$img?>" alt="Computador" class="botao"  style="width:100%">
                </a>
            </div>
          </div>
            <?php  } 
                if($categoria == "Acessorio"){  ?>
          <div class="column acessorio">
            <div class="content">
              <a href="carrinho/add/<?=$id?>"  style="width:100%">
              <img src="assets/storage/<?=$img?>" alt="Acessorio"  class="botao" style="width:100%">
                </a>
            </div>
          </div>
            <?php  }   
                }; ?>
        <!-- END GRID -->
        </div>
 </div>
</section>
<script>
filterSelection("all") // Execute the function and show all columns
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
  <!--  <!-- End Portfolio Section -->