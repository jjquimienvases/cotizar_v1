
<?php

// 'ftp.jjquimienvases.com', 'jquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar'
// pues preguntaaaa ahahaha
class Invoice{
 private $user  = 'jjquimienvases_jjadmin';
  private $host  = 'ftp.jjquimienvases.com';
  private $password   = "LeinerM4ster";
  private $database  = "jjquimienvases_cotizar";
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
    SELECT id, email, first_name, last_name, address, mobile
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
    INSERT INTO ".$this->invoiceOrderTable."(user_id, order_receiver_name, order_receiver_address, order_total_before_tax, order_total_tax, order_tax_per, order_total_after_tax, order_amount_paid, order_total_amount_due, note,metodopago)
    VALUES ('".$POST['userId']."', '".$POST['companyName']."', '".$POST['address']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['taxRate']."', '".$POST['totalAftertax']."', '".$POST['amountPaid']."', '".$POST['amountDue']."', '".$POST['notes']."','".$POST['metodopago']."')";
    mysqli_query($this->dbConnect, $sqlInsert);
    $lastInsertId = mysqli_insert_id($this->dbConnect);
    for ($i = 0; $i < count($POST['productCode']); $i++) {
      $sqlInsertItem = "
      INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount)
      VALUES ('".$lastInsertId."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";
      mysqli_query($this->dbConnect, $sqlInsertItem);
    }
  }
	public function updateInvoice($POST) {
    if($POST['invoiceId']) {

      $sqlInsert = "UPDATE ".$this->invoiceOrderTable;
      $sqlInsert .= "SET order_receiver_name=$POST[companyName], ";
      $sqlInsert .= " order_receiver_address='$POST[address]',";
      $sqlInsert .= " order_total_before_tax='$POST[subTotal]', ";
      $sqlInsert .= " order_total_tax = '$POST[taxAmount]',";
      $sqlInsert .= " order_tax_per = '$POST[taxRate]',";
      $sqlInsert .= " order_total_after_tax = '$POST[totalAftertax]',";
      $sqlInsert .= " order_amount_paid = '$POST[amountPaid]',";
      $sqlInsert .= " order_total_amount_due = '$POST[amountDue]', ";
      $sqlInsert .= " note = '$POST[notes]',";
      $sqlInsert .= " metodopago ='$POST[metodopago]',";
			$sqlInsert .= " codigo ='$POST[facturas]'";
      $sqlInsert .= " WHERE user_id = '$POST[userId]' ";
      $sqlInsert .= " AND order_id = '$POST[invoiceId]' ";
      $sqlInsert .= " ";
      $sqlInsert .= " ";


      $this->dbConnect->query($sqlInsert);
    }
    $this->deleteInvoiceItems($POST['invoiceId']);
    for ($i = 0; $i < count($POST['productCode']); $i++) {
      $sqlInsertItem = "
      INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_code, item_name, order_item_quantity, order_item_price, order_item_final_amount)
      VALUES ('".$POST['invoiceId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";
      $this->dbConnect->query($sqlInsertItem);
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
    WHERE order_id = '$invoiceId'";
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
