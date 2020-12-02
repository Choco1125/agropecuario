<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Insertar insumo
		if ($tipo == "insert") {
			$nombre = $_POST['nombre'];
			$unidad = $_POST['unidad'];

			$query = "INSERT INTO insumo (nombre, unidad) VALUES ('$nombre','$unidad')";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			} else {
				echo "0";
			}
	}

		//Eliminar insumo
		if ($tipo == "delete") {

		$id = $_POST['id'];

		$query = "DELETE FROM insumo WHERE id = '$id'";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo "1";
		} else {
			echo "0";
		}

	}

		//Editar insumo
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$unidad = $_POST['unidad'];

			$query = "UPDATE insumo SET nombre = '$nombre', unidad = '$unidad' WHERE id = '$id'";

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

			$query = "SELECT * FROM insumo WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$res = mysqli_fetch_array($sql);
				$salida = array('nombre' => $res['nombre'], 'unidad' => $res['unidad'], 'id' => $res['id']);
				echo json_encode($salida);
			} else {
				echo "0";
			}
		}

}
?>