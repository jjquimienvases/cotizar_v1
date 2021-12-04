let value = "";
let estado_orden = "";
let id_compañia_order = "";
let compañia_order = "";
let item_id_order = "";
let contratipo_order = "";
let precio_order = "";
const options2 = {
    style: 'currency',
    currency: 'USD'
};
let cantidad_i = "";
let resultt_i = "";
const numberFormat2 = new Intl.NumberFormat('en-US', options2);

function limpiar_data() {
    /* $("#info").empty() */
    document.getElementById("info").innerHTML = "";
    document.getElementById("stock_actual").innerHTML = "";
    document.getElementById("unidad_empaque").innerHTML = "";
    console.log("limpiando data");
}

function limpiar_table() {
    document.getElementById("info_2").innerHTML = "";
}

function clear_table() {
    document.getElementById("info_orders").innerHTML = "";
    document.getElementById("info_facturas").innerHTML = "";
}

function clear_table_modal() {
    document.getElementById("info_items_order").innerHTML = "";

}

function clear_form() {
    document.getElementById("info").innerHTML = "";
    document.getElementsByClassName("info_form").innerHTML = "";
    $("#contenedor_info_form").hide();

}

function clear_table_provider_order() {
    document.getElementById("info_prodivers_orders").innerHTML = "";
}
function clear_table_provider_items_() {
    document.getElementById("list_items_data_provider").innerHTML = "";
}

function clear_table_products_order() {
    document.getElementById("info_products_orders").innerHTML = "";
}

function deletedata(data_item, data_order) {
    Swal.fire({
        title: 'Deseas Eliminar Este Dato?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Si`,
        denyButtonText: `No`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                    url: "../ajax/ajax_delete_item.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: data_item,
                        order: data_order,
                    },
                })
                .done(function (d) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Item eliminado con exito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    items_table()
                })
                .fail(function (e) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Algo salio mal',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
        } else if (result.isDenied) {
            Swal.fire('Decidiste cancelar la operacion!', '', 'info')
        }
    })

}
//genera las ordenes de compra, CAMBIA EL ESTADO 
function generar_orders() {
    let data_ = "leiner";
    Swal.fire({
        title: 'Deseas generar estas ordenes de compra?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Si`,
        denyButtonText: `No`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                    url: "../ajax/ajax_send_orders.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: data_,

                    },
                })
                .done(function (d) {
                    getOrderList()
                    clear_form()
                    closemodal()
                    $(".btn-close").trigger('click');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Orden Generada Con Exito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    items_table()
                })
                .fail(function (e) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Algo salio mal',
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
        } else if (result.isDenied) {
            Swal.fire('Decidiste cancelar la operacion!', '', 'info')
        }
    })
}


function items_table() {
    limpiar_table()
    $.ajax({
            url: "../ajax/ajax_get_items_table.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
            },
        })
        .done(function (d) {
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {
                let id = item.id;
                let order_id = item.order_id;
                let proveedor = item.proveedor;
                let item_name = item.item_name;
                let quantity = item.cantidad;
                let item_unitario = item.item_unitario;
                let resultado = item.item_total;

                /*  var capa = document.getElementById("info_2");  */

                let boton_proveedores = '<button class="btn btn-danger mt-2 printer" onclick="deletedata(' + id + ',' + order_id + ')" id="proveedor"><i class="fas fa-trash-alt"></i></button>';
                //GENERANDO LA INFORMACION DE LOS proveedores
                /*     $('#info_proveedores').html() */
                /*   $('#info_proveedores').html(boton_proveedores) */

                let td = document.createElement("td");
                var capa = document.getElementById("info_2");
                var tr = document.createElement("tr");
                var td_item = document.createElement("td");
                var td_order = document.createElement("td");
                var td_compañia = document.createElement("td");
                var td_quantity = document.createElement("td");
                var td_i_unitario = document.createElement("td");
                var td_resultado = document.createElement("td");

                td_item.innerHTML = item_name;
                td_order.innerHTML = order_id;
                td_compañia.innerHTML = proveedor;
                td_quantity.innerHTML = quantity;
                td_i_unitario.innerHTML = numberFormat2.format(item_unitario);
                td_resultado.innerHTML = numberFormat2.format(resultado);
                //capa imprime la informacion
                capa.appendChild(tr);
                capa.appendChild(td_order);
                capa.appendChild(td_compañia);
                capa.appendChild(td_item);
                capa.appendChild(td_quantity);
                capa.appendChild(td_i_unitario);
                capa.appendChild(td_resultado);
                /*  let button_delete = '<button class="btn deep-orange accent-4 mt-2" onclick="deletedata(' +
                 code_item +
                 ')" id="delete_row"><i class="large material-icons">cancel</i></button>'; */
                $("#info_2").append(boton_proveedores);
            });

        })
        .fail(function (e) {});
}

