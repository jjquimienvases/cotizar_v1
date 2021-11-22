<?php
include '../conexion.php';
$order_id = $_POST["cotizacion"];
$documento = $_POST["document"];
$tipo_persona = $_POST["persona"];




// $documento = "NIT";
// $tipo_persona = "PERSON_JURIDICA";
// $order_id = 37165;
$json = [];
$fecha = date('Y-m-d H:i:s');
$sql_largo = $con->query("SELECT * FROM factura_id");
foreach ($sql_largo as $id_fac) {
    $customerInvoice = $id_fac["id"];
}
$customerInvoiceId = (float)$customerInvoice + 1;
try {
    $consultar_cotizacion = $con->query("SELECT * FROM factura_orden WHERE order_id = $order_id");
    $sql_productos = "";
    foreach ($consultar_cotizacion as $data) {
        $cedula = $data["cedula"];
        $sql_info_cliente = $con->query("SELECT * FROM clientes WHERE cedula = $cedula");

        foreach ($sql_info_cliente as $data_c) :
            // $data_c = (object) $data_c;
            //obtener ciudad codigo postal y municipio 
            $city_demo = $data_c["ciudad"];
            $select_city = $con->query("SELECT * FROM ciudades cd INNER JOIN municipios mp ON cd.m_id = mp.id WHERE cd.ciudad LIKE '%$city_demo%'");
            foreach ($select_city as $data_city) :
            // $id_fk = $data_city['m_id'];
            // $postal = $data_city['postal'];
            // $municipio = $data_city['municipio'];
            // $ciudad = $data_city['ciudad'];$customerInvoiceId = (float)$customerInvoice + 33;
            endforeach;

            $cc = str_replace("-", "", $cedula);
         
        endforeach;
        $sql_productos = $con->query("SELECT * FROM factura_orden_producto WHERE order_id = $order_id");
        $new_data_p = [];
        foreach ($sql_productos as $data_p) :
            $data_p = (object) $data_p;

            $ns = new stdClass;
            $ns->itemType = "GRAVADO";
            $ns->quantity = (float) $data_p->order_item_quantity;
            $ns->amount = round((float) $data_p->order_item_unitario / 1.19, 2);
            $con_iva_unitario = $data_p->order_item_unitario;
            $ns->name = "";
            $subtotal = (float) $ns->amount * $ns->quantity;
            $ns->description = $data_p->item_name;
            $ns->taxableAmount = round((float) $subtotal, 2);
            $ns->totalTax = round((float) $ns->taxableAmount * 0.19, 2);
            $ns->total = round((float) $ns->taxableAmount + $ns->totalTax, 2);
            $ns->clasificationId = "";
            $ns->clasificationName = "";
            $ns->discountPercentage = 0;
            $ns->discountAmount = 0;
            // taxAbelAmount = 
            // Amount = va sin iva 
            // Total = neto + iva 
            // neto = valor sin iva 
            // subtotal = amount * quantity 


            $taxes = new stdClass;
            $taxes->type = "IVA";
            $taxes->amount = round($ns->totalTax, 2);
            $taxes->taxableAmount = round($ns->taxableAmount, 2);
            $taxes->percentage = "19";

            $ns->taxes = [];
            $ns->taxes[] = $taxes;

            $ns->itemCode = $data_p->item_code;
            $ns->observation = "";
            $ns->isGift = false;

            $new_data_p[] = $ns;


        endforeach;
     


        $json = [$new_data_p, $data, $data_c, $fecha, $data_city, $documento, $tipo_persona, $cc, $customerInvoiceId];

        echo json_encode($json);

        return $json;
    }
} catch (\Exception $err) {
    http_response_code(500);
    echo json_encode([
        "status" => 500,
        "err" => $err
    ]);
    echo $order_id;
}
