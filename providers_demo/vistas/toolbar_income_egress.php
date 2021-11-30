<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class=" cont d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="tooltitle">
      <h1 class="h2">Ingresos y Egresos</h1>
    </div>
    <input type="date" name="inicio" class="form-control mx-2">
    <input type="date" name="final" class="form-control mx-2">
    <select class="form-select mx-2" aria-label="Default select example">
      <option selected>Tipo de pago</option>
      <option value="1">Bancolombia</option>
      <option value="2">Davivienda</option>
      <option value="3">Efectivo</option>
      <option value="4">Credito</option>
      <option value="5">Datafono</option>
      <option value="6">Contra entrega</option>
    </select>
    <label for="exampleFormControlInput1" class="form-label mx-2">Ingresos</label>
    <input id="Prueba" class="form-control marc mx-2" type="text" value="0" aria-label="Disabled input example" disabled readonly>
    <label for="exampleFormControlInput1" class="form-label mx-2">Egresos</label>
    <input id="Prueba2" class="form-control marc mx-2" type="text" value="0" aria-label="Disabled input example" disabled readonly>
    <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#ModalIncomeEgress">
      Crear
    </button>
  </div>
</body>

</html>