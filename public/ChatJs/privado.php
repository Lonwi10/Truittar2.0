<?php
	$bd = "truittar";
	$server = "localhost";
	$user = "root";
	$password = "Lol123-321";

	$conexion = @mysqli_connect($server, $user, $password, $bd);
	if(!$conexion) die("Error de conexion".msqli_connect_error() );

	$user = $_POST["user"];
	$message = $_POST["message"];
	$user2 = $_POST["target"];

	$sql = "INSERT INTO messages (envio,contentenido,recibo) VALUES ('$user','$message','$user2')";
	$result = mysqli_query($conexion, $sql);

	if($result)
		echo "Mensaje recibido.";
		
?>