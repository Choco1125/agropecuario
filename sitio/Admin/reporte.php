<?php
include "main.php";
?>
<style>
	th,
	td {
		text-align: center;
	}
</style>

<div class="container">
	<br>
	<a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
	<br>
	<br>
	<form method="GET" onsubmit="return verificar();">
		<h2 class="text-center">
			Reporte - <?php
								include "../../php/conection.php";
								$query = "SELECT nombre FROM finca WHERE id = " . $_SESSION['finca'];
								$sql = mysqli_query($conection, $query);
								if ($sql) {
									echo mysqli_fetch_array($sql)['nombre'];
								}
								?>
		</h2>
		<div class="row align-items-end">
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="inicio">Fecah de Inicio</label>
					<input id="inicio" name="inicio" type="date" value="<?php echo (isset($_GET)) ? $_GET['inicio'] : '' ?>" class="form-control">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="fin">Fecha Final</label>
					<input id="fin" name="fin" type="date" value="<?php echo (isset($_GET)) ? $_GET['fin'] : '' ?>" class="form-control">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="lote">Lote</label>
					<select class="form-control" name="lote" id="lote">
						<option value="">Seleccione el lote</option>
						<?php
						if (isset($_GET)) {
							if ($_GET['lote'] == 'todos') {
								echo '<option value="todos" selected>Todos</option>';
							} else {
								echo '<option value="todos">Todos</option>';
							}
						} else {
							echo '<option value="todos">Todos</option>';
						}

						$query = "SELECT * FROM lote WHERE id_finca=" . $_SESSION['finca'];
						$sql = mysqli_query($conection, $query);
						if ($sql) {
							while ($row = mysqli_fetch_array($sql)) {
								if (isset($_GET)) {
									if ($_GET['lote'] == $row['id']) {
						?>
										<option value="<?php echo $row['id'] ?>" selected><?php echo $row['nombre'] ?></option>
									<?php
									} else {
									?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
									<?php
									}
								} else {
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
						<?php
								}
							}
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="form-group text-center">
					<label for=""></label>
					<button type="submit" class="btn btn-success"> Generar </button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="container-fluid">

	<?php
	if (isset($_GET['lote'])) {

		$inicio = $_GET['inicio'];
		$fin = $_GET['fin'];

		$query;
		if ($_GET['lote'] == 'todos') {
			$query = "SELECT * FROM lote WHERE id_finca=" . $_SESSION['finca'];
		} else {
			$query = "SELECT * FROM lote WHERE id=" . $_GET['lote'];
		}

		$sql1 = mysqli_query($conection, $query);
		if ($sql1) {
			while ($lote = mysqli_fetch_array($sql1)) {
	?>
				<h2 class="text-center"><?php echo $lote['nombre'] ?></h2>
				<?php
				/*************************************/
				//labores registradas al dia				
				/*************************************/
				$query = "SELECT r.id,r.fecha,l.nombre FROM registro_labor AS r INNER JOIN labores AS l WHERE r.labor_id=l.id AND r.lote_id=" . $lote['id'] . " AND r.fecha BETWEEN '$inicio' AND '$fin' AND r.labor=1 AND r.tipo=0";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
				?>
						<h3><?php echo $row['fecha'] . ' - ' . $row['nombre'] . ' al día' ?></h3>

						<?php
						// empleados
						$query = "SELECT * FROM labor_empleado WHERE registro_id=" . $row['id'];
						$labor = mysqli_query($conection, $query);
						if ($labor) {
							$num = mysqli_num_rows($labor);
							if ($num > 0) {
						?>
								<h4>Empleados</h4>
								<table class="table">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Valor</th>
										</tr>
									</thead>
									<tbody>
										<?php
										while ($dat = mysqli_fetch_array($labor)) {
											if ($dat['empleado_id'] > 0) {
												$query = "SELECT * FROM empleado WHERE id=" . $dat['empleado_id'];
												$aux = mysqli_query($conection, $query);
												if ($aux) {
													$aux = mysqli_fetch_array($aux);
													echo '<tr>
														<td>' . $aux['nombre'] . '</td>
														<td>' . $dat['valor'] . '</td>
													</tr>';
												}
											} else {
												echo '<tr>
													<td>' . $dat['nombre'] . '</td>
													<td>' . $dat['valor'] . '</td>
												</tr>';
											}
										}
										?>
									</tbody>
								</table>
							<?php
							}
						}

						//insumos
						$query = "SELECT * FROM bodega_labor WHERE registro_id=" . $row['id'];
						$insumos = mysqli_query($conection, $query);
						if (mysqli_num_rows($insumos) > 0) {
							?>
							<h3>Insumos</h3>
							<table class="table">
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
											$query = "SELECT SUM(r.valor*r.cantidad) AS 'valor',SUM(r.cantidad) AS 'cantidad' FROM bodega_labor AS r INNER JOIN bodega AS b WHERE registro_id=" . $row['id'] . " AND bodega_id=b.id AND b.insumo_id=" . $dat['id'];
											$aux = mysqli_query($conection, $query);
											if ($aux) {
												$num = mysqli_num_rows($aux);
												$aux = mysqli_fetch_array($aux);
												if ($num > 0 && !is_null($aux['cantidad'])) {
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


				/*************************************/
				//estado labores al contrato				
				/*************************************/
				//se muestra el estado (¿se tiene que llevar un historial?)

				$query = "SELECT r.id,r.fecha,l.nombre,r.valor FROM registro_labor AS r INNER JOIN labores AS l WHERE r.labor_id=l.id AND r.lote_id=" . $lote['id'] . " AND r.fecha BETWEEN '$inicio' AND '$fin' AND r.labor=1 AND r.tipo=1";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
						?>
						<h3><?php echo $row['fecha'] . ' - ' . $row['nombre'] . ' al contrato' ?></h3>
						<h5>Valor: <?php echo $row['valor'] ?></h5>

						<?php
						// empleados
						$query = "SELECT * FROM labor_empleado WHERE registro_id=" . $row['id'];
						$labor = mysqli_query($conection, $query);
						if ($labor) {
							$num = mysqli_num_rows($labor);
							if ($num > 0) {
						?>
								<h4>Empleados</h4>
								<table class="table">
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

						//insumos
						$query = "SELECT * FROM bodega_labor WHERE registro_id=" . $row['id'];
						$insumos = mysqli_query($conection, $query);
						if (mysqli_num_rows($insumos) > 0) {
							?>
							<h3>Insumos</h3>
							<table class="table">
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
											$query = "SELECT SUM(r.valor*r.cantidad) AS 'valor',SUM(r.cantidad) AS 'cantidad' FROM bodega_labor AS r INNER JOIN bodega AS b WHERE registro_id=" . $row['id'] . " AND bodega_id=b.id AND b.insumo_id=" . $dat['id'];
											$aux = mysqli_query($conection, $query);
											if ($aux) {
												$num = mysqli_num_rows($aux);
												$aux = mysqli_fetch_array($aux);
												if ($num > 0 && !is_null($aux['cantidad'])) {
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


				/*************************************/
				//reporte de despache				
				/*************************************/
				$query = "SELECT d.fecha,d.cantidad,p.nombre FROM despache AS d INNER JOIN producto AS p WHERE d.fecha BETWEEN '$inicio' AND '$fin' AND d.producto_id=p.id AND lote_id=" . $lote['id'];
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					?>
					<hr><br><br>
					<h6>REPORTE DE DESPACHE</h6>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Producto</th>
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $row['fecha'] ?></td>
									<td><?php echo $row['nombre'] ?></td>
									<td><?php echo $row['cantidad'] ?></td>
								<?php
							}
								?>
								</tr>
						</tbody>
					</table>
				<?php
				}


				$finca_id = $_SESSION['finca'];

				/*************************************/
				//compras con usuario				insumo usuarios proveedor
				/*************************************/
				$query = "SELECT c.valor,c.cantidad,c.n_factura,c.fecha,i.nombre AS 'insumo',u.nombre,u.apellido,p.nombre AS 'proveedor' FROM compras AS c INNER JOIN insumo AS i INNER JOIN usuarios AS u INNER JOIN proveedor AS p WHERE c.fecha BETWEEN '$inicio' AND '$fin' AND c.insumo_id=i.id AND c.usuario_id=u.id AND c.proveedor_id=p.id AND c.finca_id='$finca_id'";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
				?>
					<hr><br><br>
					<h6>COMPRAS</h6>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha</th>
								<th># Factura</th>
								<th>Insumo</th>
								<th>Cantidad</th>
								<th>Usuario</th>
								<th>Proveedor</th>
								<th>Valor</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $row['fecha'] ?></td>
									<td><?php echo $row['n_factura'] ?></td>
									<td><?php echo $row['insumo'] ?></td>
									<td><?php echo $row['cantidad'] ?></td>
									<td><?php echo $row['nombre'] . ' ' . $row['apellido'] ?></td>
									<td><?php echo $row['proveedor'] ?></td>
									<td><?php echo $row['valor'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				<?php
				}



				/*************************************/
				//ventas con usuario				producto cliente
				/*************************************/
				$query = "SELECT v.fecha,v.valor,v.cantidad,v.n_remision,v.pago,u.nombre,u.apellido,p.nombre AS 'producto',c.nombre AS 'cliente' FROM ventas AS v INNER JOIN producto AS p INNER JOIN cliente AS c INNER JOIN usuarios AS u WHERE v.fecha BETWEEN '$inicio' AND '$fin' AND v.producto_id=p.id AND v.cliente_id=c.id AND u.id=v.usuario_id AND v.lote_id=" . $lote['id'];
				$sql = mysqli_query($conection, $query);
				if ($sql) {
				?>
					<hr><br><br>
					<h6>VENTAS</h6>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha</th>
								<th># Remisión</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Usuario</th>
								<th>Cliente</th>
								<th>Valor</th>
								<th>Tipo de Pago</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $row['fecha'] ?></td>
									<td><?php echo $row['n_remision'] ?></td>
									<td><?php echo $row['producto'] ?></td>
									<td><?php echo $row['cantidad'] ?></td>
									<td><?php echo $row['nombre'] . ' ' . $row['apellido'] ?></td>
									<td><?php echo $row['cliente'] ?></td>
									<td><?php echo $row['valor'] ?></td>
									<td><?php echo $row['pago'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				<?php
				}

				/*************************************/
				//gastos administrativos				
				/*************************************/
				$query = "SELECT g.fecha,g.valor,g.n_factura,observacion,r.nombre FROM gastos_administrativos AS g INNER JOIN rubro_administrativo AS r  WHERE g.fecha BETWEEN '$inicio' AND '$fin' AND g.rubro_id=r.id AND g.finca_id='$finca_id'";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
				?>
					<hr><br><br>
					<h6>GASTOS ADMINISTRATIVOS</h6>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha</th>
								<th># Factura</th>
								<th>Concepto</th>
								<th>Valor</th>
								<th>Observación</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $row['fecha'] ?></td>
									<td><?php echo $row['n_factura'] ?></td>
									<td><?php echo $row['nombre'] ?></td>
									<td><?php echo $row['valor'] ?></td>
									<td><?php echo $row['observacion'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				<?php
				}


				/*************************************/
				//costos financieros				
				/*************************************/
				$query = "SELECT g.fecha,g.valor,g.n_factura,observacion,r.nombre FROM gastos_financiero AS g INNER JOIN rubro_financiero AS r  WHERE g.fecha BETWEEN '$inicio' AND '$fin' AND g.rubro_id=r.id AND g.finca_id='$finca_id'";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
				?>
					<hr><br><br>
					<h6>COSTOS FINANCIEROS</h6>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha</th>
								<th># Factura</th>
								<th>Concepto</th>
								<th>Valor</th>
								<th>Observación</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $row['fecha'] ?></td>
									<td><?php echo $row['n_factura'] ?></td>
									<td><?php echo $row['nombre'] ?></td>
									<td><?php echo $row['valor'] ?></td>
									<td><?php echo $row['observacion'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				<?php
				}


				/*************************************/
				//beneficios post-cosecha				
				/*************************************/
				$query = "SELECT g.fecha,g.valor,g.n_factura,observacion,r.nombre AS 'rubro',c.nombre AS 'cultivo' FROM gastos_post AS g INNER JOIN rubros_post AS r INNER JOIN cultivo as c WHERE g.fecha BETWEEN '$inicio' AND '$fin' AND g.rubro_id=r.id AND g.cultivo_id = c.id AND g.finca_id='$finca_id'";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
				?>
					<hr><br><br>
					<h6>BENEFICIOS POST-COSECHA</h6>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha</th>
								<th># Factura</th>
								<th>Concepto</th>
								<th>Cultivo</th>
								<th>Valor</th>
								<th>Observación</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $row['fecha'] ?></td>
									<td><?php echo $row['n_factura'] ?></td>
									<td><?php echo $row['rubro'] ?></td>
									<td><?php echo $row['cultivo'] ?></td>
									<td><?php echo $row['valor'] ?></td>
									<td><?php echo $row['observacion'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				<?php
				}


				/*************************************/
				//otros gastos
				/*************************************/
				$query = "SELECT g.fecha,g.valor,g.n_factura,observacion,r.nombre FROM gastos_otros AS g INNER JOIN rubros_otros AS r  WHERE g.fecha BETWEEN '$inicio' AND '$fin' AND g.rubro_id=r.id AND g.finca_id='$finca_id'";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
				?>
					<hr><br><br>
					<h6>OTROS GASTOS</h6>
					<br>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha</th>
								<th># Factura</th>
								<th>Concepto</th>
								<th>Valor</th>
								<th>Observación</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $row['fecha'] ?></td>
									<td><?php echo $row['n_factura'] ?></td>
									<td><?php echo $row['nombre'] ?></td>
									<td><?php echo $row['valor'] ?></td>
									<td><?php echo $row['observacion'] ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
	<?php
				}
			}
		}
	}
	?>

</div>


</body>

<?php
include "end.php";
?>
<script src="../../js/sweetalert.min.js"></script>
<script>
	function verificar() {
		var inicio = $('#inicio');
		var fin = $('#fin');
		var lote = $('#lote');

		if (inicio.val() == "") {
			swal('Error!', 'Debe de ingresar una fecha de inicio para el reporte', 'error').then((res) => {
				inicio.focus();
			});
			return false;
		}

		if (fin.val() == "") {
			swal('Error!', 'Debe de ingresar una fecha de final para el reporte', 'error').then((res) => {
				fin.focus();
			});
			return false;
		}

		if (lote.val() == "") {
			swal('Error!', 'Debe de ingresar un lote para el reporte', 'error').then((res) => {
				lote.focus();
			});
			return false;
		}

		return true;
	}
</script>

</html>