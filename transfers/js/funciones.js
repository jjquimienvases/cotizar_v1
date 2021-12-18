
let code_tot = "";
let usuario = "";
$( document ).ready(function() {
  console.log("leiner inicio");


<<<<<<< HEAD
  
  $("#buscar_item").keyup(function() {
    
    let items =  $("#buscar_item").val();
  console.log(items);

=======
function consultar_data() {
  let items = $("#buscar_item").val();
 
  axios({

  }).then
  
  axios.post('./methods/conexiones.php', {

    key: "Q1",
    item: items,
  })
    .then(function (response) {

   
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });

  return;
  console.log(items)
  $.ajax({
    url: "./methods/conexiones.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      item: items,
    },
  })
    .done(function (d) {
      console.log(d.resultado.contratipo);
      // let padre = $("#izquierda").parent().parent().parent();
      //padre.find("[name^=item_name]").val(d.resultado.contratipo);
      //padre.find("[name^=item_code]").val(d.resultado.id);
      //padre.find("[name^=gramos_actuales]").val(d.resultado.stock);
      document.getElementById("item_name").value = d.resultado.contratipo;
      document.getElementById("item_code").value = d.resultado.id;
      document.getElementById("gramos_actuales").value = d.resultado.stock;
      //$("#item_name").val(d.resultado.contratipo);
      //$("#item_code").val(d.resultado.id);
      //$("#gramos_actuales").val(d.resultado.stock);
>>>>>>> cd1461e79fa298d74ffcc80767d789eff08ab068

    axios({
       method: "POST",
       url: "./methods/conexiones.php",
       params: {
        key: "Q1",
        item: items,
      }.then(function(res)  {
        console.log(res);
    })
<<<<<<< HEAD
    .catch(err => {
        console.log(err);
    })
      
    })
  });
});




=======
    .fail(function (e) { });
>>>>>>> cd1461e79fa298d74ffcc80767d789eff08ab068







};


//ajax para mostrar informacion
function mostrarData() {
  var data = 0;
  $.ajax({
    url: "./methods/get_information.php",
    type: "POST",
    dataType: "json",
    data: {
      key: "Q1",
      item: data,
    },
  })
    .done(function (d) {
      //  datas = d.resultado;
      console.log(d);
      //  console.log(d).resultado;
      d.retornolosdatos.forEach((item) => {
        console.log(item.id);
        let td = document.createElement("td");
        // document.getElementById('cart_sku').innerHTML = item.item_code;

        var capa = document.getElementById("info");
        // var data_arreglo = ul + li_code + li_name;
        var tr = document.createElement("tr");
        var td_code = document.createElement("td");
        var td_name = document.createElement("td");
        var td_date = document.createElement("td");
        var td_status = document.createElement("td");
        var td_quantity = document.createElement("td");
        var td_act_gr = document.createElement("td");

        //valores formateadores
        //variables 
        let code_item = item.item_code;
        let code_name = item.item_name;
        let code_date = item.order_date;
        let code_status = item.item_status;
        let code_quantity = item.item_quantity;
        let gramos_actuales = item.gr_actual;

        td_code.innerHTML = code_item;
        td_name.innerHTML = code_name;
        td_date.innerHTML = code_date;
        td_status.innerHTML = code_status;
        td_quantity.innerHTML = code_quantity;
        td_act_gr.innerHTML = gramos_actuales;

        //capa imprime la informacion
        capa.appendChild(tr);
        capa.appendChild(td_code);
        capa.appendChild(td_name);
        capa.appendChild(td_date);
        capa.appendChild(td_status);
        capa.appendChild(td_quantity);

        let button_delete = '<button class="btn deep-orange accent-4 mt-2" onclick="deletedata(' +
          code_item +
          ')" id="delete_row"><i class="large material-icons">cancel</i></button>';
        $("#info").append(button_delete);

      });
      //     document.getElementById("result_venta").innerHTML = Total;
      // console.log("Arreglo" + Total);
    })
    .fail(function (e) { });

}

//para crear la cotizacion y el primer item_code
$("#send_information").click(function () {
  Swal.fire({
    title: "Estas Seguro De Solicitar Este Producto?",
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: `Si, Solicitar`,
    denyButtonText: `No, Cancelar`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var datos = $("#form_2").serialize();
      $.ajax({
        type: "POST",
        url: "ajax/ajax_create_transfer.php",
        data: datos,
        success: function (r) {
          console.log(r);
          if (r != 0 && !isNaN(r)) {
            //SI ES DISTINTO A 0 Y ES UN NUMERO
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "Agregado Con Exito!!",
              showConfirmButton: false,
              timer: 1500,
            });
            limpiar_modal_cart()
            mostrarData();
          } else {
            //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Algo Salio Mal!!",
              showConfirmButton: false,
              timer: 1500,
            });
            limpiar_modal_cart()
            mostrarData();
          }
        },
      });

      return false;
    } else if (result.isDenied) {
      Swal.fire("Se ha cancelado la solicitud. ", "", "info");
    }
  });
});

