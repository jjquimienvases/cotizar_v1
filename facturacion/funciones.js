var cotizar = "";
var table = "";

$(document).ready(function () {
  var table = $(".table").DataTable({
    ajax: "ajax/ajax_get_facturas.php",
    buttons: true,
    buttons: ["copy", "excel", "pdf"],
    id:"informacions",
    columns: [
      {
        data: "order_date",
      },
      {
        data: "cotizacion",
      },
      {
        data: "cliente",
      },
      {
        data: "email",
      },
      {
        data: "estado",
      },
      {
        data: "cotizacion",
        width: "60px",
        render: function (data, type, row) {
          return "<button id='datas' name='order_id' @click='GenerarFactura(data)' class='btn btn-success btn-xs facturar'>Facturar</button>";
        },
      },
    ],
  });

  $("#buscaritems").on("click", function () {
    $.ajax({
      url: "consulta_cliente.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q1",
        cliente: $(this).val(),
      },
    })
      .done(function (d) {
        let padre = $("#buscaritems").parent().parent().parent();
        padre.find("[name^=cedulas]").val(d.resultado.cedula);
        padre.find("[name^=nombres]").val(d.resultado.nombres);
        padre.find("[name^=ciudad]").val(d.resultado.ciudad);
        padre.find("[name^=direccion]").val(d.resultado.direccion);
        padre.find("[name^=telefono]").val(d.resultado.telefono); 
        padre.find("[name^=id]").val(d.resultado.id); 
        padre.find("[name^=email]").val(d.resultado.email); 
        padre.find("[name^=porcentaje]").val(d.resultado.descuento); 
      })
      .fail(function (e) {});
  });

  $("#edit_client").on("click", function () {
  var datos = $('#form1').serialize();
  $.ajax({
      type: "POST",
      url: "ajax/ajax_actualizar_cliente.php",
      data: datos,
      success: function(r) {
          console.log(r);
          if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
              alert("agregado con exito");

              console.log(datos);
          } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
              alert("no funciona");
              console.log(datos);
          }
      }
  });

});

});

function show_new_methods() {
    document.getElementById('info_factura').style.display = 'flex';
    document.getElementById('close').style.display = 'block';
    document.getElementById('table_info').style.display = 'none';
    document.getElementById('show').style.display = 'none';
};

function show_new_methods_call() {
    document.getElementById('info_factura_call').style.display = 'block';
    document.getElementById('close').style.display = 'block';
    document.getElementById('table_info').style.display = 'none';
    document.getElementById('show').style.display = 'none';
    document.getElementById('shows').style.display = 'none';
};

function ocultar_new_methods() {
    document.getElementById('info_factura').style.display = 'none';
    document.getElementById('close').style.display = 'none';
    document.getElementById('table_info').style.display = 'block';
    document.getElementById('show').style.display = 'block';
    document.getElementById('shows').style.display = 'block';
    document.getElementById('info_factura_call').style.display = 'none';

};


function abrir_data() {
  // var cotizacion = $(".id_cotizacion").val();
  // var cotizacion =  document.getElementsByClassName('id_cotizacion').val();
  // var cotizacion =  document.getElementsByName("cotizacion")[0].value;
  // var cotizacion =  document.getElementsByClassName("id_cotizacion")[0].value;
  // var cotizacion =  document.getElementsByClassName("id_cotizacion")[0].event.target.value;

  // console.log(cotizacion);
  
  // $.ajax({
  //     url: 'consulta.php',
  //     type: 'POST',
  //     dataType: 'json',
  //     data: {
  //         key: 'Q1',
  //         cliente: cotizacion
  //     }
  // }).done(function(d) {
  //     let padre = $("#buscarcliente").parent().parent().parent();
  //     // padre.find("[name^=fechas]").val(d.resultado.order_date);
  //     padre.find("[name^=cotizacions]").val(d.resultado.order_id);
  //     // document.getElementById('#cotizacions').val(d.resultado.order_id);;
  //     // padre.find("[name^=cliente]").val(d.resultado.order_receiver_name);
  //     // padre.find("[name^=abono]").val(d.resultado.abono);
  //     // padre.find("[name^=cotizacion]").val(d.resultado.order_id);
  //     // padre.find("[name^=mpago]").val(d.resultado.metodo_de_pago);
  //     // padre.find("[name^=restante_modal]").val(d.resultado.restante);
  //     let imagens = d.resultado.archivo;
  //     console.log(imagens);
  //     var img = new Image();
  //     img.src = './imagenes/' + imagens;
  //     let ruta = './imagenes/' + imagens;
  //     document.getElementById('imgs').src = ruta;
  // }).fail(function(e) {

  // });

}