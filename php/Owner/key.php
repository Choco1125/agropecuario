<?php
session_start();
if (isset($_SESSION['id_rol'])) {
	// if ($_SESSION['id_rol'] == '2') {
	// 	echo 'No tiene permisos para utilizar esta función';
	// 	return;			
	// }
	if (!array_search($_SESSION['id_rol'], ['0', '1', '2'])) {
		echo 'No tiene permisos para utilizar esta función';
		return;
	}
} else {
	echo 'Debe de iniciar sesión para realizar esto';
	return;
}
