<?php
include "main.php";
?>

<link rel="stylesheet" href="../../../css/datatables.min.css">

</body>

<style>
  .contenedor {
    overflow: auto;
    width: 100%;
  }

  th,
  td {
    text-align: center;
  }

  i {
    color: white;
  }

  .swal-text {
    text-align: center !important;
  }

  #imagen,
  #edit_imagen {
    display: none;
  }

  #previo {
    display: none;
  }

  #preview,
  #edit_preview {
    margin: 0px;
    height: 200px;
    width: 300px;
    display: block;
  }

  #preview>img {
    display: inline-block;
    height: 100%;
    width: 100%;
  }

  #edit_preview>img {
    display: inline-block;
    height: 100%;
    width: 100%;
  }

  .logos {
    height: 40px;
    width: 40px;
  }

  .logo_modal {
    height: 100%;
    width: 100%;
  }
</style>

<br><br>


<div class="container contenedor">
  <br>
  <div class="row">
    <div class="col-2 text-center">
      <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="col-10">
      <h3 class="text-center"> Registro / Imágenes de temperatura </h3>
    </div>
  </div>
  <br>
  <!-- Modal para agregar sociedades -->
  <div class="modal fade" id="agregar_sociedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Agregar imagen de temperatura</h5>
          <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add_sociedad">
            <input type="hidden" name="finca" id="finca" value="<?php echo $_SESSION['finca']; ?>">
            <div class="form-group">
              <label for="semana"> Semana </label>
              <input name="semana" type="week" class="form-control" id="semana" placeholder="Ingrese la semana">
            </div>
            <label for="imagen" class="btn btn-success">Seleccione una imagen</label>
            <input id="imagen" type="file" />
            <hr>
            <div id="previo">
              <div class="row justify-content-center">
                <div id="preview"></div>
              </div>
              <br>
              <div class="row justify-content-center"><button onclick="return limpiar_imagen();" class="btn btn-secondary"> Quitar Imagen </button></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="add_sociedad();" class="btn btn-success"> Agregar imagen </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Cierre modal para agregar sociedades -->

  <!-- Modal para editar sociedades -->
  <div class="modal fade" id="editar_sociedad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Editar Sociedad </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="edit_sociedad">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label for="nombre"> Nombre de la sociedad </label>
              <input name="nombre" type="text" class="form-control" id="edit_nombre" placeholder="Ingrese el nombre de la sociedad">
            </div>
            <div class="form-group">
              <label for="edit_nit"> Nit de la sociedad </label>
              <input name="nit" type="text" class="form-control" id="edit_nit" placeholder="Ingrese el nit de la sociedad">
            </div>
            <label for="edit_imagen" class="btn btn-success">Cambiar imagen</label>
            <input id="edit_imagen" type="file" />
            <hr>
            <div id="edit_previo">
              <div class="row justify-content-center">
                <div id="edit_preview">
                  <img id="edit_img" src="" alt="">
                </div>
              </div>
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
  <!-- Cierre modal para editar sociedades -->

  <!-- Modal para Mostrar logos de  sociedades -->
  <div class="modal fade" id="logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Ver Logo </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="logo_modal" class="logo_modal" src="" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Cierre modal para Mostrar logos de  sociedades -->



  <!-- Boton para agregar usuarios -->
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar_sociedad">
    Agregar imagen de temperatura
  </button>

  <br><br>

  <!-- Tabla para mostrar sociedades -->
  <table class="table" id="tabla">
    <thead>
      <tr>
        <th scope="col"> Semana</th>
        <th scope="col"> Imagen </th>
        <th scope="col"> Opciones </th>
      </tr>
    </thead>
    <tbody>
      <?php
      include "../../../php/conection.php";
      $query = "SELECT * FROM temperatura WHERE finca_id = " . $_SESSION['finca'];
      $sql = mysqli_query($conection, $query);
      if ($sql) {
        while ($row = mysqli_fetch_array($sql)) {
      ?>
          <tr>
            <td> <?php echo date('d/m/Y', strtotime($row['semana'])) ?> - <?php echo date('d/m/Y', strtotime($row['semana'] . "+ 7 days")) ?> </td>
            <td> <img class="logos" src="../<?php echo $row['imagen'] ?>" alt=""> </td>
            <td>
              <a onclick="eliminar(<?php echo $row['id'] ?>)" class="btn btn-success">
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




<?php
include "end.php";
?>

<script src="../../../js/datatables.min.js"> </script>
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
    });
    $(".logos").click(function() {
      console.log(this.src);
      $('#logo_modal').attr('src', this.src);
      $('#logo').modal('show');
    });
  });

  //previsualizar imagen agregar
  document.getElementById("imagen").onchange = function(e) {
    let reader = new FileReader();

    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);

    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function() {
      let preview = document.getElementById('preview'),
        image = document.createElement('img');
      image.src = reader.result;
      preview.innerHTML = '';
      preview.prepend(image);
      $('#previo').css('display', 'block');
    };
  }

  //previsualizar imagen editar
  document.getElementById("edit_imagen").onchange = function(e) {
    let reader = new FileReader();

    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);

    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function() {
      let preview = document.getElementById('edit_preview');
      image = document.getElementById('edit_img');
      image.src = reader.result;
    };
  }

  //limpiar imagen
  function limpiar_imagen() {
    $('#imagen').val('');
    $('#previo').css('display', 'none');
    return false;
  }

  //Limpiar
  function limpiar() {
    limpiar_imagen();
    $('#add_sociedad').trigger("reset");
  }

  //Agregar fincas
  function add_sociedad() {
    var nombre = $('#semana').val();
    var finca = $('#finca').val();
    var imagen = document.getElementById('imagen');
    var file = imagen.files[0];
    if (nombre == "") {
      swal('Error!', 'Debe seleccionar una semana', 'error');
      return;
    }
    if (file == undefined) {
      swal('Error!', 'Debe ingresar una imagen de temperatura', 'error');
      return;
    }
    var data = new FormData();
    data.append('semana', nombre);
    data.append('finca', finca);
    data.append('imagen', file);
    data.append('op', "add");
    $.ajax({
        url: '../../../php/Owner/temperatura.php',
        type: 'POST',
        contentType: false,
        data: data,
        cache: false,
        processData: false
      })
      .done(function(data) {
        if (data == "1") {
          swal({
            title: "Buen trabajo",
            text: "La imagen fue agregada correctamente",
            icon: "success",
            button: true,
          }).then((res) => {
            if (res) {
              location.reload();
            }
          });
        } else {
          swal("Error", data, "error");
        }
      });
  }

  // Eliminar
  function eliminar(id) {
    swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar esta imagen de temperatura?",
      icon: "warning",
      buttons: true,
    }).then((res) => {
      if (res) {
        $.ajax({
            url: '../../../php/Owner/temperatura.php',
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
                text: "Se elimino correctamente la imagen",
                icon: "success",
                button: true,
              }).then((res) => {
                location.reload();
              });
            } else {
              swal("¡Error!", "No se logro eliminar", "error");
            }
          });
      }
    });
  }

  //Editar nombre finca 
  function guardar() {
    var nombre = $('#edit_nombre').val();
    var nit = $('#edit_nit').val();
    var imagen = document.getElementById('edit_imagen');
    var file = imagen.files[0];
    if (nombre == "") {
      swal('Error!', 'No puede dejar el nombre vacío', 'error');
      return;
    }
    if (nit == "") {
      swal('Error!', 'No puede dejar el nit vacío', 'error');
      return;
    }
    if (file != undefined) {
      if (file.size > 2000000) {
        swal('Error!', 'La imagen es demasiado pesada', 'error');
        return;
      }
    }
    var data = new FormData();
    data.append('nombre', nombre);
    data.append('nit', nit);
    data.append('imagen', file);
    data.append('op', "edit");
    data.append('id', $('#id').val());
    $.ajax({
        url: '../../php/Owner/sociedad.php',
        type: 'POST',
        contentType: false,
        data: data,
        cache: false,
        processData: false
      })
      .done(function(data) {
        if (data == "1") {
          swal({
            title: "Buen trabajo",
            text: "La sociedad fue editada correctamente",
            icon: "success",
            button: true,
          }).then((res) => {
            if (res) {
              location.reload();
            }
          });
        } else {
          swal("Error", data, "error");
        }
      });

  }

  // Cargar los nombres al modal
  function upload_data(id) {

    $.ajax({
      url: '../../php/Owner/sociedad.php',
      type: 'POST',
      dataType: 'json',
      data: {
        op: 'read',
        id: id
      }
    }).done(function(data) {
      $('#id').val(data.id);
      $('#edit_nombre').val(data.nombre);
      $('#edit_nit').val(data.nit);
      $('#edit_img').attr('src', data.logo);
    });
  }
</script>

</html>