$(document).ready(function () {
    $('#table_facturas').DataTable();
    $("#edit").hide();
    $("#profile-tab").trigger("click");
    /*     $('#table_orders').DataTable(); */
    /* $('#table_orders').dynatable(); */
    //pasando valoires a un input reconcible
    let button_value = "";
    $("#buscar_items").keyup(function () {
        value = $(this).val();
        /*    $("#nombres2").val(value); */
    });
    $("#search").on("click", function () {
        limpiar_data()
        $("#contenedor_info_form").hide();
        /*       let id_item  = document.getElementById("buscar_items"); */
        let id_item = value;
        $.ajax({
                url: "../ajax/ajax_get_items.php",
                type: "POST",
                dataType: "json",
                data: {
                    key: "Q1",
                    id: id_item,
                },
            })
            .done(function (d) {
                /*     console.log(d); */
                d.retornolosdatos.forEach((item) => {
                    let stock_actual = item.stock;
                    let unidad_empaque = item.unidad;
                    let compañia = item.empresa;
                    let items = item.contratipo;
                    let id_proveedor = item.codigo;
                    let costo = item.precio;
                    //impriend datos estaticos
                    $('#stock_actual').val(stock_actual);
                    $('#unidad_empaque').val(unidad_empaque);
                    $('#contratipo').val(items);
                    $('#id_items').val(id_item);
                    /*  var capa = document.getElementById("info_proveedores"); */
                    var capa = $('#info_proveedores').val();
                    let boton_proveedores = '<button class="btn btn-warning mt-2 printer" value="' + id_proveedor + '" onclick="print_information(' + id_proveedor + ')" id="proveedor"><i class="fas fa-check-circle"></i></button>';
                    //GENERANDO LA INFORMACION DE LOS proveedores
                    let td = document.createElement("td");
                    var capa = document.getElementById("info");
                    var tr = document.createElement("tr");
                    var td_item = document.createElement("td");
                    var td_compañia = document.createElement("td");
                    var td_id_p = document.createElement("td");
                    var td_precio = document.createElement("td");
                    td_item.innerHTML = items;
                    td_compañia.innerHTML = compañia;
                    td_precio.innerHTML = numberFormat2.format(costo);
                    td_id_p.innerHTML = id_proveedor;
                    //capa imprime la informacion
                    capa.appendChild(tr);
                    capa.appendChild(td_id_p);
                    capa.appendChild(td_compañia);
                    capa.appendChild(td_item);
                    capa.appendChild(td_precio);
                    /*  let button_delete = '<button class="btn deep-orange accent-4 mt-2" onclick="deletedata(' +
                     code_item +
                     ')" id="delete_row"><i class="large material-icons">cancel</i></button>'; */
                    $("#info").append(boton_proveedores);
                });

                if (d == "[]") {
                    console.log("esta vacio bro");
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'No hay datos',
                        text: 'Este item no esta relacionado con ningun proveedor',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            })
            .fail(function (e) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'No hay datos',
                    text: 'Este item no esta relacionado con ningun proveedor',
                    showConfirmButton: false,
                    timer: 1500
                })
            });

    });

    $('#send_info').click(function () {
        /*   var datos = $('#contenedor_info_form').serialize(); */
        var datos = $("#form_2").serialize();
        console.log(datos);

        $.ajax({
            type: "POST",
            url: "../ajax/ajax_upload_information.php",
            data: datos,
            success: function (r) {
                console.log(r);
                if (r != 0 && r != "i_a") {

                    items_table()
                    clear_form()
                    //SI ES DISTINTO A 0 Y ES UN NUMERO
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Nueva Orden Exitosa!!',
                        text: 'la orden de compra' + r + 'se agrego con exito',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    console.log(datos);
                } else if (r == "i_a") {

                    items_table()
                    clear_form()
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Nuevo Item!!',
                        text: 'Item agregado con exito!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salio mal!!',
                        footer: '<a href="">Contactar al desarrollador</a>'
                    })
                    console.log(datos);
                }
            }
        });
        return false;
    });




});

function print_information(datas) {
    console.log(datas);
    $("#contenedor_info_form").show();
    let id_item = value;
    let id_proveedor = datas;
    $.ajax({
            url: "../ajax/ajax_print_info.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
                id_proveedor: id_proveedor,
                id: id_item,
            },
        })
        .done(function (d) {
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {
                let provider = item.empresa;
                let costo = item.precio;
                let provider_id = item.codigo;
                let items = item.contratipo;
                let items_code = item.id;


                $('#proveedor_name').val(provider);
                $('#proveedor_costo').val(costo);
                $('#proveedor_id').val(provider_id);
                $('#producto_name').val(items);
                $('#item_id').val(items_code);


            });

        })
        .fail(function (e) {});
}


function calcularTotal() {
    //obteniendo variables
    let quantity = $('#cantidad').val();
    let costo = $('#proveedor_costo').val();

    let total = "";

    total = parseInt(costo * quantity);
    $('#resultado').val(total);
    console.log(total);

}

