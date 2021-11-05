<!-- Modal -->
<div class="modal fade" id="modal_update_info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal_update_info">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aprobar Ingreso De Mercancia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form1">
                    <div class="" id="info_users">
                        <div class="row">

                            <div class="col-auto">
                                <strong> Orden ID: </strong> <input type="text" class="form-control" name="orders" id="orders" readonly>
                            </div>
                            <div class="col-auto">
                                <strong> Fecha : </strong> <input type="text" class="form-control" name="date" id="date" readonly>
                            </div>
                            <div class="col-auto">
                                <strong> Creador : </strong> <input type="text" class="form-control" name="creator" id="creator" readonly>
                            </div>
                            <div class="col-auto">
                                <strong> Proveedor: </strong> <input type="text" class="form-control" name="provider" id="provider" readonly>
                            </div>
                            <div class="col-auto">
                                <strong> Total: </strong> <input type="text" class="form-control" name="result_" id="result_" readonly>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div id="container">
                        <table class="table table-striped table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <form class="" id="form_1" method="post">
                                <tbody id="info_items_order" class="table-bordered">

                                </tbody>
                            </form>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-auto">
                            <label for="">AGREGAR LA FACTURA</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <div class="col-auto">
                            <label for="">Escribir el numero de factura:</label>
                            <input type="number" name="factura" class="form-control" placeholder="Numero de factura">
                        </div>

                        <div class="col-auto">
                            <label for="">Seleccionar bodega de ingreso:</label>
                            <select name="bodega" id="bodega" class="form-control">
                                <option value="">Seleccionar</option>
                                <option value="producto_av">Bodega Principal</option>
                                <option value="productos_ibague">Ibague Principal</option>
                                <option value="producto">Mostrador Principal</option>
                                <option value="producto_d1">Mostrador D1</option>
                                <option value="productos_ibague2">Ibague 2</option>
                            </select>
                        </div>


                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="onSubmitForm()">Subir Informacion</button>
            </div>
        </div>
    </div>
</div>