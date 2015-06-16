<?php
	require_once('config.php');

	if ($_POST){
		$idGroup = $_POST['idGroup'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		$tags = explode(',', $_POST['tags']);
		$newTags = array();
		foreach ($tags as $tag) {
			$newTagsExploded = explode(' ',$tag);
			foreach ($newTagsExploded as $newTag) {
				$newTags[] = $newTag;
			}
		}

		$tags = $newTags;

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
	    	die;
		}

		$query = "SELECT * FROM POST WHERE idGroup = '$idGroup' ORDER BY fecha DESC";
		$result = $conexion->query( $query );
		$count = $result->rowCount();
		$response = array();
		$contador = 1;
		$array_url = array();
		$tagTemp = array();
		$isTag = false;

		if ($count > 0){
			if ($count >= $from){
				foreach ($result as $val) {
					if ($contador >= $from && $contador <= $to){
						$tagTemp = array();
						$isTag = false;
						$tagsQuery = quitarEspacios($val['tags']);
						foreach (explode(',',$tagsQuery) as $valT) {
							$tagTemp[] = $valT;
							if(in_array(strtolower($valT), array_map('strtolower', $tags))) {
								$isTag = true;
							}
						}
						if($isTag == true){
							$temp = array("idPost" => $val['idPost'], "tipo" => $val['tipo'], "timestamp" => $val['fecha'], "tags" => implode(',', $tagTemp),"from_id" => $val['from_id'], "from_name" => $val['from_name'],
							"message" => $val['message'], "link" => $val['link']);
							$response[] = $temp;
							$contador = $contador + 1;
						}
					}
					//$contador = $contador + 1;
				}
				if ($count > $from){
					if($to+25 <= $count ){
						$to = $to+25;
						if($from+25 >= $count){
							$from = $from+25;
							$array_url = array("next" => BASEURL."?idGroup=".$idGroup."&from=".$from."&to=".$to."");
						}
						else if ($from+25 < $count){
							$from = $count;
							$array_url = array("next" => BASEURL."?idGroup=".$idGroup."&from=".$from."&to=".$to."");
						}
					}else{
						$array_url = array("next" => false);
					}
				}else {
					$array_url = array("next" => false);
				}

				//$response[] = $array_url;
				echo json_encode($response);
			}else {
				//echo json_encode(array("response" => false));
			}
		}else {
			//echo json_encode(array("response" => false));//
		}



	}

?>
