//primera funcion pintar la data dentro de una tabla
function orders_table() {

    $.ajax({
            url: "../ajax/ajax_get_orders.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
            },
        })
        .done(function (d) {
            /*     console.log(d); */
            limpiar_data()
            d.retornolosdatos.forEach((item) => {
                let order_id = item.order_id;
                let cliente = item.order_receiver_name;
                let fecha = item.order_date;
                let estado = item.estado;
                let button_add = '<button type="button" class="btn btn-outline-success rounded" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop" onclick="print_data(' +
                    order_id +
                    ')" id="delete_row">Finalizar</button>';

                let button_pdf = '<button class="btn btn-outline-danger rounded"><a href="../../print_invoice.php?invoice_id=' + order_id + '" class="text-danger">Ver PDF<a></button>';

                let btns = ' <p uk-margin>' +
                    button_pdf +" "+
                    button_add +
                    '</p>';

                var card_var = '<div class="uk-card uk-card-default uk-card-hover uk-card-body mb-2">' +
                    '    <h4 class="text-center text-primary">' +
                    order_id +
                    '    </h4>' +
                    '      <div class="card-body">' +
                    '<b>Cliente: </b>'+cliente +'<br>'+
                    '<b>Fecha: </b>'+fecha +'<br>'+
                    '<b>Estado: </b>'+ estado +
                    '      </div>' +
                    '<hr>' +
                    '<div class="row text-center">' +
                    btns+ '</div>' +
                    '</div>';

     
                
                 $("#info_orders").append(card_var);




            });

        })
        .fail(function (e) {});
}

function orders_table_search() {
    let daticos = $("#info_user").val();
    $.ajax({
            url: "../ajax/ajax_get_orders.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q2",
                datos: daticos,
            },
        })
        .done(function (d) {
            /*     console.log(d); */
            limpiar_data()
            d.retornolosdatos.forEach((item) => {


                let order_id = item.order_id;
                let cliente = item.order_receiver_name;
                let fecha = item.order_date;
                let estado = item.estado;
                let button_add = '<button type="button" class="btn btn-outline-success rounded" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop" onclick="print_data(' +
                    order_id +
                    ')" id="delete_row">Finalizar</button>';

                let button_pdf = '<button class="btn btn-outline-danger rounded text-danger"><a href="../../print_invoice.php?invoice_id=' + order_id + '">Ver PDF<a></button>';
                let btns = ' <p uk-margin>' +
                button_pdf +
                button_add +
                '</p>';




            var card_var = '<div class="uk-card uk-card-default uk-card-hover uk-card-body mb-2">' +
                '    <h4 class="text-center text-primary">' +
                order_id +
                '    </h4>' +
                '      <div class="card-body">' +
                '<b>Cliente: </b>'+cliente +'<br>'+
                '<b>Fecha: </b>'+fecha +'<br>'+
                '<b>Estado: </b>'+ estado +
                '      </div>' +
                '<hr>' +
                '<div class="row">' +
                btns+ '</div>' +
                '</div>';

 
            
             $("#info_orders").append(card_var);

            });

        })
        .fail(function (e) {});
}

function print_data(dato) {

    $.ajax({
            url: "../ajax/ajax_get_orders.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q3",
                datos: dato,
            },
        })
        .done(function (d) {
            d.retornolosdatos.forEach((item) => {
                let order_id = item.order_id;
                let cliente = item.order_receiver_name;
                let fecha = item.order_date;
                let monto = item.order_total_after_tax;
                $("#order_select").val(order_id);
                $("#cliente_select").val(cliente);
                $("#date_select").val(fecha);
                $("#monto_select").val(monto);
            });
        }).fail(function (e) {});
}

function update_information() {
    let order = $("#order_select").val();
    let metodo_pago = $("#metodo_pago").val();

    Swal.fire({
        icon: 'info',
        title: '¿Estas Seguro?',
        text: 'De finalizar la orden ' + order + ' con el metodo de pago ' + metodo_pago + '.',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si, estoy seguro',
        denyButtonText: `No, cancelar operacion`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            //ejecutar ajax aqui para hacer de to
            $.ajax({
                type: "POST",
                url: "../ajax/ajax_finish_order.php",
                data: {
                    orders: order,
                    mpago: metodo_pago,
                },
                success: function (r) {
                    console.log(r);
                    if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                        Swal.fire({
                            position: 'top-start',
                            icon: 'success',
                            title: 'Finalizado con exito!!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        console.log(r);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log(r);
                    }
                }
            });
            return false;

        } else if (result.isDenied) {
            Swal.fire('Cancelaste la operacion!!', '', 'info')
        }
    })
}

function limpiar_data() {
    document.getElementById("info_orders").innerHTML = "";

}


$(document).ready(function () {
    $("#button_charge").trigger("click");
});