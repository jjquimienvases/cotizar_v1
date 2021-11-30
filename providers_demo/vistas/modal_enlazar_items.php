

<!-- Modal -->
<div class="modal fade" id="staticBackdrops_items" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">ASOCIAR ITEM - PROVEEDOR</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="form-group">
            <label for="">Buscar un producto:</label>
          <div class="buscar_items_enlace">
            <datalist id="buscar_item_enlace">
              <option value="">Seleccione un producto</option>
              <?php
              $query = $con->query("SELECT * FROM producto_av ORDER BY contratipo ASC");
              while ($valores = mysqli_fetch_array($query)) {
                echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
              }
              ?>
            </datalist>
            <input class="form-control rounded-pill " list="buscar_item_enlace" name="item_select_enlace" id="buscar_items_enlace" type="text" placeholder="Codigo o Nombre">
          </div>
        </div>
        <div class="form-group">
            <label for="">Buscar un proveedor:</label>
            <datalist id="buscar_proveedor_enlace">
              <option value="">Seleccione un proveedor</option>
              <?php
              $query = $con->query("SELECT * FROM proveedor ORDER BY empresa ASC");
              while ($valores = mysqli_fetch_array($query)) {
                echo '<option value="' . $valores["codigo"] . '">' . $valores["codigo"] . ',' . $valores["empresa"] . '</option>';
              }
              ?>
            </datalist>
            <input class="form-control rounded-pill prodiver_info" list="buscar_proveedor_enlace" name="item_select_enlace" id="buscar_proveedor_enlace" type="text" placeholder="Buscar Proveedor">
        </div>
        <hr>
        <input type="text" name="price_enlace" class="form-control rounded-pill" placeholder="Escribir precio de compra sin IVA" id="price_enlace">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success rounded-pill" onclick="enlazarItemOrders()">Enlazar</button>
      </div>
    </div>
  </div>
</div>