function getOrderList() { //ESTO TRAE LA INFORMACION DEL LAS ORDENES Y LAS PINTA
    $.ajax({
            url: "../ajax/ajax_get_order_shop.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1"
            },
        })
        .done(function (d) {
            clear_table()
            getProviersOrders()
            getProductsOrders()
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let proveedor = item.proveedor;
                let order_id = item.order_id;
                let monto = item.result;
                let fecha = item.order_date;
                let estado = item.estado;
                let boton_edit = '<li class="botones_orders">| <i class="far fa-edit fa-1x printer" onclick="editOrder(' + order_id + ')" id="id_edit"></i></li>';
                let boton_pdf = '<li class="botones_orders">| <a href="../print_order_value.php?order=' + order_id + '"><i class="fas fa-file-invoice fa-1x print_pdf mb-2"></i></a></li>';
                let boton_aprobar = '<li class="botones_orders" data-bs-toggle="modal" data-bs-target="#modal_update_info" onclick="getInfoUser(' + order_id + ')">| <i class="fas fa-check-circle fa-1x aprobar mb-2" ></i></li>';
                var capa = document.getElementById("info_orders");
         

                var ul = document.createElement("ul");
                var li_estado = document.createElement("li");
                var li_order = document.createElement("li");
                var li_proveedor = document.createElement("li");
                var li_monto = document.createElement("li");
                var li_fecha = document.createElement("li");
                var hr = document.createElement("hr");
                //GENERANDO LA INFORMACION DE LOS proveedores
                estado_orden = estado;
                $(".aprobar").css("color", "#109911");
                $(".print_pdf").css("color", "#991011");
                $(".printer").css("color", "#ff5733");
                li_estado.name = "estado[]";
                li_estado.className = "estado_";
                li_estado.id = "estado_";


                li_estado.innerHTML = "Estado: ".bold() + estado;
                li_order.innerHTML = "Orden: ".bold() + order_id;
                li_proveedor.innerHTML = "Proveedor: ".bold() + proveedor;
                li_monto.innerHTML = "Total: ".bold() + numberFormat2.format(monto);
                li_fecha.innerHTML = "Estado: ".bold() + fecha;

                //capa imprime la informacion
                $(".estado_").css("color", "#109911");
                if(estado == "pendiente"){ 
                    capa.appendChild(ul);
                    capa.appendChild(li_fecha);
                    capa.appendChild(li_order);
                    capa.appendChild(li_proveedor);
                    capa.appendChild(li_monto);
                    capa.appendChild(li_estado);
                    $("#info_orders").append(boton_edit);
                    $("#info_orders").append(boton_pdf);
                    $("#info_orders").append(boton_aprobar);
                    capa.appendChild(hr);
                    $(".estado_").css("color", "#991005");
           
                }else{
                    capa.appendChild(ul);
                    capa.appendChild(li_fecha);
                    capa.appendChild(li_order);
                    capa.appendChild(li_proveedor);
                    capa.appendChild(li_monto);
                    capa.appendChild(li_estado);
                    $("#info_orders").append(boton_pdf);
                    capa.appendChild(hr); 
                
                }
               
            });

        })
        .fail(function (e) {});

}



function getOrderList_filter() { //ESTO TRAE LA INFORMACION DEL LAS ORDENES Y LAS PINTA
    let datas = $("#input_search_orders").val();

    $.ajax({
            url: "../ajax/ajax_get_order_shop_filter.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
                dato: datas,
            },
        })
        .done(function (d) {
            clear_table()
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let proveedor = item.proveedor;
                let order_id = item.order_id;
                let monto = item.result;
                let fecha = item.order_date;
                let estado = item.estado;


                let boton_edit = '<li class="botones_orders">|<i class="far fa-edit fa-1x printer" onclick="editOrder(' + order_id + ')" id="id_edit"></i></li>';
                let boton_pdf = '<li class="botones_orders">|<a href="../print_order_value.php?order=' + order_id + '"><i class="fas fa-file-invoice fa-1x print_pdf mb-2"></i></a></li>';
                let boton_aprobar = '<li class="botones_orders" data-bs-toggle="modal" data-bs-target="#modal_update_info" onclick="getInfoUser(' + order_id + ')">|<i class="fas fa-check-circle fa-1x aprobar mb-2" ></i></li>';
                var capa = document.getElementById("info_orders");
                $(".aprobar").css("color", "#109911");
                $(".print_pdf").css("color", "#991011");
                $(".printer").css("color", "#ff5733");

                var ul = document.createElement("ul");
                var li_estado = document.createElement("li");
                var li_order = document.createElement("li");
                var li_proveedor = document.createElement("li");
                var li_monto = document.createElement("li");
                var li_fecha = document.createElement("li");
                var hr = document.createElement("hr");
                //GENERANDO LA INFORMACION DE LOS proveedores
    
                estado_orden = estado;
                li_estado.name = "estado[]";
                li_estado.className = "estado_";
                li_estado.id = "estado_";
                li_estado.innerHTML = "Estado: ".bold() + estado;
                li_order.innerHTML = "Orden: ".bold() + order_id;
                li_proveedor.innerHTML = "Proveedor: ".bold() + proveedor;
                li_monto.innerHTML = "Total: ".bold() + numberFormat2.format(monto);
                li_fecha.innerHTML = "Fecha: ".bold() + fecha;
            //capa imprime la informacion
            $(".estado_").css("color", "#109911");
            if(estado == "pendiente"){ 
                capa.appendChild(ul);
                capa.appendChild(li_fecha);
                capa.appendChild(li_order);
                capa.appendChild(li_proveedor);
                capa.appendChild(li_monto);
                capa.appendChild(li_estado);
                $("#info_orders").append(boton_edit);
                $("#info_orders").append(boton_pdf);
                $("#info_orders").append(boton_aprobar);
                capa.appendChild(hr);
                $(".estado_").css("color", "#991005");
       
            }else{
                capa.appendChild(ul);
                capa.appendChild(li_fecha);
                capa.appendChild(li_order);
                capa.appendChild(li_proveedor);
                capa.appendChild(li_monto);
                capa.appendChild(li_estado);
                $("#info_orders").append(boton_pdf);
                capa.appendChild(hr); 
            
            }
            });

        })
        .fail(function (e) {});

}
//OBTENER Y PINTAR PROVEEDORES EN ORDERS
function getProviersOrders() { //ESTO TRAE LA INFORMACION de los proveedores
    $.ajax({
            url: "../ajax/ajax_get_providers.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
            },
        })
        .done(function (d) {
            clear_table_provider_order()
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let compania = item.empresa;
                let id_compania = item.codigo;
                let asesor = item.asesor;
                let telefono_asesor = item.telefono_asesor;

                var capa = document.getElementById("info_prodivers_orders");
                var ul = document.createElement("ul");
                var li_empresa = document.createElement("li");
                var li_asesor = document.createElement("li");
                var li_codigo = document.createElement("li");
                var li_telefono = document.createElement("li");
                var hr = document.createElement("hr");
                let new_compania = compania;
               let  paramentroFinal=id_compania+","+"'"+compania+"'";
               /*  let boton_generate = "<button class='btn btn-primary mt-2' data-bs-toggle='modal' data-bs-target='#exampleModal_create_order_by_provider' onclick='get_data_items_modal_provider("+id_compania+","+compania+")' id='generate_order_item'><i class='far fa-plus-square'></i></button>"; */
                let boton_generate = '<button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal_create_order_by_provider" onclick="get_data_items_modal_provider(' + paramentroFinal + ')" id="generate_order_item"><i class="far fa-plus-square"></i></button>';

                //GENERANDO LA INFORMACION DE LOS proveedores

                li_codigo.innerHTML = "ID COMPAÑIA: ".bold() + id_compania;
                li_empresa.innerHTML = "COMPAÑIA: ".bold() + compania.toUpperCase();
                li_asesor.innerHTML = "ASESOR: ".bold() + asesor.toUpperCase();
                li_telefono.innerHTML = "TELEFONO: ".bold() + telefono_asesor;

                //capa imprime la informacion
                capa.appendChild(ul);
                capa.appendChild(li_codigo);
                capa.appendChild(li_empresa);
                capa.appendChild(li_asesor);
                capa.appendChild(li_telefono);
                $("#info_prodivers_orders").append(boton_generate);
                capa.appendChild(hr);
            });

        })
        .fail(function (e) {});

}

