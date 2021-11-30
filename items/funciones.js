$(document).ready(function () {
  //data table 
  var table = $(".table").DataTable({
    ajax: "ajax/ajax_get_productos.php",
    buttons: true,
    buttons: ["copy", "excel", "pdf"],
    id: "informacions",
    columns: [
      {
        data: "id",
      },
      {
        data: "contratipo",
      },
      {
        data: "genero",
      },
      {
        data: "stock",
      },
      {
         data: "ubicacion", 
      },
    //   {
    //     data: "id",
    //     width: "60px",
    //     render: function (data, type, row) {
    //       return '<button id="datas" name="id" onclick="cotizar()" class="btn btn-success btn-xs facturar">Editar</button>';
    //     },
      
    ],
  });
// consulta y opciones de muestreo de formulario
  $("#buscaritems").on("keyup", function () {
    $.ajax({
      url: "scripts/consulta_items.php",
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
        padre.find("[name^=stock]").val(d.resultado.stock);
        padre.find("[name^=ubicacion]").val(d.resultado.ubicacion);
        padre.find("[name^=unidad]").val(d.resultado.unidad);
        padre.find("[name^=categoria]").val(d.resultado.id_categoria);
        padre.find("[name^=Costo]").val(d.resultado.gramo);
        padre.find("[name^=minima]").val(d.resultado.minimo);
        padre.find("[name^=maxima]").val(d.resultado.maximo);
        padre.find("[name^=proveedor_name]").val(d.resultado.name_prov);
      })
      .fail(function (e) {});
  });
//consulta para muestreo de datos en materia prima
  $("#buscarmateria").on("keyup", function () {
    $.ajax({
      url: "scripts/consulta_materia.php",
      type: "POST",
      dataType: "json",
      data: {
        key: "Q1",
        id_materia: $(this).val(),
      },
    })
      .done(function (d) {
        let padre = $("#info_data_materia").parent().parent().parent();
        padre.find("[name^=id]").val(d.resultado.id);
        padre.find("[name^=materia]").val(d.resultado.nombre);
        padre.find("[name^=presentacion]").val(d.resultado.porcentaje);
        padre.find("[name^=costo]").val(d.resultado.costo);
        padre.find("[name^=estado]").val(d.resultado.estado);

      })
      .fail(function (e) {});
  });

  var rol_user = document.getElementById("rol").value;
  var id_user = document.getElementById("user_id").value;
  console.log("este es el id user"+id_user);
  console.log("este es el id rol"+rol_user);
  
  if (id_user == 37) {
    var stock = document.getElementById("stock");
    stock.setAttribute("enabled", "");
  } else{}

  var ubicacion = document.getElementById("ubicacion");
  var unidad = document.getElementById("unidad");
  if(id_user == 37){
    ubicacion.setAttribute("enabled", "");
    unidad.setAttribute("enabled", "");
  }else if(rol_user == 5){
    ubicacion.setAttribute("enabled", "");
    unidad.setAttribute("enabled", "");
  }else if(rol_user != 8){
    ubicacion.setAttribute("disabled", "");
    unidad.setAttribute("disabled", "");
  }else if(rol_user != 1){
    ubicacion.setAttribute("disabled", "");
    unidad.setAttribute("disabled", "");
  }else if(rol_user != 7){
    ubicacion.setAttribute("disabled", "");
    unidad.setAttribute("disabled", "");
  }else{
      
  }

  if (rol_user == 5) {
    document.getElementById("adicional").style.display = "block";
  } else if (rol_user == 8) {
    document.getElementById("adicional").style.display = "block";
  } else if (rol_user == 1) {
    document.getElementById("adicional").style.display = "block";
  } else if(rol_user == 6) {
   document.getElementById("stock").style.display = "block";
  }else{}
  //AJAX PARA ACTUALIZAR LA DATA
  $("#send_info").click(function () {
    Swal.fire({
      title: "Estas de editar la informacion de este item?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: `Si, Ejecutar`,
      denyButtonText: `No`,
      cancelButtonText: `Cancelar`,
    }).then((result) => {
      if (result.isConfirmed) {
        var datos = $("#form_1").serialize();
        $.ajax({
          type: "POST",
          url: "ajax/ajax_send_info.php",
          data: datos,
          success: function (r) {
            console.log(r);
            if (r != 0 && !isNaN(r)) {
              //SI ES DISTINTO A 0 Y ES UN NUMERO
              Swal.fire("Edicion ejecutada con exito!", "", "success");
              let padre = $("#form_1").parent().parent().parent();
              padre.find("[name^=item]").val("");
              padre.find("[name^=id]").val("");
              padre.find("[name^=stock]").val("");
              padre.find("[name^=ubicacion]").val("");
              padre.find("[name^=unidad]").val("");
              padre.find("[name^=costo]").val("");
              padre.find("[name^=minima]").val("");
              padre.find("[name^=maxima]").val("");
              padre.find("[name^=proveedor_name]").val("");
              console.log(datos);
            } else {
              //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Tu usuario no esta habilitado para ejecutar esta accion!",
                footer: "<a href = 'https://api.whatsapp.com/send?phone=573045393941' target='_blank'>Contactar al desarrollador</a>",
              });
              console.log(datos);
            }
          },
        });
        return false;
      } else if (result.isDenied) {
        Swal.fire("Cancelaste la edicion de este item", "", "info");
      }
    });
    });
    
     //AJAX PARA CREAR ITEMS
     
      $("#send_new_item").click(function () {

  Swal.fire({
    icon: "info",
    title: "¿Estas seguro de crear este producto?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Estoy seguro`,
    denyButtonText: `No, cancelar.`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var frm = document.getElementById("formUpload");
      var data = new FormData(frm);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          var msg = xhttp.responseText;
          if (msg != 0) {
            // alert(msg);
            $("#exampleModalCreate").modal("hide");
            Swal.fire("Este producto se a creado con exito en todas las bodegas!", "", "success");
            let padre = $("#formUpload").parent().parent().parent();
            padre.find("[name^=id]").val("");
            padre.find("[name^=contratipo]").val("");
            padre.find("[name^=precio]").val("");
            padre.find("[name^=genero]").val("");
            padre.find("[name^=id_categoria]").val("");
            padre.find("[name^=unidadxemp]").val("");
            padre.find("[name^=peso]").val("");
            padre.find("[name^=stock]").val("");
            padre.find("[name^=stock_minimo]").val("");
            padre.find("[name^=stock_maximo]").val("");
            padre.find("[name^=nombre_proveedor]").val("");
            padre.find("[name^=descripcion_corta]").val("");
            padre.find("[name^=descripcion_comercial]").val("");
            padre.find("[name^=imagen]").val("");
            console.log(data);
          } else {
            // alert(msg);
            Swal.fire({
              title: "No funciona :( !",
              text: "Algo no se ejecuto correctamente.",
              icon:"error",
            });
          }
        }
      };
      xhttp.open("POST", "ajax/ajax_create_item.php", true);
      xhttp.send(data);
      $("#formUpload").trigger("reset");
    } else if (result.isDenied) {
      Swal.fire("Cancelaste la creacion de es este producto", "", "info");
    }
  });
});

