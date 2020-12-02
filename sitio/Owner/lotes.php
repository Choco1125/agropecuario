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

th, td {
  text-align: center;
}

i {
  color: white;
}

</style>

<!-- Modal para agregar lotes -->
<div class="modal fade" id="agregar_lote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar lote </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_lote" method="POST">
          <input type="hidden" name="id_finca" value="<?php echo $_SESSION['finca'] ?>">

          <div class="form-group">
            <label for="nombre"> Nombre </label>
            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del lote">
          </div>

          <div class="form-group">
            <label for="cultivo"> Cultivo </label>
            <select class="form-control" name="cultivo" id="cultivo">
              <option value="">Ingrese el cultivo</option>
<?php 
  include "../../php/conection.php";
  $query = "SELECT * FROM cultivo";
  $sql = mysqli_query($conection,$query);
  if ($sql) {
      while ($row = mysqli_fetch_array($sql)) {
?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
<?php
      }
  }


?>
            </select>
          </div>

          <div class="form-group">
            <label for="variedad"> Variedad </label>
            <input name="variedad" type="text" class="form-control" id="variedad" placeholder="Ingrese la variedad">
          </div>

          <div class="form-group">
            <label for="cantidad"> Cantidad </label>
            <input name="cantidad" type="number" class="form-control" id="cantidad" placeholder="Ingrese la cantidad">
          </div>

          <div class="form-group">
            <label for="fecha"> Fecha de la siembra </label>
            <input name="fecha" type="date" class="form-control" id="fecha" placeholder="Ingrese la fecha de la siembra">
          </div>

          <div class="form-group">
            <label for="distancia"> Distancia de la siembra </label>
            <input name="distancia" type="text" class="form-control" id="distancia" placeholder="Ingrese la distancia de la siembra">
          </div>

          <div class="form-group">
            <label for="area"> Area </label>
            <input name="area" type="text" class="form-control" id="area" placeholder="Ingrese la area ">
          </div>

          <div class="form-group">
            <label for="asnm"> ASNM </label>
            <input name="asnm" type="text" class="form-control" id="asnm" placeholder="Ingrese la ASNM">
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
        <button type="button" onclick="add_lote();" class="btn btn-success"> Agregar lote </button>
      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar lotes -->

<!-- Modal para editar lotes-->
<div class="modal fade" id="editar_lote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar lote </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="edit_lote">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
             <label for="edit_nombre"> Nombre </label>
             <input name="nombre" type="text" class="form-control" id="edit_nombre">
          </div>

          <div class="form-group">
            <label for="edit_cultivo"> Cultivo </label>
            <select class="form-control" name="cultivo" id="edit_cultivo">
              <option value="">Ingrese el cultivo</option>
<?php 
  include "../../php/conection.php";
  $query = "SELECT * FROM cultivo";
  $sql = mysqli_query($conection,$query);
  if ($sql) {
      while ($row = mysqli_fetch_array($sql)) {
?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
<?php
      }
  }


?>
            </select>
          </div>

          <div class="form-group">
             <label for="edit_variedad"> Variedad </label>
             <input name="variedad" type="text" class="form-control" id="edit_variedad">
          </div>

          <div class="form-group">
             <label for="edit_cantidad"> Cantidad </label>
             <input name="cantidad" type="number" class="form-control" id="edit_cantidad">
          </div>

          <div class="form-group">
             <label for="edit_fecha"> Fecha de la siembra </label>
             <input name="fecha" type="date" class="form-control" id="edit_fecha">
          </div>

          <div class="form-group">
             <label for="edit_distancia"> Distancia de la siembra </label>
             <input name="distancia" type="text" class="form-control" id="edit_distancia">
          </div>

          <div class="form-group">
             <label for="edit_area"> Area del producto </label>
             <input name="area" type="text" class="form-control" id="edit_area">
          </div>

          <div class="form-group">
             <label for="edit_asnm"> ASNM del producto </label>
             <input name="asnm" type="text" class="form-control" id="edit_asnm">
          </div>
        </form>

      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="guardar();" class="btn btn-success"> Guardar cambios </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre modal para editar lotes -->

<br><br>
<div class="container-fluid contenedor ">


<h3> Lotes -  
  <?php 
    $query = "SELECT nombre FROM finca WHERE id = ".$_SESSION['finca'];
    $sql = mysqli_query($conection, $query);
    if ($sql) {
      echo mysqli_fetch_array($sql)['nombre'];
    }
  ?> 
</h3>
<br>

<!-- Boton para agregar lotes -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar_lote">
Agregar lotes
</button>

