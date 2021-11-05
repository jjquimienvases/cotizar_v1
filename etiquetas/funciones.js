function show_orders_search(){
    $.ajax({
        url: "ajax/ajax_get_orders.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q1",
            valor: $("#search_orders").val(),
        },
    })
    .done(function (d) {
        clear_table();
        d.retornolosdatos.forEach((item) => {
            let order_id = item.order_id;
            let cliente = item.order_receiver_name;
            let fecha = item.order_date;
            let comercial = item.order_receiver_address;
            let descuento = item.order_total_amount_due;
            let total_r = item.order_total_after_tax;
            let estado = item.estado;
            
            let monto = descuento;
            if(descuento == 0){
                monto = total_r
            }
            let class_btn = "";
            if(estado == "pendiente"){
                 class_btn = "btn btn-outline-danger rounded-pill";
            }else if(estado == "finalizado"){
                 class_btn = "btn btn-outline-success rounded-pill";
            }else{
                class_btn = "btn btn-outline-secondary rounded-pill";
            }
            let button_add = '<td><button class="'+class_btn+'"><a href="print_etiquetas_.php?invoice_id='+order_id+'">'+estado+'</a></button></td>';

            var capa = document.getElementById("info_orders");
            // var data_arreglo = ul + li_code + li_name;
            var tr = document.createElement("tr");
            var td_code = document.createElement("td");
            var td_cliente = document.createElement("td");
            var td_fecha = document.createElement("td");
            var td_monto = document.createElement("td");
            var td_comercial = document.createElement("td");

            td_cliente.innerHTML = cliente;
            td_code.innerHTML = order_id;
            td_fecha.innerHTML = fecha;
            td_comercial.innerHTML = comercial;
            td_monto.innerHTML = monto;


            capa.appendChild(tr);
            capa.appendChild(td_fecha);
            capa.appendChild(td_code);
            capa.appendChild(td_cliente);
            capa.appendChild(td_comercial);
    
            $("#info_orders").append(button_add);

       
    });
}).fail(function(e){});
}


function show_transfer_search(){
    $.ajax({
        url: "ajax/ajax_get_orders.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q2",
            valor_: $("#search_transfers").val(),
        },
    })
    .done(function (d) {
        clear_table();
        d.retornolosdatos.forEach((item) => {
            let order_id = item.transfer_id;
            let bodega_entrada = item.bodega_entrada;
            let bodega_salida = item.bodega_salida;
            let fecha = item.order_date;
            let estado = item.estado;
            
            
            let class_btn = "";
            if(estado == "solicitud"){
                 class_btn = "btn btn-outline-danger rounded-pill";
            }else if(estado == "finalizado"){
                 class_btn = "btn btn-outline-success rounded-pill";
            }else{
                class_btn = "btn btn-outline-secondary rounded-pill";
            }
            let button_add = '<td><button class="'+class_btn+'"><a href="print_etiquetas_t.php?invoice_id='+order_id+'">'+estado+'</a></button></td>';

            var capa = document.getElementById("info_transfers");
            // var data_arreglo = ul + li_code + li_name;
            var tr = document.createElement("tr");
            var td_code = document.createElement("td");
            var td_be = document.createElement("td");
            var td_bs = document.createElement("td");
            var td_fecha = document.createElement("td");
          

            td_be.innerHTML = bodega_entrada;
            td_code.innerHTML = order_id;
            td_fecha.innerHTML = fecha;
            td_bs.innerHTML = bodega_salida;
           
            capa.appendChild(tr);
            capa.appendChild(td_fecha);
            capa.appendChild(td_code);
            capa.appendChild(td_bs);
            capa.appendChild(td_be);
    
            $("#info_transfers").append(button_add);

       
    });
}).fail(function(e){});
}




function clear_table(){
    document.getElementById("info_orders").innerHTML = "";
    document.getElementById("info_transfers").innerHTML = "";
}