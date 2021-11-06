<?php
include '../globals.php';

session_start();

$user_id = $_SESSION['userid'];
$id_rol = $_SESSION['id_rol'];
$user = $_SESSION['user'];


if ($id_rol == 4) {
    $ref = "../Panel_Comerciales.php";
} else if ($id_rol == 2) {
    $ref = "../panel_bodega.php";
} else if ($id_rol == 7) {
    $ref = "../panel_ibague.php";
} else if ($id_rol == 3) {
    $ref = "../panel_d1.php";
} else if ($id_rol == 6) {
    $ref = "../panel_bodega.php";
} else {
    $ref = "../Panel_Comerciales.php";
}

include 'modal_create_items.php';
include 'modal_edit_materia.php';


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="../jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- jQuery and JS bundle w/ Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="funciones.js"></script>
  <title>Items</title>
</head>

<body>
  <div class="container">
    <div class="text-center">
      <button class="btn btn-outline-success mt-3" data-toggle="modal" data-target="#exampleModal"> Editar Item</button>
           <button class="btn btn-outline-danger mt-3" data-toggle="modal" data-target="#exampleModalMaterial">Editar Materia Prima</button>
           <button class="btn btn-info mt-3" data-toggle="modal" data-target="#exampleModalCreate"> Crear Item</button>
      <button class="btn btn-warning mt-3" id="ver_stocks" name="ver_stocks"> Ver Stocks</button>
      <button class="btn btn-success mt-3"> <a href="<?= $ref?>">Regresar a mi panel</a> </button>
      
      <button class="btn btn-danger" id="actualizar_items">Actualizar ps ome </button>
      <div id="modal">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar un productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- formulario-->
                <form methods="POST" id="form_1">

                  <div class="buscaritems">
                      <?php echo $id_rol; ?>
                    <label for="" class="text-success">Consultar Un Producto:</label>
                    <datalist id="buscaritem">
                      <option value="">Selecciona un producto</option>
                      <?php
                      if ($user_id == 27) {
                        $query = $cnx->query("SELECT * FROM productos_ibague2 ORDER BY id ASC");
                      } else if ($id_rol == 4) {
                        $query = $cnx->query("SELECT * FROM producto_av ORDER BY id ASC");
                      } else if ($id_rol == 2) {
                        $query = $cnx->query("SELECT * FROM producto ORDER BY id ASC");
                      } else if ($user_id == 26) {
                        $query = $cnx->query("SELECT * FROM productos_ibague ORDER BY id ASC");
                      } else if ($user_id == 1) {
                        $query = $cnx->query("SELECT * FROM producto_av ORDER BY id ASC");
                      }else{
                        $query = $cnx->query("SELECT * FROM producto_av ORDER BY id ASC");
                         //$query = $cnx->query("SELECT * FROM productos_ibague ORDER BY id ASC");
                       
                      }
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                      }
                      ?>
                    </datalist>
                    <input list="buscaritem" type="text" name="cedulasres" id="buscaritems" class="form-control" placeholder="Buscar Item" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Puedes buscar el item apartir de su codigo o nombre del mismo :D</small>

                  </div>

                  <div class="form-row">
                    <div class="col mb-2">
                      <small id="sku" class="text-muted">SKU</small>
                      <input type="text" class="form-control" name="id" placeholder="ID" readonly aria-describedby="sku">
                    </div>
                    <div class="col mb-2">
                      <small id="item" class="text-muted">ITEM</small>
                      <input type="text" class="form-control" name="item" placeholder="ITEM" aria-describedby="item">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col mb-2">
                      <small id="stocks" class="text-muted">STOCK</small>
                      <input type='text' class='form-control' name='stock' id="stock" placeholder='Stock' aria-describedby="stocks">
                      <input type="hidden" class="form-control" name="rol" id="rol" value="<?= $id_rol ?>">
                      <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= $user_id ?>">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col mb-2">
                      <small id="ubicacions" class="text-muted">UBICACION</small>
                      <input type="text" class="form-control" name="ubicacion" id="ubicacion" placeholder="Ubicacion" aria-describedby="ubicacions">
                    </div>
                    <div class="col mb-2">
                      <small id="unidads" class="text-muted">UNIDAD DE EMPAQUE</small>
                      <input type="text" class="form-control" name="unidad"  id="unidad" placeholder="Unidad de empaque" aria-describedby="unidads">
                    </div>
                  </div>
                  <hr>
                  <div id="adicional">
                    <div class="form-row">
                      <div class="col mb-2">
                        <small id="costo" class="text-muted">COSTO</small>
                        <input type="text" class="form-control" name="Costo" placeholder="Costo" aria-describedby="costo">
                      </div>
                      <div class="col mb-2">
                        <small id="categoria" class="text-muted">CATEGORIA</small>
                        <input type="text" class="form-control" name="categoria" placeholder="Categoria" aria-describedby="categoria">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col mb-2">
                        <small id="minima" class="text-muted">Cantidad Minima</small>
                        <input type="text" class="form-control" name="minima" placeholder="Cantidad Minima" aria-describedby="minima">
                      </div>
                      <div class="col mb-2">
                        <small id="maxima" class="text-muted">Cantidad Maxima</small>
                        <input type="text" class="form-control" name="maxima" placeholder="Cantidad Maxima" aria-describedby="maxima">
                      </div>
                    </div>
                    <div class="col mb-2">
                      <small id="prov_name" class="text-muted">Nombre Asignado Por El Proveedor</small>
                      <input type="text" class="form-control" name="proveedor_name" placeholder="Nombre de compra" aria-describedby="prov_name">
                    </div>
                  </div>


                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info" id="send_info">Editar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="contenedor" id="app">
    <div class="container" id="table_info">
      <form method="post" id="info_facturas" @submit.prevent>


        <table class="table" id="mytable">
          <thead class="thead-dark">


            <th scope="col">ID</th>
            <th scope="col">ITEM</th>
            <th scope="col">GENERO</th>
            <th scope="col">STOCK</th>
            <th scope="col">UBICACION</th>
          </thead>
          <tbody id="informacion">

          </tbody>
        </table>

      </form>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="js/consulta.js"></script>
</body>

</html>