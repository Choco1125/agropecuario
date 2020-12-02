<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//agregar
		if ($tipo == "insert") {
			//obtenemos los datos 
			$identificacion = $_POST['identificacion'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];


			//insertamos en la BD
			include '../conection.php';
			$query = "INSERT INTO empleado(identificacion, nombre, apellidos) VALUES ('$identificacion','$nombre','$apellido')";
			$sql = mysqli_query($conection,$query);
			if($sql){
				echo '1';
			}else{
				echo 'No se logro agregar el empleado';
			}
		}

		//eliminar
		if($tipo == 'delete'){
			$id = $_POST['id'];

			//eliminamos de la BD
			include '../conection.php';
			$query = "DELETE FROM empleado WHERE id = '$id'";
			$sql = mysqli_query($conection,$query);
			if($sql){
				echo '1';
			}else{
				echo 'No se logro eliminar el empleado';
			}
		}

		//leer datos
		if($tipo == 'read'){
			$id = $_POST['id'];

			//consultamos de la BD
			include '../conection.php';
			$query = "SELECT * FROM empleado WHERE id = '$id'";
			$sql = mysqli_query($conection,$query);
			if($sql){
				echo json_encode(mysqli_fetch_array($sql));
			}
		}

		//editar datos
		if ($tipo == 'edit') {
			$id = $_POST['id'];
			$identificacion = $_POST['identificacion'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];

			//editar en la BD
			include '../conection.php';
			$query = "UPDATE empleado SET identificacion='$identificacion',nombre='$nombre',apellidos='$apellido' WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if($sql){
				echo '1';
			}else{
				echo 'No se logro Editar el empleado';
			}
		}

	}
	
 ?>