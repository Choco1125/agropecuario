
<?php 
	include 'key.php';
	if (isset($_POST)) {
		$inicio = $_POST['fecha_inicio'];
		$fin    = $_POST['fecha_fin'];

		//consulta
		include '../conection.php';
		$query = "SELECT * FROM pluviometria WHERE (fecha) BETWEEN '$inicio' AND '$fin' ORDER BY fecha ASC";
		$sql = mysqli_query($conection,$query);
		if ($sql) {
			$aux = array();
			while ($row = mysqli_fetch_array($sql)) {
				$aux[] = $row;
			}
			echo json_encode($aux);			
		}
	}

 ?>