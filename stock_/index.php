<?php
include 'conexion.php';
session_start();
$id_rol = $_SESSION['id_rol'];
$user = $_SESSION['user'];


//referencia del boton

 $href = "";
 if($id_rol == 7){
     $href = "../panel_ibague.php";
 }else if($id_rol == 2){
    $href = "../panel_mostrador.php";
 }else if($id_rol == 3){
     $href = "../panel_d1.php";
 }else if($id_rol == 6){
     $href = "../panel_bodega.php";
 }else if($id_rol == 8){
     $href = "../administrador/index.php";
 }else if($id_rol == 1){
     $href = "../factuenvases/home.php";
 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <title>Upload Inventario</title>
    <style>
      li{
          list-style: none;
      }
      a{
          text-decoration: none;
          color:white;
      }
    </style>

</head>

<body>
    <div class="container mt-1">
    <div class="text-center mt-1">
<img src="../logo.png" width="200" height="205" alt="Logo corporativo">
    </div>
<div class="text-center mt-2">

<button type="button" onclick="getInformationOrder(<?= $id_rol ?>)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
Ver Productos Ingresados
</button>
<button class="btn btn-warning"> <a href=<?= $href; ?>>Volver Al Panel Principal</a> </button>
</div>
<?php 
   include 'modal_historial.php';
  ?>

        <div class="row">
            
            <div class="col">
                <label for="inicio">Escoger Fecha Inicial:</label>
                 <input type="date" id="inicio" class="form-control">
            </div>
            <div class="col">
                 <label for="final">Escoger Fecha Final:</label>
                 <input type="date" id="final" class="form-control">
            </div>
                
            <label>Buscar Un Producto</label>

            <div class="form-group">
                
                <div class="buscaritem">
                    <datalist id="buscar_item">
                        <option value="" class="form-control">Seleccionar Un Producto</option>
                        <?php
                        $query = $conexion->query("SELECT * FROM productos_ibague ORDER BY id ASC");
                        while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="' . $valores["id"] . '" class="form-control">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                        }
                        ?>
                    </datalist>
                    <input class="form-control" list="buscar_item" name="item_id" id="buscaritem" type="text" placeholder="Buscar Items">
                </div>
            </div>
            <div class="text-right mt-2">
                <button class="btn btn-success">Consultar</button>
            </div>
        </div>
  
  <form id="form_1">
        <div id="info_item" class="form-group">
            <label for="">Codigo:</label>
            <input type="number" name="id" class="form-control" readonly>
            <label for="">Contratipo:</label>
            <input type="text"  name="contratipo" class="form-control" readonly>
            <label for="">Stock Actual:</label>
            <input type="number" name="stock" class="form-control" readonly>
            <label for="">Catidad Vendida en el rango de fechas:</label>
            <input type="number" name="cantidad_vendida" class="form-control" readonly>
            <label for="">Cantidad Salidas-T en el rango de fechas:</label>
            <input type="number" name="cantidad_salida_t" class="form-control" readonly>
            <label for="">Cantidad Entradas-T en el rango de fechas:</label>
            <input type="number" name="cantida_entrada_t" class="form-control" readonly>
             <label for="">Cantidad Ingreso Compras:</label>
            <input type="number" name="cantida_ingreso" class="form-control" readonly>
             <label for="">Gramos en perfumes preparados:</label>
            <input type="number" name="cantidad_perfumes" class="form-control" readonly>
            <label for="">CANTIDAD REAL</label>
            <input type="number" name="nuevo_stock" class="form-control">
          
          <button class="btn btn-success mt-3" type="button" onclick="send_data()" id="send_info">Subir Informacion</button>
        </div>
  </form>


    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="js/funciones.js"></script>
</body>
<script>
//ajax subir informacion
function send_data(){
    var datos = $("#form_1").serialize();
    console.log(datos);
    let timerInterval;
    Swal.fire({
      title: "Cargando informacion!",
      html: "Gracias por confiar en nosotros, Faltan <b></b> Milisegundos.",
      timer: 2000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
        timerInterval = setInterval(() => {
          const content = Swal.getHtmlContainer();
          if (content) {
            const b = content.querySelector("b");
            if (b) {
              b.textContent = Swal.getTimerLeft();
            }
          }
        }, 100);
      },
      willClose: () => {
        clearInterval(timerInterval);
      },
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log("I was closed by the timer");
      }
    });
    $.ajax({
      type: "POST",
      url: "ajax/send_info.php",
      data: datos,
      success: function (r) {
        // console.log(r);
        if (r != 0 && !isNaN(r)) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Item Agregado Con Exito",
            showConfirmButton: false,
            timer: 1500,
          });
          //limpiando los inputs 
          let padre = $("#items_modal").parent().parent().parent();
          padre.find("[name^=id]").val("");
          padre.find("[name^=contratipo]").val("");
          padre.find("[name^=stock]").val("");
          padre.find("[name^=cantidad_vendida]").val("");
          padre.find("[name^=cantidad_salida_t]").val("");
          padre.find("[name^=cantidad_entrada_t]").val("");
  
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Algo salio mal!",
            showConfirmButton: false,
            timer: 1500,
          });
        }
      },
    });
    return false;
};

function getInformationOrder(data) {
    // console.log("este es el data de getinfo" +data);
    $.ajax({
      url: "methods/conexion_get_information.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q1",
        item: data,
      },
    })
      .done(function (d) {
        d.retornolosdatos.forEach((item) => {
        //   console.log(item.id);
          let td = document.createElement("td");
          td.innerHTML = item.sku;
          td.innerHTML = item.contratipo;
          td.innerHTML = item.nuevo_stock;
          td.innerHTML = item.usuario;
          td.innerHTML = item.fecha;
          td.innerHTML = item.estado;
          // document.getElementById('cart_sku').innerHTML = item.item_code;
          var capa = document.getElementById("info_cart");
          // var data_arreglo = ul + li_code + li_name;
          var li_code = document.createElement("li");
          var li_name = document.createElement("li");
          var li_nuevo_stock = document.createElement("li");
          var li_fecha = document.createElement("li");
          var li_usuario = document.createElement("li");
          var hr = document.createElement("hr");
          //valores formateadores
    
         
          li_code.innerHTML = "Codigo: " + item.sku;
          li_code.class = "form-control";
          li_name.innerHTML = "Producto: " + item.contratipo;
          li_name.class = "form-control";
          li_nuevo_stock.innerHTML = "Cantidad: " + item.nuevo_stock;
          li_nuevo_stock.class = "form-control";
          li_fecha.innerHTML = "Fecha: " + item.fecha;
          li_fecha.class = "form-control";
          li_usuario.innerHTML = "Usuario: " + item.usuario;
          li_usuario.class = "form-control";
          //capa imprime la informacion
          capa.appendChild(li_fecha);
          capa.appendChild(li_usuario);
          capa.appendChild(hr);
          capa.appendChild(li_code);
          capa.appendChild(li_name);
          capa.appendChild(li_nuevo_stock);
       
          capa.appendChild(hr);
 
        });

      })
      .fail(function (e) {});
  }
  
  function limpiar_modal_cart() {
    // $('#info_cart').val('');
    console.log("limpiando data");
    document.getElementById("info_cart").innerHTML = "";
  }
</script>
</html>