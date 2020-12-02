<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Insertar cultivo
		if ($tipo == "insert") {
			$nombre = $_POST['nombre'];
			$query = "INSERT INTO cultivo (nombre) VALUES ('$nombre')";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			} else {
				echo "0";
			}
		}

		//Eliminar cultivo
		if ($tipo == "delete") {

		$id = $_POST['id'];

		$query = "DELETE FROM cultivo WHERE id = '$id'";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo "1";
		} else {
			echo "0";
		}

	}

		//Editar cultivo
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];

			$query = "UPDATE cultivo SET nombre = '$nombre' WHERE id = '$id'";

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

			$query = "SELECT * FROM cultivo WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$res = mysqli_fetch_array($sql);
				$salida = array('nombre' => $res['nombre'], 'id' => $res['id']);
				echo json_encode($salida);
			} else {
				echo "0";
			}
		}

}
?>