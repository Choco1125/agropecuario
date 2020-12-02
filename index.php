<?php
session_start();
if (isset($_SESSION['login'])) {
	if ($_SESSION['login']) {
		//redireccionar a donde sea necesario
		switch ($_SESSION['id_rol']) {
			case "1":
				header("location: sitio/Admin");
				break;
			case "2":
				header("location: sitio/Owner");
				break;
			case "3":
				header("location: sitio/Bodega");
				break;
			case "4":
				header("location: sitio/Vendedor");
				break;
			case "5":
				header("location: sitio/Comprador");
				break;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Agropecuaria </title>
	<link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<style>
	body {
		background: url("img/bg.jpg") no-repeat;
		background-size: cover;
		padding-top: 10%;
		margin: 0px;
		height: 100%;
		width: 100%;
	}

	html {
		margin: 0px;
		height: 100%;
		width: 100%;
	}

	.contenedor {
		background: rgba(0, 0, 0, 0.6);
		height: 320px;
		padding: 20px 60px 20px 60px;
		border-radius: 10px;
	}
</style>

<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-10 col-md-5 contenedor">
				<h1 class="text-white text-center"> Inicio de sesión </h1>
				<br>
				<form method="POST" action="php/log/login.php" class="mt-2">
					<input name="nombre" class="form-control" type="text" placeholder="Nombre de Usuario" required>
					<br>
					<input name="pass" class="form-control" type="password" placeholder="Contraseña" required>
					<br>
					<input class="form-control btn btn-success" type="submit" value="Ingresar">
				</form>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js">
</script>

</html>