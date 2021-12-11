<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="contentForm" id="app">
        <form class="m-3">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Ingreso o Egreso</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione el tipo</option>
                    <option value="1">Ingreso</option>
                    <option value="2">Egreso</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Fecha</label>
                <input type="text" class="form-control" id="exampleInputPassword1" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Concepto</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Monto</label>
                <input type="text" class="form-control" id="exampleInputPassword1" />
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Seleccione el comprobante</label>
                <input class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Pago</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione el tipo de pago</option>
                    <option value="1">Bancolombia</option>
                    <option value="2">Davivienda</option>
                    <option value="3">Efectivo</option>
                    <option value="4">Credito</option>
                    <option value="5">Datafono</option>
                    <option value="6">Contra entrega</option>
                </select>
            </div>
        </form>
    </div>
</body>

</html>