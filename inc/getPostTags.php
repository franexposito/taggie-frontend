<?php
	require_once('config.php');

	if ($_GET){
		$idPost = $_GET['idPost'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$query = "SELECT * FROM POST WHERE idPost = '$idPost'";
		$result = $conexion->query( $query );
		$count = $result->rowCount();
		$response = array();

		if ($count > 0) {
			foreach ($result as $value) {
				$response = array('result' => true, 'tags' => quitarEspacios($value['tags']), 'tipo' => $value['tipo']);
			}
		}else {
			$response = array('result' => false);
		}

		echo json_encode($response);
	}else {

	}
?>