function getProviersOrders_filter() { //ESTO TRAE LA INFORMACION de los proveedores

    let dato = $("#input_search_providers_orders").val();
    $.ajax({
            url: "../ajax/ajax_get_providers_filter.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
                dato: dato,
            },
        })
        .done(function (d) {
            clear_table_provider_order()
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let compania = item.empresa;
                let id_compania = item.codigo;
                let asesor = item.asesor;
                let telefono_asesor = item.telefono_asesor;
                var capa = document.getElementById("info_prodivers_orders");
                var ul = document.createElement("ul");
                var li_empresa = document.createElement("li");
                var li_asesor = document.createElement("li");
                var li_codigo = document.createElement("li");
                var li_telefono = document.createElement("li");
                var hr = document.createElement("hr");
                let  paramentroFinal=id_compania+","+"'"+compania+"'";
                /*  let boton_generate = "<button class='btn btn-primary mt-2' data-bs-toggle='modal' data-bs-target='#exampleModal_create_order_by_provider' onclick='get_data_items_modal_provider("+id_compania+","+compania+")' id='generate_order_item'><i class='far fa-plus-square'></i></button>"; */
                 let boton_generate = '<button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal_create_order_by_provider" onclick="get_data_items_modal_provider(' + paramentroFinal + ')" id="generate_order_item"><i class="far fa-plus-square"></i></button>';
 
                li_codigo.innerHTML = "ID COMPAÑIA: ".bold() + id_compania;
                li_empresa.innerHTML = "COMPAÑIA: ".bold() + compania.toUpperCase();
                li_asesor.innerHTML = "ASESOR: ".bold() + asesor.toUpperCase();
                li_telefono.innerHTML = "TELEFONO: ".bold() + telefono_asesor;
                //capa imprime la informacion
                capa.appendChild(ul);
                capa.appendChild(li_codigo);
                capa.appendChild(li_empresa);
                capa.appendChild(li_asesor);
                capa.appendChild(li_telefono);
                $("#info_prodivers_orders").append(boton_generate);
                capa.appendChild(hr);

            });

        })
        .fail(function (e) {});

}
//consultando e imprimiendo items asociados 
function getProductsOrders() { //ESTO TRAE LA INFORMACION de los proveedores
    $.ajax({
            url: "../ajax/ajax_get_products_orders.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
            },
        })
        .done(function (d) {
            clear_table_products_order()
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let compania = item.empresa;
                let contratipo = item.contratipo;
                let item_id = item.id;
                let precio = item.precio;
                let id_compania = item.codigo;
                var capa = document.getElementById("info_products_orders");
                var ul = document.createElement("ul");
                var li_empresa = document.createElement("li");
                var li_contratipo = document.createElement("li");
                var li_codigo = document.createElement("li");
                var li_precio = document.createElement("li");
                var hr = document.createElement("hr");
                let  info=id_compania+","+"'"+compania+"'"+','+item_id+','+"'"+contratipo+"'"+','+precio;
                let boton_generate = '<button class="btn btn-warning mt-2 generate_order_item" data-bs-toggle="modal"  onclick="printItemProviderData('+info+')" data-bs-target="#staticBackdrop_generate_order_by_item" id="generate_order_item"><i class="far fa-plus-square"></i></button>';
                li_codigo.innerHTML = "ITEM ID: ".bold() + item_id;
                li_contratipo.innerHTML = "CONTRATIPO: ".bold() + contratipo.toUpperCase();
                li_precio.innerHTML = "PRECIO: ".bold() + numberFormat2.format(precio);
                li_empresa.innerHTML = "PROVEEDOR: ".bold() + compania.toUpperCase();
                //capa imprime la informacion
                id_compañia_order = id_compania;
                compañia_order = compania;
                item_id_order = item_id;
                contratipo_order = contratipo;
                precio_order = precio;
                capa.appendChild(ul);
                capa.appendChild(li_codigo);
                capa.appendChild(li_contratipo);
                capa.appendChild(li_empresa);
                capa.appendChild(li_precio);
                $("#info_products_orders").append(boton_generate);
                capa.appendChild(hr);
            });

        })
        .fail(function (e) {});

}

