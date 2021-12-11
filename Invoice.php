
<?php

class Invoice{
  private $user  = 'cotizar';
  private $host  = '173.230.154.140';
  private $password   = "LeinerM4ster";
  private $database  = "cotizar";
  private $invoiceUserTable = 'factura_usuarios';
  private $invoiceOrderTable = 'factura_orden';
  private $invoiceOrderItemTable = 'factura_orden_producto';
  public $dbConnect = false;
  public function __construct(){
    if(!$this->dbConnect){
    $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
    if($conn->connect_error){
        die("Error failed to connect to MySQL: " . $conn->connect_error);
    }else{
        $this->dbConnect = $conn;
    }
}
}
private function getData($sqlQuery) {
$result = mysqli_query($this->dbConnect, $sqlQuery);
if(!$result){
die('Error in query: '. mysqli_error());
}
$data= array();
while ($row = mysqli_fetch_assoc($result)) {
$data[]=$row;
}
return $data;
}
private function getNumRows($sqlQuery) {
$result = mysqli_query($this->dbConnect, $sqlQuery);
if(!$result){
die('Error in query: '. mysqli_error());
}
$numRows = mysqli_num_rows($result);
return $numRows;
}
public function loginUsers($email, $password){
$sqlQuery = "
SELECT id, email, first_name, last_name, address, mobile, id_rol
FROM ".$this->invoiceUserTable."
WHERE email='".$email."' AND password='".$password."'";
return  $this->getData($sqlQuery);
}
public function checkLoggedIn(){
if(!$_SESSION['userid']) {
header("Location:index.php");
}
}
public function saveInvoice($POST) {
$sqlInsert = "
INSERT INTO ".$this->invoiceOrderTable."(user_id, order_receiver_name,tel_client, direccion, ciudad, order_receiver_address, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note, metodopago, codigof, cedula)
VALUES ('".$POST['userId']."', '".$POST['companyName']."','".$POST['tele']."','".$POST['direccion']."','".$POST['ciudad']."', '".$POST['address']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['taxRate']."', '".$POST['totalAftertax']."', '".$POST['amountPaid']."', '".$POST['amountDue']."', '".$POST['notes']."','".$POST['metodopago']."','".$POST['leiner']."','".$POST['cedula']."')";
mysqli_query($this->dbConnect, $sqlInsert);
$lastInsertId = mysqli_insert_id($this->dbConnect);
for ($i = 0; $i < count($POST['productCode']); $i++) {
$sqlInsertItem = "
INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_unitario, order_item_price, item_categoria, order_item_final_amount)
VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."','".$POST['unitario'][$i]."', '".$POST['price'][$i]."', '".$POST['idCategoria'][$i]."', '".$POST['result'][$i]."')";
mysqli_query($this->dbConnect, $sqlInsertItem);
}
}
public function updateInvoice($POST) {
  if($POST['invoiceId']) {
    $sqlInsert = "UPDATE ".$this->invoiceOrderTable;
    $sqlInsert .= " SET order_receiver_name='$POST[companyName]', ";
    $sqlInsert .= " tel_client='$POST[tele]',";
    $sqlInsert .= " direccion='$POST[direccion]',";
    $sqlInsert .= " ciudad='$POST[ciudad]',";
    $sqlInsert .= " order_receiver_address='$POST[address]',";
    $sqlInsert .= " order_total_before_tax='$POST[subTotal]', ";
    $sqlInsert .= " order_total_tax = '$POST[taxAmount]',";
    $sqlInsert .= " order_tax_per = '$POST[taxRate]',";
    $sqlInsert .= " order_total_after_tax = '$POST[totalAftertax]',";
    $sqlInsert .= " order_amount_paid = '$POST[amountPaid]',";
    $sqlInsert .= " order_total_amount_due = '$POST[amountDue]', ";
    $sqlInsert .= " note = '$POST[notes]',";
    $sqlInsert .= " metodopago ='$POST[metodopago]',";
    $sqlInsert .= " codigof ='$POST[leiner]',";
    $sqlInsert .= " cedula ='$POST[cedula]' ";
    $sqlInsert .= " WHERE ";
    $sqlInsert .= " order_id = '$POST[invoiceId]' ";
    $sqlInsert .= " ";
    $sqlInsert .= " ";
    $this->dbConnect->query($sqlInsert);
  }



  $this->deleteInvoiceItems($POST['invoiceId']);
  foreach ($POST['productCode'] as $key => $item) {
    $sql = "  insert into  ".$this->invoiceOrderItemTable;
    $sql .= " (order_id,item_code,item_name,order_item_quantity,order_item_unitario,order_item_price,item_categoria,order_item_final_amount) ";
    $data = array();
    $data[] = $POST['invoiceId'];
    $data[] = isset($POST['productCode'][$key])?$POST['productCode'][$key]:0;
    $data[] = isset($POST['productName'][$key])?$POST['productName'][$key]:0;
    $data[] = isset($POST['quantity'][$key])?$POST['quantity'][$key]:0;
    $data[] = isset($POST['unitario'][$key])?$POST['unitario'][$key]:0;
    $data[] = isset($POST['price'][$key])?$POST['price'][$key]:0;
    $data[] = isset($POST['idCategoria'][$key])?$POST['idCategoria'][$key]:0;
    $data[] = isset($POST['result'][$key])?$POST['result'][$key]:0;
    $sql .= "VALUES ('".implode("','",$data)."')";
    $this->dbConnect->query($sql);
  }

}

public function getInvoiceList(){
$sqlQuery = "
SELECT * FROM ".$this->invoiceOrderTable."";

return  $this->getData($sqlQuery);
}
public function getInvoice($invoiceId){
$sqlQuery = "
SELECT * FROM ".$this->invoiceOrderTable."
WHERE order_id = '$invoiceId'";
$result = mysqli_query($this->dbConnect, $sqlQuery);
$row = mysqli_fetch_assoc($result);
return $row;
}
public function getInvoiceItems($invoiceId){
$sqlQuery = "
SELECT * FROM ".$this->invoiceOrderItemTable."
WHERE order_id = '$invoiceId' ORDER BY order_id DESC";
return  $this->getData($sqlQuery);
}
public function deleteInvoiceItems($invoiceId){
$sqlQuery = "
DELETE FROM ".$this->invoiceOrderItemTable."
WHERE order_id = '".$invoiceId."'";
mysqli_query($this->dbConnect, $sqlQuery);
}
public function deleteInvoice($invoiceId){
$sqlQuery = "
DELETE FROM ".$this->invoiceOrderTable."
WHERE order_id = '".$invoiceId."'";
mysqli_query($this->dbConnect, $sqlQuery);
$this->deleteInvoiceItems($invoiceId);
return 1;
}
}
?>
