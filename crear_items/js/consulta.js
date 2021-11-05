
// new Vue ({
//     el: "#app",
//     data: () => ({
//         materia: "",
//         presentacion: "",
//         cantidad:"",
//         user_creador: "",
//         envase_presentacion: "",
//         tapa_presentacion: "",


//     }),
//     async mounted(){
//     //  await this.CreateItem();
//     },
//     methods: {
//         consultar_data() {
//             Swal.fire({
//                 icon: "question",
//                 title: "¿Desea Generar Este Item?",
//                 text: "¿Seguro que desea generar Este Item?",
//                 confirmButtonText: "Si quiero",
//                 showCancelButton: true,
//                 cancelButtonText: "No, No quiero",
//                 confirmButtonColor: "#3085d6",
//                 cancelButtonColor: "#d33",
//               })
//                 .then(async (result) => {
//                   if (result.isConfirmed) {
//                       console.log("entre");
//                     //   var data = {
//                     //     url:"../ajax/ajax_create_item.php",
//                     //     method: "POST",
//                     //     timeout: 0,
    
//                     //   };

//                     let data = await $.get("../ajax/ajax_create_item.php");
//                     data = data;
//                     console.log(data);

//                     return;
                    
//                   }
//                 }).catch((error) => {
//                     console.log(error);
//                   });

//         },
// },
// })


$(document).ready(function() {
    $('#send_info').click(function() {
        var datos = $('#form_1').serialize();
        console.log(datos);
        $.ajax({
            type: "POST",
            url: "../ajax/ajax_create_item.php",
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
        return false;
    });
});