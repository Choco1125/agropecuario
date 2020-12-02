<?php
include 'key.php';
if (isset($_POST)) {
	$tipo = $_POST['op'];


	/******************************/
	//agregar labor a un lote
	/*****************************/
	if ($tipo == "add") {

		include '../conection.php';
		$tipo_l = $_POST['tipo'];
		$id;

		//se registra los datos importantes de la labor
		$labor = $_POST['labor'];
		$tipoLabor = $_POST['tipoLabor'];
		$lote = $_POST['lote'];
		$fecha = $_POST['fecha'];
		$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '0';
		$valor = (isset($_POST['valor'])) ? str_replace(",", "", $_POST['valor']) : '0';
		$observacion = $_POST['observacion'];
		$ph_inicial = $_POST['ph_inicial'];
		$ph_final = $_POST['ph_final'];

		//registrar la pluviometria si llega como parametro
		/**************************************************/

		$query = "INSERT INTO registro_labor(labor_id, lote_id, fecha, tipo, estado, valor, observacion,ph_inicial,ph_final) VALUES ('$labor','$lote','$fecha','$tipo_l','$estado','$valor','$observacion','$ph_inicial','$ph_final')";
		// echo $query;
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			$query = "SELECT id FROM registro_labor ORDER BY id DESC LIMIT 0,1";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$id = mysqli_fetch_array($sql)['id'];

				//tipos de labor (tipoLabor,fumigacion,ninguno)

				/****************************/
				//registrar empleados
				/****************************/
				$kilos = 0;
				if ($tipoLabor == 'recoleccion') {
					for ($i = 1; $i <= $_POST['cantidad_empleados']; $i++) {
						$empleado = $_POST['id_empleado' . $i];
						$valor = $_POST['valor' . $i];
						$auxkilos = $_POST['kilos' . $i];
						$kilos += $auxkilos;
						$query = "INSERT INTO labor_empleado(registro_id, empleado_id, nombre, valor,kilos) VALUES ('$id','$empleado','','$valor','$auxkilos')";
						echo $query;
						$sql = mysqli_query($conection, $query);
						if (!$sql) {
							echo "Se produjo un error al registrar los empleados";
							return;
						}
					}
				} else {
					for ($i = 1; $i <= $_POST['cantidad_empleados']; $i++) {
						$empleado = $_POST['id_empleado' . $i];
						$valor = $_POST['valor' . $i];
						$query = "INSERT INTO labor_empleado(registro_id, empleado_id, nombre, valor,kilos) VALUES ('$id','$empleado','','$valor',$kilos)";
						$sql = mysqli_query($conection, $query);
						if (!$sql) {
							echo "Se produjo un error al registrar los empleados";
							return;
						}
					}
				}

				/******************************/
				//registrar kilos si se trata 
				//de una recolección
				/*****************************/
				if ($tipoLabor == "recoleccion") {
					$valor_kilo = (isset($_POST['valor_kilo'])) ? str_replace(",", "", $_POST['valor_kilo']) : '';
					$query = "INSERT INTO kilos(registro_id, kilos, valor_kilo) VALUES ('$id','$kilos','$valor_kilo')";
					// echo $query;
					$sql = mysqli_query($conection, $query);
					if (!$sql) {
						echo 'Ocurrio un erro al registrar los kilos de esta labor';
						return;
					}
				}

				/*****************************/
				//registrar insumos
				/*****************************/
				for ($i = 1; $i <= $_POST['cantidad_insumos']; $i++) {
					$id_insumo = $_POST['id_insumo' . $i];
					$cantidad = $_POST['i_cantidad' . $i];

					//retirar de la bodega
					$query = "SELECT cantidad,valor FROM bodega WHERE id='$id_insumo'";
					$sql = mysqli_query($conection, $query);
					if ($sql) {
						$aux = mysqli_fetch_array($sql);
						$cant_ant = $aux['cantidad'];
						$valor_ant = $aux['valor'];

						$query = "INSERT INTO bodega_labor(registro_id, bodega_id, cantidad, valor) VALUES ('$id','$id_insumo','$cantidad','$valor_ant')";
						$sql = mysqli_query($conection, $query);
						if (!$sql) {
							echo "Se produjo un error al registrar los insumos";
							return;
						}


						$cant = $cant_ant - $cantidad;
						$query = "UPDATE bodega SET cantidad='$cant' WHERE id='$id_insumo'";
						$sql = mysqli_query($conection, $query);
						if ($sql) {
							$query = "INSERT INTO historial(bodega_id, fecha, proceso, operacion, cantidad,valor,valor_ant,cantidad_ant) VALUES ('$id_insumo','$fecha','$id','0','$cantidad','0','$valor_ant','$cant_ant')";
							$sql = mysqli_query($conection, $query);

							if (!$sql) {
								echo $query;
								echo "Error al registrar historial";
								return;
							}
						} else {
							echo "Error al retirar de bodega";
							return;
						}
					} else {
						echo "Error al retirar de bodega";
						return;
					}
				}
				echo '1';
				return;
			} else {
				echo 'Error al registrar labor';
				return;
			}
		} else {
			echo 'Error al registrar labor: ';
			return;
		}
	}

	/******************************/
	//presupuestar labor a un lote
	/*****************************/
	if ($tipo == "presupuestar") {
		include '../conection.php';
		$tipo_l = $_POST['tipo'];
		$id;

		//se registra los datos importantes de la labor
		// $labor = explode('-', $_POST['labor'])[0];
		$labor = $_POST['labor']; //Elimina el indice nulo y se deja solo el id
		$lote = $_POST['lote'];
		$fecha = $_POST['fecha'];
		$empleados = "";
		if (isset($_POST['jornales'])) {
			$empleados = $_POST['jornales'];
		} else if (isset($_POST['kilos'])) {
			$empleados = $_POST['kilos'];
		}
		$valor = str_replace(",", "", $_POST['valor']);
		$observacion = $_POST['observacion'];


		//estado para las labores presupuestadas guardo o el número de jornales o el total de kilos
		$query = "INSERT INTO registro_labor(labor_id, lote_id, fecha, tipo, estado, valor, observacion,labor,ph_inicial,ph_final) VALUES ('$labor','$lote','$fecha','$tipo_l','$empleados','$valor','$observacion','0','','')";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			$query = "SELECT id FROM registro_labor ORDER BY id DESC LIMIT 0,1";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$id = mysqli_fetch_array($sql)['id'];

				/*****************************/
				//registrar insumos
				/*****************************/

				$cantidad_insumos = $_POST['cantidad_insumos'];
				for ($i = 1; $i <= $cantidad_insumos; $i++) {
					if (isset($_POST['id_insumo' . $i])) {
						$id_insumo = $_POST['id_insumo' . $i];
						$cantidad = $_POST['i_cantidad' . $i];
						//calcular precio
						$query = "SELECT valor FROM bodega WHERE id='$id_insumo'";
						$sql = mysqli_query($conection, $query);
						if ($sql) {
							$aux = mysqli_fetch_array($sql);
							$valor = $aux['valor'];

							$query = "INSERT INTO bodega_labor(registro_id, bodega_id, cantidad, valor) VALUES ('$id','$id_insumo','$cantidad','$valor')";
							$sql = mysqli_query($conection, $query);
							if (!$sql) {
								echo "Se produjo un error al registrar los insumos";
								return;
							}
						}
					}
				}

				echo '1';
				return;
			} else {
				echo 'Error al registrar labor';
				return;
			}
		} else {
			echo 'Error al registrar labor';
			return;
		}
	}

	if ($tipo == "estado") {
		$id = $_POST['id'];
		$estado = $_POST['valor'];

		include '../conection.php';
		$query = "UPDATE registro_labor SET estado='$estado' WHERE id='$id'";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
		} else {
			echo 'Ocurrio un error al cambiar el estado';
		}
	}

	if ($tipo == 'insumo') {
		$id = $_POST['id'];
		$id_insumo = $_POST['insumo'];
		$cantidad = $_POST['cantidad'];
		//obtener hora
		date_default_timezone_set('America/Bogota');

		$time = time();
		$dia = date("d", $time);
		$mes = date("m", $time);
		$anyo = date("Y", $time);
		$fecha = $anyo . "-" . $mes . "-" . $dia;

		//retirar de la bodega
		include '../conection.php';
		$query = "SELECT cantidad,valor FROM bodega WHERE id='$id_insumo'";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			$aux = mysqli_fetch_array($sql);
			$cant_ant = $aux['cantidad'];
			$valor_ant = $aux['valor'];

			$query = "INSERT INTO bodega_labor(registro_id, bodega_id, cantidad, valor) VALUES ('$id','$id_insumo','$cantidad','$valor_ant')";
			$sql = mysqli_query($conection, $query);
			if (!$sql) {
				echo "Se produjo un error al registrar los insumos";
				return;
			}


			$cant = $cant_ant - $cantidad;
			$query = "UPDATE bodega SET cantidad='$cant' WHERE id='$id_insumo'";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$query = "INSERT INTO historial(bodega_id, fecha, proceso, operacion, cantidad,valor,valor_ant,cantidad_ant) VALUES ('$id_insumo','$fecha','$id','0','$cantidad','','$valor_ant','$cant_ant')";
				$sql = mysqli_query($conection, $query);
				if (!$sql) {
					echo "Error al registrar historial";
					return;
				} else {
					echo json_encode(array('res' => '1', 'cantidad' => $cant));
					return;
				}
			} else {
				echo "Error al retirar de bodega";
				return;
			}
		}
	}

	if ($tipo == 'unidad') {
		$id = $_POST['id'];

		//consultar la unidad y existencia de un insumo
		include '../conection.php';
		$query = "SELECT b.cantidad,i.unidad FROM insumo AS i INNER JOIN bodega as b WHERE b.insumo_id = i.id AND b.finca_id = '" . $_SESSION['finca'] . "' and b.id = '$id'";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo json_encode(mysqli_fetch_array($sql));
		}
	}

	if ($tipo == 'unidadInsumo') {
		$id = $_POST['id'];

		//consultar la unidad y existencia de un insumo
		include '../conection.php';
		$query = "SELECT unidad FROM insumo  WHERE id = '$id'";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo json_encode(mysqli_fetch_array($sql));
		}
	}

	if ($tipo == 'empleados_contrato') {
		$id = $_POST['id'];
		include '../conection.php';
		$query = "SELECT * FROM labor_empleado WHERE registro_id=" . $id;
		$labor = mysqli_query($conection, $query);
		if ($labor) {
			$num = mysqli_num_rows($labor);
			if ($num > 0) {
?>
				<table class="table" id="tabla_e">
					<thead>
						<tr>
							<th>Nombre</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($dat = mysqli_fetch_array($labor)) {
							if ($dat['empleado_id'] > 0) {
								$query = "SELECT nombre FROM empleado WHERE id=" . $dat['empleado_id'];
								$aux = mysqli_query($conection, $query);
								if ($aux) {
									$aux = mysqli_fetch_array($aux);
									echo '<tr>
										<td>' . $aux['nombre'] . '</td>
									</tr>';
								}
							} else {
								echo '<tr>
									<td>' . $dat['nombre'] . '</td>
								</tr>';
							}
						}
						?>
					</tbody>
				</table>
			<?php
			}
		}
	}


	if ($tipo == 'insumos') {
		$id = $_POST['id'];
		include '../conection.php';
		$query = "SELECT * FROM bodega_labor WHERE registro_id=" . $id;
		$insumos = mysqli_query($conection, $query);
		if (mysqli_num_rows($insumos) > 0) {
			?>
			<table class="table" id="tabla_i">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th>Valor</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT id,nombre FROM insumo";
					$insumos = mysqli_query($conection, $query);
					if ($insumos) {
						while ($dat = mysqli_fetch_array($insumos)) {
							$query = "SELECT SUM(r.valor*r.cantidad) AS 'valor',SUM(r.cantidad) AS 'cantidad' FROM bodega_labor AS r INNER JOIN bodega AS b WHERE registro_id='$id' AND bodega_id=b.id AND b.insumo_id=" . $dat['id'];
							$aux = mysqli_query($conection, $query);
							if ($aux) {
								$aux = mysqli_fetch_array($aux);
								if ($aux['cantidad'] > 0) {
									echo '<tr>
										<td>' . $dat['nombre'] . '</td>
										<td>' . $aux['cantidad'] . '</td>
										<td>' . $aux['valor'] . '</td>
									</tr>';
								}
							}
						}
					}
					?>
				</tbody>
			</table>
<?php
		}
	}
}


?>