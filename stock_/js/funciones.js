

  $("#buscaritem").on('keyup', function() {
      //ajax para imprimir info de la abla
    $.ajax({
        url: './methods/conexion_items.php',
        type: 'POST',
        dataType: 'json',
        data: {
            key: 'Q1',
            codigo_item: $(this).val()
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


    //ajax para imprimir ventas
    $("#buscaritem").on('keyup', function(){
        $.ajax({
            url: './methods/conexion_items_ventas.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                codigo_item: $(this).val()
            }
        }).done(function(d) {
            console.log(d);
            let padre = $("#info_item").parent().parent();
            padre.find("[name^=cantidad_vendida]").val(d.resultado.Total);
        }).fail(function(e) {
            console.log(e);
        });
    });
    
    //ajax para imprimir salidas
    $("#buscaritem").on('keyup', function(){
        $.ajax({
            url: './methods/conexion_items_salidas.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                codigo_item: $(this).val()
            }
        }).done(function(d) {
            console.log(d);
            let padre = $("#info_item").parent().parent();
            padre.find("[name^=cantidad_salida_t]").val(d.resultado.Total);
        }).fail(function(e) {
            console.log(e);
        });
    });

    //ajax para imprimir entradas
  $("#buscaritem").on('keyup', function(){
        $.ajax({
            url: './methods/conexion_items_entradas.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                codigo_item: $(this).val()
            }
        }).done(function(d) {
            console.log(d);
            let padre = $("#info_item").parent().parent();
            padre.find("[name^=cantidad_entrada_t]").val(d.resultado.Total);
        }).fail(function(e) {
            console.log(e);
        });
    });
  //ajax para imprimir otras ventas

  $("#buscaritem").on('keyup', function(){
        $.ajax({
            url: './methods/conexion_items_ingresos.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                codigo_item: $(this).val()
            }
        }).done(function(d) {
            console.log(d);
            let padre = $("#info_item").parent().parent();
            padre.find("[name^=cantida_ingreso]").val(d.resultado.Total);
        }).fail(function(e) {
            console.log(e);
        });
    });
    
    //ajax para imprimir ingresos de mercancia
    
  $("#buscaritem").on('keyup', function(){
        $.ajax({
            url: './methods/conexion_items_gramos.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                codigo_item: $(this).val()
            }
        }).done(function(d) {
            console.log(d);
            let padre = $("#info_item").parent().parent();
            padre.find("[name^=cantidad_perfumes]").val(d.resultado.Total);
        }).fail(function(e) {
            console.log(e);
        });
    });

})


