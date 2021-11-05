<?php 
 
include 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Actualizar Fotografia</title>
</head>

<body>

    <div class="container mt-4">
    <center><h3>Actualizar la imagen de este item</h3></center>    
    <form method="post" id="formUploadImg" enctype="multipart/form-data">
        <div class="buscarcliente">
            <datalist id="buscarclient">

                <option value="">Seleccione un item</option>
                <?php
                $sql = $conexion->query("SELECT * FROM producto_av ORDER BY id_categoria ASC");
                while ($data = mysqli_fetch_array($sql)) {
                    echo '<option value="' . $data["id"] . '">' . $data["id"] . ',' . $data["contratipo"] . '</option>';
                }
                ?>
            </datalist>
            <div class="input-field col s6">
                <input value="" id="buscarcliente" list="buscarclient" type="text" name="id_item" class="validate" placeholder="Buscar Productos">
                <label class="active" for="buscarcliente">Buscar un item</label>
            </div>
        </div>
        <hr>
        <label>Agregar Una fotografia</label>
<input type="file" value="" id="imagen" name="imagen" class="form-control"> 
     <br>  
<button class="btn btn-primary" type="button" id="actualizar_img"> Subir Fotografia</button>
       </form>
    </div>
</body>
<script>
    
      $("#actualizar_img").click(function () {

  Swal.fire({
    icon: "info",
    title: "Estas seguro de subir esta imagen?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Estoy seguro`,
    denyButtonText: `No, cancelar.`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var frm = document.getElementById("formUploadImg");
      var data = new FormData(frm);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          var msg = xhttp.responseText;
          if (msg != 0) {
            // alert(msg);
            // $("#exampleModalCreate").modal("hide");
            Swal.fire("La imagen de este producto se a actualizado!", "", "success");
          
            console.log(data);
          } else {
            // alert(msg);
            Swal.fire({
              title: "No funciona :( !",
              text: "Algo no se ejecuto correctamente.",
              icon:"error",
            });
          }
        }
      };
      xhttp.open("POST", "ajax/ajax_update_img.php", true);
      xhttp.send(data);
      $("#formUploadImg").trigger("reset");
    } else if (result.isDenied) {
      Swal.fire("Cancelaste la actualizacion de es este producto", "", "info");
    }
  });
});

    
</script>
</html>