<?php
 session_start();

include '../Invoice.php';
$invoice = new Invoice();
$invoice ->checkLoggedIn();

 ?>



<title>Devoluciones JJQUIMIENVASES</title>
 <link rel="stylesheet" type="text/css" href="css/select2.css">
 <script src="jquery-3.1.1.min.js"></script>
 <script src="js/select2.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>
 <!-- <script src="js/invoice.js"></script> -->
 <link href="css/style.css" rel="stylesheet">

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <meta charset="utf-8">
  <link rel="stylesheet" href="./css/reset.css">
  	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
  	<link rel="stylesheet" href="./css/main.css">
    <?php $mysqli = new mysqli ('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas'); ?>


  <style>

  h3{
    Color: #31B1E5;
    display: block;
    text-align: center;
    margin-top: 5px;
    margin-bottom: 10px;
    font-size: 30px;

  }
  select{
    border-radius: 30;
    background-color:
  }
  </style>

  <body>

 <div class="container">




   <h3>DEVOLUCIONES</h3>
   <!-- <label for="">Elegir un producto:</label> <select class="" name="">
     <option value=""></option>
   </select> -->

   <div class="datos">
     <form class="" action="enviardevolucion.php" method="post">

        <div style="text-align: center;">
          <label for="">Escoger un producto</label>
          <hr>
          <select id="mibuscador" style="width: 100%">
            <option value="0">Seleccione un producto:</option>
            <?php
            $query = $invoice -> query ("SELECT * FROM producto ORDER BY contratipo");
            while ($valores = mysqli_fetch_array($query)) {
              echo '<option value="'.$valores[id].'">'.$valores[contratipo].','.$valores[id].'</option>';
            }
            ?>
          </select>
        </div>
   <!-- Aqui inicia la prueba del nuevo formulario-->
           <input class="input" type="number" name="codigo" placeholder="&#8962;  Codigo"  readonly>
           <input class="input" type="text" name="name" placeholder="&#8962;  Producto" readonly>
           <input class="input" type="number" name="stock" placeholder="&#8962;  Stock" readonly>
           <input class="input" type="number" name="cantidad" placeholder="&#8962;  Cantidad" required>
           <input class="input" type="text" name="cliente" placeholder="&#8962;  Cliente" required>
           <div class="btn__form">
             <input class="btn__submit" type="submit" value="Aprobar"> <br>
          </div>
       </form>

       <a href="catalogos.php"> <button type="button" class="btn btn-outline-success" >Volver al menu</button> </a>

   </div>

    <!-- <a href="catalogos.php"> <button type="button" class="btn btn-primary" accesskey="q">Primary</button> </a> -->

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
  				// padre.find("[name^=genero]").val(d.resultado.genero)
          padre.find("[name^=stock]").val(d.resultado.stock)
  				padre.find("[name^=codigo]").val(d.resultado.id)
  				padre.find("[name^=name]").val(d.resultado.contratipo)
  				padre.find("[name^=precio]").val(d.resultado.gramo)
  			}).fail(function(e){console.log("ERROR:",e);});
  		})

  		function run_calcular(e, id){
  			calculateTotal(id);
  		}
  		$(document).ready(function(){
  			$('#mibuscador').select2();
  		});
  	</script>

  </body>
</html>
