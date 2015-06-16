<?php
	require_once('config.php');

	if($_POST){
		$data = $_POST['data'];
		$lang = $_GET['lang'];

		$dataGroup = array();
		if (strpos($data,'no_facebook_service') === false) {
			$dataGroup = explode(',', $_POST['data']);
		}

		//echo $dataGroup;

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$query = "SELECT * FROM GROUPS";
		if ($lang) {
			$query = "SELECT * FROM GROUPS WHERE lang = '$lang'";
		} else {
			$query = "SELECT * FROM GROUPS WHERE lang = 'ES'";
		}
		$result = $conexion->query( $query );
		$count = $result->rowCount();
		$response = array();
		$contador = 0;

		if (strpos($data,'no_facebook_service') !== false) {

   			 if ($count > 0) {
				foreach ($result as $value) {
					$temp = array($contador => array('idGroup' => $value['idGroup'], 'accesible' => true, 'nombre' => $value['name'],'pais' => $value['country']));
					$response = $response + $temp;
					$contador = $contador + 1;
				}
			}


		} else {

			if ($count > 0) {
				foreach ($result as $value) {
					if (in_array($value['idGroup'], $dataGroup)){
						$temp = array($contador => array('idGroup' => $value['idGroup'], 'accesible' => true, 'nombre' => $value['name'],'pais' => $value['country']));
						$response = $response + $temp;
					}else{
						$temp = array($contador => array('idGroup' => $value['idGroup'], 'accesible' => true, 'nombre' => $value['name'],'pais' => $value['country']));
						$response = $response + $temp;
					}
					$contador = $contador + 1;
				}
			}
			else {
				//$response = array('response' => false);
			}

		}

		echo json_encode($response);

	}else {
		//echo json_encode(array('response' => 'no'));
	}
?>
