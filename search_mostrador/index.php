<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<title>Cotizaciones</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

     <style>
         th,td {
             padding: 0.4rem !important;
         }
         body>div {
             box-shadow: 10px 10px 8px #888888;
             border: 2px solid black;
             border-radius: 10px;
             margin-top: 20px;
             height: auto;
         }
         a{
           decoration: none;
           color: white;
         }
         .container{
           height: auto;
         }
         tbody{
           height: 100%;
         
         }
         button{
             background:black;
         }
         span{
             background:#837A7A;
         }
     </style>
</head>
<body>
	<header>

	
  </header>

<section class="principal">


	  <hr>
      <center>  <h3> Lista de cotizaciones Mostrador</h3> </center>
  <hr>
  <center>
        <span class="btn btn-primary"><a href="../panel_mostrador.php">Panel Mostrador</a></span>
        <span class="btn btn-success"><a href="../create_invoice_2_.php">Crear Nueva Cotizacion</a></span>
        <span class="btn btn-danger" ><a href="../action.php?action=logout">Cerrar Session</a></span>
  </center>
       <br>

	<div class="formulario">
		<label for="caja_busqueda">Buscar una cotizacion:</label>
		<input type="text" name="caja_busqueda" id="caja_busqueda"></input>


	</div>
    
	<div id="datos"></div>


</section>



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>

</html>
