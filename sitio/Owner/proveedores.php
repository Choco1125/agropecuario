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

<!-- Modal para agregar proveedor -->
<div class="modal fade" id="agregar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar proveedor </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add_proveedor" method="POST">

            <div class="form-group">
            <label for="nit"> Nit </label>
            <input name="nit" type="text" class="form-control" id="nit" placeholder="Ingrese el nit">
            </div>

      			<div class="form-group">
      			<label for="nombre"> Nombre </label>
      			<input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre">
      			</div>

      			<div class="form-group">
      			<label for="telefono"> Teléfono </label>
      			<input name="telefono" type="number" class="form-control" id="telefono" placeholder="Ingrese el teléfono">
      			</div>

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_proveedor();" class="btn btn-success"> Agregar proveedor </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar proveedor -->

<!-- Modal para editar proveedor-->
<div class="modal fade" id="editar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar proveedor </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="edit_proveedor">
        	<input type="hidden" name="id" id="id">
        	<div class="form-group">
	           <label for="nit"> Nit del proveedor </label>
	           <input name="nit" type="text" class="form-control" id="edit_nit">
	        </div>

	        <div class="form-group">
	           <label for="nombre"> Nombre del proveedor </label>
	           <input name="nombre" type="text" class="form-control" id="edit_nombre">
	        </div>

	        <div class="form-group">
	           <label for="telefono"> Teléfono del proveedor </label>
	           <input name="telefono" type="text" class="form-control" id="edit_telefono">
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
<!-- Cierre modal para editar proveedor -->

<div class="container contenedor">
  
  <br><br>
    <h3> Proveedores </h3>
	<br>

	<!-- Boton para agregar proveedores -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar_proveedor">
		Agregar Proveedores
	</button>

	<!-- Tabla para mostrar la información de proveedores -->
	<!-- Tabla para mostrar la información de proveedores -->
	<br><br>
	<table class="table" id="tabla">
	<thead>
	<tr>
	  <th scope="col"> Nit </th>
	  <th scope="col"> Nombre </th> 
	  <th scope="col"> Teléfono </th>
	  <th scope="col"> Acciones </th>
	</tr>
	</thead>
		<tbody>
			<?php 
				include "../../php/conection.php";
				$query = "SELECT * FROM proveedor";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
						?>
						<tr>
							<td> <?php echo $row['nit'] ?> </td>
							<td> <?php echo $row['nombre'] ?> </td>
							<td> <?php echo $row['telefono'] ?> </td>
							<td> 
								<a data-toggle="modal" data-target="#editar_proveedor" onclick="upload_data(<?php echo $row['id']; ?>)" class="btn btn-success">
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
    });
  });

//Limpiar
function limpiar(){
  $('#add_proveedor').trigger("reset");
}
 
//Agregar proveedor
function add_proveedor(){
	var data = $('#add_proveedor').serialize() + "&op=insert";
	$.ajax({
	url: '../../php/Owner/proveedores.php',
	type: 'POST',
	data: data,
	})
	.done(function(data) {
	if (data == "1") {
	swal({
		title: "Buen trabajo",
		text: "El proveedor fue agregado correctamente",
		icon: "success",
		button: true,
	}).then((res)=>{
		if(res){
			location.reload();
		}
	});
		}else{
			swal("Error", "No se logró agregar el proveedor","error");
		}
	});
}

//Eliminar
function eliminar(id){
      swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar este proveedor?",
      icon: "warning",
      buttons: true,
     }).then((res)=>{
      if(res){
        $.ajax({
          url: '../../php/Owner/proveedores.php',
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
              text: "Se elimino correctamente el proveedor",
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

//Editar proveedores 
function guardar(){
    var data = $('#edit_proveedor').serialize() + "&op=edit";
    $.ajax({
      url: '../../php/Owner/proveedores.php',
      type: 'POST',
      data: data,
    })
    .done(function(data) {
      if (data == "1") {
        swal({
          title: "Buen trabajo",
          text:  "El proveedor fue editado correctamente",
          icon:  "success",
          button: true,
        }).then((res)=>{
          if (res) {
            location.reload();
          }
        });
      } else {
        swal ("Error", "No se logro editar el proveedor","error");
      }
    });
}

//Cargar los nombres al modal
function upload_data(id){

$.ajax({
  url: '../../php/Owner/proveedores.php',
  type: 'POST',
  data: {op: 'read',
         id: id}
}).done(function(data) {
  var datos = jQuery.parseJSON(data);
  $('#id').val(datos['id']);
  $('#edit_nit').val(datos['nit']);
  $('#edit_nombre').val(datos['nombre']);
  $('#edit_telefono').val(datos['telefono']);
});

}
</script>


</html>