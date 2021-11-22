<!DOCTYPE html>

<?php
include('conexion.php');

session_start();
$id_rol = $_SESSION['id_rol'];


$id_usuario = $_SESSION["userid"];
if ($id_usuario == 10 or $id_usuario == 4460 or $id_usuario == 8 or $id_usuario == 41 or $id_usuario == 26 or $id_usuario == 27 or $id_usuario == 20 or $id_usuario == 2 or $id_usuario == 4471) {
}else{
  header('location:../create_invoice_.php');
    
}

//   if($id_user != 26){
//       header("Location:../panel_ibague.php");
//   }else{
     
//   }


if($id_usuario == 27){
      $bodega = "mostrador_ibague_2";
      $metodo = "mostrador_ibague_2";
}else if($id_usuario == 26){
      $bodega = "mostrador_ibague_1";
      $metodo = "mostrador_ibague_1";
} 

if($id_rol == 2){
  //bodega mostrador principal bogota
  $bodega = "mostradorjj";
}else if($id_rol == 3){
  //bodega mostrador D1
  $bodega = "mostradord1";
}


    if($id_rol == 2){
      //bodega mostrador principal bogota
      $metodo = "mostradorjj";
    }else if($id_rol == 3){
      //bodega mostrador D1
      $metodo = "mostradord1";
    }
    
    
    

$tmp = array();
$res = array();

$status = "pendiente";

$sel = $con->query("SELECT * FROM factura_orden WHERE estado = '$status' AND metodopago = '$bodega' ORDER BY order_date DESC LIMIT 10");

$seleccion = $con->query("SELECT count(*) AS total FROM factura_orden WHERE estado = '$status' AND metodopago = '$bodega'");
$data=mysqli_fetch_assoc($seleccion);
$cuenta = $data['total'];


  if ($cuenta > 0) {
    while ($row = $sel->fetch_assoc()) {
        $tmp = $row;
        array_push($res, $tmp);
    }
  }else{
  echo "NO TIENES COTIZACIONES PENDIENTES POR ALISTAMIENTO";
}


?>
<?php
$resultado = "";
if (isset($_POST['buscar_cotizacion'])) {
 $id = $_POST['producto'];
 $sql = "SELECT * FROM factura_orden WHERE order_id='$id'  OR order_receiver_name LIKE '%$id%' ";
 $r = $con->query($sql);
 if ($o = $r->fetch_object()) {
   $resultado = $o;
 }

}

include_once '../conexion_proveedor.php';



include 'consulta_datos.php';






$mysqli2 = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');  

 ?>


<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!--<script src="jquery-3.1.1.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

        <title>Finalizar Venta</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos.css"> 
  </head>
    <body>
      <?php
      if ($id_rol == 7) {
         //bodega de ibagueto
        include "barra_ibague.php";
      }else if($id_rol == 3){
        //bodega mostrador d1
        include "barrad1.php";
      }else if($id_rol == 2){
        //bodega mostrador
       include 'barra_mostrador.php';
      }
      
      $boton_cotizar = "";
      
       if ($id_rol == 7) {
         //bodega de ibagueto
         $boton_cotizar = "<button class='btn btn-warning'><a href='../create_invoice_ibague_.php'>Crear Cotizaciones </a> </button>";
         
      }else if($id_rol == 3){
        //bodega mostrador d1
         $boton_cotizar = "<button class='btn btn-warning'><a href='../create_invoice_d1_.php'>Crear Cotizaciones </a> </button>";
      }else if($id_rol == 2){
        //bodega mostrador
         $boton_cotizar = "<button class='btn btn-warning'><a href='../create_invoice_2_.php'>Crear Cotizaciones </a> </button>";
      }  
?>

        <!-- <div class="container"> -->
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <h1>Completar Venta Mostrador</h1>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-8">
                <center>  <div class="form-group">
                    <input type="text" name="mycount" id="mycount" value=" <?php echo "Tienes: ".$cuenta." Cotizaciones Pendientes"; ?>" readonly>
                  </div> </center>

 
                  <!--<center>  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >-->
                  <!--    Click aqui para seleccionar una cotizacion-->
                  <!--  </button> </center>-->
 <hr>
                  <center>  <div class="form-group">
                    <input type="text" name="mycounts" id="mycounts" value="AVISO: Cuando le des click al boton de pendiente, la informacion de el cliente ya estara registrada en la ventana emergente" readonly>
                  </div> </center>
 <hr>
<?php 
echo $boton_cotizar;
?>
<label for="infor">
    INGRESAR INFORMACION DE CAJA - GASTOS Y NOVEDADES
</label>
<!--<button class="btn btn-danger" id="infor"><a href="../caja/index.php">Click aqui para ingresar informacion</a></button>-->




<br>
 <center>
     <div class="container mt-2">
    <div class="row">
