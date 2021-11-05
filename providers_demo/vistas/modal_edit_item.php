<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="form_">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-auto">
                            <label for="">Order ID</label>
                            <input type="number" id="item_order_id" name="item_order_id" readonly class="form-control">
                        </div>
                        <div class="col">
                            <label for="">ITEM ID</label>
                            <input type="number" id ="code_item" name="code_item" readonly class="form-control">
                        </div>
                    </div>
                    
                    <hr>
                    <div class="text-center">
                        <h3>Editar Precio y/o Cantidad</h3>
                    </div>
                    <label for="">Cantidad:</label>
                    <input type="number" id="order_item_quantity" name ="order_item_quantity" class="form-control mt-2">
                    <label for="">Precio Unitario:</label>
                    <input type="number" name="item_unitary_price" id="item_unitary_price" class="form-control mt-2">
                    
                </form>
     

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="hide_modal_edit_item">Cancelar</button>
                <button type="button" class="btn btn-primary" id="edit_items" onclick="edit_item_order_data()">Editar</button>
            </div>
        </div>
    </div>
</div>