<?php
	$bd = "twitter";
	$server = "localhost";
	$user = "root";
	$password = "blearuto18";

	$conexion = @mysqli_connect($server, $user, $password, $bd);
	if(!$conexion) die("Error de conexion".msqli_connect_error() );

	$userr = "prueba2";
	$message = $_POST["message"];

	$sql = "INSERT INTO messages (sender_id,content) VALUES ('$userr','$message')";
	$result = mysqli_query($conexion, $sql);

	if($result)
		echo "Mensaje recibido.";
		
?>