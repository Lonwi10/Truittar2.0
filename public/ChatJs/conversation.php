<?php
	$bd = "twitter";
	$server = "localhost";
	$user = "root";
	$password = "blearuto18";

	$conexion = @mysqli_connect($server, $user, $password, $bd);
	if(!$conexion) die("Error de conexion".msqli_connect_error() );

	$sql = "SELECT envio,contentenido FROM messages order by id asc;";
	$result = mysqli_query($conexion, $sql);

	while($data = mysqli_fetch_assoc($result)){
		echo "<p><b>".$data["envio"]."</b> dice: ".$data["contentenido"]."</p>";
	}
		
?>