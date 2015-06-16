<?php
	require_once('config.php');

	if($_POST){
		$idFacebook = $_POST['idFacebook'];
		$idGroup = $_POST['idGroup'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute(PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	    	die;
		}

		$query = "UPDATE PROMOCIONES SET idGroup = '$idGroup' WHERE idFacebook = '$idFacebook'";

		try{
			$conexion->query($query);
			echo json_encode(array("response" => true));
		}catch(PDOException $e){
			echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}
	}else{
		echo json_encode(array('response' => false));
		die;
	}
?>
