<div class="card border border-danger container rounded -lg overflow-auto mt-4" id="orders_in_orders_middle" style="width: 30rem;">
  <div class="card-body">
    <label for="" class="mt-2 title_input_search ">Buscar orden de compra o proveedor:</label>
    <div class="input-group container mt-3">
      <input type="text" name="input_search_orders" id="input_search_orders" placeholder="Buscar Orden" onkeyup="getOrderList_filter()" class="form-control rounded-pill">
      <button class="btn btn-success rounded-circle ml-4" id="order_open_create" data-bs-toggle="modal" data-bs-target="#ModalProduct" onclick="items_table()"><i class="fas fa-plus-circle"></i></button>
    </div>
    <hr>
    <div class="container" id="info_orders"></div>
  </div>
</div>