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

.swal-text {
  text-align: center !important; 
}

</style>

<br><br>


<div class="container contenedor">

  <h3> Administrar Fincas </h3>
  <br>
<!-- Modal para agregar fincas -->
<!-- Modal para agregar fincas -->
<div class="modal fade" id="agregar_fincas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar finca </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add_finca">

            <div class="form-group">
              <label for="nombre"> Nombre de la finca </label>
              <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre de la finca">
            </div>
            
            <div class="form-group">
              <label for="sociedad"> Seleccione la sociedad a la que pertenece </label>
              <select class="form-control" name="sociedad" id="sociedad">
                <option value=""> seleccione una sociedad </option>
                <?php 
                  include "../../php/conection.php";
                  $query = "SELECT * FROM sociedad";
                  $sql = mysqli_query($conection,$query);
                  while ($row = mysqli_fetch_array($sql)) {
                    ?>
                      <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                    <?php
                  }

                 ?>
              </select>
            </div>

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_finca();" class="btn btn-success"> Agregar finca </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre modal para agregar fincas -->

<!-- Modal para editar fincas -->
<div class="modal fade" id="editar_fincas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar finca </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="edit_finca">
          <input type="hidden" name="id" id="id">
            <br>

          <div class="form-group">
             <label for="nombre"> Nombre de la finca </label>
             <input name="nombre" type="text" class="form-control" id="edit_nombre" placeholder="Ingrese el nuevo nombre">
          </div>

          <div class="form-group">
              <label for="sociedad"> Seleccione la sociedad a la que pertenece </label>
              <select class="form-control" name="sociedad" id="edit_sociedad">
                <option value=""> seleccione una sociedad </option>
                <?php 
                  include "../../php/conection.php";
                  $query = "SELECT * FROM sociedad";
                  $sql = mysqli_query($conection,$query);
                  while ($row = mysqli_fetch_array($sql)) {
                    ?>
                      <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                    <?php
                  }

                 ?>
              </select>
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
<!-- Cierre modal para editar fincas -->

<!-- Boton para agregar usuarios -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar_fincas">	Agregar Finca
</button>

<br><br>

<!-- Tabla para mostrar fincas -->
<table class="table" id="tabla">
  <thead>
    <tr>
      <th scope="col"> Nombre de la finca </th>
      <th scope="col"> Sociedad </th>
      <th scope="col"> Opciones </th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  		include "../../php/conection.php";
  		$query = "SELECT f.id,f.nombre AS 'finca',s.nombre AS 'sociedad' FROM finca AS f INNER JOIN sociedad AS s INNER JOIN usuario_finca AS r WHERE f.id_sociedad = s.id AND f.id=r.finca_id AND r.usuario_id=".$_SESSION['id'];
  		$sql = mysqli_query($conection, $query);
  		if ($sql) {
  			while ($row = mysqli_fetch_array($sql)) {
  		?>
  		<tr>
        <td> <?php echo $row['finca'] ?> </td>
  			<td> <?php echo $row['sociedad'] ?> </td>
			<td> 
				<a data-toggle="modal" data-target="#editar_fincas" onclick="upload_data(<?php echo $row['id']; ?>)" class="btn btn-success">
				 	<i class="far fa-edit"> </i>  
				</a> 
				<a onclick="eliminar(<?php  echo $row['id'] ?>)" class="btn btn-secondary"> 
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
  $('#add_finca').trigger("reset");
}
  
//Agregar fincas
function add_finca(){
  var nombre = $('#nombre').val();
  var sociedad = $('#sociedad').val();
  if (nombre == "" || sociedad == "") {
    swal('Error!','Debe ingresar todos los los datos','error');
    return;
  }
	var data = $('#add_finca').serialize() + "&op=insert";
	$.ajax({
		url: '../../php/Owner/fincas.php',
		type: 'POST',
		data: data,
	})
	.done(function(data) {
		if (data == "1") {
			swal({
				title: "Buen trabajo",
				text: "La finca fue agregada correctamente",
				icon: "success",
				button: true,
			}).then((res)=>{
				if(res){
					location.reload();
				}
			});

	  		}else{
	  			swal("Error", "No se logró agregar la finca.","error");
	  		}
	});
}

  // Eliminar
 	function eliminar(id){
    swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar esta finca?  \r\n Recuerde que cuando elimina una finca se elimina tanto la bodega, como el registro de lotes, etc.",
      icon: "warning",
      buttons: true,
    }).then((res)=>{
      if(res){
        $.ajax({
          url: '../../php/Owner/fincas.php',
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
              text: "Se elimino correctamente la finca",
              icon: "success",
              button: true,
            }).then((res)=>{
              location.reload();
            });
          }else{
            swal("¡Error!","No se logro eliminar", "error");
          }
        });
      }
    });

  }

  //Editar nombre finca 
  function guardar(){
    var nombre = $('#edit_nombre').val();
    var sociedad = $('#edit_sociedad').val();
    if (nombre == "" || sociedad == "") {
      swal('Error!','Debe ingresar todos los los datos','error');
      return;
    }
     var data = $('#edit_finca').serialize() + "&op=edit";
    $.ajax({
      url: '../../php/Owner/fincas.php',
      type: 'POST',
      data: data,
    })
    .done(function(data) {
      if (data == "1") {
        swal({
          title: "Buen trabajo",
          text:  "La finca fue editada correctamente",
          icon:  "success",
          button: true,
        }).then((res)=>{
          if (res) {
            location.reload();
          }
        });
      } else {
        swal ("Error", "No se logro editar la finca","error");
      }
    });
    
  }

// Cargar los nombres al modal
  function upload_data(id){

    $.ajax({
      url: '../../php/Owner/fincas.php',
      type: 'POST',
      data: {op: 'read',
             id: id}
    }).done(function(data) {
      var datos = jQuery.parseJSON(data);
      $('#edit_nombre').val(datos['nombre']);
      $('#id').val(datos['id']);
      $('#edit_sociedad').val(datos['sociedad']);
    });
    
  }



</script>

</html>