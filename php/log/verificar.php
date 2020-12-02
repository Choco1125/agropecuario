<?php 
	session_start();
	if (isset($_SESSION['login'])) {
		if (isset($_SESSION['finca'])) {
			if ($permiso != $_SESSION['id_rol']) {
				header('location: ../../sitio/');
			}
		}else{
			header('location: ../../sitio/');
		}
	}else{
		header('location: ../../index.php');
	}

?>