function getProductsOrders_filter() { //ESTO TRAE LA INFORMACION de los proveedores
    let dato = $("#input_search_products_orders").val();
    $.ajax({
            url: "../ajax/ajax_get_products_orders_filter.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
                dato: dato
            },
        })
        .done(function (d) {
            clear_table_products_order()
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let compañia = item.empresa;
                let contratipo = item.contratipo;
                let item_id = item.id;
                let precio = item.precio;

                var capa = document.getElementById("info_products_orders");
                var ul = document.createElement("ul");
                var li_empresa = document.createElement("li");
                var li_contratipo = document.createElement("li");
                var li_codigo = document.createElement("li");
                var li_precio = document.createElement("li");
                var hr = document.createElement("hr");
                li_codigo.innerHTML = "ITEM ID: ".bold() + item_id;
                li_contratipo.innerHTML = "CONTRATIPO: ".bold() + contratipo.toUpperCase();
                li_precio.innerHTML = "PRECIO: ".bold() + numberFormat2.format(precio);
                li_empresa.innerHTML = "PROVEEDOR: ".bold() + compañia.toUpperCase();

                //capa imprime la informacion

                capa.appendChild(ul);
                capa.appendChild(li_codigo);
                capa.appendChild(li_contratipo);
                capa.appendChild(li_empresa);
                capa.appendChild(li_precio);

                capa.appendChild(hr);

            });

        })
        .fail(function (e) {});

}
//pintando datos para generar orden de cmompra apartir del proveedor
function get_data_items_modal_provider(val_1 ,val_2) { 

    
    $("#provider_selected_orders").val(val_2);
    $("#id_provider_").val(val_1);
    let dato = $("#id_provider_").val();
    $.ajax({
            url: "../ajax/ajax_get_items_provider.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1",
                id_provider: val_1
            },
        })
        .done(function (d) {
            clear_table_provider_items_();
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let compañia = item.empresa;
                let contratipo = item.contratipo;
                let item_id = item.id;
                let precio = item.precio;

                var capa = document.getElementById("list_items_data_provider");
                var ul = document.createElement("ul");
                var li_empresa = document.createElement("li");
                var li_contratipo = document.createElement("li");
                var li_codigo = document.createElement("li");
                var li_precio = document.createElement("li");
                var hr = document.createElement("hr");



                li_codigo.innerHTML = "ITEM ID: ".bold() + item_id;
                li_contratipo.innerHTML = "CONTRATIPO: ".bold() + contratipo.toUpperCase();
                li_precio.innerHTML = "PRECIO: ".bold() + numberFormat2.format(precio);
                li_empresa.innerHTML = "PROVEEDOR: ".bold() + compañia.toUpperCase();

                //capa imprime la informacion

                capa.appendChild(ul);
                capa.appendChild(li_codigo);
                capa.appendChild(li_contratipo);
  /*               capa.appendChild(li_empresa); */
                capa.appendChild(li_precio);

                capa.appendChild(hr);

            });

        })
        .fail(function (e) {});

}

