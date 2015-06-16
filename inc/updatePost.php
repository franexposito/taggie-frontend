<?php
	require_once('config.php');

	if ($_POST) {
		$idPost = $_POST['idPost'];
		$idGroup = $_POST['idGroup'];
		$tipo = $_POST['tipo'];
		$date = $_POST['timestamp'];
		$tags = $_POST['tags'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$query = "UPDATE POST SET tipo = '$tipo', tags = '$tags' WHERE idPost = '$idPost'";

		try{
			$conexion->query( $query );
			echo json_encode(array('result' => true));
		}catch ( PDOException $e ) {
			echo json_encode(array('result' => false, 'msg' => $url));
		}

	} else {

	}
?>
