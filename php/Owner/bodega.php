<?php 
	include 'key.php';
	 if (isset($_POST)) {
	 	$tipo = $_POST['op'];

	 	//Delete
		if ($tipo == "delete") {

			$id = $_POST['id'];

			$query = "DELETE FROM insumos WHERE id = '$id'";

			include "../../php/conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1";
			} else {
				echo "0";
			}
		}
	}
?>