<?php
	require_once ('config.php');

	if($_POST){
		$idFacebook = $_POST['idFacebook'];
		$idGroup = $_POST['idGroup'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$email = $_POST['email'];
		$edad = $_POST['edad'];
		$ciudad = $_POST['ciudad'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute(PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	    	die;
		}

		$query = "INSERT INTO PROMOCIONES (idFacebook, idGroup, nombre, apellidos, email, edad, ciudad) VALUES ('$idFacebook', '$idGroup', '$nombre', '$apellidos', '$email', '$edad', '$ciudad')";
		try {
			$conexion->query($query);
			echo json_encode(array('result' => true));
		}catch ( PDOException $e ) {
			echo json_encode(array('response' => false));
		}


	}else{
		echo json_encode(array('response' => false));
		die;
	}

?>
