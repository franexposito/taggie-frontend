<?php
	require_once('config.php');

	if ($_POST) {
		$fromFacebookId = $_POST['fromfacebookid'];
		$toFacebookId = $_POST['tofacebookid'];
		$groupId = $_POST['groupid'];
		$valoracion = $_POST['valoracion'];
		$message = $_POST['message'];
		$nombre = $_POST['nombre'];

		$queryInsert = "INSERT INTO COMENTARIOS_TRABAJADORES (fromfacebookid, tofacebookid, groupid, valoracion, message, nombre) VALUES ('$fromFacebookId', '$toFacebookId', '$groupId', '$valoracion', '$message', '$nombre')";


		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion->exec("set names utf8");
		} catch(PDOException $e){
	    		echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$queryGetUserCommented = "SELECT * FROM COMENTARIOS_TRABAJADORES WHERE fromfacebookid = '$fromFacebookId' AND tofacebookId = '$toFacebookId' AND groupid = '$groupId'";
		$result = $conexion->query( $queryGetUserCommented );
		$count = $result->rowCount();

		if ($count > 0) {

			echo json_encode(array('result1' => false));

		} else {

			try{
				$conexion->query( $queryInsert );
				echo json_encode(array('result' => true));
			}catch ( PDOException $e ) {
				echo json_encode(array('result' => false, 'msg2' => $e));
			}

		}

	} else {

	}
?>
