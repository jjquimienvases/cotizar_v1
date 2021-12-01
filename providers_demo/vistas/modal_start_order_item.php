<div class="modal fade" id="staticBackdrop_generate_order_by_item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar o Crear nueva orden</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-auto">
                            <label for="">ID ITEM SELECCIONADO:</label>
                            <input type="number" name="item_ids" id="item_id_orders_select" class="form-control rounded-pill" readonly>
                        </div>
                        <div class="col-auto">
                            <label for="">ITEM SELECCIONADO:</label>
                            <input type="text" name="item_names" id="item_name_orders_select" class="form-control rounded-pill" readonly>
                        </div>
                       
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-auto">
                            <label for="">PROVEEDOR:</label>
                            <input type="text" name="provider" id="provider_orders_select" class="form-control rounded-pill" readonly>
                        </div>
                        <input type="hidden" name="id_proveedor" id="id_proveedor">
                        <div class="col-auto">
                            <label for="">COSTO:</label>
                            <input type="number" name="price_item_selected" id="price_item_selected" class="form-control rounded-pill" readonly>
                        </div>
                    </div>
                    
                
                    <hr>
                    <div class="row">
                        <div class="col-auto">
                            <label for="">CANTIDAD:</label>
                            <input type="number" name="quantity_item_selected" onkeyup="calculate_in_modal()" id="quantity_item_selected" class="form-control rounded-pill">
                        </div>
                        <div class="col-auto">
                            <label for="">TOTAL:</label>
                            <input type="text" name="result_item_selected" id="result_item_selected" class="form-control rounded-pill" readonly>
                        </div>
                    </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close_modal_items" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="solicitar_item_order">Solicitar</button>
            </div>
        </div>
    </div>
</div>