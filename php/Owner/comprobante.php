<?php
include 'key.php';
if (isset($_POST)) {
	$tipo = $_POST['op'];

	//generar
	if ($tipo == "generar") {
		$inicio = $_POST['fecha_inicio'];
		$fin = $_POST['fecha_fin'];
		$id = $_POST['employee'];
		$finca_id = $_SESSION['finca'];

		/***************************************/
		//consulta para saber los trabajos 
		//y costo de los mismos de un trabajador
		//en un rango de fecha
		/****************************************/
		include '../conection.php';
		$query = "SELECT lo.nombre AS 'lote',f.nombre AS 'finca',la.nombre,r.tipo,r.valor AS 'contrato',l.valor AS 'dia' FROM finca AS f INNER JOIN lote AS lo INNER JOIN registro_labor AS r INNER JOIN labores AS la INNER JOIN labor_empleado AS l WHERE lo.id_finca=f.id AND r.lote_id = lo.id AND ((r.fecha) BETWEEN '$inicio' AND '$fin') AND r.labor_id=la.id AND l.registro_id = r.id AND l.empleado_id = '$id' AND f.id = '$finca_id'";
		echo $query;
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			$salida = array();
			$aux = array();
			$total = 0;
			while ($row = mysqli_fetch_array($sql)) {
				if ($row['tipo'] == "1") { //al contrato
					$aux[] = $row['nombre'] . ' al contrato en el lote ' . $row['lote'] . ' de la finca ' . $row['finca'];
					$total += $row['contrato'];
				} elseif ($row['tipo'] == "2") { //al dia
					$aux[] = $row['nombre'] . ' al día en el lote ' . $row['lote'] . ' de la finca ' . $row['finca'];
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

		include '../conection.php';
		$sql_query = mysqli_query($conection, "SELECT id_sociedad FROM finca WHERE id = " . $finca_id);
		$consulta = mysqli_fetch_assoc($sql_query);

		$sociendad_id = $consulta['id_sociedad'];

		//insertar en la BD
		$query = "INSERT INTO comprobante(n_factura, finca_id, fecha, nombre, identificacion, direccion, telefono, concepto, valor_letras, valor,sociedad_id) VALUES ('$n_factura','$finca_id','$fecha','$nombre','$identificacion','$direccion','$telefono','$concepto','$valor_letras','$valor','$sociendad_id')";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
			return;
		} else {
			echo 'Ocurrio un error registrando el comprobante';
			return;
		}
	}

	//eliminar
	if ($tipo == "delete") {
		$id = $_POST['id'];

		include '../conection.php';
		$query = "DELETE FROM comprobante WHERE id='$id'";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
			return;
		} else {
			echo 'Ocurrió un error al eliminar el comprobante';
			return;
		}
	}

	//mostrar
	if ($tipo == "read") {
		$id = $_POST['id'];

		include '../conection.php';
		$query = "SELECT * FROM comprobante WHERE id='$id'";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo json_encode(mysqli_fetch_array($sql));
			return;
		}
	}

	//editar
	if ($tipo == "edit") {
		//datos
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
		$query = "UPDATE comprobante SET fecha='$fecha',nombre='$nombre',identificacion='$identificacion',direccion='$direccion',telefono='$telefono',concepto='$concepto',valor_letras='$valor_letras',valor='$valor' WHERE n_factura='$n_factura'";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
			return;
		} else {
			echo 'Ocurrio un error editando el comprobante';
			return;
		}
	}
}
