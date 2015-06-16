<?php
	require_once('config.php');

	if($_GET){
		$groupId= $_GET['groupid'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute(PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion->exec("set names utf8");
		}catch(PDOException $e){
			echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	    	die;
		}

		$query = "SELECT * FROM TRABAJADORES WHERE groupid= '$groupId'";

		$result = $conexion->query($query);
		$response = array();
		$contador = 0;
		foreach ($result as $value) {
			$facebookIdTemp = $value['facebookid'];
			$queryComentariosTrabajadores = "SELECT * FROM COMENTARIOS_TRABAJADORES WHERE tofacebookid = '$facebookIdTemp'";
			$result_comments = $conexion->query($queryComentariosTrabajadores);
			$contadorComments = 0;
			$responseComments = array();
			$valoracion = 0;
			foreach ($result_comments as $comment) {
				$tempComments = array($contadorComments => array('fromfacebookid' => $comment['fromfacebookid'], 'nombre' => $comment['nombre'], 'message' => $comment['message'], 'valoracion' => $comment['valoracion']));
				$valoracion = $valoracion + $comment['valoracion'];
				//echo json_encode(array('2'=>$tempComments));
				$responseComments = $responseComments + $tempComments;
				$contadorComments = $contadorComments + 1;


			}

			$contadorCommentsString = $contadorComments;
			if ($contadorComments == 0) {
				$contadorComments = 1;
			}

			$temp = array($contador => array('nombre' => $value['nombre'], 'facebookid' => $value['facebookid'], 'profesion' => $value['profesion'], 'comentarios' => $contadorCommentsString, 'valoracion' => bcdiv($valoracion, $contadorComments, 1), 'comments' => $responseComments));
			$response = $response + $temp;
			$contador++;
		}
		echo json_encode($response);


	}else{
		echo json_encode(array("response" => false));
	}
?>
