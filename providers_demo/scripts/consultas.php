
<?php
include '../../globals.php';

$sql = $cnx->query("SELECT * FROM clientes LIMIT 20");
foreach ($sql as $data) {
    $nombres = $data['nombres'];
    print_r($nombres);
} 