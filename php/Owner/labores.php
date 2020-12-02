<?php 
	include 'key.php';
	if (isset($_POST)){
		$operation = $_POST['op'];
		$registro_id = $_POST['id'];

		if ($operation == 'insumos') {

			include '../conection.php';
			$query = "SELECT * FROM bodega_labor WHERE registro_id=".$registro_id;
			$insumos = mysqli_query($conection,$query);
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
				$insumos = mysqli_query($conection,$query);
				if ($insumos) {
					while ($dat = mysqli_fetch_array($insumos)) {
						$query = "SELECT SUM(r.valor*r.cantidad) AS 'valor',SUM(r.cantidad) AS 'cantidad' FROM bodega_labor AS r INNER JOIN bodega AS b WHERE registro_id='$registro_id' AND bodega_id=b.id AND b.insumo_id=".$dat['id'];
						$aux = mysqli_query($conection,$query);
						if ($aux) {
							$aux = mysqli_fetch_array($aux);
							if ($aux['cantidad'] > 0) {
								echo '<tr>
										<td>'.$dat['nombre'].'</td>
										<td>'.$aux['cantidad'].'</td>
										<td>'.$aux['valor'].'</td>
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

		if ($operation == 'empleados_dia') {

			include '../conection.php';
			$query = "SELECT * FROM labor_empleado WHERE registro_id=".$row['id'];
			$labor = mysqli_query($conection,$query);
			if ($labor) {
				$num = mysqli_num_rows($labor);
				if ($num >0) {
?>
					<table class="table" id="tabla_e">
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
							$query = "SELECT * FROM empleado WHERE id=".$dat['empleado_id'];
							$aux = mysqli_query($conection,$query);
							if ($aux) {
								$aux = mysqli_fetch_array($aux);
								echo '<tr>
										<td>'.$aux['nombre'].'</td>
										<td>'.$dat['valor'].'</td>
									</tr>';
							}
						}else{
							echo '<tr>
									<td>'.$dat['nombre'].'</td>
									<td>'.$dat['valor'].'</td>
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

		if ($operation == 'empleados_contrato') {

			include '../conection.php';
			$query = "SELECT * FROM labor_empleado WHERE registro_id=".$registro_id;
			$labor = mysqli_query($conection,$query);
			if ($labor) {
				$num = mysqli_num_rows($labor);
				if ($num >0) {
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
							$query = "SELECT nombre FROM empleado WHERE id=".$dat['empleado_id'];
							$aux = mysqli_query($conection,$query);
							if ($aux) {
								$aux = mysqli_fetch_array($aux);
								echo '<tr>
										<td>'.$aux['nombre'].'</td>
									</tr>';
							}
						}else{
							echo '<tr>
									<td>'.$dat['nombre'].'</td>
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

		if ($operation == "eliminar_p") {
			include '../conection.php';
			$query = "DELETE FROM registro_labor WHERE id=".$registro_id;
			echo $query;
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error eliminando el registro';
				return;
			}
		}


		if ($operation == "eliminar_e") {

			include '../conection.php';
			$query = "DELETE FROM registro_labor WHERE id=".$registro_id;
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				//se busca en el historial de bodega el registro en el que proceso
				//tenga ese id y la operacion sea 0
				$query = "SELECT id,bodega_id,valor_ant,cantidad_ant FROM historial WHERE proceso='$registro_id' AND operacion=0";
				$sql = mysqli_query($conection,$query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
						$id = $row['id'];
						$cantidad = $row['cantidad_ant'];
						$valor = $row['valor_ant'];
						$bodega_id = $row['bodega_id'];
						//se asigna a bodega en el id = bodega_id los valores anteriores
						$query = "UPDATE bodega SET cantidad='$cantidad',valor='$valor' WHERE id='$bodega_id'";
						$bodega = mysqli_query($conection,$query);
						if ($bodega) {
							// se consulta los registros con id mayor al del historia y que bodega_id
							// sea igual
							$query = "SELECT * FROM historial WHERE bodega_id='$bodega_id' AND id > '$id'";
							$historial = mysqli_query($conection,$query);
							if ($historial) {
								while ($row1 = mysqli_fetch_array($historial)) {
									$operacion = $row1['operacion'];

									//se consulta lo que hay en bodega
									$query = "SELECT * FROM bodega WHERE id='$bodega_id'";
									$bodega = mysqli_query($conection,$query);
									$bodega = mysqli_fetch_array($bodega);

									switch ($operacion) {
										case '0'://salida
											//set bodega											
											$cantidad = $bodega['cantidad'] - $row1['cantidad'];
											$query = "UPDATE bodega SET cantidad='$cantidad' WHERE id=".$bodega_id;
											$update = mysqli_query($conection,$query);

											//set historial
											$valor_ant = $bodega['valor'];
											$cantidad_ant = $bodega['cantidad'];
											$query = "UPDATE historial SET valor_ant='$valor_ant',cantidad_ant='$cantidad_ant' WHERE id=".$row1['id'];
											$update = mysqli_query($conection,$query);
											break;
										case '1'://entrada
											//set bodega											
											$cantidad = $bodega['cantidad'] + $row1['cantidad'];
											$valor = ($bodega['valor'] > 0) ? $row1['valor'] : ($bodega['valor']+$row1['valor'])/2 ;
											$query = "UPDATE bodega SET cantidad='$cantidad',valor='$valor' WHERE id=".$bodega_id;
											$update = mysqli_query($conection,$query);

											//set historial
											$valor_ant = $bodega['valor'];
											$cantidad_ant = $bodega['cantidad'];
											$query = "UPDATE historial SET valor_ant='$valor_ant',cantidad_ant='$cantidad_ant' WHERE id=".$row1['id'];
											$update = mysqli_query($conection,$query);
											break;
										case '2'://reajuste
											//set bodega											
											$cantidad = $row1['cantidad'];
											$valor = $row1['valor'];
											$query = "UPDATE bodega SET cantidad='$cantidad',valor='$valor' WHERE id=".$bodega_id;
											$update = mysqli_query($conection,$query);

											//set historial
											$valor_ant = $bodega['valor'];
											$cantidad_ant = $bodega['cantidad'];
											$query = "UPDATE historial SET valor_ant='$valor_ant',cantidad_ant='$cantidad_ant' WHERE id=".$row1['id'];
											$update = mysqli_query($conection,$query);
											break;
									}

								}
							}else{
								echo "Error al consultar historial";
							}
							//eliminar el registro del historial con el id
							$query = "DELETE FROM historial WHERE id = '$id'";
							$eliminar = mysqli_query($conection,$query);
						}else{
							echo 'Error al reajustar bodega';
							return;
						}						
					}

					echo '1';
					return;
				}else{
					echo 'Error al consultar bodega';
					return;
				}
				
			}else{
				echo 'Ocurrio un error eliminando el registro';
				return;
			}
			




			//se agregan nuevamente teniendo cuidado con la operacion
			//se elimina el registro

		}

	}

 ?>

