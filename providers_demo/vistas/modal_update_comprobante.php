<div class="modal fade " id="exampleModal_comprobante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adjuntar Comprobante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-auto">
                        <label for="">Orden De Compra:</label>
                        <input type="number" readonly class="form-control" name="order" id="order">
                    </div>
                    <div class="col-auto">
                        <label for="">Factura Relacionada:</label>
                        <input type="number" readonly class="form-control" name="factura" id="factura">
                    </div>
                    <div class="col-auto">
                        <label for="">Escoger Metodo De Pago:</label>
                        <select name="metodo_pago" id="metodo_pago" class="form-control">
                            <option value="bancolombia">Bancolombia</option>
                            <option value="davivienda">Davivienda</option>
                            <option value="efectivo">Efectivo</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="">Adjuntar Comprobante De Pago:</label>
                        <input type="file" name="file_img" id="file_img" class="form-control">
                    </div>
                </div>
                <hr>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Subir Comprobante</button>
            </div>
        </div>
    </div>
</div>