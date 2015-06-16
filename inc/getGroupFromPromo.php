<?php
	require_once('config.php');

	if($_POST){
		$idFacebook = $_POST['idFacebook'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute(PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	    	die;
		}

		$query = "SELECT idGroup FROM PROMOCIONES WHERE idFacebook = '$idFacebook'";
		$result = $conexion->query($query);
		$count = $result->rowCount();
		$id = '';

		if($count > 0){
			foreach ($result as $val) {
				$id = $val['idGroup'];
			}
			echo json_encode(array($idFacebook => $id));
		}else{
			echo json_encode(array("response" => false));
		}

	}else{
		echo json_encode(array("response" => false));
	}
?>