function limpiar_modal_cart() {
  // $('#info_cart').val('');
  console.log("limpiando data");
  document.getElementById("info").innerHTML = "";
  Total_format = 0;
}

$(document).ready(function () {
  $("#trigger").trigger("click");

});

function deletedata(data) {

  var datos = data;
  //ajax
  Swal.fire({
    title: "Estas seguro de eliminar este item?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Eliminar`,
    denyButtonText: `No, Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      let timerInterval;
      Swal.fire({
        title: "Estamos eliminando este producto de tu carrito!",
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
        url: "ajax/ajax_delete_item.php",
        data: { codigo: datos },
        success: function (r) {
          console.log(r);
          if (r != 0 && !isNaN(r)) {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "Item Eliminado Con Exito",
              showConfirmButton: false,
              timer: 1500,
            });
            limpiar_modal_cart()
            setTimeout(mostrarData(), 2000);
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Algo salio mal!, el producto no se elimino de tu carrito.",
              showConfirmButton: false,
              timer: 1500,
            });
            limpiar_modal_cart()
            setTimeout(mostrarData(), 2000);

          }
        },
      });
      return false;
    } else if (result.isDenied) {
      Swal.fire("El producto no se elimino de tu carrito!", "", "info");
    }
  });
}

$(document).ready(function () {
  $('.modal').modal();
});

//imprimir informacion en el modal

function getInfoUser(data) {
  console.log("entre");
  $.ajax({
    url: 'methods/get_user_modal.php',
    type: 'POST',
    dataType: 'json',
    data: {
      key: 'Q1',
      transfer: data
    }
  }).done(function (d) {

    let solicitante_demo = d.resultado.solicitante;

    let solicitante = solicitante_demo.replace("&nbsp;", " ");

    document.getElementById("date").value = (d.resultado.order_date);
    document.getElementById("sol").value = (solicitante);
    document.getElementById("trans").value = (d.resultado.transfer_id);
    document.getElementById("status").value = (d.resultado.estado);
    //IMPRIMIENDO ITEMS
    $.ajax({
      url: 'methods/get_modal_info.php',
      type: 'POST',
      dataType: 'json',
      data: {
        key: 'Q1',
        id_transfer: data
      }
    }).done(function (d) {
      limpiar_modal_cart();
      d.retornolosdatos.forEach((item) => {
        // console.log(item.id);
        // let td = document.createElement("td");
        // document.getElementById('cart_sku').innerHTML = item.item_code;

        var capa = document.getElementById("info");
        // var data_arreglo = ul + li_code + li_name;
        var tr = document.createElement("tr");
        var input = document.createElement("input");
        var input_2 = document.createElement("input");
        var input_3 = document.createElement("input");
        var td_code = document.createElement("td");
        var td_name = document.createElement("td");
        var td_gramos = document.createElement("td");

        // var td_date = document.createElement("td");
        // var td_status = document.createElement("td");
        var td_quantity = document.createElement("td");

        //valores formateadores
        //variables 
        let code_item = item.item_code;
        let code_name = item.item_name;
        let code_quantity = item.item_quantity;
        let gr_act = item.gr_actual;
        td_code.innerHTML = code_item;
        td_name.innerHTML = code_name;
        td_gramos.innerHTML = gr_act;
        input.value = code_quantity;
        input.name = "item_quantity[]";
        input.id = "quanty_itemss";
        input.className = "quanty_items";
        input_2.value = code_item;
        input_2.name = "item_code[]";
        input_2.className = "item_codes";
        input_2.attributes = { readonly: true };



        //capa imprime la informacion
        capa.appendChild(tr);
        capa.appendChild(input_2);
        capa.appendChild(td_name);
        capa.appendChild(input);
        capa.appendChild(td_gramos);

      });



    }).fail(function (e) {

    });

  }).fail(function (e) {

  });
}
//Enviar traspaso a solicitud
$("#complete_transfer").click(function () {
  usuario = $("#user_name").val();
  id_user = $("#user_id").val();
  Swal.fire({
    title: usuario,
    text: "Estas Seguro De Enviar Este Solicitud?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Enviar`,
    denyButtonText: `No, Cancelar`,
    icon: "warning",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "ajax/ajax_complete_transfer.php",
        data: id_user,
        success: function (r) {
          console.log(r);
          if (r != 0 && !isNaN(r)) {
            //SI ES DISTINTO A 0 Y ES UN NUMERO

            Swal.fire({
              title: "Perfecto " + usuario + "!!",
              text: "Tu traspaso es el #" + r + "!!",
              icon: "success",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Lista De Traspasos!'
            }).then((result) => {
              if (result.isConfirmed) {
                function redireccionar() {
                  location.href = 'transfers_list.php';
                }
                setTimeout(redireccionar(), 1000);
              } else {
                function redireccionars() {
                  location.href = 'index.php';
                }
                setTimeout(redireccionars(), 1000);
              }
            })
          } else {
            //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
            alert("no funciona");
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Algo Salio Mal!!",
              showConfirmButton: false,
              timer: 1500,
            });

          }
        },
      });

      return false;
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
});



