<?php

	require_once('config.php');

	if ($_GET){
		$idGroup = $_GET['idGroup'];
		$from = $_GET['from'];
		$to = $_GET['to'];
		$tipo = $_GET['tipo'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	    	die;
		}

		if ($tipo == 0)
			$query = "SELECT * FROM POST WHERE idGroup = '$idGroup' ORDER BY fecha DESC";
		else
			$query = "SELECT * FROM POST WHERE idGroup = '$idGroup' AND tipo = '$tipo' ORDER BY fecha DESC";

		$result = $conexion->query( $query );
		$count = $result->rowCount();
		$response = array();
		$contador = 1;
		$array_url = array();

		if ($count > 0){
			if ($count >= $from){
				foreach ($result as $val) {
					if ($contador >= $from && $contador <= $to){
						$temp = array("idPost" => $val['idPost'], "tipo" => $val['tipo'], "timestamp" => $val['fecha'], "tags" => quitarEspacios($val['tags']), "from_id" => $val['from_id'],
						"from_name" => $val['from_name'], "message" => $val['message'], "link" => $val['link']);
						$response[] = $temp;;
					}
					$contador = $contador + 1;
				}
				if ($count > $from){
					if($to+25 <= $count ){
						$to = $to+25;
						if($from+25 >= $count){
							$from = $from+25;
							//$array_url = array("next" => BASEURL."?idGroup=".$idGroup."&from=".$from."&to=".$to."");
						}
						else if ($from+25 < $count){
							$from = $count;
							//$array_url = array("next" => BASEURL."?idGroup=".$idGroup."&from=".$from."&to=".$to."");
						}
					}else{
						//$array_url = array("next" => false);
					}
				}else {
					//$array_url = array("next" => false);
				}

				//$response[] = $array_url;
				echo json_encode($response);
			}else {
				echo json_encode(array());
			}
		}else {
			echo json_encode(array());
		}



	}

?>
