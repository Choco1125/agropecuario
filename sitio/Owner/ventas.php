<?php
  include "main.php";
 ?>

<link rel="stylesheet" href="../../css/datatables.min.css">

</body>

<style>
  .contenedor{
    overflow: auto;
    width: 100%;
  }

i {
  color: white;
}

th, td {
  text-align: center;
}

</style>

<br><br>
<div class="container contenedor ">


<h3> Ventas -  
  <?php 
    include "../../php/conection.php";
    $query = "SELECT nombre FROM finca WHERE id = ".$_SESSION['finca'];
    $sql = mysqli_query($conection, $query);
    if ($sql) {
      echo mysqli_fetch_array($sql)['nombre'];
    }
  ?> 
</h3>
<br>

<!-- Tabla de bodega -->
<table class="table" id="tabla">
  <thead>
    <tr>
      <th scope="col"> Nro. Remisión </th>
      <th scope="col"> Fecha </th>
      <th scope="col"> Nombre Lote </th>
      <th scope="col"> Nombre Empleado </th>
      <th scope="col"> Nombre Producto </th>
      <th scope="col"> Cantidad </th>
      <th scope="col"> Valor </th>
      <th scope="col"> Acciones </th>
    </tr>
  </thead>
  <tbody>

<?php

  //Imprimimos los registros de la base DB
  $id_finca = $_SESSION['finca'];
  include "../../php/conection.php";
  $query = "SELECT id, n_remision, fecha, nombre_lote, nombre_empleado, nombre_producto, cantidad, valor FROM ventas";
  $sql = mysqli_query($conection, $query);
  if ($sql) {
    while ($row = mysqli_fetch_array($sql)) {
?>
  <tr>
    <td> <?php echo $row['n_remision'] ?></td>
    <td> <?php echo $row['fecha'] ?></td>
    <td> <?php echo $row['nombre_lote'] ?></td>
    <td> <?php echo $row['nombre_empleado'] ?></td>
    <td> <?php echo $row['nombre_producto'] ?></td>
    <td> <?php echo $row['cantidad'] ?></td>
    <td> <?php echo $row['valor'] ?></td>
    <td> 
      <a class="btn btn-danger" onclick="eliminar(<?php echo $row['id'] ?>);"> 
        <i class="fas fa-trash-alt"> </i> 
      </a>
    </td>
  </tr>

<?php
    }
  }


 ?>
  
  </tbody>
  </table>
<!-- Cierre de tabla del modal para ver bodega -->


<?php
include "end.php";
?>

<script src="../../js/datatables.min.js"> </script>
<script>
 $(document).ready(function() {
      $('#tabla').DataTable({
        language: {
            search: "Buscar Registro",
                paginate: {
                  first:      "Primero",
                  previous:   "Anterior",
                  next:       "Siguiente",
                  last:       "Último"
                },
                "lengthMenu":     "Mostar _MENU_ Por Página",
                "zeroRecords": "No Se Encontraron Registros",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No Se Encontraron Registros",
                "infoFiltered": "(Se Filtraron _MAX_ Registros)",
            }
      })
   });

//Eliminar
function eliminar(id){
    swal({
    title: "Advertencia",
    text: "¿Seguro de querer eliminar este campo?",
    icon: "warning",
    buttons: true,
   }).then((res)=>{
    if(res){
      $.ajax({
        url: '../../php/Owner/ventas.php',
        type: 'POST',
        data: {
          op: 'delete',
          id: id
        }
      })
      .done(function(data) {
        console.log(data);
          if(data == 1){
            swal({
            title: "Buen trabajo",
            text: "Se elimino correctamente el campo",
            icon: "success",
            button: true,
          }).then((res)=>{
            location.reload();
          });
          } else {
            swal("¡Error!","No se logró eliminar", "error");
        }
      });
    }
  });
}
</script>

 </html>