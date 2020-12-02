<?php
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		 $Servidor = "localhost";
		 $BaseDatos = "agropecuaria";
		 $Usuario = "root";
		 $Clave = "";
	} else {
		 $Servidor = "localhost";
		 $BaseDatos = "gomezriveraagrop_v2";
		 $Usuario = "gomezriveraagrop_v2";
		 $Clave = "eq4UPtWnx2FmYfP";
	}

	//conexion  a la BD
	$conection = mysqli_connect($Servidor, $Usuario, $Clave, $BaseDatos);

 ?>