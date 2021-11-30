<?php
session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");
}
include 'conectar.php';
$conexion = conectar();

$alistamiento = "alistamiento";
$result= $conexion -> query ("SELECT count(*) as total FROM notificaciones WHERE estado = 'pendiente' ");
$data=mysqli_fetch_assoc($result);

$cuenta = $data['total'];

$alistamiento = "pendiente";
$resultados= $conexion -> query ("SELECT count(*) as totales FROM files WHERE estado = 'pendiente' ");
$datas=mysqli_fetch_assoc($resultados);

$cuentas = $datas['totales'];

?>



<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
	<?php include "includes/scripts.php"; ?>
		<title>Home Cotizar</title>
		 <link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">

	    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="estilos.css">

	</head>
	<body>

	    <?php include 'barra.php' ?>
  <br>
		<section id="container">
	  <center><h4> BIENVENIDO</h4>
			<span class="user">  <?php echo $_SESSION['user']; ?></span>
	  <center><h3> ¿Que deseas hacer hoy? </h3></center>
	  <br>
	  <center><p> Colombia, <?php echo fechaC();?></p></center>
	<br></section>

		<div class="container principal">
			<div class="row">
				<div class="col-lg-12 text-center">
		            <div class="row">
	                    <!--tarjeta 1-->
                      <div class="col-lg-4 col-md-12 mb-4">
   								 			 <div class="card-section card-section-third border rounded">
   								 				 <div class="card-header card-header-third rounded">
   								 						 <h3 class="card-header-title mb-3 text-black"> Todas las cotizaciones</h3>
   								 				 </div>
   								 				 <div class="card-body text-center mb-2">
   								 						<p class="card-text">ingresar aqui para actualizar el Codigo de las cotizaciones.</p>
   								 						<hr>
   								 					 <a href="search/index.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>

   								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


   								 				 </div>
   								 			 </div>
   								 	 </div>


	                    <!--tarjeta 2-->
										<div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black"> Orden De Compra</h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text">Ingresar aqui para generar una orden de compra</p>
								 						<hr>
								 					 <a href="new_create_orden.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>
 <a href="providers_demo/vistas/proveedores.php"><button class="btn btn-lg btn-danger">new</button></a>
								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>


	                    <!--tarjeta 3-->
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Facturas Pendientes</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
			                      <strong><p>Tienes ( <?php echo $cuenta;   ?> ) Facturas pendientes</p>  </strong>

				                     <p class="card-text"> Cotizaciones pendientes por factura </p>
				                     <hr>
														<a href="ver_facturas_pendientes.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>
														<a href="facturacion/index.php"><button class="btn btn-lg btn-danger">N Facturacion</button></a>

							


			                    </div>
		                  	</div>
		                </div>

 
      <!--tarjeta 3-->
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Productos</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Catalogos</p>
				                     <hr>
														<a href="factuenvases/catalogos/admin_productos.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>
														<a href="factuenvases/catalogos/nuevamercancia_demo.php"><button class="btn btn-lg btn-warning">Nueva M</button></a>
														<a href="items/index.php"><button class="btn btn-lg btn-info">STOCKS</button></a>

						
			                    </div>
		                  	</div>
		                </div>

  <!-- Tarjeta 4 -->
        <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Ver Cotizaciones</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text"> Ver cotizaciones sin iva</p>
				                     <hr>
														<a href="ver_info_sin_iva.php"><button class="btn btn-lg btn-primary">Click Aqui</button></a>

							


			                    </div>
		                  	</div>
		                </div>   
		               <!-- ADJUNTAR DOCUMENTO --> 
		                
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Cotizaciones Pendientes</h3>
			                    </div>
			                    <div class="card-body text-center mb-2"> 
			                    <strong><p>Tienes ( <?php echo $cuentas;   ?> ) Cotizaciones pendientes</p>  </strong>
				                     <p class="card-text"> Cotizaciones pendientes por factura y empaque</p>
				                     <hr>
														<a href="upload/index.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>

			                    </div>
		                  	</div>
		                </div>
		                
		<!-- tarjeta 5-->
		       <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Proveedores</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Proveedores y producto</p>
				                     <hr>
														<a href="proveedores/index.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>

							


			                    </div>
		                  	</div>
		                </div>
		 <!-- tarjeta 6 -->               
		                		       <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Ingresos de mercancia</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Ingresos</p>
				                     <hr>
														<a href="ingresos.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>
						
			                    </div>
		                  	</div>
		                </div>
		                
		              		 <!-- tarjeta 7 -->               
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Ver Clientes</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Ver y buscar clientes</p>
				                     <hr>
									<a href="search_clientes/index.php"><button class="btn btn-lg btn-secundary">Click Aqui</button></a>
						
			                    </div>
		                  </div>  
		            </div>    		
		            
		            <!-- tarjeta 8 -->               
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Solicitud Mercancia</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Ver solicitud de mercancia</p>
				                     <hr>
                                   <a href="ordenes_de_compra/mostrador.php"><button class="btn btn-lg btn-success">Ver Solicitudes</button></a>						
			                    </div>
		                  </div>  
		            </div>
		            
		            <!--transfers -->
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Traspasos</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Editar Cantidades Traspasos</p>
				                     <hr>
                                   <a href="transfers/transfers_list.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>						
			                    </div>
		                  </div>  
		            </div>
				
				<!-- ok abonos-->
					<div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black"> ABONOS</h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text">Abonos</p>
								 						<hr>
								 					 <a href="abonos/table_info.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>
				<!-- ok abonos-->
					<div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black"> Cotizaciones Estado</h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text">Ver Estado</p>
								 						<hr>
								 					 <a href="upload/empaques_on.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>
								 	 <!-- CONTRATOS-->
								 	 <div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black">Contratos</h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text">Generar Documentos</p>
								 						<hr>
								 					 <a href="contratos/index.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>
								 	 
								 	 <!-- DEVOLUCIONES -->
								 	 <div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black">Devoluciones</h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text">Generar Devolucion</p>
								 						<hr>
								 					 <a href="devoluciones/vistas/view_search.php"><button class="btn btn-lg btn-info">Click Aqui</button></a>

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>
								 	 <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">ESENCIAS</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Lista de esencias</p>
				                     <hr>

						        	<a href="check_fragancias/index.php"><button class="btn btn-lg btn-danger">Ver lista</button></a>
	
			                    </div>
		                  	</div>
		                </div>
								 	 <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">ETIQUETAS</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Generar Etiquetas</p>
				                     <hr>

						        	<a href="etiquetas/index.php"><button class="btn btn-lg btn-danger">Generar</button></a>
	
			                    </div>
		                  	</div>
		                </div>
				
				</div>
			</div>
		</div>



	 <script src="js/script.js"></script>


	</body>
	</html>
