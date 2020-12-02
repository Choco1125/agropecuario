<?php
	include 'key.php'; 
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Insertar cliente
		if ($tipo == "insert") {
		$nit = $_POST['nit'];
		$nombre = $_POST['nombre'];
		$telefono = $_POST['telefono'];

		$query = "INSERT INTO cliente (nit, nombre, telefono) VALUES ('$nit','$nombre','$telefono')";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo "1";
		} else {
			echo "0";
		}
	}
		
		//Editar cliente
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$nit = $_POST['nit'];
			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];

			$query = "UPDATE cliente SET nit = '$nit', nombre = '$nombre', telefono = '$telefono' WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			} else {
				echo "0";
			}
		}


		//Mostrar datos que se editarán en el modal
		if ($tipo == "read") {
			$id = $_POST['id'];

			$query = "SELECT * FROM cliente WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$res = mysqli_fetch_array($sql);
				$salida = array('nit' => $res['nit'], 'nombre' => $res['nombre'], 
					'telefono' => $res['telefono'], 'id' => $res['id']);
				echo json_encode($salida);
			} else {
				echo "0";
			}
		}

}
?>