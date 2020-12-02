<?php
include 'key.php';
if (isset($_POST)) {
	$tipo = $_POST['op'];

	//agregar otros gastos
	if ($tipo == "add_otros") {

		//obtenemos los datos
		$tipo = $_POST['tipo'];
		$fecha = $_POST['fecha'];
		$rubro_id = $_POST['rubro'];
		$valor = $_POST['valor'];
		$n_factura = $_POST['n_factura'];
		$observacion = $_POST['observacion'];
		$finca_id = $_SESSION['finca'];

		include '../conection.php';
		$query = "INSERT INTO gastos_otros(fecha,rubro_id,valor,n_factura,observacion,finca_id,tipo) VALUES('$fecha','$rubro_id','$valor','$n_factura','$observacion','$finca_id','$tipo')";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
			return;
		} else {
			echo 'Ocurrio un error al registrar el gasto';
			return;
		}
	}

	//agregar gastos financieros
	if ($tipo == "add_financieros") {

		//obtenemos los datos
		$fecha = $_POST['fecha'];
		$tipo = $_POST['tipo'];
		$rubro_id = $_POST['rubro'];
		$valor = $_POST['valor'];
		$n_factura = $_POST['n_factura'];
		$observacion = $_POST['observacion'];
		$finca_id = $_SESSION['finca'];

		include '../conection.php';
		$query = "INSERT INTO gastos_financieros(fecha,rubro_id,valor,n_factura,observacion,finca_id,tipo) VALUES('$fecha','$rubro_id','$valor','$n_factura','$observacion','$finca_id','$tipo')";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
			return;
		} else {
			echo 'Ocurrio un error al registrar el gasto';
			return;
		}
	}

	//agregar gastos administrativos
	if ($tipo == "add_administrativos") {

		//obtenemos los datos
		$fecha = $_POST['fecha'];
		$tipo = $_POST['tipo'];
		$rubro_id = $_POST['rubro'];
		$valor = $_POST['valor'];
		$n_factura = $_POST['n_factura'];
		$observacion = $_POST['observacion'];
		$finca_id = $_SESSION['finca'];

		include '../conection.php';
		$query = "INSERT INTO gastos_administrativos(fecha,rubro_id,valor,n_factura,observacion,finca_id,tipo) VALUES('$fecha','$rubro_id','$valor','$n_factura','$observacion','$finca_id','$tipo')";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
			return;
		} else {
			echo 'Ocurrio un error al registrar el gasto';
			return;
		}
	}

	//agregar gastos post cosecha
	if ($tipo == "add_post") {

		//obtenemos los datos
		$fecha = $_POST['fecha'];
		$tipo = $_POST['tipo'];
		$rubro_id = $_POST['rubro'];
		$cultivo_id = $_POST['cultivo'];
		$valor = $_POST['valor'];
		$n_factura = $_POST['n_factura'];
		$observacion = $_POST['observacion'];
		$finca_id = $_SESSION['finca'];

		include '../conection.php';
		$query = "INSERT INTO gastos_post(fecha,rubro_id,cultivo_id,valor,n_factura,observacion,finca_id,tipo) VALUES('$fecha','$rubro_id','$cultivo_id','$valor','$n_factura','$observacion','$finca_id','$tipo')";
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo '1';
			return;
		} else {
			echo 'Ocurrio un error al registrar el gasto';
			return;
		}
	}
}
