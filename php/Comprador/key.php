<?php 
	session_start();
	if (isset($_SESSION['id_rol'])) {
		if ($_SESSION['id_rol'] != '3') {
			echo 'No tiene permisos para utilizar esta función';
			return;			
		}
	}else{
		echo 'Debe de iniciar sesión para realizar esto';
		return;
	}
 ?>