
<?php

class Invoice{
  private $user  = 'jjquimienvases_jjadmin';
  private $host  = 'ftp.jjquimienvases.com';
  private $password   = "LeinerM4ster";
  private $database  = "jjquimienvases_cotizar";
  private $invoiceUserTable = 'factura_usuarios';
  private $invoiceOrderTable = 'orden_compra';
  private $invoiceOrderItemTable = 'orden_compra_productos';
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
public function saveOrden($POST) {
$sqlInsert = "
INSERT INTO ".$this->invoiceOrderTable."(user_id, order_receiver_name, direccion, ciudad, note)
VALUES ('".$POST['userId']."', '".$POST['companyName']."','".$POST['direccion']."','".$POST['ciudad']."' ,'".$POST['notes']."')";
mysqli_query($this->dbConnect, $sqlInsert);
$lastInsertId = mysqli_insert_id($this->dbConnect);
for ($i = 0; $i < count($POST['productCode']); $i++) {
$sqlInsertItem = "
INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_code, item_name, order_item_quantity)
VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."')";
mysqli_query($this->dbConnect, $sqlInsertItem);
}
}


public function updateInvoice($POST) {
  if($POST['invoiceId']) {
    $sqlInsert = "UPDATE ".$this->invoiceOrderTable;
    $sqlInsert .= " SET order_receiver_name='$POST[companyName]', ";
    $sqlInsert .= " direccion='$POST[direccion]',";
    $sqlInsert .= " ciudad='$POST[ciudad]',";
    $sqlInsert .= " order_receiver_address='$POST[address]',";
    $sqlInsert .= " note = '$POST[notes]',";
    $sqlInsert .= " total = '$POST[subTotal]'";
    $sqlInsert .= " WHERE ";
    $sqlInsert .= " order_id = '$POST[invoiceId]' ";
    $sqlInsert .= " ";
    $sqlInsert .= " ";
    $this->dbConnect->query($sqlInsert);
  }



  $this->deleteInvoiceItems($POST['invoiceId']);
  foreach ($POST['productCode'] as $key => $item) {
    $sql = "  insert into  ".$this->invoiceOrderItemTable;
    $sql .= " (order_id,item_code,item_name,order_item_quantity,cantidad_numero,item_price,result)";
    $data = array();
    $data[] = $POST['invoiceId'];
    $data[] = isset($POST['productCode'][$key])?$POST['productCode'][$key]:0;
    $data[] = isset($POST['productName'][$key])?$POST['productName'][$key]:0;
    $data[] = isset($POST['cantidad'][$key])?$POST['cantidad'][$key]:0;
    $data[] = isset($POST['quantity'][$key])?$POST['quantity'][$key]:0;
    $data[] = isset($POST['price'][$key])?$POST['price'][$key]:0;
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
