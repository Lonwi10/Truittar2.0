<?php
	$bd = "twitter";
	$server = "localhost";
	$user = "root";
	$password = "blearuto18";

	$conexion = @mysqli_connect($server, $user, $password, $bd);
	if(!$conexion) die("Error de conexion".msqli_connect_error() );

	$sql = "SELECT username,id FROM users order by id asc;";
	$result = mysqli_query($conexion, $sql);

	while($data = mysqli_fetch_assoc($result)){
		
		echo "<li>Usuario: ".$data["username"]." <a href="."http://localhost:8000/chat"."id=".$data["id"].">chat</a></li>";
	}
		
?>