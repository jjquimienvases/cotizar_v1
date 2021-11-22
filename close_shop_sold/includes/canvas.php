<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Finalizar Venta</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Informacion</p>
    <hr>
    <label for="">Fecha</label>
    <input type="text" readonly id="date_select" class="form-control rounded-pill">
  <label for="">Cotizacion</label>
   <input type="number" class="form-control rounded-pill" readonly id="order_select">
   <label for="">Cliente</label>
   <input type="text" readonly id="cliente_select" class="form-control rounded-pill">
   <label for="">Monto</label>
   <input type="text" class="form-control rounded-pill" readonly id="monto_select">
<label for="">Seleccionar Metodo de pago:</label>
   <select name="metodo_pago" id="metodo_pago" class="form-control rounded-pill">
       <option value="efectivo">Efectivo</option>
       <option value="bancolombia">Bancolombia</option>
       <option value="davivienda">Davivienda</option>
       <option value="datafono">Datafono</option>
       <option value="payu">PayU</option>
   </select>
<hr>
<button class="btn btn-success rounded-pill" onclick="update_information()">Finalizar Venta</button>
  </div>
</div>