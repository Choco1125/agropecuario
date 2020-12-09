<?php
if (isset($_GET['finca'])) {
	session_start();
	if ($_GET['finca'] == "0") {
		if ($_SESSION['id_rol'] != "2") {
			header('location: ../../sitio/');
		}
	}
	$_SESSION['finca'] = $_GET['finca'];
	//redireccionar a donde sea necesario
	switch ($_SESSION['id_rol']) {
		case "1":
			header("location: ../../sitio/Admin");
			$_SESSION['carpeta'] = 'Admin';
			break;
		case "2":
			header("location: ../../sitio/Owner");
			$_SESSION['carpeta'] = 'Owner';
			break;
		case "3":
			header("location: ../../sitio/Comprador");
			$_SESSION['carpeta'] = 'Comprador';
			break;
		case "4":
			header("location: ../../sitio/Vendedor");
			$_SESSION['carpeta'] = 'Vendedor';
			break;
		case "5":
			$_SESSION['carpeta'] = 'Comprador';
			header("location: ../../sitio/Comprador");
			break;
	}
} else {
	header('location: ../../sitio/');
}
