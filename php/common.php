<?php 
	if (isset($_POST)) {
		//obtener los datos del post
		session_start();
		$id             = $_SESSION['id'];
		$identificacion = $_POST['identificacion'];
		$nombre_usuario = $_POST['nombre_usuario'];
		$nombre         = $_POST['nombre'];
		$apellido       = $_POST['apellido'];
		$now_pass       = $_POST['now_pass'];
		$new_pass       = $_POST['new_pass'];

		include "../php/conection.php";
		$query = "";
		if($new_pass != ""){
			$now_pass       = md5($_POST['now_pass']);
			$new_pass       = md5($_POST['new_pass']);
			$query = "SELECT * FROM usuarios WHERE id='$id' AND contrasena = '$now_pass'";
			$sql = mysqli_query($conection,$query);
			if($sql){
				$num = mysqli_num_rows($sql);
				if($num > 0){
					$query = "UPDATE usuarios SET nombre_usuario='$nombre_usuario',contrasena='$new_pass',nombre='$nombre',apellido='$apellido',identificacion='$identificacion' WHERE id = '$id'";
				}else{
					echo "La contraseña es incorrecta";
					return;
				}
			}else{
				echo "No se logro editar los datos";
				return;
			}
		}else{
			$query = "UPDATE usuarios SET nombre_usuario='$nombre_usuario',nombre='$nombre',apellido='$apellido',identificacion='$identificacion' WHERE id = '$id'";
		}

		$sql = mysqli_query($conection,$query);

		if ($sql) {
			echo "1";
		}else{
			echo "No se lograron editar los datos puede que el nombre de usuario o identificación este repetido.";
			return;
		}


	}
?>