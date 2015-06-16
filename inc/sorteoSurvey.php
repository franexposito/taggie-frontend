<?php
	require_once('config.php');

	if ($_POST) {
		$email = $_POST['email'];
		$puntos = $_POST['puntos'];

		$queryInsert = "INSERT INTO CONCURSO (email, puntos) VALUES ('$email', '$puntos')";
		$querySelect = "SELECT * FROM CONCURSO WHERE email = '$email'";

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    		echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$result = $conexion->query( $querySelect );
		$count = $result->rowCount();

		if ($count == 0) {
			try{
				$conexion->query( $queryInsert );
				echo json_encode(array('result1' => true));
			}catch ( PDOException $e ) {
				echo json_encode(array('result2' => false, 'error' => $e));
			}
		} else {
			$queryUpdate = "";
			$alreadyPuntos = 0;

			foreach ($result as $value) {
				$currentPuntos = $value['puntos'];
				$alreadyPuntos = $alreadyPuntos + $currentPuntos;
				break;

			}
			try{
				$puntos = $puntos + $alreadyPuntos;
				$conexion->query( "UPDATE CONCURSO SET puntos = $puntos WHERE email = '$email'");
				echo json_encode(array('result3' => true));
			}catch ( PDOException $e ) {
				echo json_encode(array('result4' => false, 'error' => $e));
			}
		}


	} else {

	}
?>
