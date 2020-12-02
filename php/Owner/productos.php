<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Insertar producto
		if ($tipo == "insert") {
			$nombre = $_POST['nombre'];
			$unidad = $_POST['unidad'];
			$cultivo_id = $_POST['cultivo_id'];

			include "../../php/conection.php";
			$query = "INSERT INTO producto (nombre, unidad,cultivo_id) VALUES ('$nombre','$unidad','$cultivo_id')";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
				return;
			} else {
				echo "0";
				return;
			}
		}

		//Eliminar producto
		if ($tipo == "delete") {

			$id = $_POST['id'];

			include "../../php/conection.php";
			$query = "DELETE FROM producto WHERE id = '$id'";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
				return;
			} else {
				echo "0";
				return;
			}
		}

		//Editar producto
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$unidad = $_POST['unidad'];
			$cultivo_id = $_POST['cultivo_id'];

			include "../../php/conection.php";
			$query = "UPDATE producto SET nombre = '$nombre', unidad = '$unidad', cultivo_id = '$cultivo_id' WHERE id = '$id'";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
				return;
			} else {
				echo "0";
				return;
			}
		}


		//Mostrar datos que se editarán en el modal
		if ($tipo == "read") {
			$id = $_POST['id'];

			include "../../php/conection.php";
			$query = "SELECT * FROM producto WHERE id = '$id'";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$res = mysqli_fetch_array($sql);
				$salida = array(
					'nombre' => $res['nombre'], 
					'unidad' => $res['unidad'], '
					id' => $res['id'],
					'cultivo_id' => $res['cultivo_id']
				);
				echo json_encode($salida);
			} else {
				echo "0";
			}
		}

}
?>