<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Asociaciones</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<style>
	.card-1 {
		margin: 10%;
		padding: 20px;
		overflow: hidden;
		width: 80%;
		height: 208px;
		cursor: pointer;
		border-radius: 10px;
		-webkit-transition: all 1s ease-out;
		box-shadow: 1px 2px 10px #dcdbdb;
	}

	.card-none {
		margin: 10%;
		padding: 20px;
		overflow: hidden;
		width: 80%;
		height: 208px;
		cursor: pointer;
		-webkit-transition: all 1s ease-out;
	}

	.card-none>a {
		font-size: 40px;
		text-align: center;
		text-decoration: none;
	}

	.card-1:hover {
		height: 330px;
	}

	.card-1>img {
		height: 160px;
	}

	.content {
		height: 100px;
		overflow: auto;
		margin-bottom: 0px !important;
	}

	#lista::-webkit-scrollbar {
		background: #28a745;
		border-radius: 5px;
		width: 5px;
	}

	#lista::-webkit-scrollbar-thumb {
		background: white;
		border-radius: 5px;
	}
</style>

<body>
	<div class="container">
		<h1 class="text-center">Seleccione la asociación y finca a gestionar:</h1>
		<div class="row">
			<?php
			session_start();
			if ($_SESSION['id_rol'] == "2") {
			?>
				<div class="col-12 col-md-4 justify-content-center">
					<div class="card card-none">
						<br><br>
						<a href="../php/log/select_finca.php?finca=0">Ninguna</a>
					</div>
				</div>
			<?php
			}
			?>
			<?php
			/*********************************************/
			//se listan las sociedades con las fincas
			/*********************************************/
			include '../php/conection.php';
			$usuario_id = $_SESSION['id'];
			$query = "SELECT s.nombre AS 'name',s.id AS 'sociedad',s.logo,f.id,f.nombre FROM usuario_finca AS c INNER JOIN finca as f INNER JOIN sociedad as s WHERE c.usuario_id='$usuario_id' AND f.id = c.finca_id AND f.id_sociedad = s.id ORDER BY s.id ASC";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				$num = mysqli_num_rows($sql);
				$i = 1;

				$row = mysqli_fetch_array($sql);
				$sociedad = $row['sociedad'];
				$badera = false;
				while ($i <= $num) {
					$sociedad = $row['sociedad'];
			?>
					<div class="col-12 col-md-4  justify-content-center">
						<div class="card card-1">
							<img src="<?php echo substr($row['logo'], 3) ?>" alt="">
							<span class="text-center"><?php echo $row['name'] ?></span>
							<ul id="lista" class="content navbar-nav">
								<?php
								while ($row['sociedad'] == $sociedad) {
								?>
									<li class="nav-item">
										<a class="nav-link btn-success text-white text-center" href="../php/log/select_finca.php?finca=<?php echo $row['id'] ?>"> <?php echo $row['nombre'] ?> </a>
									</li>
								<?php
									$row = mysqli_fetch_array($sql);
									$i++;
									$bandera = false;
								}
								if (!$bandera) {
									$bandera = true;
								} else {
									$row = mysqli_fetch_array($sql);
									$i++;
								}
								?>
							</ul>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>

</body>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>