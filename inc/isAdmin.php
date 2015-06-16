<?php
	require_once('config.php');

	if ($_GET){
		$idFacebook = $_GET['idFacebook'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	    	die;
		}

		$query = "SELECT * FROM ADMINS WHERE idFacebook = '$idFacebook'";
		$result = $conexion->query( $query );
		$count = $result->rowCount();
		$response = array();
		$contador = 0;

		if ($count > 0){
			foreach ($result as $value) {
				$temp = array("idGroup" => $value["idGroup"]);
				$response[] = $temp;
			}
		}else {
			$response[] = array("idGroup" => null);
		}

		echo json_encode($response);

	}

?>
