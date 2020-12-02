<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//agregar
		if ($tipo == 'add') {
			$finca_id = $_SESSION['finca'];
			$semana = $_POST['semana'];
			$img = '';

			//verificar imagenes
			if(isset($_FILES["imagen"]["type"])){
				$tipo = @end(explode(".", $_FILES['imagen']['name']));
				if($tipo != "jpg" && $tipo != "png" && $tipo != "jpeg"){
					echo "el tipo del archivo no es el correcto";
					return;
				}
				$img = "../../img/temperaturas/".time().".".$tipo;
				if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $img)) {
					echo "no se logro subir la imagen al servidor";
					return;
				}
			}else{
				echo "no se subio ninguna imagen";
				return;
			}

			//insertar a la BD
			include "../conection.php";
			$query = "INSERT INTO temperatura(finca_id, semana, imagen) VALUES ('$finca_id','$semana','$img')";
			$sql = mysqli_query($conection,$query);
			if($sql){
				echo "1";
			}else{
				@unlink($img);
				echo "No se logró agregar el registro a la base de datos compruebe que esya semana no este registrada ya.";
			}

		}
	}

 ?>