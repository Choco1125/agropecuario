<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];
		//Agregar Usuario
		if ($tipo == "insert") {

			//obtenemos vaiables del post
			$identificacion = $_POST['identificacion'];
			$nombre_usuario = $_POST['nombre_usuario'];
			$tipo = $_POST['tipo'];
			$nombreE = $_POST['nombreE'];
			$apellidoE = $_POST['apellidoE'];

			//modificamos en la BD
			include "../conection.php";
			$query = "INSERT INTO usuarios (identificacion, nombre_usuario, id_rol, nombre, apellido,contrasena) VALUES ('$identificacion', '$nombre_usuario','$tipo','$nombreE','$apellidoE','".md5('123456')."')";
			$sql = mysqli_query($conection, $query);


			if ($sql) {
				//agregamos todas las fincas a las que tiene acceso
				$query = "SELECT id FROM usuarios ORDER BY id DESC";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					$id = mysqli_fetch_array($sql)['id'];
					$query = "SELECT id FROM finca";
					$sql = mysqli_query($conection, $query);
					while ($row = mysqli_fetch_array($sql)) {
						if (isset($_POST['finca_'.$row['id']])) {
							if($_POST['finca_'.$row['id']] == "1"){
								$query = "INSERT INTO usuario_finca (usuario_id, finca_id) VALUES('$id', '".$row['id']."')";
								mysqli_query($conection, $query);
							}							
						}
					}
				}
				echo "1"; 
			} else {
				echo "0";
			}
			mysqli_close($conection);
			return;
		}

		//Cargar datos
		if($tipo == "read") {
			$id = $_POST['id'];

			$query = "SELECT * FROM usuarios WHERE id = '$id'";


			include "../conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {			
				$res = mysqli_fetch_array($sql);
				$salida = array('id' => $res['id'],
				'identificacion' => $res['identificacion'],
				'nombre_usuario' => $res['nombre_usuario'],
				'id_rol' => $res['id_rol'],
				'nombre' => $res['nombre'],
				'apellido' => $res['apellido']);

				//agregar todas las fincas a la consulta
				$query = "SELECT finca_id FROM usuario_finca WHERE usuario_id = ".$id;
				$sql = mysqli_query($conection, $query);
				$aux = array();
				while ($row = mysqli_fetch_array($sql)) {
					$aux[] = array('finca_'.$row['finca_id'],"1");
				}
				$salida['fincas'] = $aux;
				echo json_encode($salida);

			} else {
				echo "0";
			}
			mysqli_close($conection);
			return;
		}

		//Editar Usuario
		if ($tipo == "edit") {

			$id = $_POST['id'];
			$identificacion = $_POST['identificacion'];
			$nombre_usuario = $_POST['nombre_usuario'];
			$tipo = $_POST['tipo'];
			$nombreE = $_POST['nombreE'];
			$apellidoE = $_POST['apellidoE'];

			$query = "UPDATE usuarios SET identificacion = '$identificacion',nombre_usuario = '$nombre_usuario',id_rol = '$tipo',nombre = '$nombreE',apellido = '$apellidoE' WHERE id = '$id'";
			include "../conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
					$query = "DELETE FROM usuario_finca WHERE usuario_id = ".$id;
					$sql = mysqli_query($conection, $query);
					$query = "SELECT id FROM finca";
					$sql = mysqli_query($conection, $query);
					while ($row = mysqli_fetch_array($sql)) {
						if (isset($_POST['finca_'.$row['id']])) {
							if($_POST['finca_'.$row['id']] == "1"){
								$query = "INSERT INTO usuario_finca (usuario_id, finca_id) VALUES('$id', '".$row['id']."')";
								mysqli_query($conection, $query);
							}							
						}
					}
				echo "1"; 
			} else {
				echo "0";
			}
			mysqli_close($conection);
			return;
		}

		//Eliminar usuarios
		if ($tipo == "delete") {

			$id = $_POST['id'];

			$query = "DELETE FROM usuarios WHERE id = '$id'";
			include "../conection.php";

			$sql = mysqli_query($conection, $query);
			if ($sql) {
				echo "1"; 
			} else {
				echo "0";
			}
			mysqli_close($conection);
			return;
		}
	}
 ?>