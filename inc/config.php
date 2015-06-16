<?php
	define("DB_DSN", "mysql:host=localhost;dbname=jdrbfcuw_help");
	define("DB_USUARIO", "jdrbfcuw_help");
	define("DB_CONTRASENIA", "helpHelp!");
	define("BASEURL", "http://rafael-ruiz.es/help/getPost.php");

	function quitarEspacios($tags) {
	$tags = str_replace(",     ",",",$tags);
	$tags = str_replace(",    ",",",$tags);
	$tags = str_replace(",   ",",",$tags);
	$tags = str_replace(",  ",",",$tags);
	$tags = str_replace(", ",",",$tags);

	return $tags;
}
?>
