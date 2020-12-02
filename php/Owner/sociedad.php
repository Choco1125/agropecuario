<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];

		//agregar
		if ($tipo == "add") {
			//obtener datos
			$nombre = $_POST['nombre'];
			$nit = $_POST['nit'];
			$img = "";

			//verificar imagenes
			if(isset($_FILES["imagen"]["type"])){
				$tipo = @end(explode(".", $_FILES['imagen']['name']));
				if($tipo != "jpg" && $tipo != "png" && $tipo != "jpeg"){
					echo "el tipo del archivo no es el correcto";
					return;
				}
				$img = "../../img/sociedades/".time().".".$tipo;
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
			$query = "INSERT INTO sociedad(nombre, logo, nit) VALUES ('$nombre','$img','$nit')";
			$sql = mysqli_query($conection,$query);

			if($sql){
				echo "1";
			}else{
				@unlink($img);
				echo "No se logró agregar el registro a la base de datos";
			}
		}

		//eliminar
		if ($tipo == "delete") {
			$id = $_POST['id'];

			if($id == ""){
				echo "0";
				return;
			}

			//operacion en la base de  datos
			include "../conection.php";
			$query = "SELECT logo FROM sociedad WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				$imagen = mysqli_fetch_array($sql)['logo'];
				@unlink($imagen);
				$query = "DELETE FROM sociedad WHERE id='$id'";
				$sql = mysqli_query($conection,$query);	

				if ($sql) {
					echo "1";
				}else{
					echo "0";
				}				
			}else{
				echo "0";
			}
		}

		//leer
		if ($tipo == "read") {
			$id = $_POST['id'];


			//consultamos en la base de datos
			include "../conection.php";
			$query = "SELECT * FROM sociedad WHERE id='$id'";
			$sql = mysqli_query($conection,$query);

			if ($sql) {
				echo json_encode(mysqli_fetch_array($sql));
			}else{
				echo "0";
			}
		}

		//editar
		if ($tipo == "edit") {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$nit = $_POST['nit'];
			if($id == "" || $nombre == "" || $nit == ""){
				echo "0";
				return;
			}

			$img = "";
			//verificar imagenes
			if(isset($_FILES["imagen"]["type"])){
				$tipo = @end(explode(".", $_FILES['imagen']['name']));
				if($tipo != "jpg" && $tipo != "png" && $tipo != "jpeg"){
					echo "el tipo del archivo no es el correcto";
					return;
				}
				$img = "../../img/sociedades/".time().".".$tipo;
				if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $img)) {
					echo "no se logro subir la imagen al servidor";
					return;
				}
			}

			//operacion en la base de  datos
			include "../conection.php";
			$query = "SELECT * FROM sociedad WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				$query = "";
				$aux = "";
				if($img == ""){
					$query = "UPDATE sociedad SET nombre='$nombre',nit='$nit' WHERE id='$id'";
				}else{
					$aux = mysqli_fetch_array($sql)['logo'];
					$query = "UPDATE sociedad SET nombre='$nombre',nit='$nit',logo='$img' WHERE id='$id'";
				}

				$sql = mysqli_query($conection,$query);
				if($sql){
					if($img != ""){
						@unlink($aux);
					}
					echo "1";
				}else{
					echo "0";
				}

			}else{
				echo "0";
			}
		}

	}

 ?>