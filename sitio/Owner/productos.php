<?php

include "main.php";

?>

<link rel="stylesheet" href="../../css/datatables.min.css">

<style>

.contenedor {
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

<!-- Modal para agregar productos -->
<div class="modal fade" id="agregar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar producto </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add_producto" method="POST">

            <div class="form-group">
              <label for="nombre"> Nombre </label>
              <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del producto">
            </div>

      			<div class="form-group">
        			<label for="unidad"> Unidad </label>
        			<input name="unidad" type="text" class="form-control" id="unidad" placeholder="Ingrese la unidad">
      			</div>

            <div class="form-group">
              <label for="cultivo_id">Seleccione el cultivo</label>
              <select class="form-control" name="cultivo_id" id="cultivo_id">
                  <option value="">Seleccione un cultivo</option>
<?php 
    include '../../php/conection.php';
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

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_producto();" class="btn btn-success"> Agregar producto </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar productos -->

<!-- Modal para editar productos-->
<div class="modal fade" id="editar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar producto </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="edit_producto">
        	<input type="hidden" name="id" id="id">
        	<div class="form-group">
	           <label for="nombre"> Nombre </label>
	           <input name="nombre" type="text" class="form-control" id="edit_nombre">
	        </div>

	        <div class="form-group">
	           <label for="unidad"> Unidad </label>
	           <input name="unidad" type="text" class="form-control" id="edit_unidad">
	        </div>

          <div class="form-group">
              <label for="edit_cultivo_id">Seleccione el cultivo</label>
              <select class="form-control" name="cultivo_id" id="edit_cultivo_id">
                  <option value="">Seleccione un cultivo</option>
<?php 
    include '../../php/conection.php';
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

      	</form>

      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="guardar();" class="btn btn-success"> Guardar cambios </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre modal para editar productos -->

<div class="container contenedor">

	<br><br>
    <h3> Productos </h3>
  <br>

	<!-- Boton para agregar productos -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar_producto">
		Crear Productos
	</button>

	<!-- Tabla para mostrar la información de productos -->
	<br><br>
	<table class="table" id="tabla">
	<thead>
	<tr>
	  <th scope="col"> Nombre </th>
    <th scope="col"> Unidad </th>
	  <th scope="col"> Cultivo </th>
	  <th scope="col"> Opciones </th>
	</tr>
	</thead>
		<tbody>
			<?php 
				include "../../php/conection.php";
				$query = "SELECT p.id,p.nombre,p.unidad,c.nombre AS 'cultivo' FROM producto As p INNER JOIN cultivo As c WHERE p.cultivo_id = c.id";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
						?>
						<tr>
							<td> <?php echo $row['nombre'] ?> </td>
              <td> <?php echo $row['unidad'] ?> </td>
							<td> <?php echo $row['cultivo'] ?> </td>
							<td> 
								<a data-toggle="modal" data-target="#editar_producto" onclick="upload_data(<?php echo $row['id']; ?>)" class="btn btn-success">
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
  $('#add_producto').trigger("reset");
}
 
//Agregar producto
function add_producto(){
  //comprobar que ingresen todos los datos
  var nombre = $('#nombre').val();
  var unidad = $('#unidad').val();
  var cultivo_id = $('#cultivo_id').val();

  if( nombre == "" || unidad == "" || cultivo_id == ""){
    swal('Error','Debe de ingresar todos los datos','error');
    return;
  }


	var data = $('#add_producto').serialize() + "&op=insert";
	$.ajax({
  	url: '../../php/Owner/productos.php',
  	type: 'POST',
  	data: data,
	})
	.done(function(data) {
  	if (data == "1") {
    	swal({
    		title: "Buen trabajo",
    		text: "El producto fue agregado correctamente",
    		icon: "success",
    		button: true,
    	}).then((res)=>{
    		if(res){
    			location.reload();
    		}
    	});
		}else{
			swal("Error", "No se logró agregar el producto","error");
		}
	});
}

  //Eliminar
  function eliminar(id){
    swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar este producto?",
      icon: "warning",
      buttons: true,
    }).then((res)=>{
      if(res){
        $.ajax({
          url: '../../php/Owner/productos.php',
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
              text: "Se elimino correctamente el producto",
              icon: "success",
              button: true,
            }).then((res)=>{
              location.reload();
            });
          	} else {
            	swal("¡Error!","No se logro eliminar", "error");
          }
        });
      }
    });
  }

  //Editar nombre finca 
  function guardar(){
    //comprobar que ingresen todos los datos
    var nombre = $('#edit_nombre').val();
    var unidad = $('#edit_unidad').val();
    var cultivo_id = $('#edit_cultivo_id').val();

    if( nombre == "" || unidad == "" || cultivo_id == ""){
      swal('Error','Debe de ingresar todos los datos','error');
      return;
    }
    var data = $('#edit_producto').serialize() + "&op=edit";
    $.ajax({
      url: '../../php/Owner/productos.php',
      type: 'POST',
      data: data,
    })
    .done(function(data) {
      if (data == "1") {
        swal({
          title: "Buen trabajo",
          text:  "El producto fue editado correctamente",
          icon:  "success",
          button: true,
        }).then((res)=>{
          if (res) {
            location.reload();
          }
        });
      } else {
        swal ("Error", "No se logro editar el producto","error");
      }
    });
  }

// Cargar los nombres al modal
function upload_data(id){

$.ajax({
  url: '../../php/Owner/productos.php',
  type: 'POST',
  data: {op: 'read',
         id: id}
}).done(function(data) {
  var datos = jQuery.parseJSON(data);
  $('#id').val(id);
  $('#edit_nombre').val(datos['nombre']);
  $('#edit_unidad').val(datos['unidad']);
  $('#edit_cultivo_id').val(datos['cultivo_id']);
});

}
</script>


</html>