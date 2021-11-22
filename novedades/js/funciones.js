const options2 = {
    style: 'currency',
    currency: 'USD'
};
const numberFormat2 = new Intl.NumberFormat('en-US', options2);

let Total_format = 0;
let demo_total = 0;
let demo_novedades = 0;
let demo_call = 0;
let demo_diferencia = 0;
let demo_total_ib2 = 0;
let demo_caja_1 = 0;
let demo_caja_2 = 0;

function limpiar_data(){
    document.getElementById("rest_total_ventas").innerHTML = "";
    document.getElementById("rest_total_novedades").innerHTML = "";
    document.getElementById("rest_total").innerHTML = "";
    document.getElementById("info").innerHTML = "";
    document.getElementById("info_2").innerHTML = "";
    document.getElementById("info_3").innerHTML = "";
    document.getElementById("info_ib2").innerHTML = "";
    document.getElementById("rest_total_ventas_cj").innerHTML = "";
    document.getElementById("rest_total_ventas_IB2_cj").innerHTML = "";
    document.getElementById("rest_total_caja").innerHTML = "";
    rest_total_caja
    demo_total = 0;
    demo_novedades = 0;
    demo_diferencia = 0;
    demo_call = 0;
    demo_total_ib2 = 0;
    demo_caja_1 = 0;
    demo_caja_2 = 0;
}




