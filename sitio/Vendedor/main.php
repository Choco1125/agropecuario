<?php 
  $permiso = "4";
  include '../../php/log/verificar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Finca | Vendedor </title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


</head>
<body>

<style>
  li>a:hover {
    color: black !important; 
  }

  .derecha {
    float: right !important;
  }

  nav {
    position: fixed;
  }
  
  th,tr{
    text-align: center;
  }

</style>

<!-- Inicio navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-success">
  <a class="navbar-brand text-white" href="../index.php"> Vendedor </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-white" href="../Vendedor/index.php"> Ventas </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link text-white" href="../Vendedor/clientes.php"> Clientes </a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-success text-white" href="../Common/index.php"> Mi Perfil </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link text-white" href="#" onclick="logout();"> Cerrar Sesión </a>
      </li>
    </ul>
  </div>
</nav>
<br><br>