<div class="form-group col-md-2">
<button class="btn btn-info" id="infor"><a href="../cierre_caja/index.php" target="_blank">Cerrar Caja</a></button>
</div>
<div class="form-group col-md-2">
<button class="btn btn-warning" id="abono"><a href="../abonos/table_info.php" target="_blank">ABONOS</a></button>
</div>
<div class="form-group col-md-2">
<button class="btn btn-danger" id="abono"><a href="../devoluciones/vistas/view_search.php" target="_blank">Devoluciones</a></button>
</div>
<div class="form-group col-md-5">
<button class="btn btn-primary" id="catalogo_close"><a href="../close_shop_sold/vistas/index.php" target="_blank">Cerrar Ventas Catalogo</a></button>
</div>
</div>
</div>

<hr>
     <h2>Buscar Cotizaciones</h2>
 <div class="barra__buscador">
   <form action="" class="formulario" method="post">
     <input type="text" name="buscar" id="buscador" placeholder="buscar ID  o Fecha"
     value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="form-group">
     <input type="submit" class="btn btn-primary" name="btn_buscar" value="Buscar">
   </form>
 </div> 
 
 </center>
 
 <hr>
 <button type="button" name="button" class="btn btn-success"><a href="index.php">Refrescar Pagina</a></button>
 <span><?php echo $id_user;?> </span>
 <hr>
                    <table class="table table-hover table-bordered" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cotizacion</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Comercial</th>
                                <th scope="col">Total</th>
                                <th scope="col">PDF Cotizacion</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                      <div id="reload">

                        <?php
                           include 'tbody.php';
                           ?>

                      </div>
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- </div> -->
        <!-- Modal -->
       <?php include 'modal_finalizar.php'; ?>

        <div class="modal fade" id="modalPdf" tabindex="-1" aria-labelledby="modalPdf" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ver archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="500px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="scripts/funciones.js"></script>
      
      
       <script>
      

   
		 	$(document).ready(function(){
		$('#finalizar').click(function(){
		     var datos=$('#form1').serialize();
			$.ajax({
				type:"POST",
				url:"upload.php",
				data:datos,
				success:function(r){
					console.log(r);
					 Swal.fire({
            title: 'Bien Hecho!',
            text: "Cotizacion Finalizada Correctamente!",
            icon: 'success',

            confirmButtonColor: '#3085d6',

            confirmButtonText: 'Continuar!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "index.php";

            }
          })
          
						},
			error:function(error){
			    console.log(error);
			}
	
		});
		 	});
        
        //esto es por si le dan al boton de no valido
        $('#nope').click(function(){
		     var datos=$('#form1').serialize();
			$.ajax({
				type:"POST",
				url:"no_upload.php",
				data:datos,
				success:function(r){
					console.log(r);
					alert("Solicitud de anulacion enviada correctamente.");
  				window.location.reload();
						},
			error:function(error){
			    console.log(error);
			}
	
		});
		 	});
		 	//este boton s para enviar el descuento
      $('#desc_btn').click(function() {
        var datas = $('#form1').serialize();
        $.ajax({
          type: "POST",
          url: "send_ajax_descuento.php",
          data: datas,
          success: function(r) {
            console.log(r);
            Swal.fire({
              title: 'Bien Hecho!',
              text: "Descuento a la remision "+r+" aplicado correctamente!",
              icon: 'success'
            });

           let reload = window.location.reload();
           setTimeout(reload,2000);
          },
          error: function(error) {
            console.log(error);
          }

        });
      });
        
        
		 	});
        
                            function openModelPDF(url) {
                                $('#modalPdf').modal('show');
                                $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/upload/'; ?>'+url);
                            }
        </script>

<!--QUERY PARA AGREGAR LA INFORMACION EN LOS INPUTS -->

<script type="text/javascript">
 // esta es la consulta ajax pero buena es que cmo estaba haciend opruebas no tiene los datos como son
  $(".buscaCliente").click(function(){//si ves puse un . en vez de #, esto quiere decir que se usa la clase en vez del id, me explico? si claro que si bro
    var id_cliente=$(this).attr('value');
    $.ajax({
        url: 'con_json.php',
        type: 'POST',
        dataType: 'json',
        data: {id:id_cliente},
        success:function(res){
         $("#nombre").val(res.order_receiver_name);
         $("#cotizaciones").val(res.order_id);
         $("#cedula").val(res.cedula);
         let montox = 0;
         let order_total_after_tax = res.order_total_after_tax;
         let order_total_amount_due = res.order_total_amount_due;
         if(order_total_amount_due == "" || order_total_amount_due == 0){
        montox = order_total_after_tax;
    }else{
        montox = order_total_amount_due;
    }
         $("#txt_campo_2").val(montox);
         $("#comercial").val(res.order_receiver_address);
         $("[btn-imprimir-remision]").attr('href','../imprimir.php?invoice_id='+res.order_id);
        }
      });
  });
</script>



    </body>
</html>
