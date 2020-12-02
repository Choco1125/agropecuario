<?php
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Insertar finca
		if ($tipo == "insert") {
			$nombre = $_POST['nombre'];
			$sociedad = $_POST['sociedad'];
			$usuario_id = $_SESSION['id'];

			include "../conection.php";
			$query = "INSERT INTO finca (nombre,id_sociedad) VALUES ('$nombre','$sociedad')";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				//consultamos el id del registro creado
				$query = "SELECT id FROM finca ORDER BY id DESC LIMIT 0,1";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					$finca_id = mysqli_fetch_array($sql)['id'];
					$query = "INSERT INTO usuario_finca (usuario_id,finca_id) VALUES ('$usuario_id','$finca_id')";
					$sql = mysqli_query($conection, $query);
					if ($sql) {
						echo "1";
					}else{
						echo '0';
					}

				}else{
					echo '0';
				}

			}else{
				echo "0";
				return;
			}
		}

		//Eliminar finca
		if ($tipo == "delete") {

			$id = $_POST['id'];

			$query = "DELETE FROM finca WHERE id = '$id'";
			include "../conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1"; 
			} else {
				echo "0";
			}
		}

		//Editar Finca
		if ($tipo == "edit") {
			$nombre   = $_POST['nombre'];
			$sociedad = $_POST['sociedad'];
			$id = $_POST['id'];

			$query = "UPDATE finca SET nombre = '$nombre',id_sociedad = '$sociedad' WHERE id = '$id'";
			include "../conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			} else {
				echo "0";
			}
		}

		//Mostrar datos que se editarán  en el modal
		if ($tipo == "read") {
			$id = $_POST['id'];

			$query = "SELECT * FROM finca WHERE id = '$id' ";

			include "../conection.php";
			$sql = mysqli_query($conection, $query);
			 if ($sql) {
			 	$res = mysqli_fetch_array($sql);
			 	$salida = array('nombre' => $res['nombre'],"id" => $res['id'], 'sociedad' => $res['id_sociedad']);
			 	echo json_encode($salida);
			 } else {
			 	echo "0";
			 }
		}
	}
 ?>