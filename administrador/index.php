<?php
include '../conectar.php';
session_start();
// $invoice = new Invoice();
// $invoice->checkLoggedIn();
// if(!empty($_POST['companyName']) && $_POST['companyName']) {
// 	$invoice->saveInvoice($_POST);
// 	header("Location:invoice_list.php");
// }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><meta charset="euc-jp">
    <?php include "../factuenvases/includes/scripts.php"; ?>
    
    <title>Panel de administador</title>
    <link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="css/estilos.css">
  </head>
  <body>
    <br>
  		<section id="container">
  	  <center><h4> BIENVENIDO</h4>
  			<span class="user">  <?php echo $_SESSION['user']; ?></span>
  	  <center><h3> ¿Que deseas hacer hoy? </h3></center>
  	  <br>
  	  <center><p> Colombia, <?php echo fechaC();?></p></center>
  	<br></section>
<!-- Aqui van los enlaces-->
<div class="container principal">
  <div class="row">
    <div class="col-lg-12 text-center">
            <div class="row">
                  <!--tarjeta 1-->
                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black">Cotizaciones</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">Ver lista de cotizaciones</p>
                       <hr>
                      <a href="../search/index.php"><button class="btn btn-lg btn-primary">Click Aqui</button></a>

                      <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


                    </div>
                  </div>
              </div>



                  <!--tarjeta 2-->
                <div class="col-lg-4 col-md-12 mb-4">
                   <div class="card-section card-section-third border rounded">
                     <div class="card-header card-header-third rounded">
                         <h3 class="card-header-title mb-3 text-black">Inventarios</h3>
                     </div>
                     <div class="card-body text-center mb-2">
                        <p class="card-text">Ver Stock de todas las bodegas.</p>
                        <hr>
                       <a href="../inventario/vistas/preview.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>

                       <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


                     </div>
                   </div>
               </div>


                  <!--tarjeta 3-->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card-section card-section-third border rounded">
                      <div class="card-header card-header-third rounded">
                          <h3 class="card-header-title mb-3 text-black">Ingresos Mercancia</h3>
                      </div>
                      <div class="card-body text-center mb-2">
                         <p class="card-text">Ver nuevos ingresos de mercancia.</p>
                         <hr>
                        <a href="ingresos_mercancia.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>

                        <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                      </div>
                    </div>
                </div>
                <!--TARJETA 4 -->
            <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card-section card-section-third border rounded">
                      <div class="card-header card-header-third rounded">
                          <h3 class="card-header-title mb-3 text-black">Traslados Mercancia</h3>
                      </div>
                      <div class="card-body text-center mb-2">
                         <p class="card-text">Ver traslados de mercancia.</p>
                         <hr>
                        <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <a href="trapasos/send_pdf/index.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>
                      </div>
                    </div>
                </div>

            <!-- tarjeta 5 -->
            <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card-section card-section-third border rounded">
                      <div class="card-header card-header-third rounded">
                          <h3 class="card-header-title mb-3 text-black">Facturas Pendientes</h3>
                      </div>
                      <div class="card-body text-center mb-2">
                         <p class="card-text">Facturas Pendientes por enviar.</p>
                         <hr>
                        <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
           <a href="../facturacion/index.php"><button class="btn btn-lg btn-info">Click Aqui</button></a>

                      </div>
                    </div>
                </div>

           <!--tarjeta 6 -->
           <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black">Usuarios</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">Administrar Usuarios.</p>
                       <hr>
                      <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <a href="#">	<button class="btn btn-lg btn-secondary" onclick="return confirmAdmin()">Click Aqui</button></a>
                    </div>
                  </div>
              </div>
                         <!--tarjeta 7 -->
           <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black">Salida De Mercancia</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">Ver la cantidad que se a vendido.</p>
                       <hr>
                      <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <a href="salida_mercancia.php">	<button class="btn btn-lg btn-success">Click Aqui</button></a>
                    </div>
                  </div>
              </div>
              
                                       <!--tarjeta 8 -->
           <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black">Reportes</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">Reportes de venta.</p>
                       <hr>
                      <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <!--<a href="send_report/index.php">	<button class="text-warning">General</button></a>-->
                    <!--<a href="reporte/users_report.php">	<button class="btn btn-lg btn-warning">Usuario</button></a>-->
                    <a href="../reportes/vistas/cot_finalizadas.php">	<span class="btn btn-success">Reporte</span></a>
                    <a href="../reportes/ajax/ajax_consulta_resumen.php">	<span class="btn btn-warning">Resumen</span></a>
                    
                    </div>
                  </div>
              </div>
              
                                               <!--tarjeta 9 -->
           <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black">Consultar Ventas Call</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">Ventas Call.</p>
                       <hr>
                      <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <a href="../upload/index.php">	<button class="btn btn-lg btn-warning">Consultar</button></a>

                    </div>
                  </div>
              </div>     
              
              <!--tarjeta 9 -->
           <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black"> PANEL ASISTENTE</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">ingresar panel asistente</p>
                       <hr>
                      <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <a href="../asistente.php">	<button class="btn btn-lg btn-danger">Consultar</button></a>

                    </div>
                  </div>
              </div>      
           <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black"> CATALOGO E</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">ingresar al Demo </p>
                       <hr>
                      <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <a href="../catalogo_e/index.php">	<button class="btn btn-lg btn-warning">Ingresar</button></a>

                    </div>
                  </div>
              </div>      
                   <div class="col-lg-4 col-md-12 mb-4">
                  <div class="card-section card-section-third border rounded">
                    <div class="card-header card-header-third rounded">
                        <h3 class="card-header-title mb-3 text-black"> Cuadre caja</h3>
                    </div>
                    <div class="card-body text-center mb-2">
                       <p class="card-text">cick aqui</p>
                       <hr>
                      <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
                    <a href="../novedades/index.php">	<button class="btn btn-lg btn-warning">Ingresar</button></a>

                    </div>
                  </div>
              </div> 
          


            </div>
    </div>
  </div>
</div>



  </body>
</html>
