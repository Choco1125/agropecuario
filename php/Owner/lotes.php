<?php
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		if ($tipo == "insert") {
			$id_finca  = $_POST['id_finca'];
			$nombre    = $_POST['nombre'];
			$cultivo  = $_POST['cultivo'];
			$variedad  = $_POST['variedad'];
			$cantidad  = $_POST['cantidad'];
			$fecha     = $_POST['fecha'];
			$distancia = $_POST['distancia'];
			$area      = $_POST['area'];
			$asnm      = $_POST['asnm'];

			$query = "INSERT INTO lote (id_finca, nombre, cultivo_id, variedad, cantidad, fecha_siembra, distancia_siembra, area, asnm) VALUES ('$id_finca','$nombre','$cultivo','$variedad','$cantidad','$fecha','$distancia','$area','$asnm')";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			}else{
				echo "0";
			}

		}

		//Editar lote
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$cultivo = $_POST['cultivo'];
			$variedad = $_POST['variedad'];
			$cantidad = $_POST['cantidad'];
			$fecha = $_POST['fecha'];
			$distancia = $_POST['distancia'];
			$area = $_POST['area'];
			$asnm = $_POST['asnm'];

			$query = "UPDATE lote SET nombre = '$nombre', cultivo_id = '$cultivo', variedad = '$variedad', cantidad = '$cantidad', fecha_siembra = '$fecha', distancia_siembra = '$distancia', area = '$area', asnm = '$asnm' WHERE id = '$id'";

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

			$query = "SELECT * FROM lote WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$res = mysqli_fetch_array($sql);
				$salida = array('nombre' => $res['nombre'], 'cultivo' => $res['cultivo_id'], 
					'variedad' => $res['variedad'], 'cantidad' => $res['cantidad'], 'fecha_siembra' => $res['fecha_siembra'], 'distancia_siembra' => $res['distancia_siembra'], 'area' => $res['area'], 'asnm' => $res['asnm'], 'id' => $res['id']);
				echo json_encode($salida);
			} else {
				echo "0";
			}
		}


		//Delete
		if ($tipo == "delete") {

			$id = $_POST['id'];

			$query = "DELETE FROM lote WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			} else {
				echo "0";
			}

		}

	}

?>