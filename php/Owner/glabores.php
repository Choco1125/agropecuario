<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Insertar labor
		if ($tipo == "insert") {
			$nombre = $_POST['nombre'];
			$tipo = $_POST['tipo'];

			$query = "INSERT INTO labores (nombre,tipo) VALUES ('$nombre','$tipo')";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			} else {
				echo "0";
			}
	}

		//Eliminar labor
		if ($tipo == "delete") {

		$id = $_POST['id'];

		$query = "DELETE FROM labores WHERE id = '$id'";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo "1";
		} else {
			echo "0";
		}

	}

		//Editar labor
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$nombre = $_POST['edit_nombre'];
			$recoleccion = $_POST['edit_tipo'];

			$query = "UPDATE labores SET nombre = '$nombre',tipo = '$recoleccion' WHERE id = '$id'";

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

			$query = "SELECT * FROM labores WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$res = mysqli_fetch_array($sql);
				$salida = array('nombre' => $res['nombre'], 
								'id' => $res['id'],
								'tipo' => $res['tipo']);
				echo json_encode($salida);
			} else {
				echo "0";
			}
		}


}
