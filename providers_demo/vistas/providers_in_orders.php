<div class="card border border-primary container rounded -lg overflow-auto mt-4" id="providers_in_orders_izquierda" style="width: 30rem;">
  <div class="card-body">
    <label for="" class="mt-2 title_input_search ">Buscar Proveedor:</label>
    <div class="input-group mt-3">

      <input type="text" name="input_search_providers_orders" id="input_search_providers_orders" onkeyup="getProviersOrders_filter()" placeholder="Buscar Proveedor" class="form-control border border-secundary">
      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_create_provider_order"><i class="fas fa-plus-circle"></i></button>

    </div>

    <hr>
    <div class="container" id="info_prodivers_orders">

    </div>
  </div>
</div>