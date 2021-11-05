<?php

include "../scripts/consultas_sql.php";

echo json_encode(getConsultaMostradorPendientes($punto));
