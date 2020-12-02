<?php 
	include 'key.php';
	if (isset($_POST)) {
		$tipo = $_POST['op'];


		//eliminar
		if ($tipo == 'delete') {
			
			$id = $_POST['id'];

			$id = $_POST['id'];

			include '../conection.php';
			$query = "SELECT * FROM temperatura WHERE id='$id'";
			$sql = mysqli_query($conection,$query);
			if($sql){
				$img = mysqli_fetch_array($sql)['imagen'];
				$query = "DELETE FROM temperatura WHERE id='$id'";
				$sql = mysqli_query($conection,$query);
				if($sql){
					echo '1';
					@unlink($img);
					return;
				}else{
					echo "Ocurrio un error al eliminar el registro";
					return;
				}
			}
		}

	}
	
 ?>