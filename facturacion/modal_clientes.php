<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informacion Del Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form1">


                <div class="buscaritems">
                    <label for="" class="text-success">Consultar Un Cliente:</label>
                    <datalist id="buscaritem">
                      <option value="c" selected>Selecciona un cliente</option>
                      <?php
                        $query = $con->query("SELECT * FROM clientes ORDER BY cedula ASC");
                     
                      while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores["cedula"] . '">' . $valores["cedula"] . ',' . $valores["nombres"] . '</option>';
                      }
                      ?>
                    </datalist>
                    <input list="buscaritem" type="text" name="cedulasres" id="buscaritems" class="form-control" placeholder="Buscar Item" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Puedes buscar el cliente apartir de su cedula o nombre :D</small>


                  </div>

                    <div class="row">
                        <div class="col">
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres">
                        </div>
                        <br>
                        <div class="col">
                            <input type="text" name="cedulas" class="form-control" placeholder="Cedula">
                            <input type="hidden" name="id" class="form-control" >
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="telefono" class="form-control" placeholder="Telefono">
                        </div>
                        <br>
                        <div class="col">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="ciudad" class="form-control" placeholder="Ciudad">
                        </div>
                        <br>
                        <div class="col">
                            <input type="text" name="direccion" class="form-control" placeholder="Direccion">
                        </div>
               
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" name="porcentaje" class="form-control" placeholder="Porcentaje">
                        </div>
                        <br>
                        <div class="col">
                            <input type="text" name="saldo" class="form-control" placeholder="Saldo" Readonly>
                        </div>
               
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="edit_client">Editar Cliente</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>