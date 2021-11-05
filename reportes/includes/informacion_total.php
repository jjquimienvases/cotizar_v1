 <?php
    include '../scripts/consultas_sql.php';
    include '../funciones_globales.php';


    // $date = date('Y-m-d');


    //aqui las consultas 
    $puntos_de_venta = ["mostradorjj", "mostradord1", "mostrador_ibague_1", "mostrador_ibague_2", "bancolombia"];
    $comerciales = ["tamara", "maria", "sergio", "velasco", "nidia", "karen", "leiner", "michel", "elizabeth", "diego", "linda", "jimenez"];

    foreach ($puntos_de_venta as $punto) :



    ?>
     <div class="tab-pane fade show" id="<?= $punto ?>" role="tabpanel" aria-labelledby="home-tab">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
             <li class="nav-item" role="presentation">
                 <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#<?= $punto ?>-efectivas" type="button" role="tab" aria-controls="<?= $punto ?>-efectivas" aria-selected="true">Efectivas</button>
             </li>
             <li class="nav-item" role="presentation">
                 <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#<?= $punto ?>-pendientes" type="button" role="tab" aria-controls="<?= $punto ?>-pendientes" aria-selected="false">Pendientes</button>
             </li>
             <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bancolombia" type="button" role="tab" aria-controls="bancolombia" aria-selected="false">Call Center</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#mostrador_ibague_1" type="button" role="tab" aria-controls="mostrador_ibague_1" aria-selected="false">Ibague 1</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#mostrador_ibague_2" type="button" role="tab" aria-controls="mostrador_ibague_2" aria-selected="false">Ibague 2</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#call_mostrador" type="button" role="tab" aria-controls="call_mostrador" aria-selected="false">Call Center / Mostrador</button>
            </li> -->
         </ul>

         <div class="tab-pane fade show" id="<?= $punto ?>-efectivas" role="tabpanel" aria-labelledby="home-tab">
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th colspan="6" class="text-center"> Cotizaciones Efectivas <?= $punto ?></th>
                     </tr>
                     <tr>
                         <th>Fecha</th>
                         <th>Remision</th>
                         <th>Cliente</th>
                         <th>Comercial</th>
                         <th>Metodo de pago</th>
                         <th>Monto</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $consulta_mostrador = getConsultaMostrador($punto);
                        // print_r($consulta_mostrador);
                        foreach ($consulta_mostrador as $datos_mostrador) :
                            $fecha = $datos_mostrador["order_date"];
                            $cotizacion = $datos_mostrador["order_id"];
                            $cliente = $datos_mostrador["order_receiver_name"];
                            $comercial = $datos_mostrador["order_receiver_address"];
                            $metodo_de_pago = $datos_mostrador["metodo_de_pago"];
                            $monto_x = 0;

                            $total_tax = $datos_mostrador["order_total_after_tax"];
                            $total_desc = $datos_mostrador["order_total_amount_due"];

                            if ($total_desc == "0" || $total_desc == "") {
                                $monto_x = $total_tax;
                            } else {
                                $monto_x = $total_desc;
                            }
                        ?>
                         <tr>
                             <td><?= $fecha; ?></td>
                             <td><?= $cotizacion; ?></td>
                             <td><?= strtoupper($cliente); ?></td>
                             <td><?= strtoupper($comercial); ?></td>
                             <td><?= strtoupper($metodo_de_pago); ?></td>
                             <td><?= formatear($monto_x); ?></td>
                         </tr>
                     <?php endforeach ?>

                 </tbody>


             </table>
         </div>
         <div class="tab-pane fade show" id="<?= $punto ?>-pendientes" role="tabpanel" aria-labelledby="home-tab">
             <? include_once 'informacion_pendientes.php'; ?>
         </div>

     </div>

 <?php endforeach; ?>