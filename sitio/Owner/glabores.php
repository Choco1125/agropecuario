<?php
include "main.php";
?>

<link rel="stylesheet" href="../../css/datatables.min.css">

<style>
  .contenedor {
    overflow: auto;
    width: 100%;
  }

  th,
  tr {
    text-align: center;
  }

  a {
    color: black;
  }

  i {
    color: white;
  }
</style>

<!-- Modal para agregar labores -->
<div class="modal fade" id="agregar_labores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar labor </h5>
        <button onclick="limpiar();" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_labor" method="POST">

          <div class="form-group">
            <label for="nombre"> Nombre </label>
            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el Nombre">
          </div>
          <label for="tipo">Tipo de Labor</label>
          <select class="form-control" id="tipo" name="tipo">
            <option value="ninguno">Ninguna</option>
            <option value="recoleccion">Recolección</option>
            <option value="fumigacion">Fumigación</option>
          </select>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
        <button type="button" onclick="add_labor();" class="btn btn-success"> Agregar labor </button>
      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar labores -->

<!-- Modal para editar labor-->
<div class="modal fade" id="editar_labor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar labor </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="edit_labor">
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="edit_nombre"> Nombre de la labor </label>
            <input name="edit_nombre" type="text" class="form-control" id="edit_nombre">
          </div>
          <label for="edit_tipo">Tipo de Labor</label>
          <select class="form-control" id="edit_tipo" name="edit_tipo">
            <option value="ninguno">Ninguna</option>
            <option value="recoleccion">Recolección</option>
            <option value="fumigacion">Fumigación</option>
          </select>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
        <button type="button" onclick="guardar();" class="btn btn-success"> Guardar cambios </button>
      </div>
    </div>
  </div>
</div>
<!-- Cierre modal para editar labor -->

<div class="container contenedor">

  <br><br>
  <h3> Gestionar Labores </h3>
  <br>

  <!-- Boton para agregar labores -->
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar_labores">
    Agregar Labores
  </button>

  <!-- Tabla para mostrar la información de labores -->
  <br><br>
  <table class="table" id="tabla">
    <thead>
      <tr>
        <th scope="col"> Nombre </th>
        <th scope="col"> Tipo </th>
        <th scope="col"> Acciones </th>
      </tr>
    </thead>
    <tbody>
      <?php
      include "../../php/conection.php";
      $query = "SELECT * FROM labores";
      $sql = mysqli_query($conection, $query);
      if ($sql) {
        while ($row = mysqli_fetch_array($sql)) {
          ?>
          <tr>
            <td> <?php echo $row['nombre'] ?> </td>
            <td> <?php echo $row['tipo'] ?> </td>
            <td>
              <a data-toggle="modal" data-target="#editar_labor" onclick="upload_data(<?php echo $row['id']; ?>)" class="btn btn-success">
                <i class="far fa-edit"> </i>
              </a>
              <a class="btn btn-secondary" onclick="eliminar(<?php echo $row['id'] ?>);">
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
</div>

</body>

<?php
include "end.php";
?>

<script src="../../js/datatables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tabla').DataTable({
      language: {
        search: "Buscar Registro",
        paginate: {
          first: "Primero",
          previous: "Anterior",
          next: "Siguiente",
          last: "Último"
        },
        "lengthMenu": "Mostar _MENU_ Por Página",
        "zeroRecords": "No Se Encontraron Registros",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No Se Encontraron Registros",
        "infoFiltered": "(Se Filtraron _MAX_ Registros)",
      }
    })
  });

  //Limpiar
  function limpiar() {
    $('#add_labor').trigger("reset");
  }

  //Agregar labores
  function add_labor() {
    var data = $('#add_labor').serialize() + "&op=insert";
    $.ajax({
        url: '../../php/Owner/glabores.php',
        type: 'POST',
        data: data,
      })
      .done(function(data) {
        if (data == "1") {
          swal({
            title: "Buen trabajo",
            text: "La labor fue agregada correctamente",
            icon: "success",
            button: true,
          }).then((res) => {
            if (res) {
              location.reload();
            }
          });
        } else {
          swal("Error", "No se logró agregar la labor", "error");
        }
      });
  }

  //Editar nombre labores 
  function guardar() {
    var data = $('#edit_labor').serialize() + "&op=edit";
    $.ajax({
        url: '../../php/Owner/glabores.php',
        type: 'POST',
        data: data,
      })
      .done(function(data) {
        if (data == "1") {
          swal({
            title: "Buen trabajo",
            text: "La labor fue editada correctamente",
            icon: "success",
            button: true,
          }).then((res) => {
            if (res) {
              location.reload();
            }
          });
        } else {
          swal("Error", "No se logró editar la labor", "error");
        }
      });
  }

  //Cargar los nombres al modal
  function upload_data(id) {

    $.ajax({
      url: '../../php/Owner/glabores.php',
      type: 'POST',
      data: {
        op: 'read',
        id: id
      }
    }).done(function(data) {
      var datos = jQuery.parseJSON(data);
      console.log(datos['tipo']);
      $('#id').val(datos['id']);
      $('#edit_nombre').val(datos['nombre']);
      $('#edit_tipo').val(datos['tipo']).focus();
    });

  }

  //Eliminar
  function eliminar(id) {
    swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar esta labor?",
      icon: "warning",
      buttons: true,
    }).then((res) => {
      if (res) {
        $.ajax({
            url: '../../php/Owner/glabores.php',
            type: 'POST',
            data: {
              op: 'delete',
              id: id
            }
          })
          .done(function(data) {
            if (data == 1) {
              swal({
                title: "Buen trabajo",
                text: "Se elimino correctamente la labor",
                icon: "success",
                button: true,
              }).then((res) => {
                location.reload();
              });
            } else {
              swal("¡Error!", "No se logró eliminar", "error");
            }
          });
      }
    });
  }
</script>

</html>