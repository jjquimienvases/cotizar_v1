<?php
 session_start();

include '../Invoice.php';
include 'conectar.php';
$conexion = conectar();
$invoice = new Invoice();
$invoice ->checkLoggedIn();

if(empty($_POST['name']) && empty($_POST['cantidad'])) {
   echo "<script> alert ('completar todos los campos para actualizar el stock'); </script>";
}else{
  $invoice->saveStock($_POST);
  header("location:nuevamercancia.php");
}
 ?>



<title>Nueva Mercancia</title>
 <script src="jquery-3.1.1.min.js"></script>
 <script src="js/select2.js"></script>
 <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/select2.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <meta charset="utf-8">
  <style>
  button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  align-content: center;
}
 table{
   width: 80%;
 }
 .contenedor{
   display: block;
   width: 90%;
   margin-left: 50px;
   margin-right: 50px;
   /* display: inline; */
 }
 input{
   width: 100%;
 }

 @media
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr {
		display: block;
	}

	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}

	tr { border: 1px solid #ccc; }

	td {
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee;
		position: relative;
		padding-left: 50%;
	}

	td:before {
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%;
		padding-right: 10px;
		white-space: nowrap;
	}
}
  </style>

  <body>

 <div class="contenedor">
   <h3>AGREGAR MERCANCIA BODEGA Principal</h3>
   <?php 
    $rol_usuari
   ?>
   <div class="datos">
     <form class="" action="enviarstock.php" method="post">
       <table class="table table-bordered table-hover">
         <tr>
           <th>Elegir Bodega</th>     
           <th width="5%">Buscar aqui</th>
           <th>Codigo</th>
           <th>Producto</th>
           <th>U x Empaque</th>
           <th>Precio</th>
           <th>Cantidad actual</th>
           <th>Nueva Cantidad</th>
           <th>Factura</th>
           <th>Proveedor</th>
         </tr>
         <tr>
           <td> 
            <select class="form-control" name="bodega">
                <option value="producto_av" selected>Bodega Principal</option>
                <option value="productos_ibague">Ibague</option>
                <option value="producto">Mostrador Principal</option>
                <option value="producto_d1">Mostrador D1</option>
            </select>
           </td>
           <td>
             <div style="text-align: center;">
               <select id="mibuscador" style="width: 100%">
                 <option value="0">Seleccione:</option>
                    <?php
                      $query = $conexion -> query ("SELECT * FROM producto");
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="'.$valores[id].'">'.$valores[contratipo].','.$valores[id].'</option>';
                      }
                    ?>
               </select>
             </div>
           </td>

           <td> <input type="number" name="codigo" value=""> </td>
           <td> <input type="text" name="name" value=""> </td>
           <td> <input type="text" name="empaque" value=""> </td>
           <td> <input type="number" name="precio" value=""> </td>
           <td> <input type="number" name="stock" value=""> </td>
           <td> <input type="number" name="cantidad" value=""> </td>
           <td> <input type="text" name="factura" value=""> </td>
           <td> <input type="text" name="proveedor" value=""> </td>
         </tr>
    <hr>


       </table>
        <div class="boton">
          <button type="submit" name="button">Ingresar este producto</button>
        </div>
       </form>
   </div>
     <hr>
 </div>


 <script>
 function ver_datos(id, e){
 var dato = document.getElementById('producto'+id);
 e.preventDefault();
 }


 $("#mibuscador").on('change',function(){
   $.ajax({
     url:'metodos/conexiones.php',
     type:'POST',
     dataType:'json',
     data:{key:'Q1',producto:$(this).val()}
   }).done(function(d){

     let padre = $("#mibuscador").parent().parent().parent();
     padre.find("[name^=codigo]").val(d.resultado.id)
     padre.find("[name^=name]").val(d.resultado.contratipo)
     padre.find("[name^=precio]").val(d.resultado.gramo)
     padre.find("[name^=stock]").val(d.resultado.stock)
     padre.find("[name^=empaque]").val(d.resultado.unidad)
   }).fail(function(e){console.log("ERROR:",e);});
 })


 $(document).ready(function(){
       $('#mibuscador').select2();
   });


 </script>

  </body>
</html>
