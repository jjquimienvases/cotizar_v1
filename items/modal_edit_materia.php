<div class="modal fade" id="exampleModalMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Materia Prima</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
 
         <form methods="POST" id="form_3">

                  <div class="buscarmateria">
                    
                    <label for="" class="text-success">Consultar Una Materia Prima:</label>
                    <datalist id="buscar_materias">
                      <option value="">Selecciona un producto</option>
                      <?php
                   
                        $query = $conexion->query("SELECT * FROM materia_prima ORDER BY id ASC");
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["nombre"] . '</option>';
                      }
                      ?>
                    </datalist>
                    <input list="buscar_materias" type="text" name="materia_name" id="buscarmateria" class="form-control" placeholder="Buscar Item" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Puedes buscar el item apartir de su codigo o nombre del mismo :D</small>

                  </div>
<div id="info_data_materia">
    <div class="form-row">
                    <div class="col mb-2">
                      <small id="sku" class="text-muted">ID</small>
                      <input type="text" class="form-control" name="id" placeholder="ID" readonly aria-describedby="sku">
                    </div>
                    <div class="col mb-2">
                      <small id="item" class="text-muted">Materia Prima</small>
                      <input type="text" class="form-control" name="materia" placeholder="Materia Prima" aria-describedby="item">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col mb-2">
                      <small id="stocks" class="text-muted">Presentacion</small>
                      <input type='text' class='form-control' name='presentacion' id="presentacion" placeholder='Presentacion' aria-describedby="stocks">
                      <input type="hidden" class="form-control" name="rol" id="rol" value="<?= $id_rol ?>">
                      <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= $user_id ?>">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col mb-2">
                      <small id="ubicacions" class="text-muted">Costo</small>
                      <input type="text" class="form-control" name="costo" id="costo" placeholder="Costo" aria-describedby="ubicacions">
                    </div>
                    <div class="col mb-2">
                      <small id="unidads" class="text-muted">Estado Fisico</small>
                      <input type="text" class="form-control" name="estado"  id="estado" placeholder="Estado Fisico" aria-describedby="unidads">
                    </div>
                  </div>
</div>
                  
                  <hr>
                  
                </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="send_materia">Actualizar Datos</button>
      </div>
    </div>
  </div>
</div>