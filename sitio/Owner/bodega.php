<?php 
  include "main.php";
?>

<link rel="stylesheet" href="../../css/datatables.min.css">

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

<h3> Bodega -  
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

<!-- Modal historial bodega-->
<div class="modal fade" id="ver_historial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Historial bodega </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="contenido">

        <!-- Se imprimen los datos desde la base de datos -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
        
      </div>
    </div>
  </div>
</div>

<!-- Tabla de bodega -->
<table class="table" id="tabla">
  <thead>
    <tr>
      <th scope="col"> Nombre </th>
      <th scope="col"> Cantidad </th>
      <th scope="col"> Unidad </th>
      <th scope="col"> Valor </th>
      <th scope="col"> Acciones </th>
    </tr>
  </thead>
  <tbody>

<?php

  //Imprimimos los registros de la base DB
  $id_finca = $_SESSION['finca'];
  include "../../php/conection.php";
  $query = "SELECT b.id,i.nombre,i.unidad,b.cantidad,b.valor FROM bodega AS b INNER JOIN insumo AS i WHERE b.finca_id='$id_finca' AND b.insumo_id = i.id";
  $sql = mysqli_query($conection, $query);
  if ($sql) {
    while ($row = mysqli_fetch_array($sql)) {
?>
  <tr>
    <td> <?php echo $row['nombre'] ?></td>
    <td> <?php echo $row['cantidad'] ?></td>
    <td> <?php echo $row['unidad'] ?></td>
    <td> <?php echo $row['valor'] ?></td>
    <td> 
      <a data-toggle="modal" data-target="#ver_historial" onclick="ver_historial(<?php echo $row['id']; ?>)" class="btn btn-primary"> 
        <i class="far fa-eye"> </i>
      </a>

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
        

</body>

<?php
include "end.php";
?>

<script src="../../js/datatables.min.js">  </script>

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

//Ver Historial
  function ver_historial(id){
  $.ajax({
    url: '../../php/Owner/historial.php',
    type: 'POST',
    data: {id: id}
  })
  .done(function(data) {
    $('#contenido').html(data);
  });
}

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
        url: '../../php/Owner/bodega.php',
        type: 'POST',
        data: {
          op: 'delete',
          id: id
        }
      })
      .done(function(data) {
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