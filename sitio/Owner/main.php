<?php 
  $permiso = "2";
  include '../../php/log/verificar.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Agropecuaria | Gerente </title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


</head>
<body>

<style>

	li>a:hover {
		/*border-radius: 5px !important;
    padding-left: 20px !important;*/
	}

  li>a{
    padding-left: 15px !important;
    padding-right: 15px !important;
  }

	.derecha {
		float: right !important;
	}

  .dropdown{
    margin: 0px 10px 0px 10px;
  }

  nav {
  	position: fixed;
  }

  .dropdown-menu > li:hover .submenu {
    display: block;
    max-height: 200px;
  }

  .submenu {
    background: #28a745;
    color: white !important;
    padding-left: 0px;
    list-style: none;
    overflow: hidden;
    max-height: 0;
    -webkit-transition: all 0.5s ease-out;
  }


  .especial{
    padding-left: 25px !important;
  }

  .submenu>li>a.dropdown-item:hover{
    border: none;
    color: black;
    background: white;
  }

  .submenu>li>a.dropdown-item{
    padding-left: 25px !important;
    color: white;
  }

</style>

<!-- Inicio navbar owner -->
<nav class="navbar navbar-expand-lg navbar-light bg-success">
  <a class="navbar-brand text-white" href="../index.php"> Inicio </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"> </span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php 
        if ($_SESSION['finca'] != "0") {
      ?>
       <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Owner/informe.php"> Informe </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Owner/reporte.php"> Reporte </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Owner/lotes.php"> Lotes </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Owner/bodega.php"> Bodega </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Owner/ventas.php"> Ventas </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Owner/maquinaria.php"> Máquinaria y Equipos </a>
      </li>
      <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="tab_generar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mostrar
        </button>
          <div class="dropdown-menu" aria-labelledby="tab_generar">
            <a class="dropdown-item" href="../Owner/pluviometria.php"> Reporte Pluviometría </a>
            <a class="dropdown-item" href="../Owner/temperatura.php"> Reporte Temperatura </a>
            <a class="dropdown-item" href="../Owner/comprobantes.php"> Comprobantes de Pago </a>    
            <a class="dropdown-item" href="../Owner/administrativos.php"> Gastos Administrativos </a>
            <a class="dropdown-item" href="../Owner/financieros.php"> Costos Financieros </a>       
            <a class="dropdown-item" href="../Owner/beneficios.php"> Beneficios Post-Cosecha </a>   
            <a class="dropdown-item" href="../Owner/otros.php"> Otros Gastos </a>        
          </div>
      </div>
      <?php
        }
       ?>
      <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administrar
        </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="../Owner/sociedades.php"> Sociedades </a>
            <a class="dropdown-item" href="../Owner/fincas.php"> Fincas </a>
            <a class="dropdown-item" href="../Owner/usuarios.php"> Usuarios </a>
            <a class="dropdown-item" href="../Owner/empleados.php"> Empleados </a>
            <a class="dropdown-item" href="../Owner/proveedores.php"> Proveedores </a>
            <a class="dropdown-item" href="../Owner/clientes.php"> Clientes </a>
            <a class="dropdown-item" href="../Owner/cultivos.php"> Cultivos </a>
            <a class="dropdown-item" href="../Owner/productos.php"> Productos </a>
            <a class="dropdown-item" href="../Owner/insumos.php"> Insumos </a>
            <a class="dropdown-item" href="../Owner/glabores.php"> Labores </a>
            <li>
              <a class="dropdown-item especial" href="#"> Rubros</a>
              <ul class="submenu">
                <li><a class="dropdown-item" href="../Owner/rubros.php?rubro=1">Gastos Administrativos</a></li>
                <li><a class="dropdown-item" href="../Owner/rubros.php?rubro=2">Costos Financieros</a></li>
                <li><a class="dropdown-item" href="../Owner/rubros.php?rubro=4">Beneficios post-cosecha</a></li>
                <li><a class="dropdown-item" href="../Owner/rubros.php?rubro=3">Otros</a></li>
              </ul>
            </li>
          </div>
      </div>
      <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Common/index.php"> Mi Perfil </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn-success text-white" href="#" onclick="logout();"> Cerrar Sesión </a>
      </li>
    </ul>
  </div>
</nav>

<!-- Cierre navbar owner -->

