<?php
	include "main.php";
?>
<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">
<link rel="stylesheet" href="../../css/datatables.min.css">
  
<style>
  .select2{
    width: 100% !important;
  }

  .contenedor{
    overflow: auto;
    width: 100%;
  }

</style>

  <!-- Modal para actualizar contrato -->
<div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Actualizar </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="data">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label for="formControlRange">Seleccione el porcentaje de ejecucion del contrato</label>
              <input value="0" min="0" name="valor" max="100" type="range" onchange="cambiar();" class="form-control-range" id="valor">
            </div>
            <div class="progress">
              <div id="progreso" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="actualizar();" class="btn btn-success"> Actualizar </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para aactualizar contrato   -->

<!-- Modal para insumos -->
<div class="modal fade" id="modal_insumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Insumos </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"> &times; </span>
        </button>
      </div>
      <div id="contenido_insumos" class="modal-body">

        <!-- Aqui se muestra el contenido con un ajax -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para emplados -->
<div class="modal fade" id="modal_empleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Empleados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="contenido_empleados" class="modal-body">
        
        <!-- Aqui se muestra el contenido con un ajax -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
      </div>
    </div>
  </div>
</div>


<!-- Modal para agregar insumos -->
<div class="modal fade" id="insumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Agregar insumo a esta contrato </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="data_insumos" method="POST">
            <input id="id_i" name="id" type="hidden">
            <div class="form-group">
              <label for="insumo">Insumo</label>
              <select name="insumo" id="insumo" class="from-control">
                    <option value="">seleccione un insumo</option>
            <?php 
        include '../../php/conection.php';
        $query = "SELECT b.id,b.cantidad,i.nombre FROM insumo AS i INNER JOIN bodega as b WHERE b.insumo_id = i.id AND b.finca_id = '".$_SESSION['finca']."'";
        $sql = mysqli_query($conection,$query);
        if ($sql) {
          while ($row = mysqli_fetch_array($sql)) {
      ?>
          <option value="<?php echo $row['id'] ?>"><?php echo $row['cantidad'].' - '.$row['nombre'] ?></option>
      <?php
          }
        }
       ?>
                </select>
            </div>
            <div class="form-group">
              <label for="cantidad">cantidad</label>
              <input class="form-control" name="cantidad" id="cantidad" type="number">
            </div>            
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="add_insumo();" class="btn btn-success"> Agregar </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar insumos -->

<div class="container contenedor">
  <br>
  <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
  <br>

  <?php 
      include '../../php/conection.php';
      $query = "SELECT * FROM finca WHERE id=".$_SESSION['finca'];
      $sql = mysqli_query($conection,$query);
      $finca;
      if ($sql) {
        $finca = mysqli_fetch_array($sql);
      }
   ?>
  <br>
    <h3> <?php echo $finca['nombre'] ?> </h3>
  <br>

  <!-- Tabla para mostrar la información de contratos -->
  <!-- Tabla para mostrar la información de contratos -->
  <table class="table" id="tabla">
  <thead>
  <tr>
    <th scope="col"> Fecha </th> 
    <th scope="col"> Labor </th>
    <th scope="col"> Estado </th>
    <th scope="col"> Valor </th>
    <th scope="col"> Empleados </th>
    <th scope="col"> Insumos </th>
    <th scope="col"> Observaciones </th>
    <th scope="col"> Actualizar estado </th>
  </tr>
  </thead>
    <tbody>
      <?php
        $query = "SELECT r.id,l.nombre,r.fecha,r.estado,r.valor,r.observacion FROM registro_labor AS r INNER JOIN labores AS l WHERE l.id = r.labor_id AND r.tipo='1' AND r.labor='1' ";
        $sql = mysqli_query($conection, $query);
        if ($sql) {
          while ($row = mysqli_fetch_array($sql)) {
            ?>
            <tr>
              <td> <?php echo $row['fecha'] ?> </td>
              <td> <?php echo $row['nombre'] ?> </td>
              <td> <?php echo $row['estado'].'%' ?> </td>
              <td> <?php echo $row['valor'] ?> </td>
              <td> 
                <button type="button" onclick="empleados(<?php echo $row['id'] ?>);" class="btn btn-primary" data-toggle="modal" data-target="#modal_empleados"> Ver </button>
               </td>
              <td> <button type="button" onclick="insumos(<?php echo $row['id'] ?>);" class="btn btn-primary" data-toggle="modal" data-target="#modal_insumos"> Ver </button> </td>
              <td> <?php echo $row['observacion'] ?> </td>
              <td> 
                <a data-toggle="modal" data-target="#actualizar" onclick="upload_data(<?php echo $row['id'].','.$row['estado']; ?>)" class="btn btn-success">
                  <i class="far fa-edit"> </i>  
                </a>
                <a data-toggle="modal" data-target="#insumos" onclick="asignar_id(<?php echo $row['id'] ?>)" class="btn btn-success">
                  <i class="far fa-edit"> </i>  
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
<script src="../../js/select2.min.js"></script>
<script>

  $(document).ready(function() {
      $('#insumo').select2({
        dropdownParent: $('#insumos')
      });
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

  function upload_data(id,estado){
    $('#id').val(id);
    $('#valor').val(estado);
    $('#progreso').html(estado+'%');
    $('#progreso').css('width', estado+'%');
  }

  function asignar_id(id){
    $('#id_i').val(id);
  }

  function cambiar(){
    var valor = $('#valor').val();
    $('#progreso').html(valor+'%');
    $('#progreso').css('width', valor+'%');
  }

  function actualizar(){
    $.ajax({
      url: '../../php/Admin/labor.php',
      type: 'POST',
      data: $('#data').serialize()+'&op=estado',
    })
    .done(function(data) {
      if (data == "1") {
        swal('Buen Trabajo!','Estado actualizado correctamente','success').then((res)=>{
          location.reload();
        });
      }else{
        swal('Error!',data,'error');
      }
    });
  }

  function add_insumo(){
    
    var insumo = $('#insumo');
    var cantidad = $('#cantidad');
    if(insumo.val() == ""){
      swal('Error!','Debe de seleccionar un insumo','error');
      return;
    }

    if (cantidad.val() == "") {
      swal('Error!','Debe ingresar la cantidad','error');
      return;
    }

    console.log('asdasd');

    $.ajax({
      url: '../../php/Admin/labor.php',
      type: 'POST',
      dataType: 'json',
      data: $('#data_insumos').serialize()+'&op=insumo',
    })
    .done(function(data) {
      if(data.res == '1'){
        var aux = $('#insumo option[value="'+insumo.val()+'"]');
        aux.text(data.cant);
        $('#insumos').modal('hide');
        $('#data_insumos').trigger('reset');
      }else{
        swal('Error!',data,'error');
      }
    });
  }


    function insumos(id){
    $.ajax({
      url: '../../php/Admin/labor.php',
      type: 'POST',
      data: {id: id, op:'insumos'}
    }).done(function(data) {
      console.log(data);
      $('#contenido_insumos').html(data);
      $('#tabla_i').DataTable({
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
        });
    }).fail(function(data){
      console.lo(data);
    });
  }

  function empleados(id){
    $.ajax({
    url: '../../php/Admin/labor.php',
    type: 'POST',
    data: {id: id, op:'empleados_contrato'}
  })
  .done(function(data) {
    $('#contenido_empleados').html(data);
    $('#tabla_e').DataTable({
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
      });
  });

  }


</script>

</html>