<?php include_once "inc/header.php"; ?>
<title>Admin</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include_once "inc/navbar_topo.php"; ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?php include_once "inc/sidebar_menu.php"; ?>
    </aside>


    <div class="content-wrapper">
      <br />


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row">

            <!-- ./col -->
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 style="font-family:inter; font-weight:lighter; font-size:21px">Adiministradores</h3>

                  <p style="font-family:arial; font-size:35px">
                    <?php
                    $pegar_con = BD::conn()->prepare("SELECT id, status FROM usuarios");
                    $pegar_con->execute();
                    if ($pegar_con->rowCount() == 0) {
                      echo '0';
                    } else {
                      $con = $pegar_con->rowCount();
                      echo "$con \n";
                    ?>
                    <?php } ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>

              </div>
            </div>
            <!-- ./col -->

             <!-- ./col -->
             <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3 style="font-family:inter; font-weight:lighter; font-size:21px">Domains</h3>

                  <p style="font-family:arial; font-size:35px">
                    <?php
                    $pegar_con = BD::conn()->prepare("SELECT id, status FROM usuarios");
                    $pegar_con->execute();
                    if ($pegar_con->rowCount() == 0) {
                      echo '0';
                    } else {
                      $con = $pegar_con->rowCount();
                      echo "$con \n";
                    ?>
                    <?php } ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>

              </div>
            </div>
            <!-- ./col -->



             <!-- ./col -->
             <div class="col-lg-12 col-12">
              <!-- small box -->
              <div class="small-box bg-default">
                <div class="inner">
                  <h3 style="font-family:inter; font-weight:lighter; font-size:21px">Olá,  <?php echo $usuarioLogado->nomealuno;?> </h3>

                  
                  <div id="data-hora" style="font-family:arial; font-size:35px"></div>
	
                  
                  <script>
			// Função para formatar 1 em 01
			const zeroFill = n => {
				return ('0' + n).slice(-2);
			}

			// Cria intervalo
			const interval = setInterval(() => {
				// Pega o horário atual
				const now = new Date();

				// Formata a data conforme dd/mm/aaaa hh:ii:ss
				const dataHora = zeroFill(now.getUTCDate()) + '/' + zeroFill((now.getMonth() + 1)) + '/' + now.getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());

				// Exibe na tela usando a div#data-hora
				document.getElementById('data-hora').innerHTML = dataHora;
			}, 1000);
		</script>
                </div>
                <div class="icon">
                  <i class="ion ion-calendar"></i>
                </div>

              </div>
            </div>
            <!-- ./col -->


<!-- ./col -->
<div class="col-lg-12 col-12">
              <!-- small box -->
              <div class="small-box bg-default">
                <div class="inner">
                  <h3 style="font-family:inter; font-weight:lighter; font-size:21px">Último Login</h3>

                  <p style="font-family:arial; font-size:35px">
             
<?php
    $source = $usuarioLogado->lastlog;
    $date = new DateTime($source);
   
    echo $date->format('d-m-Y'); 
?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-clock"></i>
                </div>

              </div>
            </div>
            <!-- ./col -->

          
            <style>
              #Fonte {
                font-family: inter;
                text-transform: uppercase;
                color: #333;
                font-size: 15px
              }

              #Fonte a {
                color: #333
              }

              #Fonte a:hover {
                color: red
              }
            </style>

         



            <!-- ./col -->
          </div>


          <!-- /.row -->



          <!-- /.row -->





          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- footer -->
    <footer class="main-footer">



</body>
<?php include_once "inc/footer.php"; ?>