


  <div id="my-modal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Escoger Una Fragancia</h2>
      </div>
      <div class="modal-body">

  <div class="modal_mensaje">
      <div style="text-align: center;">
     <select id="mibuscadores" style="width: 100%" class="buscador">
       <option value="0">Buscar esencia:</option>
          <?php
            $query = $mysqli2 -> query ("SELECT * FROM producto WHERE id_categoria = 4");
            while ($valores = mysqli_fetch_array($query)) {
              echo '<option value="'.$valores[id].'">'.$valores[contratipo].','.$valores[id].'</option>';
            }
          ?>
     </select>
  </div>
    <hr>
      <center>	<span>Escoger que producto vas a vender:</span>
        <br>
  <select onchange="yesnoCheck(this);" class="opcionesPerfumeria" name="opcionesPerfumeria" id="opcionesPerfumeria" onchange="calcularTotales();" >
  <option value="">Selecciona una opcion</option>
  <option value="splash">Splash</option>
  <option value="crema">Crema</option>
  <option value="onzas">Onzas</option>
  <option value="after">After Shave</option>
  <option value="pp">Perfume Preparado</option>
  </select>
  <hr>
  <label for="distribuidor">DISTRIBUIDOR</label>
  <input class="distribuidor" type="checkbox" id ="distribuidor" name="distribuidor">

     <!-- opciones de splash -->
  <center>   <div id="ifYes" style="display: none;">
       <label for="car">Elegir Una Presentacion: </label>
       <select onchange="opcion(this);" id="splash" name="splash">
         <option value="">opcion</option>
         <option value="120">120 ML</option>
         <option value="250">250 ML</option>
       </select>
       <button type="" name="close1" id="close1">X</button>
     </div> </center>
     <!-- opciones de crema     -->
  <center>
  <div id="cremas" style="display: none;">
  <label for="car">Elegir Una Presentacion: </label>
  <select onchange="crema_opciones(this);" id="crema" name="crema">
  <option value="">Escoger una opcion</option>
  <option value="30">30 ML</option>
  <option value="60">60 ML</option>
  <option value="120">120 ML</option>
  <option value="250">250 ML</option>
  </select>
  <button type="" name="close2" id="close2">X</button>
  </div>
