<?php include '../conexion.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="contentForm" id="app">
   
      <div class="mb-3">
        <div class="form-group">
          <div class="buscar_item">
            <datalist id="buscar_item">
              <option value="">Seleccione un producto</option>
              <?php
              $query = $con->query("SELECT * FROM producto_av ORDER BY contratipo ASC");
              while ($valores = mysqli_fetch_array($query)) {
                echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
              }
              ?>
            </datalist>
            <input class="form-control info_form" list="buscar_item" name="item_select" id="buscar_items" type="text" placeholder="Codigo o Nombre">
          </div>
          <button class="btn btn-success mt-2" id="search">Consultar</button>
        </div>
      </div>
      <div class="row">
        <div class="col-auto">
          <div class="">
            <label for="exampleInputPassword1" class="form-label">ID</label>
            <input type="text" class="form-control info_form" readonly id="id_items" />
          </div>
        </div>
        <div class="col-auto">
          <div class="">
            <label for="exampleInputPassword1" class="form-label">Nombre</label>
            <input type="text" class="form-control info_form" readonly id="contratipo" />
          </div>
        </div>
      </div>
  
      <div class="row">
        <div class="col-auto">
        <label for="exampleInputPassword1" class="form-label">Stock</label>
        <input type="text" class="form-control info_form" readonly id="stock_actual" />
        </div>
        <div class="col-auto">
        <label for="exampleInputPassword1" class="form-label">Unidad de Empaque</label>
        <input type="text" class="form-control info_form" readonly id="unidad_empaque" />
        </div>
      </div>

      <table class="table table-responsive table-striped">
          <thead>
              <tr>
                  <th>ID Proveedor</th>
                  <th>Compañia</th>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Seleccionar</th>
              </tr>
          </thead>
          <tbody id="info" class="info_form">

          </tbody>
      </table>

      <?php include '../includes/options_proveedores.php'; ?>
  </div>
</body>

</html>