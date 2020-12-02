<?php
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//generar
		if ($tipo == "generar") {
			$inicio = $_POST['fecha_inicio'];
			$fin = $_POST['fecha_fin'];
			$id = $_POST['employee'];

			/***************************************/
			//consulta para saber los trabajos 
			//y costo de los mismos de un trabajador
			//en un rango de fecha
			/****************************************/
			include '../conection.php';
			$query = "SELECT la.nombre,r.tipo,r.valor AS 'contrato',l.valor AS 'dia' FROM registro_labor AS r INNER JOIN labores AS la INNER JOIN labor_empleado AS l WHERE ((r.fecha) BETWEEN '$inicio' AND '$fin') AND r.labor_id=la.id AND l.registro_id = r.id AND l.empleado_id = '$id'";
			$sql = mysqli_query($conection,$query);
			if($sql){
				$salida = array();
				$aux = array();
				$total = 0;
				while ($row = mysqli_fetch_array($sql)) {
					$aux[] = $row['nombre'];
					if($row['tipo'] == "1"){//al contrato
						$total += $row['contrato'];
					}elseif ($row['tipo'] == "2") {//al dia
						$total += $row['dia'];						
					}
				}
				$salida['valor'] = $total;
				$salida['labores'] = $aux;
				echo json_encode($salida);
				return;
			}
		}

		//agregar
		if ($tipo == "add") {
			//datos
			$finca_id = $_SESSION['finca'];
			$n_factura = $_POST['n_factura'];
			$fecha = $_POST['fecha'];
			$nombre = $_POST['nombre'];
			$identificacion = $_POST['identificacion'];
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$concepto = $_POST['concepto'];
			$valor_letras = $_POST['valor_letras'];
			$valor = $_POST['valor'];

			//insertar en la BD
			include '../conection.php';
			$query = "INSERT INTO comprobante(n_factura, finca_id, fecha, nombre, identificacion, direccion, telefono, concepto, valor_letras, valor) VALUES ('$n_factura','$finca_id','$fecha','$nombre','$identificacion','$direccion','$telefono','$concepto','$valor_letras','$valor')";
			$sql = mysqli_query($conection,$query);
			if($sql){
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error registrando el comprobante';
				return;
			}
		}

		//mostrar
		if ($tipo == "read") {
			$id = $_POST['id'];

			include '../conection.php';
			$query = "SELECT * FROM comprobante WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo json_encode(mysqli_fetch_array($sql));
				return;
			}
		}

	}
 ?>