function get_ventas() {
   let date_inicial = $("#inicial").val();
   let date_final = $("#final").val();
   

   limpiar_data();
   $.ajax({
       url: "ajax/ajax_get_info.php",
       type: "POST",
       dataType: "json",
       data: {
           key: "Q1",
           inicial: date_inicial,
           final: date_final,
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            
            let total = 0;
            let date = item.order_date;
            let order_id = item.order_id;
            let cliente = item.order_receiver_name;
            
            let total_1 = item.order_total_after_tax;
            let total_2 = item.order_total_amount_due;
            if (total_2 == 0) {
                total = total_1;
            } else {
                total = total_2;
            }
            /*  total =  total.fontcolor('green') */
            let td = document.createElement("td");
            var capa = document.getElementById("info");
            var tr = document.createElement("tr");
            var td_date = document.createElement("td");
            var td_order = document.createElement("td");
            var td_cliente = document.createElement("td");
            var td_monto = document.createElement("td");
            
            td_date.innerHTML = date;
            td_order.innerHTML = order_id;
            td_cliente.innerHTML = cliente;
            td_monto.innerHTML = numberFormat2.format(total);
            td_monto.className = "value";
            
            //capa imprime la informacion
            capa.appendChild(tr);
            capa.appendChild(td_date);
            capa.appendChild(td_order);
            capa.appendChild(td_cliente);
            capa.appendChild(td_monto);
            
            
            
            demo_total += parseFloat(total);
            //--------------------------------------------------------------------------------------------------
        });
        $('#rest_total_ventas').val(numberFormat2.format(demo_total));
        
        // Total_format = numberFormat2.format(Total);
        
        
        
    })
    .fail(function (e) {});
   $.ajax({
       url: "ajax/ajax_get_info.php",
       type: "POST",
       dataType: "json",
       data: {
           key: "Q5",
           inicial: date_inicial,
           final: date_final,
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            
            let total = 0;
            let date = item.order_date;
            let order_id = item.order_id;
            let cliente = item.order_receiver_name;
            
            let total_1 = item.order_total_after_tax;
            let total_2 = item.order_total_amount_due;
            if (total_2 == 0) {
                total = total_1;
            } else {
                total = total_2;
            }
            /*  total =  total.fontcolor('green') */
            let td = document.createElement("td");
            var capa = document.getElementById("info_ib2");
            var tr = document.createElement("tr");
            var td_date = document.createElement("td");
            var td_order = document.createElement("td");
            var td_cliente = document.createElement("td");
            var td_monto = document.createElement("td");
            
            td_date.innerHTML = date;
            td_order.innerHTML = order_id;
            td_cliente.innerHTML = cliente;
            td_monto.innerHTML = numberFormat2.format(total);
            td_monto.className = "value";
            
            //capa imprime la informacion
            capa.appendChild(tr);
            capa.appendChild(td_date);
            capa.appendChild(td_order);
            capa.appendChild(td_cliente);
            capa.appendChild(td_monto);
            
            
            
            demo_total_ib2 += parseFloat(total);
            //--------------------------------------------------------------------------------------------------
        });
        $('#rest_total_ventas_IB2').val(numberFormat2.format(demo_total_ib2));
        
        // Total_format = numberFormat2.format(Total);
        
        
        
    })
    .fail(function (e) {});
    
    
    $.ajax({
        url: "ajax/ajax_get_info.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q2",
            inicial: date_inicial,
            final: date_final,
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            
            console.log(item)
            let monto = item.monto;
            let date = item.order_date;
            let order_id = item.order_id;
            let razon = item.novedad;
            
            /*  total =  total.fontcolor('green') */
            let td = document.createElement("td");
            var capa = document.getElementById("info_2");
            var tr = document.createElement("tr");
            var td_date = document.createElement("td");
            var td_order = document.createElement("td");
            var td_razon = document.createElement("td");
            var td_monto = document.createElement("td");
            
            td_date.innerHTML = date;
            td_order.innerHTML = order_id;
            td_razon.innerHTML = razon;
            td_monto.innerHTML = numberFormat2.format(monto);
            
            //capa imprime la informacion
            capa.appendChild(tr);
            capa.appendChild(td_date);
            capa.appendChild(td_razon);
            capa.appendChild(td_monto);
            demo_novedades += parseFloat(monto);
        });
        $('#rest_total_novedades').val(numberFormat2.format(demo_novedades));
        
     
    })
    .fail(function (e) {});



    $.ajax({
        url: "ajax/ajax_get_info.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q3",
            inicial: date_inicial,
            final: date_final,
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            
            console.log(item)
            let montos = item.total;
            let date = item.order_date;
            let order_id = item.order_id;
            let cliente = item.order_receiver_name;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
            
            /*  total =  total.fontcolor('green') */
            let td = document.createElement("td");
            var capas = document.getElementById("info_3");
            var tr = document.createElement("tr");
            var td_date = document.createElement("td");
            var td_order = document.createElement("td");
            var td_razon = document.createElement("td");
            var td_monto = document.createElement("td");
            var td_cliente = document.createElement("td");

            td_cliente.innerHTML = cliente;
            td_date.innerHTML = date;
            td_order.innerHTML = order_id;
            
            td_monto.innerHTML = numberFormat2.format(montos);
            
            //capa imprime la informacion
            capas.appendChild(tr);
            capas.appendChild(td_date);
            capas.appendChild(td_order);
            capas.appendChild(td_cliente);
            capas.appendChild(td_monto);
            demo_call += parseFloat(montos);
        });
      
        
        
        $('#rest_total_ventas_call').val(numberFormat2.format(demo_call));
        
    })
    .fail(function (e) {});
    
    
     $.ajax({
        url: "ajax/ajax_get_info.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q6",
            inicial: date_inicial,
            final: date_final,
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            
            console.log(item)
            let montos = item.efectivo;
        
            demo_caja_1 += parseFloat(montos);
        });
      
        
        
        $('#rest_total_ventas_cj').val(numberFormat2.format(demo_caja_1));
        
    })
    .fail(function (e) {});
    
    
    $.ajax({
        url: "ajax/ajax_get_info.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q7",
            inicial: date_inicial,
            final: date_final,
        },
    })
    .done(function (d) {
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {
            
            console.log(item)
            let montos = item.efectivo;
        
            demo_caja_2 += parseFloat(montos);
        });
      
        
        
        $('#rest_total_ventas_IB2_cj').val(numberFormat2.format(demo_caja_2));
        
    })
    .fail(function (e) {});
    
    
    setTimeout(function () { calculate_diferencia()},5000)
   
    
}


function calculate_diferencia(){
    
    let suma_v = (demo_call + demo_total + demo_total_ib2);
    let resta = suma_v - demo_novedades;
    $('#rest_total').val(numberFormat2.format(resta));
    
     let suma_vcj = (demo_caja_2 + demo_caja_1 + demo_call);
    let resta_cj = suma_vcj - demo_novedades;
    $('#rest_total_caja').val(numberFormat2.format(resta_cj));
}