function get_data_items_modal_provider_filter() { 
    let dato = $("#id_provider_").val();
    let dato_search = $("#search_item_provider").val();
 
    $.ajax({
            url: "../ajax/ajax_get_items_provider.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q2",
                id_provider: dato,
                item_id: dato_search
            },
        })
        .done(function (d) {
            document.getElementById("list_items_data_provider").innerHTML = "";
            console.log("search: "+dato_search);
            console.log("PROVEEDOR"+dato);
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {

                let compañia = item.empresa;
                let contratipo = item.contratipo;
                let item_id = item.id;
                let precio = item.precio;

                var capa = document.getElementById("info_products_orders");
                var ul = document.createElement("ul");
                var li_empresa = document.createElement("li");
                var li_contratipo = document.createElement("li");
                var li_codigo = document.createElement("li");
                var li_precio = document.createElement("li");
                var hr = document.createElement("hr");



                li_codigo.innerHTML = "ITEM ID: ".bold() + item_id;
                li_contratipo.innerHTML = "CONTRATIPO: ".bold() + contratipo.toUpperCase();
                li_precio.innerHTML = "PRECIO: ".bold() + numberFormat2.format(precio);
                li_empresa.innerHTML = "PROVEEDOR: ".bold() + compañia.toUpperCase();

                //capa imprime la informacion

                capa.appendChild(ul);
                capa.appendChild(li_codigo);
                capa.appendChild(li_contratipo);
            /*     capa.appendChild(li_empresa); */
                capa.appendChild(li_precio);

                capa.appendChild(hr);

            });

        })
        .fail(function (e) {});

}
//  funcion para editar las ordenes de compra
function editOrder(data) {
    console.log(data);
    Swal.fire({
        title: 'Deseas Editar Esta Orden De Compra?',
        icon: 'info',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Si`,
        denyButtonText: `No`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "../ajax/ajax_get_items_edit.php",
                data: {
                    key: 'Q1',
                    order: data
                },
                success: function (r) {
                    console.log(r);
                    if (r != 0 && !isNaN(r)) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Listo para editar!!",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        //simulando click 
                        $("#edit").trigger("click");
                        limpiar_table()
                        $.ajax({
                                url: "../ajax/ajax_get_items_edit.php",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    key: "Q2",
                                    order: data,
                                },
                            })
                            .done(function (d) {
                                /*     console.log(d); */
                                d.retornolosdatos.forEach((item) => {
                                    let id = item.id;
                                    let order_id = item.order_id;
                                    let proveedor = item.proveedor;
                                    let item_name = item.item_name;
                                    let quantity = item.cantidad;
                                    let item_unitario = item.item_unitario;
                                    let resultado = item.item_total;

                                    /*  var capa = document.getElementById("info_2");  */

                                    let boton_proveedores = '<button class="btn btn-danger mt-2 printer" onclick="deletedata(' + id + ',' + order_id + ')" id="proveedor"><i class="fas fa-trash-alt"></i></button>';
                                    let td = document.createElement("td");
                                    var capa = document.getElementById("info_2");
                                    var tr = document.createElement("tr");
                                    var td_item = document.createElement("td");
                                    var td_order = document.createElement("td");
                                    var td_compañia = document.createElement("td");
                                    var td_quantity = document.createElement("td");
                                    var td_i_unitario = document.createElement("td");
                                    var td_resultado = document.createElement("td");

                                    td_item.innerHTML = item_name;
                                    td_order.innerHTML = order_id;
                                    td_compañia.innerHTML = proveedor;
                                    td_quantity.innerHTML = quantity;
                                    td_i_unitario.innerHTML = numberFormat2.format(item_unitario);
                                    td_resultado.innerHTML = numberFormat2.format(resultado);
                                    //capa imprime la informacion
                                    capa.appendChild(tr);
                                    capa.appendChild(td_order);
                                    capa.appendChild(td_compañia);
                                    capa.appendChild(td_item);
                                    capa.appendChild(td_quantity);
                                    capa.appendChild(td_i_unitario);
                                    capa.appendChild(td_resultado);
                                    $("#info_2").append(boton_proveedores);
                                });

                            })
                            .fail(function (e) {});
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Algo salio mal!, el item seleccionado no se edito correctamente.",
                            showConfirmButton: false,
                            timer: 1500,
                        });


                    }
                },
            });
        } else if (result.isDenied) {
            Swal.fire('Cancelaste la operación.', '', 'info')
        }
    })
}

//funciones para cargar mercancia, subir facturas, cambiar estados, generar el ingreso.
function getInfoUser(data) {

    $.ajax({
        url: '../ajax/ajax_get_info.php',
        type: 'POST',
        dataType: 'json',
        data: {
            key: 'Q1',
            order: data
        }
    }).done(function (d) {
        let creator_demo = d.resultado.user_create;
        let creator = creator_demo.replace("&nbsp;", " ");
        let total = numberFormat2.format(d.resultado.result);
        $("#orders").val(d.resultado.order_id);
        $("#date").val(d.resultado.order_date);
        $("#creator").val(creator.toUpperCase());
        $("#provider").val(d.resultado.proveedor);
        $("#result_").val(total);
        //IMPRIMIENDO ITEMS
        $.ajax({
            url: '../ajax/ajax_print_items.php',
            type: 'POST',
            dataType: 'json',
            data: {
                order: data
            }
        }).done(function (d) {
            clear_table_modal()
            d.retornolosdatos.forEach((item) => {
                console.log(item);
                var capa = document.getElementById("info_items_order");
                var tr = document.createElement("tr");
                var input = document.createElement("input");
                var input_2 = document.createElement("input");
                var input_3 = document.createElement("input");
                var td_code = document.createElement("td");
                var td_name = document.createElement("td");
                var td_result = document.createElement("td");
                var td_input_2 = document.createElement("td");
                var td_input_3 = document.createElement("td");
                var td_quantity = document.createElement("td");
                let code_item = item.item_id;
                let code_name = item.item_name;
                let code_quantity = item.cantidad;
                let code_unitario = item.item_unitario;
                let order_id = item.order_id;
                let result = item.item_total;
                td_code.innerHTML = code_item;
                td_name.innerHTML = code_name;
                td_result.innerHTML = numberFormat2.format(result);
                td_quantity.innerHTML = code_quantity
                input.value = code_quantity;
                input.name = "item_quantity[]";
                input.id = "quanty_itemss";
                input.className = "quanty_items";
                input_2.value = code_item;
                input_2.name = "item_code[]";
                input_2.className = "item_codes";
                input_2.attributes = {
                    readonly: true
                };
                let boton_editar = '<td><i class="far fa-edit edit" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="print_edit_item_data(' + code_item + ',' + order_id + ')"></i></td>';
                //metiendo input dentro del td 
                td_input_3.innerHTML = numberFormat2.format(code_unitario);
                td_input_3.name = "item_unitario[]";
                td_input_3.className = "item_unitario";
                td_input_3.attributes = {
                    readonly: true
                };

                //capa imprime la informacion 
                capa.appendChild(tr);
                capa.appendChild(td_code);
                capa.appendChild(td_name);
                capa.appendChild(td_input_3);
                capa.appendChild(td_quantity);
                capa.appendChild(td_result);
                $("#info_items_order").append(boton_editar);
            });

        }).fail(function (e) {});

    }).fail(function (e) {});
}

//funcin para cargar mercancia, ingresar factura, cargar pdf, actualizar stock 
function print_edit_item_data(data_1, data_2) {

    console.log(data_1, data_2);

    $.ajax({
        url: '../ajax/ajax_get_info_2.php',
        type: 'POST',
        dataType: 'json',
        data: {

            item_id: data_1,
            order: data_2,
        }
    }).done(function (d) {
        let item_id = d.resultado.item_id;
        let order = d.resultado.order_id;;
        let quantity = d.resultado.cantidad;
        let unitario = d.resultado.item_unitario;
        $("#item_order_id").val(order);
        $("#code_item").val(item_id);
        $("#order_item_quantity").val(quantity);
        $("#item_unitary_price").val(unitario);

    }).fail(function (e) {});
    //enviando ajax para printar datos y editar la informacion del item seleccionado
}

function edit_item_order_data() {
    var datos = $("#form_").serialize();
    console.log(datos);

    $.ajax({
        type: "POST",
        url: "../ajax/ajax_change_item.php",
        data: datos,
        success: function (r) {
            console.log(r);
            if (r != 0) {
                getInfoUser(r)
                //SI ES DISTINTO A 0 Y ES UN NUMERO
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Exitoso!!',
                    text: 'El item se a editado con exito',
                    showConfirmButton: false,
                    timer: 1500
                })

                $("#hide_modal_edit_item").trigger("click");

                console.log(datos);
            } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salio mal!!',
                    footer: '<a href="">Contactar al desarrollador</a>'
                })
                console.log(datos);
            }
        }
    });
    return false;



}

function onSubmitForm() {
    Swal.fire({
        icon: 'info',
        title: 'Estas Seguro?',
        text: 'Estas seguro de finalizar esta orden de compra?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Si, Estoy Seguro`,
        denyButtonText: `No, Cancelar`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var frm = document.getElementById('form1');
            var data = new FormData(frm);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    var msg = xhttp.responseText;
                    if (msg == 'success') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Consulta Exitosa!!',
                            text: msg,
                            showConfirmButton: false,
                            timer: 2000
                        })

                        $("#profile-tab").trigger('click');
                        $(".btn-close").trigger('click');
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Algo salio mal!!',
                            text: msg,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }

                }
            };
            xhttp.open("POST", "../ajax/ajax.php", true);
            xhttp.send(data);
            /*  $('#form1').trigger('reset'); */
        } else if (result.isDenied) {
            Swal.fire('Cancelaste la operacion!', '', 'info')
        }
    })

}

