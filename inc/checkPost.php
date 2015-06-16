<?php
	require_once('config.php');

	if($_POST){
		$dataPost = explode(',', $_POST['data']);

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$query = "SELECT idPost FROM POST";
		$result = $conexion->query( $query );
		$count = $result->rowCount();
		$response = array();
		$contador = 0;

		if ($count > 0) {
			foreach ($result as $value) {
				if (($key = array_search($value['idPost'], $dataPost)) !== false){
					unset($dataPost[$key]);
				}
			}
			foreach ($dataPost as $val){
				$response[] = $val;
			}
		}
		else {
			$response = array('response' => false);
		}

		echo json_encode($response);

	}
?>
