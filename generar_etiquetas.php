<?php

$con = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');  

?>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <div class="container">
            <div class="row">
                <div class="buscarcliente">
                    <datalist id="buscarclient">
                        <option value="">Seleccione un item</option>
                        <?php
                        $sql = $con->query("SELECT * FROM producto_av ORDER BY id_categoria ASC");
                        while ($data = mysqli_fetch_array($sql)) {
                            echo '<option value="' . $data["id"] . '">' . $data["id"] . ',' . $data["contratipo"] . '</option>';
                        }
                        ?>
                    </datalist>
                    <div class="input-field col s6">
                        <input value="" id="buscarcliente" list="buscarclient" type="text" class="validate" placeholder="Buscar Productos">
                        <label class="active" for="buscarcliente">Buscar un item</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="text-center mt-4 text-info">
                        <h5 class="form-control">Informacion del producto seleccionado</h5>
                        <hr>
                    </div>
                    <form class="form-control" method="post" id="update_info">
                        <div class="mt-3" id="information">
                            <div class="input-field col s6">
                                <input value="" id="id" name="id" type="number" class="form-control" placeholder="Codigo O SKU" readonly>
                                <label class="active" for="id">Codigo o Item</label>
                            </div>
                            <div class="input-field col s6">
                                <input value="" id="contratipo" name="contratipo" type="text" class="form-control" placeholder="Nombre o Contratipo" readonly>
                                <label class="active" for="contratipo">Contratipo</label>
                            </div>
                            <div class="input-field col s6">
                                <input value="" id="ubicacion" name="ubicacion" type="text" class="form-control" placeholder="Ubicacion">
                                <label class="active" for="ubicacion">Ubicaci贸n</label>
                                <button class="btn btn-primary" type="button" id="execute_f">Generar Etiqueta | <i class="fas fa-file-pdf"></i></button>
                            </div>
                            <div class="input-field col s6">
                                <input value="" id="unidad" name="unidad" type="text" class="form-control" placeholder="Unidad De Empaque">
                                <label class="active" for="unidad">Unidad de empaque</label>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<script>
 $(document).ready(function({
    $("#buscarcliente").on('keyup', function() {
        $.ajax({
            url: 'methods/conexion_items.php',
            type: 'POST',
            dataType: 'json',
            data: {
                key: 'Q1',
                item: $(this).val()
            }
        }).done(function(d) {

            let padre = $("#information").parent().parent().parent();
            padre.find("[name^=id]").val(d.resultado.id);
            padre.find("[name^=contratipo]").val(d.resultado.contratipo);
            padre.find("[name^=unidad]").val(d.resultado.unidad);
            padre.find("[name^=ubicacion]").val(d.resultado.ubicacion);

        }).fail(function(e) {

        });
    })

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems, options);
    });

    // Or with jQuery

    $(document).ready(function() {
        $('.modal').modal();
    });


    $("#execute_f").on('click', function() {
        Swal.fire({
            title: 'Seguro que deseas generar esta etiqueta?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Si, estoy seguro!!`,
            denyButtonText: `No, Quiero corregir.`,
        }).then((result) => {

            if (result.isConfirmed) {

                var datos = $('#update_info').serialize();

                console.log(datos);
                $.ajax({
                    type: "POST",
                    url: "ajax/ajax_update_bodega.php",
                    data: datos,
                    success: function(r) {
                        console.log(r);
                        if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                            Swal.fire({
                                icon: 'success',
                                title: 'Guardado con exito, ¿Deseas ver la etiqueta?',
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: `Ver etiqueta`,
                                denyButtonText: `No, Actualizar otro item.`,
                            }).then((result) => {
                                if (result.isConfirmed) {
                             

                                    windowObjectReference = window.open(

                                        "print_items_etiquetas.php?etiqueta="+r,

                                        "DescriptiveWindowName",

                                        "resizable,scrollbars,status"

                                    );


                                } else if (result.isDenied) {
                                    Swal.fire('No podras recuperar esta etiqueta', '', 'info')
                                }

                            })

                            console.log(datos);
                        } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                            alert("no funciona");
                            console.log(datos);
                        }
                    }
                });
                return false;
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    })
});
</script>