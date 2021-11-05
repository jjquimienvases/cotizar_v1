$(document).ready(function () {
  function limpiar_data() {
    console.log("limpiando data");
    document.getElementsByClassName("info_target_1").innerHTML = "";
    document.getElementById("info").innerHTML = "";
    $(".info_target_1").text("");
  }
  $("#buscar").on("click", function () {
    limpiar_data();
    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q1",
        item: $("#item_select").val(),
      },
    })
      .done(function (d) {
        // console.log(d);
        var stock = d.resultado.stock;
        var capa = document.getElementById("info_stock");
        var h3_stock = document.createElement("h3");
        h3_stock.innerHTML = stock;

        capa.appendChild(h3_stock);
        //   $("#stock_actual").val('30');
        // let padre = $("#infomation").parent().parent().parent();
        // padre.find("[name^=stock_actual]").val(d.resultado.stock);
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q7",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        // console.log(d);
        var salida_t1 = d.resultado.salidas_anterior;
        var capa = document.getElementById("info_salida_t1");
        var h3 = document.createElement("h3");
        h3.innerHTML = salida_t1;

        capa.appendChild(h3);
      })
      .fail(function (e) {});
    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q8",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        // console.log(d);
        var salida_t2 = d.resultado.salidas_actual;
        var capa = document.getElementById("info_salida_t2");
        var h3 = document.createElement("h3");
        h3.innerHTML = salida_t2;

        capa.appendChild(h3);
      })
      .fail(function (e) {});
    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q9",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        // console.log(d);
        var entrada_t1 = d.resultado.entradas_Anterior;
        var capa = document.getElementById("info_entrada_t1");
        var h3 = document.createElement("h3");
        h3.innerHTML = entrada_t1;

        capa.appendChild(h3);
      })
      .fail(function (e) {});
    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q10",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        // console.log(d);
        var entrada_t2 = d.resultado.entradas_Actual;
        var capa = document.getElementById("info_entrada_t2");
        var h3 = document.createElement("h3");
        h3.innerHTML = entrada_t2;

        capa.appendChild(h3);
      })
      .fail(function (e) {});
    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q11",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        // console.log(d);
        var entrada_t2 = d.resultado.ventas_mostrador;
        var capa = document.getElementById("info_ventas_mostrador");
        var h3 = document.createElement("h3");
        h3.innerHTML = entrada_t2;

        capa.appendChild(h3);
      })
      .fail(function (e) {});
    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q12",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        // console.log(d);
        var entrada_t2 = d.resultado.ventas_mostrador_D1;
        var capa = document.getElementById("info_ventas_d1");
        var h3 = document.createElement("h3");
        h3.innerHTML = entrada_t2;

        capa.appendChild(h3);
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q4",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        var total_ventas_call = d.resultado.Total_Ventas;
        var capa = document.getElementById("info_ventas_call");
        var h3_ventas_call = document.createElement("h3");
        h3_ventas_call.innerHTML = total_ventas_call;
        capa.appendChild(h3_ventas_call);
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q5",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        var total_ventas_call = d.resultado.total_ingresos;
        var capa = document.getElementById("info_target_1");
        var h3_ventas_call = document.createElement("h3");
        h3_ventas_call.innerHTML = total_ventas_call;
        capa.appendChild(h3_ventas_call);
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q3",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        d.retornolosdatos.forEach((item) => {
          let td = document.createElement("td");
          // document.getElementById('cart_sku').innerHTML = item.item_code;

          var capa = document.getElementById("info");
          // var data_arreglo = ul + li_code + li_name;
          var tr = document.createElement("tr");
          var td_code = document.createElement("td");
          var td_count = document.createElement("th");
          var td_name = document.createElement("td");
          var td_date = document.createElement("td");
          var td_status = document.createElement("td");
          var td_quantity = document.createElement("td");
          var td_clientes = document.createElement("td");
          var td_comercial = document.createElement("td");
          var td_cedula = document.createElement("td");
          var tds = document.createElement("td");

          //valores formateadores
          //variables

          let code_item = item.item_code;
          let code_name = item.item_name;
          let code_date = item.order_date;
          let code_status = item.estado;
          let cliente = item.order_receiver_name;
          let comercial = item.order_receiver_address;
          let cedula = item.cedula;
          let code_quantity = item.order_item_quantity;

          td_code.innerHTML = code_item;
          td_name.innerHTML = code_name.toUpperCase();
          td_comercial.innerHTML = comercial.toUpperCase();
          td_date.innerHTML = code_date;
          td_status.innerHTML = code_status.toUpperCase();
          td_quantity.innerHTML = code_quantity;
          td_clientes.innerHTML = cliente.toUpperCase();
          td_cedula.innerHTML = cedula;

          //capa imprime la informacion
          capa.appendChild(tr);

          // capa.appendChild(td_code);
          capa.appendChild(tds);
          capa.appendChild(td_cedula);
          capa.appendChild(td_date);
          capa.appendChild(td_clientes);
          capa.appendChild(td_name);
          capa.appendChild(td_quantity);
          capa.appendChild(td_comercial);

          // let button_delete = '<button class="btn deep-orange accent-4 mt-2" onclick="deletedata(' +
          // code_item +
          // ')" id="delete_row"><i class="large material-icons">cancel</i></button>';
          // $("#info").append(button_delete);
        });
      })
      .fail(function (e) {});

      $.ajax({
        url: "methods/get_info.php",
        type: "POST",
        dataType: "json",
        data: {
          key: "Q3",
          item: $("#item_select").val(),
          inicial: $("#fecha_inicial").val(),
          final: $("#fecha_final").val(),
        },
      })
        .done(function (d) {
          d.retornolosdatos.forEach((item) => {
            let td = document.createElement("td");
            // document.getElementById('cart_sku').innerHTML = item.item_code;
  
            var capa = document.getElementById("info_modal_ventas_call");
            // var data_arreglo = ul + li_code + li_name;
            var tr = document.createElement("tr");
            var td_code = document.createElement("td");
            var td_count = document.createElement("th");
            var td_name = document.createElement("td");
            var td_date = document.createElement("td");
            var td_status = document.createElement("td");
            var td_quantity = document.createElement("td");
            var td_clientes = document.createElement("td");
            var td_comercial = document.createElement("td");
            var td_cedula = document.createElement("td");
            var tds = document.createElement("td");
  
            //valores formateadores
            //variables
  
            let code_item = item.item_code;
            let code_name = item.item_name;
            let code_date = item.order_date;
            let code_status = item.estado;
            let cliente = item.order_receiver_name;
            let comercial = item.order_receiver_address;
            let cedula = item.cedula;
            let code_quantity = item.order_item_quantity;
  
            td_code.innerHTML = code_item;
            td_name.innerHTML = code_name.toUpperCase();
            td_comercial.innerHTML = comercial.toUpperCase();
            td_date.innerHTML = code_date;
            td_status.innerHTML = code_status.toUpperCase();
            td_quantity.innerHTML = code_quantity;
            td_clientes.innerHTML = cliente.toUpperCase();
            td_cedula.innerHTML = cedula;
  
            //capa imprime la informacion
            capa.appendChild(tr);
  
            // capa.appendChild(td_code);
            // capa.appendChild(tds);
            capa.appendChild(td_date);
            // capa.appendChild(td_cedula);
            capa.appendChild(td_clientes);
            capa.appendChild(td_name);
            capa.appendChild(td_quantity);
            capa.appendChild(td_comercial);
  
            // let button_delete = '<button class="btn deep-orange accent-4 mt-2" onclick="deletedata(' +
            // code_item +
            // ')" id="delete_row"><i class="large material-icons">cancel</i></button>';
            // $("#info").append(button_delete);
          });
        })
        .fail(function (e) {});




    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q13",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        d.retornolosdatos.forEach((item) => {
          let td = document.createElement("td");
          var capa = document.getElementById("info_ingresos");
          var tr = document.createElement("tr");
          var td_code = document.createElement("td");
          var td_count = document.createElement("th");
          var td_name = document.createElement("td");
          var td_date = document.createElement("td");
          var td_status = document.createElement("td");
          var td_quantity = document.createElement("td");
          var td_proveedor = document.createElement("td");
          var td_factura = document.createElement("td");
          let code_item = item.code;
          let code_name = item.contratipo;
          let code_date = item.order_date;
          let proveedor = item.Proveedor;
          let factura = item.factura;
          let code_quantity = item.cantidad;

          td_code.innerHTML = code_item;
          td_name.innerHTML = code_name.toUpperCase();
          td_proveedor.innerHTML = proveedor.toUpperCase();
          td_date.innerHTML = code_date;
          td_quantity.innerHTML = code_quantity;
          td_factura.innerHTML = factura;
          //capa imprime la informacion
          capa.appendChild(tr);
          capa.appendChild(td_date);
          capa.appendChild(td_proveedor);
          capa.appendChild(td_factura);
          capa.appendChild(td_code);
          capa.appendChild(td_quantity);
        });
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q14",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        d.retornolosdatos.forEach((item) => {
          let td = document.createElement("td");
          var capa = document.getElementById("info_t_salida_antiguo");
          var tr = document.createElement("tr");
          var td_code = document.createElement("td");
          var td_date = document.createElement("td");
          var td_producto = document.createElement("td");
          var td_quantity = document.createElement("td");
          var td_bodega_salida = document.createElement("td");
          var td_bodega_entrada = document.createElement("td");
          var tds = document.createElement("td");

          let code_item = item.codigo;
          let code_name = item.producto;
          let code_date = item.order_date;
          let code_status = item.estado;
          let bodega_s = item.bodega_salida;
          let bodega_e = item.bodega_entrada;
          let code_quantity = item.cantidad;

          td_code.innerHTML = code_item;
          td_producto.innerHTML = code_name.toUpperCase();
          td_date.innerHTML = code_date;
          // td_status.innerHTML = code_status.toUpperCase();
          td_quantity.innerHTML = code_quantity;
          td_bodega_salida.innerHTML = bodega_s.toUpperCase();
          td_bodega_entrada.innerHTML = bodega_e.toUpperCase();

          //capa imprime la informacion
          capa.appendChild(tr);
          capa.appendChild(td_date);
          capa.appendChild(td_code);
          capa.appendChild(td_quantity);
          // capa.appendChild(td_bodega_salida);
          capa.appendChild(td_bodega_entrada);
        });
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q15",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        d.retornolosdatos.forEach((item) => {
          let td = document.createElement("td");
          var capa = document.getElementById("info_t_salida_nuevo");
          var tr = document.createElement("tr");
          var td_code = document.createElement("td");
          var td_date = document.createElement("td");
          var td_producto = document.createElement("td");
          var td_quantity = document.createElement("td");
          var td_bodega_salida = document.createElement("td");
          var td_bodega_entrada = document.createElement("td");
          var td_transfer_id = document.createElement("td");

          let code_item = item.item_code;
          let code_name = item.item_name;
          let code_date = item.order_date;
          let code_status = item.estado;
          let bodega_s = item.bodega_salida;
          let bodega_e = item.bodega_entrada;
          let code_quantity = item.item_quantity;
          let transfer = item.transfer_id;

          td_code.innerHTML = code_item;
          td_transfer_id.innerHTML = transfer;
          td_producto.innerHTML = code_name.toUpperCase();
          td_date.innerHTML = code_date;
          // td_status.innerHTML = code_status.toUpperCase();
          td_quantity.innerHTML = code_quantity;
          td_bodega_salida.innerHTML = bodega_s.toUpperCase();
          td_bodega_entrada.innerHTML = bodega_e.toUpperCase();

          //capa imprime la informacion
          capa.appendChild(tr);
          capa.appendChild(td_date);
          capa.appendChild(td_transfer_id);
          capa.appendChild(td_code);
          capa.appendChild(td_quantity);
          // capa.appendChild(td_bodega_salida);
          capa.appendChild(td_bodega_entrada);
        });
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q16",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        d.retornolosdatos.forEach((item) => {
          let td = document.createElement("td");
          var capa = document.getElementById("info_t_entrada_antiguo");
          var tr = document.createElement("tr");
          var td_code = document.createElement("td");
          var td_date = document.createElement("td");
          var td_producto = document.createElement("td");
          var td_quantity = document.createElement("td");
          var td_bodega_salida = document.createElement("td");
          var td_bodega_entrada = document.createElement("td");
          var tds = document.createElement("td");

          let code_item = item.codigo;
          let code_name = item.producto;
          let code_date = item.order_date;
          let code_status = item.estado;
          let bodega_s = item.bodega_salida;
          let bodega_e = item.bodega_entrada;
          let code_quantity = item.cantidad;

          td_code.innerHTML = code_item;
          td_producto.innerHTML = code_name.toUpperCase();
          td_date.innerHTML = code_date;
          // td_status.innerHTML = code_status.toUpperCase();
          td_quantity.innerHTML = code_quantity;
          td_bodega_salida.innerHTML = bodega_s.toUpperCase();
          td_bodega_entrada.innerHTML = bodega_e.toUpperCase();

          //capa imprime la informacion
          capa.appendChild(tr);
          capa.appendChild(td_date);
          capa.appendChild(td_code);
          capa.appendChild(td_quantity);
          capa.appendChild(td_bodega_salida);
          //   capa.appendChild(td_bodega_entrada);
        });
      })
      .fail(function (e) {});

    $.ajax({
      url: "methods/get_info.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q17",
        item: $("#item_select").val(),
        inicial: $("#fecha_inicial").val(),
        final: $("#fecha_final").val(),
      },
    })
      .done(function (d) {
        d.retornolosdatos.forEach((item) => {
          let td = document.createElement("td");
          var capa = document.getElementById("info_t_entrada_nuevo");
          var tr = document.createElement("tr");
          var td_code = document.createElement("td");
          var td_date = document.createElement("td");
          var td_producto = document.createElement("td");
          var td_quantity = document.createElement("td");
          var td_bodega_salida = document.createElement("td");
          var td_bodega_entrada = document.createElement("td");
          var td_transfer_id = document.createElement("td");

          let code_item = item.item_code;
          let code_name = item.item_name;
          let code_date = item.order_date;
          let code_status = item.estado;
          let bodega_s = item.bodega_salida;
          let bodega_e = item.bodega_entrada;
          let code_quantity = item.item_quantity;
          let transfer = item.transfer_id;

          td_code.innerHTML = code_item;
          td_transfer_id.innerHTML = transfer;
          td_producto.innerHTML = code_name.toUpperCase();
          td_date.innerHTML = code_date;
          // td_status.innerHTML = code_status.toUpperCase();
          td_quantity.innerHTML = code_quantity;
          td_bodega_salida.innerHTML = bodega_s.toUpperCase();
          td_bodega_entrada.innerHTML = bodega_e.toUpperCase();

          //capa imprime la informacion
          capa.appendChild(tr);
          capa.appendChild(td_date);
          capa.appendChild(td_transfer_id);
          capa.appendChild(td_code);
          capa.appendChild(td_quantity);
          capa.appendChild(td_bodega_salida);
          // capa.appendChild(td_bodega_entrada);
        });
      })
      .fail(function (e) {});
  });
});
