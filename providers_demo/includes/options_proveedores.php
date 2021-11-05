<form id="form_2">
    <div class="container mt-3" id="contenedor_info_form">
        <div class="form-group">
            <label for="">Proveedor Seleccionado:</label>
            <input type="text" readonly class="form-control" id="proveedor_name" name="proveedor">
            <label for="">Costo sin iva:</label>
            <input type="number" readonly class="form-control" id="proveedor_costo" name="costo">
            <input type="hidden" readonly class="form-control" id="proveedor_id" name="id_proveedor">
            <input type="hidden" readonly class="form-control" id="item_id" name="item_id">
            <label for="">Producto:</label>
            <input type="text" readonly class="form-control" id="producto_name" name="producto_name">
            <label for="">Cantida en cajas:</label>
            <input type="text" class="form-control" id="cajas">
            <label for="">Cantidad en numeros enteros:</label>
            <input type="number" class="form-control" onkeyup="calcularTotal()" id="cantidad" name="cantidad">
            <label for="">Total:</label>
            <input type="number" readonly class="form-control" id="resultado" name="resultado">
        </div>
        <br>
        <button class="btn btn-success" type="button" name="enviar_info" id="send_info">Agregar Producto</button>
    </div>
</form>
