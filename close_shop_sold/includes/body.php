<div class="container">
<nav class="navbar navbar-light bg-light mt-2">
  <div class="container-fluid">
    <a class="navbar-brand">JJ QUIMIENVASES SAS</a>
    <button class="btn btn-success rounded-pill tittle_redirect"><a href="">Regresar Al Menu Principal</a></button>
    <div class="d-flex">
      <input class="form-control me-2 rounded-pill" id="info_user" type="search" placeholder="Buscar Remision" aria-label="Search" onkeyup="orders_table_search()">
      <button class="btn btn-outline-success rounded-pill" type="button">Buscar</button>
</div>
  </div>
</nav>
<hr>
<div class="container">
  <button class="btn btn-success rounded-pill" onclick="orders_table()" id="button_charge" > prueba <i class="bi bi-arrow-down-circle"></i></button>
  
  <span class="text-center text-danger">En este apartado puedes visualizar todas las compras hechas desde el catalogo electronico, dar click en finalizar para declarar la salida de mercancia y el ingreso monetario.</span>
  <hr>
  <button onclick="orders_table()" class="btn btn-primary rounded-pill">Refrescar informacion</button>
  <hr class="text-danger">
  <div id="info_orders"></div>
</div>
</div>

<?php include 'canvas.php'; ?>