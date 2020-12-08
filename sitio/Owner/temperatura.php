<?php
include "main.php";
?>

<link rel="stylesheet" href="../../css/datatables.min.css">

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

  <h3> Temperaturas -
    <?php
    include "../../php/conection.php";
    $query = "SELECT nombre FROM finca WHERE id = " . $_SESSION['finca'];
    $sql = mysqli_query($conection, $query);
    if ($sql) {
      echo mysqli_fetch_array($sql)['nombre'];
    }
    ?> </h3>
  <br>


  <!-- Modal para Mostrar las imagenes -->
  <div class="modal fade" id="logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Ver imagen de temperatura </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="logo_modal" class="logo_modal" src="" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Cierre modal para Mostrar imagenes -->


  <!-- Tabla para mostrar temperaturas -->
  <table class="table" id="tabla">
    <thead>
      <tr>
        <th scope="col"> Semana </th>
        <th scope="col"> Imagen </th>
        <th scope="col"> Acciones </th>
      </tr>
    </thead>
    <tbody>
      <?php
      include "../../php/conection.php";
      $query = "SELECT * FROM temperatura WHERE finca_id=" . $_SESSION['finca'];
      $sql = mysqli_query($conection, $query);
      if ($sql) {
        while ($row = mysqli_fetch_array($sql)) {
      ?>
          <tr>
            <td>
              <?php
              $dato = explode('-W', $row['semana']);
              echo 'Semana ' . $dato[1] . ' del ' . $dato[0];
              ?>
            </td>
            <td> <img class="logos" src="<?php echo $row['imagen'] ?>" alt=""> </td>
            <td>
              <a onclick="eliminar(<?php echo $row['id'] ?>)" class="btn btn-danger">
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

<script src="../../js/datatables.min.js"> </script>
<script>
  $(document).ready(function() {
    $(".logos").click(function() {
      console.log(this.src);
      $('#logo_modal').attr('src', this.src);
      $('#logo').modal('show');
    });
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
  });

  // Eliminar
  function eliminar(id) {
    swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar este registro?",
      icon: "warning",
      buttons: true,
    }).then((res) => {
      if (res) {
        $.ajax({
            url: '../../php/Owner/temperatura.php',
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
                text: "Registro eliminado correctamente",
                icon: "success",
                button: true,
              }).then((res) => {
                location.reload();
              });
            } else {
              swal("¡Error!", data, "error");
            }
          });
      }
    });
  }
</script>

</html>