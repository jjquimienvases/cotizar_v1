<?php
include 'conexion.php';
session_start();
$user = $_SESSION['user'];
$id_rol = $_SESSION['id_rol'];
$id_user = $_SESSION['userid'];
if ($id_rol == 2) {
    $bodega_entrada = "producto";
} else if ($id_rol == 3) {
    $bodega_entrada = "producto_d1";
} else if ($id_rol == 6) {
    $bodega_entrada = "producto_av";
} else if ($id_rol == 4) {
    $bodega_entrada = "producto_av";
} else if ($id_user == 27) {
    $bodega_entrada = "productos_ibague2";
} else if ($id_rol == 7) {
    $bodega_entrada = "productos_ibague";
} else {
    $bodega_entrada = "producto_av";
}
if(!$id_user){header('Location: https://cotizar.jjquimienvases.com/');}else{}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'meta.php'; ?>
    <title>Traslado Mercancia</title>
</head>

<body>
<input type="hidden" value="<?= $user?>" id="user_name">
<input type="hidden" value="<?= $id_user?>" id="user_id">
    <div class="container mt-3" id="app">
        <?php include 'navbar.php'; ?>
        <div class="text-center">
            <hr>
            <h3 id="welcome">Bienvenido <?= $user ?></h3>
            <h6 class="text-success informatic">Este apartado esta diseñado para ejecutar traspasos de mercancia entre las bodegas de JJ QUIMIENVASES SAS</h6>
        </div>
        <hr>
        <div id="container-a">

            <input type="hidden" onclick="mostrarData()" id="trigger">


            <div class="izquierda" id="izquierda">
                <div class="text-center text-danger mb-2">
                    <h5 class="informatic">Buscar el producto que deseas solicitar.</h5>
                </div>
                <form id="form_2">

                    <div class="buscar_item">
                        <datalist id="buscar_items">
                            <option value="">Seleccione un producto</option>
                            <?php
                            $query = $con->query("SELECT * FROM $bodega_entrada WHERE visibilidad != 0 ORDER BY id ASC");
                            while ($valores = mysqli_fetch_array($query)) {
                                echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                            }
                            ?>
                        </datalist>
                        <input class="form-control" list="buscar_items" name="item_" id="buscar_item" type="text" placeholder="Buscar un productos">
                    </div>


                    <div class="col mt-2">
                        <label>Producto</label>
                        <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Nombre Producto" readonly>
                    </div>

                    <div class="col mt-2">
                        <label>Codigo</label>
                        <input type="number" class="form-control" name="item_code" id="item_code" placeholder="Codigo Producto" readonly>
                    </div>

                    <div class="col mt-2">
                        <label for="inputCity">Escribir la cantidad que vas a solicitar</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Cantidad" id="inputCity">
                    </div>
                    
                      <div class="col mt-2">
                        <label for="inputCity">Escribir los gramos de perfumeria que tienes actualmente</label>
                        <input type="number" class="form-control" name="gramos_actuales" id="gramos_actuales" placeholder="gramos actules" id="gramos_actuales">
                    </div>

                    <div class="col mt-2">
                        <label for="inputState">Bodega de salida</label>
                        <select id="inputState" name="bodega_salida" class="form-control">
                            <option value="producto_av" selected>Bodega Principal</option>
                            <option value="producto">Mostrador Principal</option>
                            <option value="producto_d1">Mostrador D1</option>
                            <option value="productos_ibague">Mostrador Ibague 1</option>
                            <option value="productos_ibague2">Motrador Ibague 2</option>
                        </select>
                    </div>
                    <div class="text-right">
                        <button type="button" id="send_information" class="btn red lighten-3 mt-4"><i class="material-icons">archive</i></button>
                    </div>

                </form>

            </div>


            <div class="text-center">
                <!-- <button id="mostrar" type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ver Productos Solicitados</button> -->

                <div class="derecha">
                    <h3>Information</h3>
                </div>

            </div>

        </div>

        <div id="container-b">
            <table class="table table-striped table-bordered responsive-table">
                <thead class="thead-dark text-light">
                    <tr class="amber darken-3">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Cantidad</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody id="info" class="table-bordered">

                </tbody>
            </table>
            <div class="text-center">
                <button class="btn yellow darken-3" id="complete_transfer">Completar Traspaso</button>
            </div>

        </div>


    </div>

    <div class="clearfix"></div>

    <script src="js/funciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
</body>

</html>

<!--
    
    
     $.ajax({
      url: "methods/get_information.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q1",
        item: data,
      },
    })
      .done(function (d) {
        //  datas = d.resultado;
         console.log(d);
        //  console.log(d).resultado;
        d.retornolosdatos.forEach((item) => {
          console.log(item.id);
          let td = document.createElement("td");
          td.innerHTML = item.item_code;
          td.innerHTML = item.item_name;
          td.innerHTML = item.item_quantity;
          td.innerHTML = item.item_unity_price;
          td.innerHTML = item.item_total_price;
          // document.getElementById('cart_sku').innerHTML = item.item_code;
        

  
        });
        //     document.getElementById("result_venta").innerHTML = Total;
        // console.log("Arreglo" + Total);
      })
      .fail(function (e) {});
    
    
    
    
    
     var capa = document.getElementById("info");
          // var data_arreglo = ul + li_code + li_name;
          var li_code = document.createElement("li");
          var li_name = document.createElement("li");
          var li_bodega_salida = document.createElement("li");
          var li_bodega_entrada = document.createElement("li");
          var li_status = document.createElement("li");
          var li_fecha = document.createElement("li");
          var li_order = document.createElement("li");
          var li_quantity = document.createElement("li");
          var hr = document.createElement("hr");
  
          //valores formateadores
         
          li_code.innerHTML = "Codigo: " + item.item_code;
          li_code.class = "form-control";
          li_order.innerHTML = "Orden De Traspaso: " + item.transfer_id;
          li_order.class = "form-control";
          li_fecha.innerHTML = "Fecha: " + item.order_date;
          li_fecha.class = "form-control";
          li_status.innerHTML = "Orden De Traspaso: " + item.item_status;
          li_status.class = "form-control";
         
          // li_total_price_item.name = "los_totales";
          li_name.innerHTML = "Item: " + item.item_name;
          li_name.class = "form-control";
          li_quantity.innerHTML = "Cantidad: " + item.item_quantity;
          li_quantity.class = "form-control";
          //capa imprime la informacion
          capa.appendChild(li_order);
          capa.appendChild(li_fecha);
          capa.appendChild(li_code);
          capa.appendChild(li_name);
          capa.appendChild(li_quantity);
          capa.appendChild(li_status);

          let button_delete =
            '<button class="btn btn-danger" onclick="deleteData(' +
            item_codigo +
            ')" id="delete_row">Eliminar</button>';
          $("#info").append(button_delete);
          
          capa.appendChild(hr); -->
