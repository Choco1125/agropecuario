<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		$tabla = "";
		switch ($_POST['rubro']) {
			case '1':
				$tabla = "rubro_administrativo";
				break;
			case '2':
				$tabla = "rubro_financiero";
				break;
			case '3':
				$tabla = "rubros_otros";
				break;
			case '4':
				$tabla = "rubros_post";
			break;
		}

		if ($tipo == "add") {
			include '../conection.php';
			$nombre = $_POST['nombre'];

			$query = "INSERT INTO ".$tabla."(nombre) VALUES ('$nombre')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo "1";
				return;
			}else{
				echo "No se logro agregar el rubro";
				return;
			}
		}

		if ($tipo == "edit") {
			include '../conection.php';
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];

			$query = "UPDATE ".$tabla." SET nombre='$nombre' WHERE id=".$id;
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo "1";
				return;
			}else{
				echo "No se logro editar el rubro";
				return;
			}
		}

		if ($tipo == "read") {
			$id = $_POST['id'];

			include '../conection.php';
			$query = "SELECT * FROM ".$tabla." WHERE id=".$id;
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo json_encode(array('nombre' => mysqli_fetch_array($sql)['nombre']));
					return;
			}
		}

		if ($tipo == "delete") {
			$id = $_POST['id'];

			include '../conection.php';
			$query = "DELETE FROM ".$tabla." WHERE id=".$id;
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo "1";
				return;
			}else{
				echo "No se logro eliminar el rubro";
				return;
			}
		}

	}

 ?>