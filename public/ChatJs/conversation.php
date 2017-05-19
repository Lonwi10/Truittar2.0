<?php
	$bd = "truittar";
	$server = "localhost";
	$user = "root";
	$password = "8wdfacejL";

	$conexion = @mysqli_connect($server, $user, $password, $bd);
	if(!$conexion) die("Error de conexion".msqli_connect_error() );

	$sql = "SELECT sender,content FROM messages order by id asc;";
	$result = mysqli_query($conexion, $sql);

	while($data = mysqli_fetch_assoc($result)){
		echo "<p><b>".$data["sender"]."</b> dice: ".$data["content"]."</p>";
	}
		
?>