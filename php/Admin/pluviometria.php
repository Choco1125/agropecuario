<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];


		//agregar
		if ($tipo == "insert") {
			include '../conection.php';

			//datos
			$finca = $_SESSION['finca'];
			$fecha = $_POST['fecha'];
			$milimetros = $_POST['milimetros'];

			$query = "INSERT INTO pluviometria(finca_id, fecha, milimetros) VALUES ('$finca','$fecha','$milimetros')";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo "1";
			}else{
				echo "Ocurrio un error al agregar el registro,compruebe que no haya registrado esta fecha anteriormente.";
			}
		}

		//eliminar
		if ($tipo == "delete") {
			include '../conection.php';

			//datos
			$id =$_POST['id'];
			$query = "DELETE FROM pluviometria WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo "1";
			}else{
				echo "Ocurrio un error al eliminar el registro";
			}
		}


		//editar
		if ($tipo == "edit") {
			include '../conection.php';

			//datos
			$id =$_POST['id'];
			$fecha = $_POST['fecha'];
			$milimetros = $_POST['milimetros'];

			$query = "UPDATE pluviometria SET id='$id',fecha='$fecha',milimetros='$milimetros' WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				echo "1";
			}else{
				echo "Ocurrio un error al editar el registro";
			}
		}

		//consultar
		if ($tipo == "read") {
			include '../conection.php';

			//datos
			$id =$_POST['id'];

			$query = "SELECT * FROM pluviometria WHERE id = '$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {				
				echo json_encode(mysqli_fetch_array($sql));
			}
		}

	}

 ?>