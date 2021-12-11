
<button type="hidden" onclick="getOrderList()" style="display: none;" id="list"></button>
<div id="contenedor_form" class="text-center">
    <div class="text-center text-success"><h5>COMPLETAR LOS DATOS DEL COLABORADOR:</h5></div>
    <form action="" id = "form_2">
      <label>Numero de documento:</label>
      <input type="number" name="cedula" class="form-control">
      <label for="">Nombres Completos:</label>
      <input type="text" name="nombres" class="form-control">
      <label for="">Numero Telefonico:</label>
      <input type="number" name="telefono" class="form-control">
      <label for="">Direccion de residencia:</label>
      <input type="text" name="direccion" class="form-control">
      <label for="">Correo Electronico:</label>
      <input type="email" name="email" class="form-control">
      <label for="">Cargo a desempeñar:</label>
      <select name="cargo" id="cargo" class="form-control">
          <option value="Asistente Administrativo">Asistente Administrativo</option>
          <option value="Jefe punto de venta">Jefe punto de venta</option>
          <option value="Ventas mostrador">Ventas mostrador</option>
          <option value="Conductor y auxiliar de bodega">Conductor y auxiliar de bodega</option>
          <option value="Auxiliar De Bodega">Auxiliar De Bodega</option>
          <option value="Cajera">Cajera</option>
          <option value="desarrolador y progarmador">Desarrollador</option>
          <option value="Jefe de bodega">Jefe de bodega</option>
          <option value="Asesor call center">Call Center</option>
      </select>
      <label for="">Ciudad a labor</label>
      <select name="ciudad" id="" class="form-control">
          <option value="Bogota">Bogota</option>
          <option value="Ibague">Ibague</option>
      </select>
      <label for="">Seleccionar fecha de inicio de contrato:</label>
      <input type="date" name="date_inicio" class="form-control">
      <label for="">Seleccionar fecha de finalizacion de contrato:</label>
      <input type="date" name="date_final" class="form-control">
      <label>Escribir AFP:</label>
      <input type="text" class="form-control" name="afp">
      <label for="">Escribir EPS:</label>
      <input type="text" class="form-control" name="eps">
      <center><h6>Completar datos para prestacion de servicios</h6></center>
      <label>Seleccionar inicio de prestacion:</label>
       <input type="date" name="prestacion_inicio" class="form-control"> 
      <label>Seleccionar Finalizacion de prestacion:</label>
      <input type="date" name="prestacion_final" class="form-control"> 
      <div class="mt-2">
          <button class="btn btn-primary" type="button" id="send_info">Crear Usuario</button>
      </div>
    </form>
</div>