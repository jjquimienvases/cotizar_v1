<?php

include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/header.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
</head>

<body>


 <div class="container">
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
            <input class="form-control" list="buscar_item" name="item_select" id="buscar_items" type="text" placeholder="Codigo o Nombre">
        </div>
        <button class="btn btn-success mt-2" id="search">Consultar</button>
    </div>
    <hr>
    
    <div id="info_item mt-3">
        <div class="text-center"><h5>Informacion Producto</h5></div>
        <label for="">Stock Actual</label>
        <input type="number" readonly class="form-control mt-2" id="stock_actual">
        <label for="">Unidad De Empaque:</label>
        <input type="text" readonly class="form-control mt-2" id="unidad_empaque">
    </div>
    <hr>
    <div id="info_proveedores" class="mt-3">
    <div class="text-center"><h5>Informacion Proveedores</h5></div>
     
      <table class="table">
          <thead>
              <tr>
                  <th>ID Proveedor</th>
                  <th>Compañia</th>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Seleccionar</th>
              </tr>
          </thead>
          <tbody id="info">

          </tbody>
      </table>
      
    </div>
    <?php include 'includes/options_proveedores.php'; ?>

    </div> <!-- FIn del contenedor -->
</body>
<?php include 'includes/footer.php'; ?>

</html>