//actualizar la imagen 

      $("#actualizar_img").click(function () {

  Swal.fire({
    icon: "info",
    title: "¿Estas seguro de crear este producto?",
    showDenyButton: true,
    showCancelButton: true,
    confirmButtonText: `Si, Estoy seguro`,
    denyButtonText: `No, cancelar.`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      var frm = document.getElementById("formUploadImg");
      var data = new FormData(frm);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
          var msg = xhttp.responseText;
          if (msg != 0) {
            // alert(msg);
            // $("#exampleModalCreate").modal("hide");
            Swal.fire("La imagen de este producto se a actualizado!", "", "success");
          
   
            console.log(data);
          } else {
            // alert(msg);
            Swal.fire({
              title: "No funciona :( !",
              text: "Algo no se ejecuto correctamente.",
              icon:"error",
            });
          }
        }
      };
      xhttp.open("POST", "ajax/ajax_update_img.php", true);
      xhttp.send(data);
      $("#formUploadImg").trigger("reset");
    } else if (result.isDenied) {
      Swal.fire("Cancelaste la actualizacion de es este producto", "", "info");
    }
  });
});

//fin actualizar imagen

//  $("#send_new_item").click(function () {
//   Swal.fire({
//     title: "Estas seguro de editar este item?",
//     showDenyButton: true,
//     showCancelButton: true,
//     confirmButtonText: `Crear Item`,
//     denyButtonText: `No`,
//     cancelButtonText: `Cancelar`,
//   }).then((result) => {
//     if (result.isConfirmed) {
//       var datos = $("#formUpload").serialize();
//       $.ajax({
//         type: "POST",
//         url: "ajax/ajax_create_item.php",
//         data: datos,
//         success: function (r) {
//           console.log(r);
//           if (r != 0 && !isNaN(r)) {
//             //SI ES DISTINTO A 0 Y ES UN NUMERO
//             Swal.fire("Este producto se a creado con exito en todas las bodegas!", "", "success");
//             let padre = $("#formUpload").parent().parent().parent();
//             padre.find("[name^=id]").val("");
//             padre.find("[name^=contratipo]").val("");
//             padre.find("[name^=precio]").val("");
//             padre.find("[name^=genero]").val("");
//             padre.find("[name^=id_categoria]").val("");
//             padre.find("[name^=unidadxemp]").val("");
//             padre.find("[name^=peso]").val("");
//             padre.find("[name^=stock]").val("");
//             padre.find("[name^=stock_minimo]").val("");
//             padre.find("[name^=stock_maximo]").val("");
//             padre.find("[name^=nombre_proveedor]").val("");
//             console.log(datos);
//           } else {
//             //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
//             Swal.fire({
//               icon: "error",
//               title: "Oops...",
//               text: "Tu usuario no esta habilitado para ejecutar esta accion!",
//               footer: "<a href = 'https://api.whatsapp.com/send?phone=573045393941' target='_blank'>Contactar al desarrollador</a>",
//             });
//             console.log(datos);
//           }
//         },
//       });
//       return false;
//     } else if (result.isDenied) {
//       Swal.fire("Cancelaste la creacion de este item", "", "info");
//     }
//   });
//   });
    
    //AJAX PARA ACTUALIZAR MATERIA PRIMA
    $("#send_materia").click(function () {
    Swal.fire({
      title: "Estas de editar la informacion de esta materia prima?",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: `Si, Ejecutar`,
      denyButtonText: `No`,
      cancelButtonText: `Cancelar`,
    }).then((result) => {
      if (result.isConfirmed) {
        var datos = $("#form_3").serialize();
        $.ajax({
          type: "POST",
          url: "ajax/ajax_update_materia.php",
          data: datos,
          success: function (r) {
            console.log(r);
            if (r != 0 && !isNaN(r)) {
              //SI ES DISTINTO A 0 Y ES UN NUMERO
              Swal.fire("Edicion ejecutada con exito!", "", "success");
                let padre = $("#info_data_materia").parent().parent().parent();
        padre.find("[name^=id]").val("");
        padre.find("[name^=materia]").val("");
        padre.find("[name^=presentacion]").val("");
        padre.find("[name^=costo]").val("");
        padre.find("[name^=estado]").val("");
         
              console.log(datos);
            } else {
              //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Tu usuario no esta habilitado para ejecutar esta accion!",
                footer: "<a href = 'https://api.whatsapp.com/send?phone=573045393941' target='_blank'>Contactar al desarrollador</a>",
              });
              console.log(datos);
            }
          },
        });
        return false;
      } else if (result.isDenied) {
        Swal.fire("Cancelaste la edicion de este item", "", "info");
      }
    });
    });
    

  $('#ver_stocks').click(function() {
    windowObjectReference = window.open(

"../stocks/index.php",

  "DescriptiveWindowName",

  "resizable,scrollbars,status"

);
    });
    
      $("#show_woo").on( "click", function() {
    $('#info_woo').show(); //muestro mediante id
    $('#hide_woo').show();
    $("#show_woo").hide();
   });
  $("#hide_woo").on( "click", function() {
    $('#info_woo').hide(); //oculto mediante id
    $('#hide_woo').hide();
    $("#show_woo").show();
  });
  
  
    $("#actualizar_items").on("click", function () {
    $.ajax({
      url: "ajax/update_items_woo.php",
      type: "POST",
      dataType: "json",
      data: {
        id: 2
      },
    })
      .done(function (d) {
         Swal.fire("Funciona", "", "success");
        

      })
      .fail(function (e) {});
  });

  
  
  
    
});