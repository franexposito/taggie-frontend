<?php
	require_once('config.php');

	$lang = $_GET['lang'];

	try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
    		echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	}

	if ($lang) {
		$query = "SELECT * FROM TIPOS WHERE lang = '$lang' ORDER BY `orden` ASC";
	} else {
		$query = "SELECT * FROM TIPOS WHERE lang = 'ES' ORDER BY `orden` ASC";
	}
	$result = $conexion->query( $query );
	$count = $result->rowCount();
	$response = array();
	$contador = 0;

	foreach ($result as $value) {
		$temp = array($contador => array('nombre' => $value['nombre'], 'tipo' => $value['tipo']));
		$response = $response + $temp;
		$contador = $contador + 1;
	}


	echo json_encode($response);


?>