</center>
  <!-- opcion de impresion del aftershave -->

  <div class="" id="aftershave" style="display: none;">
  <button type="" name="close3" id="close3">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="aftergramos" id="aftergramos" value="18" placeholder="cantidad" readonly></td>
   <td><input type="number" name="precioAfter" id="precioAfter" value="20000" readonly> </td>
  <td><input type="number" name="cantidadAfter" id="cantidadAfter" onkeyup="return calcularTotalAfter()"></td>
  <td><input type="number" name="AdicionalAfter" id="AdicionalAfter" onkeyup="return calcularTotalAfter()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorAfterEnvase" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  </table>
  </div>
  <!-- opcion de impresion de las onzas -->
  <div class="" id="onzasPerfumeria" style="display: none;">
  <button type="" name="close4" id="close4">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="onzasgramos" id="onzasgramos" value="17" placeholder="cantidad" readonly></td>
  <td><input type="number" name="onzasPrecio" id="onzasPrecio" value="8500" readonly> </td>
  <td><input type="number" name="cantidadOnzas" id="cantidadOnzas" onkeyup="return calcularTotalOnzas()"></td>
  <td><input type="number" name="AdicionalOnzas" id="AdicionalOnzas" onkeyup="return calcularTotalOnzas()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorOnzasps" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  </table>
  </div>
  <!-- cantidad de splash 250 -->
  <div class="form-group" id="splash1" style="display: none;">
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>

  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input type="number" name="gramos" id="gramos" value="12" placeholder="cantidad" readonly></td>
  <td><input type="number" name="precio" id="precio" value="20000" readonly> </td>
  <td><input type="number" name="cantidad" id="cantidad" onkeyup="return calcularTotales()"></td>
  <td><input type="number" name="AdicionalSplash250" id="AdicionalSplash250" onkeyup="return calcularTotales()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorsplash250" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  <tfoot>
  <button type="" name="closesplash1" id="closesplash1">X</button>

  </tfoot>
  </table>

  </div>
  <!-- cantidad splash  120 -->


  <div class="" id="splash2" style="display: none;">
  <button type="" name="closesplash2" id="closesplash2">X</button>
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input type="number" name="gramos2" id="gramos2" value="7" placeholder="cantidad" readonly></td>
  <td><input type="number" name="precio2" id="precio2" value="15000" readonly> </td>
  <td><input type="number" name="cantidad2" id="cantidad2" onkeypress="return calcularTotalSplah2()"></td>
  <td><input type="number" name="AdicionalSplash120" id="AdicionalSplash120" onkeyup="return calcularTotalSplah2()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorsplash120" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  </table>
  </div>
  <!-- opciones de perfumes preparados OPCIONES -->
  <div id="ifYes3" style="display: none;">
  <button type="" name="closespr" id="closespr">X</button>

  <label for="car">Elegir Una Presentacion: </label>
  <select onchange="perfumes_preparados(this);" id="perfume_preparado1" name="perfume_perparado1">
  <option value="">opcion</option>
  <option value="1">Sencillo</option>
  <option value="2">Envase de lujo</option>
  <option value="3">Recarga</option>
  </select>
  </div>
  <!-- aqui iniciamos los perfumes preparados capacidad SENCILLOS-->
  <div class="" id="preparado" style="display: none;" >
  <label for="preparado">Elegir la capacidad: </label>
  <select onchange="perfumes_preparados_opcion(this);" id="opciones_preparado_sencillo" name="opciones_preparado_sencillo">
  <option value="">Escoger una capaciad</option>
  <option value="30">30 ML</option>
  <option value="50">50 ML</option>
  <option value="100">100 ML</option>
  </select>
  <button type="" name="close5" id="close5">X</button>

  </div>

  <div class="" id="preparado30"  style="display: none;">
  <button type="" name="closepp30" id="closepp30">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="gramos3" id="gramos3" value="11" placeholder="cantidad" readonly></td>
  <td><input type="number" name="precio3" id="precio3" value="13000" readonly> </td>
  <td><input type="number" name="cantidad3" id="cantidad3" onkeyup="return calcularTotalperfumes()"></td>
  <td><input type="number" name="gramosAdicionalesS30ml" id="gramosAdicionalesS30ml" onkeyup="return calcularTotalperfumes()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorPreparaS30ml" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  </table>
  </div>
  <div class="" id="Preparado50" style="display: none;">
  <button type="" name="closepp50" id="closepp50">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="gramos4" id="gramos4" value="18" placeholder="cantidad" readonly></td>
  <td><input type="number" name="precio4" id="precio4" value="20000" readonly> </td>
  <td><input type="number" name="cantidad4" id="cantidad4" onkeyup="return calcularTotalperfumes50ml()"></td>
  <td><input type="number" name="gramosAdicionalesS50ml" id="gramosAdicionalesS50ml" onkeyup="return calcularTotalperfumes50ml()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorPreparaS50ml" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  </table>
  </div>
  <div class="" id="preparado100" name="preparado100" style="display: none;">
  <button type="" name="closepp100" id="closepp100">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="gramos5" id="gramos5" value="36" placeholder="cantidad" readonly></td>
  <td><input type="number" name="precio5" id="precio5" value="32000" readonly> </td>
  <td><input type="number" name="cantidad5" id="cantidad5" onkeyup="return calcularTotalperfumes100ml()"></td>
  <td><input type="number" name="gramosAdicionalesS100ml" id="gramosAdicionalesS100ml" onkeyup="return calcularTotalperfumes100ml()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorPreparaS100ml" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  </table>
  </div>

  <!-- preparados de lujo -->
  <div class="" id="preparado_lujo" style="display: none;" >
  <button type="" name="closeppl" id="closeppl">X</button>

  <label for="preparado">Elegir la capacidad: </label>
  <select onchange="perfumes_preparados_opcion_lujo(this);" id="opciones_preparado_lujo" name="opciones_preparado_lujo">
  <option value="">Escoger una capaciad</option>
  <option value="30">30 ML</option>
  <option value="50">50 ML</option>
  <option value="100">100 ML</option>
  </select>
  </div>

  <div class="" id="lujo30"  style="display: none;">
  <button type="" name="closeppl30" id="closeppl30">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="gramoslujo3" id="gramoslujo3" value="11" placeholder="cantidad" readonly></td>
  <td><input type="number" name="preciolujo3" id="preciolujo3" value="15000" readonly> </td>
  <td><input type="number" name="cantidadlujo3" id="cantidadlujo3" onkeyup="return calcularTotalperfumesLujo30()"></td>
  <td><input type="number" name="gramosAdicionalesL30ml" id="gramosAdicionalesL30ml" onkeyup="return calcularTotalperfumesLujo30()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadors2" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto WHERE id_categoria = 9");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }

  ?>
  </select>
  </div></td>

  </tr>
  </tbody>
  </table>

  </div>
  <div class="" id="lujo50" style="display: none;">
  <button type="" name="closeppl50" id="closeppl50">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="gramoslujo4" id="gramoslujo4" value="18" placeholder="cantidad" readonly></td>
  <td><input type="number" name="preciolujo4" id="preciolujo4" value="25500" readonly> </td>
  <td><input type="number" name="cantidadlujo4" id="cantidadlujo4" onkeyup="return calcularTotalperfumesLujo50()"></td>
  <td><input type="number" name="gramosAdicionalesL50ml" id="gramosAdicionalesL50ml" onkeyup="return calcularTotalperfumesLujo50()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadors3" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto WHERE id_categoria = 9");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }

  ?>
  </select>
  </div></td>

  </tr>
  </tbody>
  </table>
  </div>

  <div class="" id="lujo100" name="lujo100" style="display: none;">
  <button type="" name="closeppl100" id="closeppl100">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="gramoslujo5" id="gramoslujo5" value="36" placeholder="cantidad" readonly></td>
  <td><input type="number" name="preciolujo5" id="preciolujo5" value="37500" readonly> </td>
  <td><input type="number" name="cantidadlujo5" id="cantidadlujo5" onkeyup="return calcularTotalperfumesLujo100()"></td>
  <td><input type="number" name="gramosAdicionalesL100ml" id="gramosAdicionalesL100ml" onkeyup="return calcularTotalperfumesLujo100()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadors4"  style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto ORDER BY id ASC");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>

  </tr>
  </tbody>
  </table>
  </div>

  <!-- recargas de perfumeria aqui -->
  <div class="" id="recarga" style="display: none;" >
  <button type="" name="closeppr" id="closeppr">X</button>

  <label for="recarga">Elegir la capacidad: </label>
  <select onchange="perfumes_preparados_opcion_recarga(this);" id="opciones_preparado_recarga" name="opciones_preparado_sencillo">
  <option value="">Escoger una capaciad</option>
  <option value="30">30 ML</option>
  <option value="50">50 ML</option>
  <option value="100">100 ML</option>
  </select>
  </div>
  <!-- 30ml -->
  <div class="" id="recarga30"  style="display: none;">
  <button type="" name="closeppr30" id="closeppr30">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="recarga3" id="recarga3" value="11" placeholder="cantidad" readonly></td>
  <td><input type="number" name="preciorecarga3" id="preciorecarga3" value="12000" readonly></td>
  <td><input type="number" name="cantidadrecarga3" id="cantidadrecarga3" onkeyup="return calcularTotalRecarga30()"></td>
  <td><input type="number" name="gramosAdicionalesR30ml" id="gramosAdicionalesR30ml" onkeyup="return calcularTotalRecarga30()"></td>

  </tr>
  </tbody>
  </table>
  </div>
  <!-- 50ml -->
  <div class="" id="recarga50"  style="display: none;">
  <button type="" name="closeppr50" id="closeppr50">X</button>
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="recarga4" id="recarga4" value="18" placeholder="cantidad" readonly></td>
  <td><input type="number" name="preciorecarga4" id="preciorecarga4" value="19000" readonly> </td>
  <td><input type="number" name="cantidadrecarga4" id="cantidadrecarga4" onkeyup="return calcularTotalRecarga50()"></td>
  <td><input type="number" name="gramosAdicionalesR50ml" id="gramosAdicionalesR50ml" onkeyup="return calcularTotalRecarga50()"></td>

  </tr>
  </tbody>
  </table>
  </div>
  <!-- 100ml -->
  <div class="" id="recarga100" name="recarga100"  style="display: none;">
  <button type="" name="closeppr100" id="closeppr100">X</button>
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Gramos Adicionales</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="recarga5" id="recarga5" value="36" placeholder="cantidad" readonly></td>
  <td><input type="number" name="preciorecarga5" id="preciorecarga5" value="31000" readonly> </td>
  <td><input type="number" name="cantidadrecarga5" id="cantidadrecarga5" onkeyup="return calcularTotalRecarga100()"></td>
  <td><input type="number" name="gramosAdicionalesR100ml" id="gramosAdicionalesR100ml" onkeyup="return calcularTotalRecarga100()"></td>

  </tr>
  </tbody>
  </table>
  </div>
  <!-- opciones de las cremas -->
  <div class="" id="crema30"  style="display: none;">
  <button type="" name="closecm30" id="closecm30">X</button>

  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
  <tr>
  <td><input onlyread type="number" name="crema3" id="crema3" value="2" placeholder="cantidad" readonly></td>
  <td><input type="number" name="preciocrema3" id="preciocrema3" value="5000" readonly> </td>
  <td><input type="number" name="cantidadcrema3" id="cantidadcrema3" onkeyup="return calcularTotalCrema30()"></td>
  <td><div style="text-align: center;">
  <select id="mibuscadorcrema30" style="width: 100%" class="buscador">
  <option value="0">Buscar envase:</option>
  <?php
  $query = $mysqli2 -> query ("SELECT * FROM producto");
  while ($valores = mysqli_fetch_array($query)) {
   echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
  }
  ?>
  </select>
  </div></td>
  </tr>
  </tbody>
  </table>
  </div>
  <!-- 60 ml -->
  <div class="" id="crema60"  style="display: none;">
  <button type="" name="closecm60" id="closecm60">X</button>
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
    <td>  <input onlyread type="number" name="crema4" id="crema4" value="3" placeholder="cantidad" readonly></td>
    <td>   <input type="number" name="preciocrema4" id="preciocrema4" value="7000" readonly></td>
    <td>   <input type="number" name="cantidadcrema4" id="cantidadcrema4" onkeyup="return calcularTotalCrema60()" ></td>
    <td><div style="text-align: center;">
    <select id="mibuscadorcrema60" style="width: 100%" class="buscador">
    <option value="0">Buscar envase:</option>
    <?php
    $query = $mysqli2 -> query ("SELECT * FROM producto");
    while ($valores = mysqli_fetch_array($query)) {
     echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
    }
    ?>
    </select>
    </div></td>
  </tbody>
