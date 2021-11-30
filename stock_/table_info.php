<?php

  include 'conexion.php';
  $sql = $conexion->query("SELECT * FROM stocks_uploads WHERE estado = 'pendiente'")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aprobar Subida de mercancia</title>
    <script src="../jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
</head>
<body>
<div class="container mt-3">

<table class="table">
<thead>
<tr>
    <td>#</td>
    <td>SKU</td>
    <td>ITEM</td>
    <td>STOCK</td>
    <td>USUARIO</td>
    <td>ROL</td>
    <td>FECHA</td>
</tr>
</thead>
<tbody>
<?php  foreach($sql as $data):
    $contador = 1;
    ?>
    <form id="form_2">
<tr>
 <td><?= $contador++ ?></td>
 <td><input type="number" name="sku" value="<?= $data['sku'] ?>" class="form-control" readonly>  </td>
 <td><input type="text" name="contratipo" value="<?= $data['contratipo'] ?>" class="form-control" readonly> </td>
 <td><input type="number" name="nuevo_stock" value="<?= $data['nuevo_stock'] ?>" class="form-control" readonly></td>
 <td><input type="text" name="usuario" value="<?= $data['usuario'] ?>" class="form-control" readonly></td>
 <td><input type="number" name="rol" value="<?= $data['id_rol'] ?>" class="form-control" readonly></td>
 <td><input type="text" name="fecha" value="<?= $data['fecha'] ?>" class="form-control" readonly></td>


</tr>
</form>
<?php endforeach; ?>

</tbody>
</table>
<button type="button" class="btn btn-success" onclick="send_data()">Generar Ingreso</button>

</div>
<script>
//ajax subir informacion
function send_data(){
    var datos = $("#form_2").serialize();
    console.log(datos);
    Swal.fire({
  title: '¿generar este ingreso?',
  text: 'Estas seguro de generar este ingreso?',
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: `Si, Generar`,
  denyButtonText: `No, cancelar`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Saved!', '', 'success')
    let timerInterval;
    Swal.fire({
      title: "Cargando informacion!",
      html: "Gracias por confiar en nosotros, Faltan <b></b> Milisegundos.",
      timer: 2000,
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
      url: "ajax/ajax_update_info.php",
      data: datos,
      success: function (r) {
        // console.log(r);
        if (r != 0 && !isNaN(r)) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Items Agregados Con Exito",
            showConfirmButton: false,
            timer: 1500,
          });
          //limpiando los inputs 
          let padre = $("#items_modal").parent().parent().parent();
          padre.find("[name^=id]").val("");
          padre.find("[name^=contratipo]").val("");
          padre.find("[name^=stock]").val("");
          padre.find("[name^=cantidad_vendida]").val("");
          padre.find("[name^=cantidad_salida_t]").val("");
          padre.find("[name^=cantidad_entrada_t]").val("");
  
        } else {
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
    Swal.fire('Cancelaste la actualizacion', '', 'info')
  }
})
    
};
</script>
</body>
</html>