function muestreo_data(var_data) {

    console.log("este es mi estado actual" + var_data);
    if (var_data == "pendiente") {
        $(".estado_").css("color", "#990500");
    } else if (var_data == "finalizado") {
        $(".estado_").css("color", "#015211");
        $('.printer').hide();
        $('.aprobar').hide();
    }
}


function getFacturaList() {
    $.ajax({
            url: "../ajax/ajax_get_facturas.php",
            type: "POST",
            dataType: "json",
            data: {
                key: "Q1"
            },
        })
        .done(function (d) {
            clear_table()
            /*     console.log(d); */
            d.retornolosdatos.forEach((item) => {
                let proveedor = item.proveedor;
                let order_id = item.order_id;
                let monto = item.result;
                let fecha = item.order_date;
                let estado = item.estado;
                let factura = item.factura;
                let url_pdf = item.url_pdf;
                var capa = $('#info_facturas').val();
                let boton_factura = '<td><a href="../ajax/' + url_pdf + '">' + factura + '</a></td>';
                let boton_pdf = '<td><a href="../print_order_value.php?order=' + order_id + '">' + order_id + '</a></td>';
                let boton_aprobar = '<td><i class="fas fa-check-circle comprobante fa-1x mb-2"  data-bs-toggle="modal" data-bs-target="#exampleModal_comprobante"></i></td>';

                $('.comprobante').click(function (factura) {

                    console.log("ENTRE OKAY");
                    $.ajax({
                        url: '../ajax/ajax_print_data_factura.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            factura: factura,
                        }
                    }).done(function (d) {
                        console.log(d);
                        let facturaS = d.resultado.factura;
                        let orderS = d.resultado.order_id;
                        $("#factura").val(facturaS);
                        $("#order").val(orderS);
                    }).fail(function (e) {});

                });

                let td_estado = document.createElement("td");
                var capa = document.getElementById("info_facturas");
                var tr = document.createElement("tr");
                var td_order = document.createElement("td");
                var td_proveedor = document.createElement("td");
                var td_monto = document.createElement("td");
                var td_fecha = document.createElement("td");
                var td_pdf = document.createElement("td");
                var td_aprobar = document.createElement("td");

                td_fecha.innerHTML = fecha;
                td_pdf.innerHTML = boton_pdf;
                td_aprobar.innerHTML = boton_aprobar;
                td_order.innerHTML = order_id;
                td_monto.innerHTML = numberFormat2.format(monto);
                td_proveedor.innerHTML = proveedor;
                td_estado.innerHTML = estado;

                td_estado.name = "estado[]";
                td_estado.className = "estado_";
                td_estado.id = "estado_";

                estado_orden = estado;

                /*  muestreo_data(estado_orden) */


                //capa imprime la informacion
                capa.appendChild(tr);
                capa.appendChild(td_fecha);
                $("#info_facturas").append(boton_factura);
                $("#info_facturas").append(boton_pdf);
                capa.appendChild(td_proveedor);
                capa.appendChild(td_monto);
                capa.appendChild(td_estado);
                capa.appendChild(td_order);
                $("#info_facturas").append(boton_aprobar);
                /*   capa.appendChild(td_pdf);
                  capa.appendChild(td_aprobar); */
            });

        })
        .fail(function (e) {});

}