</table>

  </div>
  <!-- 120 ml -->
  <div class="" id="crema120"  style="display: none;">
  <button type="" name="closecm120" id="closecm120">X</button>
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
    <td>   <input onlyread type="number" name="crema5" id="crema5" value="6" placeholder="cantidad" readonly></td>
    <td>   <input type="number" name="preciocrema5" id="preciocrema5" value="10000" readonly></td>
    <td>   <input type="number" name="cantidadcrema5" id="cantidadcrema5" onkeyup="return calcularTotalCrema120()" ></td>
    <td><div style="text-align: center;">
    <select id="mibuscadorcrema120" style="width: 100%" class="buscador">
    <option value="0">Buscar envase:</option>
    <?php
    $query = $mysqli2 -> query ("SELECT * FROM producto");
    while ($valores = mysqli_fetch_array($query)) {
     echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
    }
    ?>
    </select>
    </div></td>
  </tbody>
</table>
  </div>
  <!-- 250 -->
  <div class="" id="crema250"  style="display: none;">
  <button type="" name="closecm250" id="closecm250">X</button>
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Gramos</th>
  <th scope="col">Precio Unitario</th>
  <th scope="col">Cantidad</th>
  <th scope="col">Envase</th>
  </tr>
  </thead>
  <tbody>
    <td>  <input onlyread type="number" name="crema6" id="crema6" value="10" placeholder="cantidad" readonly></td>
    <td>   <input type="number" name="preciocrema3" id="preciocrema6" value="15000" readonly></td>
    <td>   <input type="number" name="cantidadcrema6" id="cantidadcrema6" onkeyup="return calcularTotalCrema250()" ></td>
    <td><div style="text-align: center;">
    <select id="mibuscadorcrema120" style="width: 100%" class="buscador">
    <option value="0">Buscar envase:</option>
    <?php
    $query = $mysqli2 -> query ("SELECT * FROM producto");
    while ($valores = mysqli_fetch_array($query)) {
     echo '<option value="'.$valores["id"].'">'.$valores["contratipo"].','.$valores["id"].'</option>';
    }
    ?>
    </select>
    </div></td>
  </tbody>
