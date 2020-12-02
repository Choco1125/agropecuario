<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//agregar
		if ($tipo == 'add') {
			
			//obtenemos los datos del post
			$fecha = $_POST['fecha'];
			$factura = $_POST['factura'];
			$insumo_id = $_POST['insumo'];
			$proveedor_id = $_POST['proveedor'];
			$cantidad = $_POST['cantidad'];
			$valor = $_POST['valor'] / $cantidad;
			//obtenemos la finca que administra
			$finca_id = $_SESSION['finca'];
			$usuario_id = $_SESSION['id'];

			//revisamos si en la bodega ya existe este insumo
			//de lo contrario se procede a registrarlo
			//con cantidad y valor en 0

			include '../conection.php';
			$query = "SELECT id FROM bodega WHERE insumo_id='$insumo_id' AND finca_id='$finca_id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				$num = mysqli_num_rows($sql);
				$bodega_id;
				if($num > 0){
					$bodega_id = mysqli_fetch_array($sql)['id'];
				}else{
					$query = "INSERT INTO bodega(finca_id, insumo_id, cantidad, valor) VALUES ('$finca_id','$insumo_id','0','0')";
					$sql = mysqli_query($conection,$query);
					if ($sql) {
						$query = "SELECT id FROM bodega WHERE insumo_id='$insumo_id' AND finca_id='$finca_id'";
						$sql = mysqli_query($conection,$query);
						if ($sql) {
							$bodega_id = mysqli_fetch_array($sql)['id'];
						}else{
							echo "Ocurrio un error al registrar en la bodega";
							return;
						}
					}else{
						echo "Ocurrio un error al agregar en inventario de bodega";
						return;
					}
				}

				// se obtiene la cantidad y precio del insumo en bodega
				$cant_ant;
				$valor_ant;
				$query = "SELECT cantidad,valor FROM bodega WHERE id = '$bodega_id'";
				$sql = mysqli_query($conection,$query);
				if ($sql) {
					$aux = mysqli_fetch_array($sql);
					$cant_ant = $aux['cantidad'];
					$valor_ant = $aux['valor'];
				}else{
					echo "Ocurrio un error al consultar el inventario de bodega";
					return;
				}

				// se registra la compra en la BD
				$proceso;
				$query = "INSERT INTO compras(insumo_id, valor, cantidad, finca_id, usuario_id, proveedor_id, n_factura, fecha) VALUES ('$insumo_id','$valor','$cantidad','$finca_id','$usuario_id','$proveedor_id','$factura','$fecha')";
				$sql = mysqli_query($conection,$query);
				if ($sql) {
					$query = "SELECT * FROM compras ORDER BY id DESC LIMIT 0,1";
					$sql = mysqli_query($conection,$query);
					if ($sql) {
						$proceso = mysqli_fetch_array($sql)['id'];
					}
				}else{
					echo 'Ocurrio un error registrando la compra';
					return;
				}

				//se procede a registrar en el historial la operación
				//y a recalcular el valor total de los insumos
				$query = "INSERT INTO historial(bodega_id, fecha, proceso, operacion, cantidad, valor, valor_ant, cantidad_ant) VALUES ('$bodega_id','$fecha','$proceso','1',$cantidad,$valor,'$valor_ant','$cant_ant')";
				$sql = mysqli_query($conection,$query);
				if ($sql) {
					
					//actualizamos el inventario en la bodega
					$cant_act = $cant_ant + $cantidad;
					$valor_act = $valor;
					if($valor_ant > 0){
						$valor_act = ($valor_ant + $valor) / 2;
					}

					$query = "UPDATE bodega SET cantidad='$cant_act',valor='$valor_act' WHERE id='$bodega_id'";
					$sql = mysqli_query($conection,$query);
					if ($sql) {
						echo '1';
					}else{
						echo "Ocurrio un error al actualizar la bodega";
					}


				}else{
					echo "Ocurrio un error al registrar en el historial";
					return;
				}


			}else{
				echo "Ocurrio un error al revisar la bodega";
				return;
			}
		}

	}

 ?>