//funcion para enlazar items en el tab orders de la

function enlazarItemOrders() {
    let proveedors = $(".prodiver_info").val();
    let producto = $("#buscar_items_enlace").val();
    let precio = $("#price_enlace").val();


    Swal.fire({
        icon: 'info',
        title: 'Deseas Enlazar Este Producto?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si, Seguro',
        denyButtonText: `No,Verificar datos`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            $.ajax({
                url: '../ajax/ajax_enlazar_items.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    key: 'Q1',
                    proveedor: proveedors,
                    producto: producto,
                    precio: precio
                }
            }).done(function (d) {
                console.log(d);
                if (d != 0) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto Enlazado Con Exito!!',
                        text: 'EL item ' + producto + ' Fue enlazado correctamente con el proveedor ' + proveedors,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    getProductsOrders()
                    $("#btn-close").trigger('click');
                    proveedors = $(".prodiver_info").val("");
                    producto = $("#buscar_items_enlace").val("");
                    precio = $("#price_enlace").val("");
                }
            }).fail(function (e) {

                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Algo salio mal!!',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    })
}

//funcion para pintar datos en el modal que crea la orden de compra apartir de un item

 function printItemProviderData(id_compañia_order,compañia_order, item_id_order, contratipo_order, precio_order ) { 
  
   
   
    let provider_id = id_compañia_order;
    let provider_name = compañia_order;
    let item_id = item_id_order;
    let item_name = contratipo_order;
    let price = precio_order;
    
 $("#item_id_orders_select").val(item_id);
 $("#item_name_orders_select").val(item_name);
 $("#provider_orders_select").val(provider_name);
 $("#id_proveedor").val(provider_id);
 $("#price_item_selected").val(price);
 let quantity = document.getElementById("quantity_item_selected").value; 
  cantidad_i = (document.getElementById("quantity_item_selected").value); 
  resultt_i = ($('#result_item_selected').val());
 let total = 0;
/*  $("#quantity_item_selected").on("keyup", function () {
     
     total = parseFloat(costo * quantity);
     $('#result_item_selected').val(total);

     
    }); */


 $("#solicitar_item_order").on("click", function () {
    $.ajax({
        type: "POST",
        url: "../ajax/ajax_upload_information.php",
        data: { 
            id_proveedor: provider_id,
            proveedor: provider_name,
            costo: price,
            item_id: item_id,
            item_name: item_name,
            cantidad: cantidad_i,
            resultado: resultt_i
        },
        success: function (r) {
            console.log(r);
            if (r != 0 && r != "i_a") {

                items_table()
                clear_form()
                //SI ES DISTINTO A 0 Y ES UN NUMERO
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Nueva Orden Exitosa!!',
                    text: 'la orden de compra' + r + 'se agrego con exito',
                    showConfirmButton: false,
                    timer: 1500
                })

                $("#close_modal_items").trigger('click');
                $("#order_open_create").trigger('click');

               
            } else if (r == "i_a") {

                items_table()
                clear_form()
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Nuevo Item!!',
                    text: 'Item agregado con exito!!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salio mal!!',
                    footer: '<a href="">Contactar al desarrollador</a>'
                })
               
            }
        }
    });
    return false;
 });


 }

 function calculate_in_modal(){
    cantidad_i = document.getElementById("quantity_item_selected").value; 
    let costo = $('#price_item_selected').val();

    cantidad_i = parseInt(document.getElementById("quantity_item_selected").value); 
    
    resultt_i = parseFloat(costo * cantidad_i);
    $('#result_item_selected').val(resultt_i);
 }
 
 function createProviderOrders(){
    Swal.fire({
        title: '¿Estas Seguro?',
        text: '¿Deseas agregar este proveedor?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si, Seguro',
        denyButtonText: `No, validar Datos`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var datos = $('#form_provider').serialize();
            $.ajax({
                type: "POST",
                url: "../ajax/ajax_create_provider.php",
                data: datos,
                success: function(r) {
                    
                    if (r != 0) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Operacion Exitosa!!',
                            text: r+' Fue agregado con exito.',
                            showConfirmButton: false,
                            timer: 2000
                          })
                          getProviersOrders()
                          $("#close_modal_create_provider_orders").trigger('click');
                    } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                    
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Operacion Fallida!!',
                            text: 'Algo salio mal.',
                            showConfirmButton: false,
                            timer: 2000
                          })
                    }
                }
            });
            return false;
        } else if (result.isDenied) {
          Swal.fire('Cancelaste la operacion', '', 'info')
        }
      })

    
  
 }
