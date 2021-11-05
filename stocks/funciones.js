function ver_datos(id, e) {
  var dato = document.getElementById("cliente" + id);
  e.preventDefault();
}
//mostrador principal
$("#buscarcliente").on("keyup", function () {
  $.ajax({
    url: "scripts/consulta_mp.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: $(this).val(),
    },
  })
    .done(function (d) {
      let padre = $("#buscarcliente").parent().parent().parent();
      padre.find("[name^=sku_mp]").val(d.resultado.id);
      padre.find("[name^=item_mp]").val(d.resultado.contratipo);
      padre.find("[name^=stock_mp]").val(d.resultado.stock);
    })
    .fail(function (e) {});
});
//d1
$("#buscarcliente").on("keyup", function () {
  $.ajax({
    url: "scripts/consulta_d1.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: $(this).val(),
    },
  })
    .done(function (d) {
      let padre = $("#buscarcliente").parent().parent().parent();
      padre.find("[name^=sku_d1]").val(d.resultado.id);
      padre.find("[name^=item_d1]").val(d.resultado.contratipo);
      padre.find("[name^=stock_d1]").val(d.resultado.stock);
    })
    .fail(function (e) {});
});
//bodega
$("#buscarcliente").on("keyup", function () {
  $.ajax({
    url: "scripts/consulta_av.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: $(this).val(),
    },
  })
    .done(function (d) {
      let padre = $("#buscarcliente").parent().parent().parent();
      padre.find("[name^=sku_av]").val(d.resultado.id);
      padre.find("[name^=item_av]").val(d.resultado.contratipo);
      padre.find("[name^=stock_av]").val(d.resultado.stock);
    })
    .fail(function (e) {});
});
//ibague1
$("#buscarcliente").on("keyup", function () {
  $.ajax({
    url: "scripts/consulta_ib1.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: $(this).val(),
    },
  })
    .done(function (d) {
      let padre = $("#buscarcliente").parent().parent().parent();
      padre.find("[name^=sku_ib1]").val(d.resultado.id);
      padre.find("[name^=item_ib1]").val(d.resultado.contratipo);
      padre.find("[name^=stock_ib1]").val(d.resultado.stock);
    })
    
    .fail(function (e) {});
});
//ibague2
$("#buscarcliente").on("keyup", function () {
  $.ajax({
    url: "scripts/consulta_ib2.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: $(this).val(),
    },
  })
    .done(function (d) {
      let padre = $("#buscarcliente").parent().parent().parent();
      padre.find("[name^=sku_ib2]").val(d.resultado.id);
      padre.find("[name^=item_ib2]").val(d.resultado.contratipo);
      padre.find("[name^=stock_ib2]").val(d.resultado.stock);
    })
        .fail(function (e) {});
});
    

//El buscador
$("#buscaritems").on("keyup", function () {
  $.ajax({
    url: "scripts/consulta_mp.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      cliente: $(this).val(),
    },
  })
    .done(function (d) {
      let padre = $("#buscaritems").parent().parent().parent();
      padre.find("[name^=id]").val(d.resultado.id);
      padre.find("[name^=item]").val(d.resultado.contratipo);
      padre.find("[name^=categoria]").val(d.resultado.id_categoria);
    })
    .fail(function (e) {});
});

//enviar ajax para solicitar mercancia
$("#send_info").click(function () {
  Swal.fire({
    title: "Estas seguro de solicitar el traspaso de este producto?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si`,
    denyButtonText: `No`,
    cancelButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      var datos = $("#form_1").serialize();
      $.ajax({
        type: "POST",
        url: "ajax/send_ajax.php",
        data: datos,
        success: function (r) {
          console.log(r);
          if (r != 0 && !isNaN(r)) {
            //SI ES DISTINTO A 0 Y ES UN NUMERO

            Swal.fire("Solicitud enviada con exito!", "", "success");
            let padre = $("#form_1").parent().parent().parent();
            padre.find("[name^=cedulasres]").val("");
            padre.find("[name^=id]").val("");
            padre.find("[name^=item]").val("");
            padre.find("[name^=quantity]").val("");
            padre.find("[name^=categoria]").val("");
            console.log(datos);
          } else {
            //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Algo salio mal!",
              footer: "<a href>Contactar al desarrollador</a>",
            });
            console.log(datos);
          }
        },
      });
      return false;
    } else if (result.isDenied) {
      Swal.fire("Cancelaste la solicitud de traspaso", "", "info");
    }
  });
});
