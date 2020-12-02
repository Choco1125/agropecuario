<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		
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

		//consultar la unidad de un produto
		if ($tipo == 'unidad'){
			//recuperamos el id
			$id = $_POST['id'];

			// consultamos en la BD
			include '../conection.php';
			$query = "SELECT unidad FROM producto WHERE id = '$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo json_encode(mysqli_fetch_array($sql));
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

		//consultar el reporde de despache de una fecha determinada
		if ($tipo == 'consultar') {
			$fecha_inicio = $_POST['fecha_inicio'];
			$fecha_final = $_POST['fecha_final'];

			require '../conection.php';
			$query = "SELECT d.fecha,d.cantidad,d.n_remision,d.unidad,d.observacion,l.nombre AS 'lote',p.nombre AS 'producto',c.nombre AS 'cliente' FROM despache As d INNER JOIN lote AS l INNER JOIN producto AS p INNER JOIN cliente AS c WHERE fecha BETWEEN '$fecha_inicio' and '$fecha_final' AND d.lote_id = l.id AND d.producto_id = p.id AND d.cliente_id = c.id";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				while ($row = mysqli_fetch_array($sql)) {
?>
				<div class="col-12">
					<label for="">Fecha: <?php echo $row['fecha'] ?></label>
				</div>
				<div class="col-12">
					<label for="">Número de remisión: <?php echo $row['n_remision'] ?></label>
				</div>
				<div class="col-12">
					<label for="">Lote: <?php echo $row['lote'] ?></label>
				</div>
				<div class="col-12">
					<label for="">Producto: <?php echo $row['producto'] ?></label>
				</div>
				<div class="col-12">
					<label for="">Cantidad: <?php echo $row['cantidad'] ?></label>
				</div>
				<div class="col-12">
					<label for="">Unidad / racimo: <?php echo $row['unidad'] ?></label>
				</div>
				<div class="col-12">
					<label for="">Cliente: <?php echo $row['cliente'] ?></label>
				</div>
				<div class="col-12">
					<label for="">Observaciones: <?php echo $row['observacion'] ?></label>
				</div>
				<hr>

<?php
				}
			}
		}

	}

 ?>