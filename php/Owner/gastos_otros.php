<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//agregar otros gastos
		if ($tipo == "add_otros") {
			
			//obtenemos los datos
			$fecha = $_POST['fecha'];
			$rubro_id = $_POST['rubro'];
			$valor = $_POST['valor'];
			$n_factura = $_POST['n_factura'];
			$observacion = $_POST['observacion'];
			$finca_id = $_SESSION['finca'];

			include '../conection.php';
			$query = "INSERT INTO gastos_otros(fecha,rubro_id,valor,n_factura,observacion,finca_id) VALUES('$fecha','$rubro_id','$valor','$n_factura','$observacion','$finca_id')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al registrar el gasto';
				return;
			}
		}

		//agregar gastos financieros
		if ($tipo == "add_financieros") {
			
			//obtenemos los datos
			$fecha = $_POST['fecha'];
			$rubro_id = $_POST['rubro'];
			$valor = $_POST['valor'];
			$n_factura = $_POST['n_factura'];
			$observacion = $_POST['observacion'];
			$finca_id = $_SESSION['finca'];

			include '../conection.php';
			$query = "INSERT INTO gastos_financieros(fecha,rubro_id,valor,n_factura,observacion,finca_id) VALUES('$fecha','$rubro_id','$valor','$n_factura','$observacion','$finca_id')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al registrar el gasto';
				return;
			}
		}

		//agregar gastos administrativos
		if ($tipo == "add_administrativos") {
			
			//obtenemos los datos
			$fecha = $_POST['fecha'];
			$rubro_id = $_POST['rubro'];
			$valor = $_POST['valor'];
			$n_factura = $_POST['n_factura'];
			$observacion = $_POST['observacion'];
			$finca_id = $_SESSION['finca'];

			include '../conection.php';
			$query = "INSERT INTO gastos_administrativos(fecha,rubro_id,valor,n_factura,observacion,finca_id) VALUES('$fecha','$rubro_id','$valor','$n_factura','$observacion','$finca_id')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al registrar el gasto';
				return;
			}
		}

		//agregar gastos post cosecha
		if ($tipo == "add_post") {
			
			//obtenemos los datos
			$fecha = $_POST['fecha'];
			$rubro_id = $_POST['rubro'];
			$cultivo_id = $_POST['cultivo'];
			$valor = $_POST['valor'];
			$n_factura = $_POST['n_factura'];
			$observacion = $_POST['observacion'];
			$finca_id = $_SESSION['finca'];

			include '../conection.php';
			$query = "INSERT INTO gastos_post(fecha,rubro_id,cultivo_id,valor,n_factura,observacion,finca_id) VALUES('$fecha','$rubro_id','$cultivo_id','$valor','$n_factura','$observacion','$finca_id')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al registrar el gasto';
				return;
			}
		}

		//eliminar otros gastos
		if ($tipo == "delete_otros") {
			
			//obtenemos los datos
			$id = $_POST['id'];

			include '../conection.php';
			$query = "DELETE FROM gastos_otros WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al eliminar el gasto';
				return;
			}
		}

		//eliminar gastos financieros
		if ($tipo == "delete_financieros") {
			
			//obtenemos los datos
			$id = $_POST['id'];

			include '../conection.php';
			$query = "DELETE FROM gastos_financieros WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al eliminar el gasto';
				return;
			}
		}

		//eliminar gastos administrativos
		if ($tipo == "delete_administrativos") {
			
			//obtenemos los datos
			$id = $_POST['id'];

			include '../conection.php';
			$query = "DELETE FROM gastos_administrativos WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al eliminar el gasto';
				return;
			}
		}

		//eliminar gastos post cosecha
		if ($tipo == "delete_post") {
			
			//obtenemos los datos
			$id = $_POST['id'];

			include '../conection.php';
			$query = "DELETE FROM gastos_post WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo '1';
				return;
			}else{
				echo 'Ocurrio un error al eliminar el gasto';
				return;
			}
		}

	}

 ?>