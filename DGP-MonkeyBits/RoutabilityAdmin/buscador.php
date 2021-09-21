<?php

	$search = '';
	if (isset($_GET['search'])) {
		$search = $_GET['search'];
	}

	$consulta = "SELECT * FROM suggestion where id='".$search."'";
	$resultado = mysqli_query($conexion, $consulta);
	$fila = mysqli_fetch_array($resultado);	
?>