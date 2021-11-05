<?php
include 'conexion.php';
include 'backend/funciones_php/funciones.php';
// include '../menus/index.php';
include 'vistas/cot_finalizadas.php';


$conexion = conectar();

?>

<!DOCTYPE html>
<html>

<head>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="frontend/estilos.css">
  <title>Reportes JJQuimienvases</title>
  <script src="../jquery-3.1.1.min.js"></script>

  <style>
    #input_call {
      background-color: white;

    }

    .contenedor_info_resumida {
      width: 1000px;
      margin-left: 10px;
      margin-top: 10px;

    }
  </style>


</head>

<body>



  <div id="contenedor">
    <?php
    /* menus($my_menu); */
    // $total_call = datos_generales($consultando_call);
    // $total_mostrador_jj = datos_generales_mostradorjj($consultando_mostrador);
    // $total_mostrador_d1 = datos_generales_mostradord1($consultando_mostrador_d1);
    // $total_mostrador_ib1 = datos_generales_ibague_1($consultando_ibague_1);
    // $total_mostrador_ib2 = datos_generales_ibague_2($consultando_ibague_2);
    ?>
    <button class="btn btn-warning" id="filter" onclick="abrir_filtro()">Filtrar Reportes</button>
    <button class="btn btn-danger" id="filters" onclick="cerrar_filtro()">X</button>
    <?php //include 'includes/informacion_actual.php'; 
    ?>

    <h3>Reportes JJQuimienvases</h3>
    <!-- Informacion que se imprime por defecto aqui imprimos las funciones result de mis consultas predeterminadas es decir montos y total ventas -->
    <?php include 'includes/formulario.php'; ?>
    <!-- Fin contenedor formulario-->
  </div>




  <hr>

  <h4>Resultado de la consulta: <span id="total_count"></span> <span id="total_monto"></span> </h4>
  <br>
  <ul id="lista_metodos"></ul>

  <center>
    <div id="contenedor_tabla">
      <table class="table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Cotizacion</th>
            <th>Cliente</th>
            <th>Comercial</th>
            <th>Metodo de pago</th>
            <th>Monto</th>
            <th>PDF</th>
          </tr>
        </thead>
        <tbody id="table-body">
        </tbody>
      </table>

      <hr>
      <h4>En este apartado se muestra la informacion que el usuario decida filtrar.</h4>
    </div>
  </center>


  <script>
    function ver_datos(id, e) {
      var dato = document.getElementById('cliente' + id);
      e.preventDefault();
    }

    $("#buscarcliente").on('keyup', function() {
      $.ajax({
        url: '../methods/conexiones.php',
        type: 'POST',
        dataType: 'json',
        data: {
          key: 'Q1',
          cliente: $(this).val()
        }
      }).done(function(d) {

        let padre = $("#buscarcliente").parent().parent().parent();
      }).fail(function(e) {

      });
    })


    $("#buscarcomercial").on('change', function() {
      $.ajax({
        url: '../methods/conexiones.php',
        type: 'POST',
        dataType: 'json',
        data: {
          key: 'Q1',
          cliente: $(this).val()
        }
      }).done(function(d) {

        let padre = $("#buscarcomercial").parent().parent().parent();
      }).fail(function(e) {

      });
    })

    $("#form_reporte").submit(function(e) {
      var datos = $(this).serialize();
      $.ajax({
        url: './backend/funciones_php/ajax_consultas.php',
        method: "POST",
        data: datos
      }).done(function(d) {
        $("#lista_metodos").empty()
        $("#table-body").empty();

        console.log(d);
        if (!d || !(d.length > 0)) {
          alert("No se encontarron datos");
          return;
        }

        const result = JSON.parse(d);
        /* console.log(result); */
        const data = [];
        const filas = [];
        for (r of result) {
          var cotizacion = r["order_id"];
          var comercial = r["order_receiver_address"].toUpperCase();
          var cliente = r["order_receiver_name"].toUpperCase();
          var metodo_de_pago = r["metodo_de_pago"];
          var fecha = r["order_date"];
          var monto = r["order_total_after_tax"];




          let fila = `
          <tr>
          <td>${fecha}</td>
          <td>${cotizacion}</td>
          <td>${cliente}</td>
          <td>${comercial}</td>
          <td>${metodo_de_pago}</td>
          <td>${monto}</td>
          <td>${monto}</td>
          </tr>
          `;

          data.push(r)
          filas.push(fila);

          // document.getElementById("fecha").value = fecha;
        }
        let mysuma = 0;
        $("#table-body").append(filas);
        // $("#total_count").html(filas.length);
        $("#total_count").html("El total filas que tiene esta consulta es:" + filas.length + " Filas");
        $("#total_monto").html("El Monto total que tiene esta consulta es:" + mysuma);

        const metodos = [];
        const html = data.map(f => {
          const metodo = f.metodo_de_pago.toUpperCase();
          const monto = Math.floor(parseFloat(f.order_total_after_tax));

          const found = metodos.find(val => val.metodo === metodo);
          if (!found) {
            metodos.push({
              metodo,
              total: monto
            });
          } else {
            found.total += monto
          }
        })



        const html_metodos = metodos.map(m => {
          $("#lista_metodos").append(`<li>${m.metodo}: ${m.total}</li>`);
        })
        mysuma += monto;


      }).fail(function(e) {

      })
      e.preventDefault();
    })


    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }

    function abrir_filtro() {
      $("#info_formulario").fadeIn();
      $("#filters").fadeIn();
    }

    function cerrar_filtro() {
      $("#info_formulario").fadeOut();
      $("#filters").fadeOut();
    }
  </script>




</body>

</html>