<br><br>

<!-- Tabla de lote -->
<table class="table" id="tabla">
  <thead>
    <tr>
      <th scope="col"> Nombre </th>
      <th scope="col"> Producto </th>
      <th scope="col"> Variedad </th>
      <th scope="col"> Cantidad </th>
      <th scope="col"> Fecha de la siembra </th>
      <th scope="col"> Distancia de la siembra </th>
      <th scope="col "> Area </th>
      <th scope="col "> ASNM </th>
      <th scope="col "> Acciones </th>
    </tr>
  </thead>
  <tbody>

<?php

  //Imprimimos los registros de la base DB
  $id_finca = $_SESSION['finca'];
  include "../../php/conection.php";
  $query = "SELECT l.id,l.nombre,c.nombre AS 'cultivo',l.variedad,l.cantidad,l.fecha_siembra,l.distancia_siembra,l.area,l.asnm FROM lote AS l INNER JOIN cultivo AS c WHERE l.id_finca='$id_finca' AND c.id = l.cultivo_id";
  $sql = mysqli_query($conection, $query);
  if ($sql) {
    while ($row = mysqli_fetch_array($sql)) {
?>
  <tr>
    <td> <?php echo $row['nombre'] ?></td>
    <td> <?php echo $row['cultivo'] ?></td>
    <td> <?php echo $row['variedad'] ?></td>
    <td> <?php echo $row['cantidad'] ?></td>
    <td> <?php echo $row['fecha_siembra'] ?></td>
    <td> <?php echo $row['distancia_siembra'] ?></td>
    <td> <?php echo $row['area'] ?></td>
    <td> <?php echo $row['asnm'] ?></td>
    <td> 
      <a href="labores.php?lote=<?php echo $row['id'] ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver labores">
            <i class="far fa-eye" id="icon"> </i> 
      </a> 
 
      <a data-target="#editar_lote" onclick="upload_data(<?php echo $row['id']; ?>)"
      class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar lote">
        <i class="far fa-edit"> </i>  
      </a>

      <a class="btn btn-secondary" onclick="eliminar(<?php echo $row['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Eliminar"> 
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
<!-- Cierre de tabla para lote -->

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

//Limpiar
function limpiar(){
  $('#add_lote').trigger("reset");
}
 
//Agregar lote
function add_lote(){
  var data = $('#add_lote').serialize() + "&op=insert";
  $.ajax({
  url: '../../php/Owner/lotes.php',
  type: 'POST',
  data: data,
  })
  .done(function(data) {
  if (data == "1") {
  swal({
    title: "Buen trabajo",
    text: "El lote fue agregado correctamente",
    icon: "success",
    button: true,
  }).then((res)=>{
    if(res){
      location.reload();
    }
  });
    }else{
      swal("Error", "No se logró agregar el lote","error");
    }
  });
}

//Editar lote 
function guardar(){
    var data = $('#edit_lote').serialize() + "&op=edit";
    $.ajax({
      url: '../../php/Owner/lotes.php',
      type: 'POST',
      data: data,
    })
    .done(function(data) {
      if (data == "1") {
        swal({
          title: "Buen trabajo",
          text:  "El lote fue editado correctamente",
          icon:  "success",
          button: true,
        }).then((res)=>{
          if (res) {
            location.reload();
          }
        });
      } else {
        swal ("Error", "No se logro editar el lote","error");
      }
    });
}

// Cargar los datos al modal editar
function upload_data(id){

$.ajax({
  url: '../../php/Owner/lotes.php',
  type: 'POST',
  data: {op: 'read',
         id: id}
}).done(function(data) {
  var datos = jQuery.parseJSON(data);
  $('#id').val(datos['id']);
  $('#edit_nombre').val(datos['nombre']);
  $('#edit_cultivo').val(datos['cultivo']);
  $('#edit_variedad').val(datos['variedad']);
  $('#edit_cantidad').val(datos['cantidad']);
  $('#edit_fecha').val(datos['fecha_siembra']);
  $('#edit_distancia').val(datos.distancia_siembra);
  $('#edit_area').val(datos['area']);
  $('#edit_asnm').val(datos['asnm']);
  //Mostrar modal con js
  $('#editar_lote').modal('show');
});
}

//Eliminar
function eliminar(id){
      swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar este lote?",
      icon: "warning",
      buttons: true,
     }).then((res)=>{      
      if(res){
        $.ajax({
          url: '../../php/Owner/lotes.php',
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
              text: "Se elimino correctamente el lote",
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