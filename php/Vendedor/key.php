<?php 
	session_start();
	if (isset($_SESSION['id_rol'])) {
		if ($_SESSION['id_rol'] != '4') {
			echo 'No tiene permisos para utilizar esta función';
			exit();	
		}
	}else{
		echo 'Debe de iniciar sesión para realizar esto';
		exit();
	}
 ?>