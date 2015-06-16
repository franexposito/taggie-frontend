<?php
	require_once('config.php');

	if ($_POST) {
		$facebookId = $_POST['facebookid'];
		$nombre = $_POST['nombre'];
		$birthday = $_POST['birthday'];
		$email = $_POST['email'];
		$verified = $_POST['verified'];
		$locale = $_POST['locale'];
		$gender = $_POST['gender'];
		$updated = $_POST['updated'];

		$queryInsert = "INSERT INTO USUARIOS (facebookid, nombre, birthday, email, verified, locale, gender, updated, loggedtimes) VALUES ('$facebookId', '$nombre', '$birthday', '$email', '$verified', '$locale', '$gender', '$updated', 1)";


		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    		echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$queryGetUser = "SELECT * FROM USUARIOS WHERE facebookid = '$facebookId'";
		$result = $conexion->query( $queryGetUser );
		$count = $result->rowCount();

		if ($count > 0) {

			foreach ($result as $val) {
				$loggedTimes = $val['loggedtimes'] + 1;
			}
			echo json_encode(array('count'=>$loggedTimes));
			$queryUpdate = "UPDATE USUARIOS SET loggedtimes = '$loggedTimes' WHERE facebookid = '$facebookId'";

			try{
				$conexion->query( $queryUpdate);
				echo json_encode(array('result1' => true));
			}catch ( PDOException $e ) {
				echo json_encode(array('result' => false, 'msg' => $e));
			}

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