//Enviar traspaso a transito
$("#send_info").click(function () {
  usuario = $("#user_name").val();
  Swal.fire({
    title: usuario,
    text: "Estas Seguro De Enviar Este Traspaso?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Enviar`,
    denyButtonText: `No, Cancelar`,
    icon: "warning",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var codes = document.getElementsByClassName("item_codes");
      var quantity = document.getElementsByClassName("quanty_items");
      var orders = $("#trans").serializeArray();
      const codess = [];
      const quantitys = [];
      const orderss = [];
      for (i = 0; i < codes.length; i++) {
        codess.push(codes[i].value);
      }
      for (i = 0; i < orders.length; i++) {
        orderss.push(orders[i].value);
      }

      for (i = 0; i < quantity.length; i++) {
        quantitys.push(quantity[i].value);
      }
      new_c = codess.toString()
      new_q = quantitys.toString();
      new_o = orderss.toString();

      $.ajax({
        type: "POST",
        url: "ajax/ajax_send_trapaso.php",
        data: {
          codes: new_c,
          quantity: new_q,
          order: new_o
        },
        success: function (r) {
          console.log(r);
          if (r != 0 && !isNaN(r)) {
            //SI ES DISTINTO A 0 Y ES UN NUMERO
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: "Perfecto " + usuario + "!!",
              text: "Los productos de esta cotizacion se han actualizado con exito!!",
              showConfirmButton: false,
              timer: 1500,
            });

            function redireccionar() {
              location.href = 'transfers_list.php';
            }
            setTimeout(redireccionar(), 4000);
          } else {
            //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
            alert("no funciona");
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Algo Salio Mal!!",
              showConfirmButton: false,
              timer: 1500,
            });
          }
        },
      });

      return false;
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
});

//finalizar traspasos y asociar inventarios
//Enviar traspaso a solicitud

function aprobar_traspasos(data) {
  usuario = $("#user_name").val();
  id_user = $("#user_id").val();
  Swal.fire({
    title: usuario,
    text: "Estas Seguro De Aprobar Este Traspaso?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Aprobar`,
    denyButtonText: `No, Cancelar`,
    icon: "warning",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "ajax/ajax_finalizar_traspaso.php",
        data: {
          order: data
        },
        success: function (r) {
          console.log(r);
          if (r != 0 && !isNaN(r)) {
            //SI ES DISTINTO A 0 Y ES UN NUMERO

            Swal.fire({
              title: "Perfecto " + usuario + "!!",
              text: "Tu traspaso el #" + r + " a sido aprobado con exito!!",
              icon: "success",

            });
            function redireccionar() {
              location.href = 'transfers_list.php';
            }
            setTimeout(redireccionar(), 4000);
          } else {
            //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
            alert("no funciona");
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Algo Salio Mal!!",
              showConfirmButton: false,
              timer: 1500,
            });

          }
        },
      });

      return false;
    } else if (result.isDenied) {
      Swal.fire("Changes are not saved", "", "info");
    }
  });
}

