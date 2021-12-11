
 $(document).ready(function() {
$("#buscar_productos").on('keyup', function() {
    //ajax para imprimir info de la abla
  $.ajax({
      url: './methods/conexion_items.php',
      type: 'POST',
      dataType: 'json',
      data: {
          key: 'Q1',
          codigo_item: $(this).val(),
      }
  }).done(function(d) {
      console.log(d);
      let padre = $("#info_item").parent().parent();
      padre.find("[name^=id]").val(d.resultado.id);
      padre.find("[name^=contratipo]").val(d.resultado.contratipo);
      padre.find("[name^=stock]").val(d.resultado.stock);
  }).fail(function(e) {
      console.log(e);
  });

});

//insert_info
$('#send_info').click(function() {
    Swal.fire({
        icon:'warning',
        title: '¿Estas seguro?',
        text: '¿Estas seguro de cargar esta informacion?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Si, Estoy Seguro`,
        denyButtonText: `No, Cancelar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
         
          var datos = $('#form_1').serialize();
          $.ajax({
              type: "POST",
              url: "ajax/ajax_upload_info.php",
              data: datos,
              success: function(r) {
                  console.log(r);
                  if (r != 0 && !isNaN(r)) { 
                
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Agregado Con exito!',
                        showConfirmButton: false,
                        timer: 1500
                      })
      
                      console.log(datos);
                  } else { 
                      console.log(datos);
                      Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Upps Algo Salio mal!',
                        showConfirmButton: false,
                        timer: 1500
                      })
                  }
              }
          });
          return false;
        } else if (result.isDenied) {
          Swal.fire('Verificar la informacion e intentarlo de nuevo.', '', 'info')
        }
      })
  
});


$('.modal').modal();

function limpiar_modal_cart() {
    // $('#info_cart').val('');
    console.log("limpiando data");
    document.getElementById("info").innerHTML = "";
    Total_format = 0;
  }

//informacion en el modal
// function getInfoUser(data){
    $('#open_modal_information').click(function() {
    let data = document.getElementById("user_id").value; 
    $.ajax({
        url: './methods/get_modal_info.php',
        type: 'POST',
        dataType: 'json',
        data: {
            key: 'Q1',
            users_id: data
        }
      }).done(function(d) {
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
          var td_user = document.createElement("td");
          var td_name = document.createElement("td");
          // var td_date = document.createElement("td");
          // var td_status = document.createElement("td");
          var td_quantity = document.createElement("td");
    
          //valores formateadores
          //variables 
          let code_item = item.item_code;
          let code_name = item.item_name;
          let code_quantity = item.new_stock;
          let user = item.user;
          td_code.innerHTML = code_item;
          td_user.innerHTML = user;
          td_name.innerHTML = code_name;
          input.value = code_quantity;
          input.name = "item_quantity[]";
          input.id = "quanty_itemss";
          input.className = "quanty_items";
          input_2.value = code_item;
          input_2.name = "item_code[]";
          input_2.className = "item_codes";
          input_2.attributes = {readonly: true};
          
          
          
          //capa imprime la informacion
          capa.appendChild(tr);
          capa.appendChild(input_2);
          capa.appendChild(td_name);
          capa.appendChild(td_user);
          capa.appendChild(input);
    
        
        });
    
    
          
      }).fail(function(e) {
    
      });
});

//actualizar STOCKS
$("#send_upload_stock").click(function () {
   let usuario = $("#user_name").val();
    Swal.fire({
      title: usuario,
      text:"Estas Seguro De Actualizar Este Inventario?",
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
        // var orders = $("#trans").serializeArray();
        const codess= [];
        const quantitys = [];
        // const orderss = [];
        for(i=0; i<codes.length;i++){
          codess.push(codes[i].value);
        }
        // for(i=0; i<orders.length;i++){
        //   orderss.push(orders[i].value);
        // }
  
        for(i=0; i<quantity.length;i++){
          quantitys.push(quantity[i].value);
        }
        new_c = codess.toString()
        new_q = quantitys.toString();
        // new_o = orderss.toString();
      
        $.ajax({
         type: "POST",
         url: "ajax/ajax_update_stock.php",
         data: {
           codes: new_c,
           quantity: new_q,
         },
         success: function (r) {
           console.log(r);
           if (r != 0 && !isNaN(r)) {
             //SI ES DISTINTO A 0 Y ES UN NUMERO
             Swal.fire({
               position: "top-end",
               icon: "success",
               title: "Perfecto "+usuario+"!!" ,
               text:"Los productos de esta bodega se han actualizado con exito!!",
               showConfirmButton: false,
               timer: 1500,
             });
  
             function redireccionar(){
              location.href ='index.php';
            } 
            setTimeout (redireccionar(), 4000); 
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
       

 });    

