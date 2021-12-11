<?php



	require_once '../db/accesoDB.php';
	date_default_timezone_set("America/Lima");

	function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
	}

	class adminDAO{

		public function allBitacora(){
			try{
				$pdo = AccesoDB::getConnectionPDO();

				$sql = 'SELECT * FROM factura_orden ORDER BY order_id DESC LIMIT 25';

				$stmt = $pdo->prepare($sql);
				$stmt->execute();

				$return = $stmt->fetchAll();
				return $return;

			} catch (Exception $e){
				throw $e;
			}
		}

		public function buscarAllBitacoraFecha($desde,$hasta){
			try{
				$pdo = AccesoDB::getConnectionPDO();

				$sql = 'SELECT * FROM factura_orden WHERE order_date BETWEEN "'.$desde.'" AND "'.$hasta.'" AND metodopago = "mostradorjj" ORDER BY order_id DESC';

				$stmt = $pdo->prepare($sql);
				$stmt->execute();

				$return = $stmt->fetchAll();
				return $return;

			} catch (Exception $e){
				throw $e;
			}
		}



	}

?>
