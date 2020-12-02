<?php
include 'key.php';
if (isset($_POST)) {
	$tipo = $_POST['op'];

	//Insertar cultivo
	if ($tipo == "insert") {
		$finca_id = $_POST['finca'];
		$articulo = $_POST['articulo'];
		$valor = $_POST['valor'];
		$fecha = $_POST['fecha'];
		$n_factura = $_POST['n_factura'];
		$cantidad = $_POST['cantidad'];
		$observacion = $_POST['observacion'];



		$query = "INSERT INTO maquinaria(finca_id, articulo, valor, fecha, n_factura, cantidad, observacion) VALUES ('$finca_id','$articulo','$valor','$fecha','$n_factura','$cantidad','$observacion')";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo "1";
		} else {
			echo "0";
		}
	}

	//Eliminar cultivo
	if ($tipo == "delete") {

		$id = $_POST['id'];

		$query = "DELETE FROM maquinaria WHERE id = '$id'";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo "1";
		} else {
			echo "0";
		}
	}

	//Editar cultivo
	if ($tipo == "edit") {
		$id = $_POST['id'];
		$finca_id = $_POST['finca'];
		$articulo = $_POST['articulo'];
		$valor = $_POST['valor'];
		$fecha = $_POST['fecha'];
		$n_factura = $_POST['n_factura'];
		$cantidad = $_POST['cantidad'];
		$observacion = $_POST['observacion'];

		$query = "UPDATE maquinaria SET finca_id='$finca_id',articulo='$articulo',valor='$valor',fecha='$fecha',n_factura='$n_factura',cantidad='$cantidad',observacion='$observacion' WHERE id='$id'";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo "1";
		} else {
			echo "0";
		}
	}


	//Mostrar datos que se editarán en el modal
	if ($tipo == "read") {
		$id = $_POST['id'];

		$query = "SELECT * FROM maquinaria WHERE id = '$id'";

		include "../../php/conection.php";

		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo json_encode(mysqli_fetch_array($sql));
		}
	}
}
