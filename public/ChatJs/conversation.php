<?php
	$bd = "truittar";
	$server = "localhost";
	$user = "root";
	$password = "Lol123-321";
	$user1 = $_POST["user"];
	$user2 = $_POST["target"];

	$conexion = @mysqli_connect($server, $user, $password, $bd);
	if ($conexion->connect_error) {
    	die('Error de conexión: ' . $conexion->connect_error);
	}

	$sql = "SELECT envio,contentenido,recibo FROM messages WHERE envio = '$user1' AND recibo = '$user2' OR  envio = '$user2' AND recibo = '$user1' order by id asc;";
	$result = mysqli_query($conexion, $sql);

	while($data = mysqli_fetch_assoc($result)){
		echo "<p><b>".$data["envio"]."</b> dice: ".$data["contentenido"]."</p>";
	}
		
?>
