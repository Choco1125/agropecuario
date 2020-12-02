<?php
	include 'key.php'; 
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//editar inventario de bodega
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$cantidad = $_POST['cantidad'];
			$valor = $_POST['valor'];

			//obtener hora
			date_default_timezone_set('America/Bogota');

			$time = time();
			$dia = date("d", $time);
			$mes = date("m", $time);
			$anyo = date("Y", $time);
			$fecha = $anyo."-".$mes."-".$dia;


			include '../conection.php';

			//consultamos los datos de bodega
			$query = "SELECT cantidad,valor FROM bodega WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				$datos = mysqli_fetch_array($sql);
				$usuario_id = $_SESSION['id'];
				$valor_ant = $datos['valor'];
				$cantidad_ant = $datos['cantidad'];

				//registramos en el historial
				$query = "INSERT INTO historial(bodega_id, fecha, proceso, operacion, cantidad, valor, valor_ant, cantidad_ant) VALUES ('$id','$fecha','$usuario_id','2','$cantidad','$valor','$valor_ant','$cantidad_ant')";
				$sql = mysqli_query($conection,$query);
				if ($sql) {
					$query = "UPDATE bodega SET cantidad='$cantidad',valor='$valor' WHERE id='$id'";
					$sql = mysqli_query($conection,$query);
					if ($sql) {
						echo '1';
						return;
					}else{
						echo "Ocurrio un error al actualizar bodega";
						return;
					}					
				}else{
					echo "Ocurrio un error al registrar el historial";
					return;
				}

			}else{
				echo 'Error al consultar bodega';
				return;
			}
		}

		//consultar la unidad de un produto
		if ($tipo == 'unidad'){
			//recuperamos el id
			$id = $_POST['id'];

			// consultamos en la BD
			include '../conection.php';
			$query = "SELECT unidad FROM insumo WHERE id = '$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo json_encode(mysqli_fetch_array($sql));
			}
		}
	}

 ?>