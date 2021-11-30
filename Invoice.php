<?php
class Invoice
{
  private $user  = 'cotizar';
  private $host  = '173.230.154.140';
  private $password   = "LeinerM4ster";
  private $database  = "cotizar";
  private $invoiceUserTable = 'factura_usuarios';
  private $invoiceOrderTable = 'factura_orden';
  private $invoiceOrderItemTable = 'factura_orden_producto';
  public $dbConnect = false;
  public function __construct()
  {
    if (!$this->dbConnect) {
      $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
      if ($conn->connect_error) {
        die("Error failed to connect to MySQL: " . $conn->connect_error);
      } else {
        $this->dbConnect = $conn;
      }
    }
  }
  private function getData($sqlQuery)
  {
    $result = mysqli_query($this->dbConnect, $sqlQuery);
    if (!$result) {
      die('Error in query: ' . mysqli_error());
    }
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    return $data;
  }
  private function getNumRows($sqlQuery)
  {
    $result = mysqli_query($this->dbConnect, $sqlQuery);
    if (!$result) {
      die('Error in query: ' . mysqli_error());
    }
    $numRows = mysqli_num_rows($result);
    return $numRows;
  }
  public function loginUsers($email, $password)
  {
    $sqlQuery = "
SELECT id, email, first_name, last_name, address, mobile, id_rol
FROM " . $this->invoiceUserTable . "
WHERE email='" . $email . "' AND password='" . $password . "'";
    return  $this->getData($sqlQuery);
  }
  public function checkLoggedIn()
  {
    if (!$_SESSION['userid']) {
      header("Location:index.php");
    }
  }
  
  

  
}
