<?php
$mysqli = new mysqli('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');

session_start();


?>


<title>Nueva Mercancia</title>
<script src="jquery-3.1.1.min.js"></script>
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<link rel="stylesheet" type="text/css" href="css/select2.css">
<script src="./js/select2.min.js"></script>
<script src="./filas.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta charset="utf-8">
<style>
  button {
    background-color: #4CAF50;
    /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    align-content: center;
  }

  table {
    width: 80%;
  }

  .contenedor {
    display: block;
    width: 90%;
    margin-left: 50px;
    margin-right: 50px;
    /* display: inline; */
  }

  input {
    width: 100%;
  }

  @media only screen and (max-width: 760px),
  (min-device-width: 768px) and (max-device-width: 1024px) {

    /* Force table to not be like tables anymore */
    table,
    thead,
    tbody,
    th,
    td,
    tr {
      display: block;
    }

    /* Hide table headers (but not display: none;, for accessibility) */
    thead tr {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }

    tr {
      border: 1px solid #ccc;
    }

    td {
      /* Behave  like a "row" */
      border: none;
      border-bottom: 1px solid #eee;
      position: relative;
      padding-left: 50%;
    }

    td:before {
      /* Now like a table header */
      position: absolute;
      /* Top/left values mimic padding */
      top: 6px;
      left: 6px;
      width: 45%;
      padding-right: 10px;
      white-space: nowrap;
    }
  }

  #boton_add {
    width: 150px;

  }

  #removeRows {
    width: 150px;
    float: left;
  }
</style>

<body>
  <div class="contenedor">
    <h3>AGREGAR MERCANCIA BODEGA Principal</h3>
    <div class="datos">
      <form method="post" id="informacion">
        <div class="row">

          <div class="col-md-3">
            <br>
            <!--    <div class="form-group">
              <a id="Nuevo" class="btn btn-info form-control">Nuevo</a>
            </div> -->
          </div>
        </div>
        <table class="table table-bordered table-hover" id='NewItem'>
          <tr>
            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
            <th width="5%">Buscar aqui</th>
            <th>Proveedor</th>
            <th>Factura</th>
            <th>Bodega</th>
            <th>Codigo</th>
            <th>Producto</th>
            <th>U x Empaque</th>
            <th>Precio</th>
            <th>Cantidad actual</th>
            <th>Nueva Cantidad</th>
          </tr>
          <tbody id="new">
            <tr>
              <td><input class="itemRow" type="checkbox"></td>
              <td>
                <div style="text-align: center;">
                  <select id="mibuscador" style="width: 100%">
                    <option value="0">Seleccione:</option>
                    <?php
                    $query = $mysqli->query("SELECT * FROM producto");
                    while ($valores = mysqli_fetch_array($query)) {
                      echo '<option value="' . $valores['id'] . '">' . $valores['contratipo'] . ',' . $valores['id'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </td>
              <!-- Proveedor-->
              <td><input type="text" name="proveedor[]" value="" class="form-control"></td>

              <!-- Factura  -->
              <td><input type="text" name="factura[]" value="" class="form-control"></td>

              <!-- Bodega -->
              <td>
                <div style="text-align: center;">
                  <select id="bodega" name="bodega[]" style="width: 100%" class="form-control">
                    <option value="producto_av">Bodega Principal:</option>
                    <option value="producto">Punto Principal:</option>
                    <option value="producto_d1">Mostrador D1:</option>
                    <option value="productos_ibague">Ibague:</option>
                  </select>
                </div>
              </td>
              <!------>
              <td><input type="number" name="codigo[]" value="" class="form-control"></td>
              <td><input type="text" name="name[]" value="" class="form-control"></td>
              <td><input type="text" name="empaque[]" value="" class="form-control"></td>
              <td><input type="number" name="precio[]" value="" class="form-control"></td>
              <td><input type="number" name="stock[]" value="" class="form-control"></td>
              <td><input type="number" name="cantidad[]" value="" class="form-control"></td>
            </tr>
          </tbody>
          <hr>
        </table>
        <hr>
        <div class="form-group" id="boton_add">
          <a id="Nuevo" class="btn btn-info form-control">Nuevo</a>
        </div>
        <div>
          <a id="removeRows" class="btn btn-danger form-control">Eliminar</a>
        </div>
        <br>
        <center>
          <div class="boton" id="boton">
            <button name="button" id="enviar">Ingresar este producto</button>
          </div>
          <div id="wait" type="hidden">
            <p>Espera un momento mientras se envia la informacion al servidor</p>
          </div>
        </center>
      </form>
    </div>
    <hr>
    <!-- <center>  <a href="../../select_bod.php"> <button type="button" class="btn btn-primary">Elegir otra bodega</button> </a> </center> -->
  </div>
  <script>
    function ver_datos(id, e) {
      var dato = document.getElementById('producto' + id);
      e.preventDefault();
    }
    var count = 0;

    $("#mibuscador").on('change', function() {
      $.ajax({
        url: 'metodos/conexiones.php',
        type: 'POST',
        dataType: 'json',
        data: {
          key: 'Q1',
          producto: $(this).val()
        }
      }).done(function(d) {
        let padre = $("#mibuscador").parent().parent().parent();
        padre.find("[name^=codigo]").val(d.resultado.id)
        padre.find("[name^=name]").val(d.resultado.contratipo)
        padre.find("[name^=precio]").val(d.resultado.gramo)
        padre.find("[name^=stock]").val(d.resultado.stock)
        padre.find("[name^=empaque]").val(d.resultado.unidad)
      }).fail(function(e) {
        console.log("ERROR:", e);
      });
    })

    function run_calcular(e, id) {
      calculateTotal(id);
    }
    $(document).ready(function() {
      $('#mibuscador').select2();
    });

    //ajax de envio

    var mostrar = function() {
      //document.getElementById('enviar').style.display = 'block';
      $('#boton').show(3000);
      $('#boton').show("fast");
    };

    $(document).ready(function() {

      $("#enviar").click(function(e) {
        //e.preventDefault();
        $('#boton').hide(3000);
        $('#boton').hide("fast");


        setTimeout(mostrar, 5000);

      });

      $('#informacion').submit(function(e) {
        e.preventDefault()
        Swal.fire({
          title: 'Estas Seguro De Subir Este Ingreso?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Si, Estoy seguro!',
          denyButtonText: `No estoy seguro`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            var datos = $(this).serialize();
            $.ajax({
              type: "POST",
              // url: "https://envasesyperfumeria.com/backend_aux/stock/update-stock",
              url: "./ajax_nueva_mercancia.php",
              data: datos,
              success: function(r) {
                console.log(r);
                Swal.fire('Los cambios se han cargado con exito!', '', 'success');

                setTimeout(function() {
                  window.location.reload();
                }, 2000);
              }
            });

          } else if (result.isDenied) {
            Swal.fire('Cancelaste el ingreso!', '', 'info')
          }
        })


      });
    });
  </script>
</body>

</html>