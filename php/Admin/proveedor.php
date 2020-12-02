<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Insertar proveedor
		if ($tipo == "add") {
			$nit = $_POST['nit'];
			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];

			include "../../php/conection.php";
			$query = "INSERT INTO proveedor (nit, nombre, telefono) VALUES ('$nit','$nombre','$telefono')";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$query = "SELECT * FROM proveedor ORDER BY id DESC LIMIT 0,1";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					echo json_encode(mysqli_fetch_array($sql));
				}else{
					echo "Ocurrio un error al agregar el proveedor";
					return;
				}
			} else {
				echo "Ocurrio un error al agregar el proveedor";
				return;
			}
		}
	}

 ?>