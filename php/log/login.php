<?php
if (isset($_POST['nombre'])) {
	//obtenemos datos del post
	$nombre = $_POST['nombre'];
	$pass = md5($_POST['pass']);


	//consultamos la BD
	include "../conection.php";
	$query = "SELECT * FROM usuarios WHERE nombre_usuario='$nombre' AND contrasena='$pass'";

	$sql = mysqli_query($conection, $query);

	if ($sql) {
		$num = mysqli_num_rows($sql);
		if ($num > 0) {
			$datos = mysqli_fetch_array($sql);
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['id']    = $datos['id'];
			$_SESSION['id_rol'] = $datos['id_rol'];


			//redireccionar a donde sea necesario
			switch ($datos['id_rol']) {
				case "1":
					header("location: ../../sitio/");
					$_SESSION['carpeta'] = 'Admin';
					break;
				case "2":
					header("location: ../../sitio/");
					$_SESSION['carpeta'] = 'Owner';
					break;
				case "3":
					header("location: ../../sitio/");
					$_SESSION['carpeta'] = 'Comprador';
					break;
				case "4":
					header("location: ../../sitio/");
					$_SESSION['carpeta'] = 'Vendedor';
					break;
				case "5":
					header("location: ../../sitio/");
					$_SESSION['carpeta'] = 'Comprador';
					break;
			}
		} else {
			header("location: ../../index.php");
		}
	} else {
		echo "No sirvió";
	}




	/*********************************/
	//metodos de mysqli

	//query(coneccion,$query)
	//num_rows($sql) 
	//fecth_array($sql)
	//fetch_row($sql)
}
