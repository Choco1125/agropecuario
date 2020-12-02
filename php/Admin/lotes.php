<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];


		//reportar los productos que sales de la finca
		//por lotes
		if ($tipo == 'add_reporte') {
			
			//obtenemos los datos
			$fecha = $_POST['fecha'];
			$n_remision = $_POST['n_remision'];
			$lote_id = $_POST['lote'];
			$producto_id = $_POST['producto'];
			$cantidad = $_POST['cantidad'];
			$unidad = $_POST['unidad'];
			$cliente_id = $_POST['cliente'];
			$observacion = $_POST['observacion'];

			//registramos en la BD
			include '../conection.php';
			$query = "INSERT INTO despache(lote_id, producto_id, fecha, cantidad, unidad, cliente_id, n_remision, observacion) VALUES ('$lote_id','$producto_id','$fecha','$cantidad','$unidad','$cliente_id','$n_remision','$observacion')";
			// $query = "INSERT INTO despache(lote_id,producto_id,cantidad,fecha) VALUES('$lote_id','$producto_id','$cantidad','$fecha')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al registrar';
				return;
			}
		}

		//registra cliente y devuelve la información de los mismos
		if ($tipo == "add_cliente") {
			$nit = $_POST['nit'];
			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];

			include "../../php/conection.php";
			$query = "INSERT INTO cliente (nit, nombre, telefono) VALUES ('$nit','$nombre','$telefono')";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$query = "SELECT * FROM cliente ORDER BY id DESC LIMIT 0,1";
				$sql = mysqli_query($conection,$query);
				if ($sql) {
					echo json_encode(mysqli_fetch_array($sql));
					return;
				}
			}
		}

		// registrar la venta de productos
		if ($tipo == 'add_venta') {
			
			//obtenemos todos los datos
			$lote_id = $_POST['lote'];
			$producto_id = $_POST['producto'];
			$cliente_id = $_POST['cliente'];
			$fecha = $_POST['fecha'];
			$valor = $_POST['valor'];
			$cantidad = $_POST['cantidad'];
			$n_remision = $_POST['n_remision'];
			$pago = $_POST['pago'];
			$usuario_id = $_SESSION['id'];

			//insertamos en la BD
			include '../conection.php';
			$query = "INSERT INTO ventas(lote_id, producto_id, cliente_id, usuario_id, fecha, valor, cantidad, n_remision, pago) VALUES ('$lote_id','$producto_id','$cliente_id','$usuario_id','$fecha','$valor','$cantidad','$n_remision','$pago')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al registrar la venta';
				return;
			}
		}


		//generar reporte de un empleado en una finca
		if ($tipo == 'generar') {
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
			$query = "SELECT lo.nombre AS 'lote',la.nombre,r.tipo,r.valor AS 'contrato',l.valor AS 'dia' FROM lote AS lo INNER JOIN registro_labor AS r INNER JOIN labores AS la INNER JOIN labor_empleado AS l WHERE  lo.id_finca = '$finca_id' AND r.lote_id = lo.id AND  ((r.fecha) BETWEEN '$inicio' AND '$fin') AND r.labor_id=la.id AND l.registro_id = r.id AND l.empleado_id = '$id'";
			$sql = mysqli_query($conection,$query);
			if($sql){
				$salida = array();
				$aux = array();
				$total = 0;
				while ($row = mysqli_fetch_array($sql)) {
					if($row['tipo'] == "1"){//al contrato
						$aux[] = $row['nombre'].' al contrato en el lote '.$row['lote'];
						$total += $row['contrato'];
					}elseif ($row['tipo'] == "2") {//al dia
						$aux[] = $row['nombre'].' al día en el lote '.$row['lote'];
						$total += $row['dia'];						
					}
				}
				$salida['valor'] = $total;
				$salida['labores'] = $aux;

				//consultamos la información del empleado
				$query = "SELECT * FROM empleado WHERE id='$id'";
				$sql = mysqli_query($conection,$query);
				if($sql){
					$aux = mysqli_fetch_array($sql);
					$salida['identificacion'] = $aux['identificacion'];
					$salida['nombre'] = $aux['nombre'];
					$salida['apellido'] = $aux['apellidos'];
					echo json_encode($salida);
					return;
				}
			}
		}

		//consultar los productos de un lote por su cultivo
		if ($tipo == 'productos') {
			$nombreCultivo = $_POST['cultivo'];

			include '../conection.php';
			$query = "SELECT p.id,p.nombre FROM producto AS p INNER JOIN cultivo AS c WHERE c.id = p.cultivo_id AND c.nombre = '$nombreCultivo'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				while ($row = mysqli_fetch_array($sql)) {
					?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
    				<?php
				}
			}
		}

	}
?>