</table>
  </div>

  <!-- <button type="button" name="calcular" onclick="return calcularTotal()" >CALCULAR EL TOTAL</button> -->

  <center> <p>INFORMACION DE LA COMPRA:</p> </center>
  <!-- aqui va el formulario que se envio a la tabla -->
  <form action="" method="POST" id="information" class="invoice-form" role="form">
  <center>
  <table>
  <tr>
  <th>Stock</th>
  <th>Codigo</th>
  <th>Presentacion</th>
  <th>Envase</th>
  </tr>
  <tr>

  <td><input class="controls" type="text" name="stocks" id="stocks" value=""/></td>
  <td><input class="controls" type="text" name="codigos" id="codigo" value=""/></td>
  <td><input class="controls" type="text" name="presentacions" id="presentacion" value=""/></td>
  <td><input class="controls" type="text" name="envases" id="envase" value=""/></td>
  </tr>
  <tr>
  <th>Gramos</th>
  <th>Cantidad</th>
  <th>Precio Und</th>
  <th>Total</th>
  </tr>
  <tr>
  <td><input class="controls" type="text" name="quantitys" id="quantity" value=""/></td>
  <td><input class="controls" type="text" name="quantityPs" id="quantityP" value=""/></td>
  <td><input class="controls" type="text" name="prices" id="price" value=""/></td>
  <td><input class="controls" type="text" name="totaless" id="totales" value=""/>
  <input class="controls" type="hidden" name="stockenvases" id="stockenvases" value=""/>

  </tr>

  </table>
  <hr>
  <!-- <button onclick="Registrar();" tabindex="7">Guardar -->
  <button type="button" name="button" id="try" onclick="return obtener_datos()" class="btn btn-success">Agregar producto</button>

  </form>
  </center>
  </div>

      </div>
      <div class="modal-footer">
        <h5>Click en agregar para aè´–adir a la cotizacion</h5>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  // Get DOM Elements
const modal = document.querySelector('#my-modal');
const modalBtn = document.querySelector('#modal-btn');
const closeBtn = document.querySelector('.close');

// Events
modalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

// Open
function openModal() {
modal.style.display = 'block';
}

// Close
function closeModal() {
modal.style.display = 'none';
}

// Close If Outside Click
function outsideClick(e) {
if (e.target == modal) {
  modal.style.display = 'none';
}
}

  </script>

  <script type="text/javascript">
     // <!-- aqui voy a poner a imprimir los valores dependiendo si es distribuidor o no -->

     if($("distribuidor").prop("checked")){


      document.getElementById("");
     }

  </script>
