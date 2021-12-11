
   function clear_table(){
    document.getElementById("informacion").innerHTML = "";
    console.log("limpiando tabla")

   }

$(document).ready(function () {
    
    $("#list").trigger("click");
    $('#send_info').click(function () {
       
        /*   var datos = $('#contenedor_info_form').serialize(); */
        var datos = $("#form_2").serialize();
        console.log(datos);
        Swal.fire({
            title: 'Estas seguro de hacer este registro?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Si, estoy seguro`,
            denyButtonText: `No, Validar Datos`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "ajax/ajax_registrar_usuario.php",
                    data: datos,
                    success: function (r) {
                        getOrderList()
                        console.log(r);
                        if (r != 0) {
                            //SI ES DISTINTO A 0 Y ES UN NUMERO
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Proceso Exitoso!!',
                                text: 'Usuario registrado con exito',
                                showConfirmButton: false,
                                timer: 1500
                            })
        
                            console.log(datos);
                        } else {
                            getOrderList() //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
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
            } else if (result.isDenied) {
              Swal.fire('Decidiste validar los datos', '', 'info')
            }
          })
       
    });


})


function getOrderList(){
    $.ajax({
        url: "ajax/ajax_get_users.php",
        type: "POST",
        dataType: "json",
        data: {
            key: "Q1"
        },
    })
    .done(function (d) {
        clear_table()
        console.log("table");
        /*     console.log(d); */
        d.retornolosdatos.forEach((item) => {

            let nombres = item.nombres;
            let id = item.id;
            let telefono = item.telefono;
            let cargo = item.cargo;
            let fecha_inicio = item.fecha_inicio;
            let fecha_final = item.fecha_final;
            let email = item.email;
            let cedula = item.cedula;

            var capa = $('#informacion').val();
            let boton_contrato = '<a href="print_contrato.php?id='+cedula+'" target="_blank"><i class="fas fa-file-signature"></i></a>';
            let boton_confidencial = '<a href="print_confidencial.php?id='+cedula+'" target="_blank"><i class="fas fa-file-pdf"></i></a>';
            let boton_otrosi = '<a href="print_otrosi.php?id='+cedula+'" target="_blank"><i class="fas fa-file-alt"></i></a>';
               let boton_prestacion = '<a href="print_prestacion.php?id='+cedula+'" target="_blank"><i class="fas fa-file-alt"></i></a>';
     
            //GENERANDO LA INFORMACION DE LOS proveedores
            /*     $('#info_proveedores').html() */
            /*   $('#info_proveedores').html(boton_proveedores) */

            var capa = document.getElementById("informacion");
            var tr = document.createElement("tr");
            let td_nombres = document.createElement("td");
            var td_cedula = document.createElement("td");
            var td_cargo = document.createElement("td");
            var td_fecha_inicio = document.createElement("td");
            var td_telefono = document.createElement("td");
            var td_contrato = document.createElement("td");
            var td_confidencial = document.createElement("td");
            var td_otrosi = document.createElement("td");
             var td_prestacion = document.createElement("td");

            td_nombres.innerHTML = nombres;
            td_cedula.innerHTML = cedula;
            td_telefono.innerHTML = telefono;
            td_cargo.innerHTML = cargo;
            td_fecha_inicio.innerHTML = fecha_inicio;
            td_contrato.innerHTML = boton_contrato;
            td_confidencial.innerHTML = boton_confidencial;
            td_otrosi.innerHTML = boton_otrosi;
            td_prestacion.innerHTML = boton_prestacion;


            //capa imprime la informacion
            capa.appendChild(tr);
            capa.appendChild(td_cedula);
            capa.appendChild(td_nombres);
            capa.appendChild(td_telefono);
            capa.appendChild(td_fecha_inicio);
            capa.appendChild(td_cargo);
                capa.appendChild(td_prestacion);
            capa.appendChild(td_contrato);
            capa.appendChild(td_confidencial);
            capa.appendChild(td_otrosi);

            /*  let button_delete = '<button class="btn deep-orange accent-4 mt-2" onclick="deletedata(' +
             code_item +
             ')" id="delete_row"><i class="large material-icons">cancel</i></button>'; */
           /*  $("#informacion").append(boton_contrato);
            $("#informacion").append(boton_confidencial);
            $("#informacion").append(boton_otrosi); */
        });

    })
    .fail(function (e) {});

}