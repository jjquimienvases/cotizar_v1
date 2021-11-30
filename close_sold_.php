<?php
include 'conectar.php';
$con = conectar();

// $sql_get_data = ("SELECT * FROM order_carrito WHERE estado = 'cotizacion'");
// $sql_get_data = ("SELECT * FROM order_carrito oc INNER JOIN carrito_ ct ON oc.order_id = ct.order_id WHERE oc.estado = 'cotizacion'");
$sql_get_data = ("SELECT * FROM order_carrito oc INNER JOIN factura_orden fo ON oc.order_id = fo.order_id WHERE oc.estado = 'cotizacion'");
$execute = $con->query($sql_get_data);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="catalogo_e/fontawesome/svg-with-js/js/fontawesome-all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cerrar Venta</title>

</head>

<body>
    <div class="container mt-4 text-center">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">FECHA</th>
                    <th scope="col">COTIZACION</th>
                    <th scope="col">CLIENTE</th>
                    <th scope="col">METODO DE PAGO</th>
                    <th scope="col">ACCION</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($execute as $data) : ?>
                    <form method="post" id="form_1" enctype="multipart/form-data">
                        <tr>
                            <td><?= $data['order_date'] ?></td>
                            <td> <input type="number" value="<?= $data['order_id'] ?>" readonly >  </td>
                            <td><?= $data['order_receiver_name'] ?></td>
                            <td>
                                <select name="metodo_de_pago" id="metodo_de_pago" class="form-control">
                                    <option value="payU">PayU</option>
                                    <option value="" disabled>Seleccionar Una Opcion</option>
                                    <option value="bancolombia">Bancolombia</option>
                                    <option value="davivienda">Davivienda</option>
                                </select>
                            </td>
                            <td> <button type="button" onclick="close_invoice(<?= $data['order_id'] ?>)" name="upload" class="btn btn-primary">Finalizar <i class="far fa-paper-plane"></i></button></td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script>
//aqui vamos a ahcer el ajax que envia los datos
function close_invoice(data) {
  var datos = $("#form_1").serialize();
 
  var metodo = document.getElementById("metodo_de_pago").value;
//   console.log(datos,data);
//   console.log(metodo,data);
  Swal.fire({
    title: "Estas seguro de finalizar esta venta?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, estoy seguro`,
    denyButtonText: `No, Cancelar`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      // Swal.fire('Saved!', '', 'success')
    //   let datos = 0;
      let timerInterval;
      Swal.fire({
        title: "Aguarda un momento, estamos finalizando tu venta!",
        html: "Gracias por confiar en nosotros, Faltan <b></b> Milisegundos.",
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
          timerInterval = setInterval(() => {
            const content = Swal.getHtmlContainer();
            if (content) {
              const b = content.querySelector("b");
              if (b) {
                b.textContent = Swal.getTimerLeft();
              }
            }
          }, 100);
        },
        willClose: () => {
          clearInterval(timerInterval);
        },
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log("I was closed by the timer");
        }
      });
      $.ajax({
        type: "POST",
        url: "ajax_close_sold.php",
        data: {order_id:data,
               metodo_de_pago:datos  
        },
        success: function (r) {
          console.log(r);
          if (r != "no_data" && !isNaN(r) && r != "fallo") {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "Cotizacion Finalizada Correctamente",
              showConfirmButton: false,
              timer: 1500,
            });

            var newLocation = "close_sold_.php";
            window.location = newLocation;

            // getInformationOrder(data);
          } else if(r == "no_data") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "No tienes productos en tu carrito!",
              showConfirmButton: false,
              timer: 1500,
            });
          }else{
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Algo salio mal!",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
      });
      return false;
    } else if (result.isDenied) {
      Swal.fire("Elegiste seguir comprando", "", "info");
    }
  });
}

</script>

</html>