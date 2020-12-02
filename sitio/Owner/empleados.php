<?php 
  include "main.php";
?>
<link rel="stylesheet" href="../../css/datatables.min.css">

</body>

<!-- Modal para agregar empleados -->
<div class="modal fade" id="add_empleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar Empleado </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add">

            <div class="form-group">
              <label for="identificacion"> Identificación </label>
              <input name="identificacion" type="text" class="form-control" id="identificacion" placeholder="Ingrese la identificacion del empleado">
            </div>
            <div class="form-group">
              <label for="nombre"> Nombre </label>
              <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el Nombre del empleado">
            </div>
            <div class="form-group">
              <label for="apellido"> Apellido </label>
              <input name="apellido" type="text" class="form-control" id="apellido" placeholder="Ingrese el Apellido del empleado">
            </div>
          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" onclick="limpiar_a();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_empleado();" class="btn btn-success"> Agregar Empleado </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre modal para agregar empleados -->

<!-- Modal para Editar empleados -->
<div class="modal fade" id="edit_empleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar Empleado </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="edit">
			<input type="hidden" id='id' name="id">
            <div class="form-group">
              <label for="identificacion"> Identificación </label>
              <input name="identificacion" type="text" class="form-control" id="edit_identificacion" placeholder="Ingrese la identificacion del empleado">
            </div>
            <div class="form-group">
              <label for="nombre"> Nombre </label>
              <input name="nombre" type="text" class="form-control" id="edit_nombre" placeholder="Ingrese el Nombre del empleado">
            </div>
            <div class="form-group">
              <label for="apellido"> Apellido </label>
              <input name="apellido" type="text" class="form-control" id="edit_apellido" placeholder="Ingrese el Apellido del empleado">
            </div>
          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" onclick="limpiar_e();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="save();" class="btn btn-success"> Guardar </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre modal para Editar empleados -->
	
	<div class="container">
		<br><br>
		<h3> Empleados </h3>
		<br>
		<a class="btn btn-secondary" data-toggle="modal" data-target="#add_empleado" href="#"> Agregar Empleado </a>
		<br><br>
		<!-- Tabla de empleados -->
		<table class="table" id="tabla">
		  <thead>
		    <tr>
		      <th scope="col"> Identificación </th>
		      <th scope="col"> Nombre </th>
		      <th scope="col"> Apellido </th>
		      <th scope="col"> Acciones </th>
		    </tr>
		  </thead>
		  <tbody>

		<?php 
			//lsitar los registros
			include '../../php/conection.php';
			$query = "SELECT * FROM empleado";
			$sql = mysqli_query($conection, $query);
		  	if ($sql) {
		    	while ($row = mysqli_fetch_array($sql)) {
		?>
					  <tr>
					    <td> <?php echo $row['identificacion'] ?></td>
					    <td> <?php echo $row['nombre'] ?></td>
					    <td> <?php echo $row['apellidos'] ?></td>
					    <td> 
					      <a data-toggle="modal" href="#" data-target="#edit_empleado" onclick="upload(<?php echo $row['id']; ?>)" class="btn btn-primary"> 
					        <i class="far fa-edit"> </i>
					      </a>
<?php if ($_SESSION['finca'] != "0") { ?>
					      <a class="btn btn-success" href="g_comprobante.php?employee=<?php echo $row['id'] ?>"> 
					        <i class="fas fa-file-invoice-dollar"></i>
					      </a>
<?php } ?>
					      <a class="btn btn-secondary" href="#" onclick="eliminar(<?php echo $row['id'] ?>);"> 
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
		<!-- Cierre de tabla-->
		
	</div>


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

	function limpiar_a(){
		$('#add').trigger("reset");
	}

	function limpiar_e(){
		$('#edit').trigger("reset");
	}

	function add_empleado(){
	 var identificacion = $('#identificacion');
	 var nombre = $('#nombre');
	 var apellido = $('#apellido');

	 if(identificacion.val() == ""){
	 	swal('Error!','Debe de ingresar una identificación para el empleado','error');
	 	return;
	 }

	 if(nombre.val() == ""){
	 	swal('Error!','Debe de ingresar una Nombre para el empleado','error');
	 	return;
	 }

	 if(apellido.val() == ""){
	 	swal('Error!','Debe de ingresar una Apellido para el empleado','error');
	 	return;
	 }

	 var data = $('#add').serialize() + '&op=insert';
	 $.ajax({
	 	url: '../../php/Owner/empleado.php',
	 	type: 'POST',
	 	data: data,
	 })
	 .done(function(data) {
	 	if (data == "1") {
  			swal({
  				title: "Buen trabajo",
  				text: "El empleado fue agregado correctamente!",
  				icon: "success",
  				button: true,
  			}).then((res)=>{
  				location.reload();
  			});
  		}else{
  			swal("Error", data,"error");
  		}
	 });
	}

	function eliminar(id){
		swal({
			title: "Advertencia",
			text: "Seguro de Querer eliminar este empleado",
			icon: "warning",
			buttons: true,
		}).then((res)=>{
			if (res) {
				$.ajax({
			 	url: '../../php/Owner/empleado.php',
			 	type: 'POST',
			 	data: {id:id,op:'delete'},
			 })
			 .done(function(data) {
			 	if (data == "1") {
		  			swal({
		  				title: "Buen trabajo",
		  				text: "El empleado fue eliminado correctamente!",
		  				icon: "success",
		  				button: true,
		  			}).then((res)=>{
		  				location.reload();
		  			});
		  		}else{
		  			swal("Error", data,"error");
		  		}
			 });				
			}
		});
	}

	function upload(id){
		$.ajax({
		 	url: '../../php/Owner/empleado.php',
		 	type: 'POST',
		 	dataType: 'json',
		 	data: {id:id,op:'read'},
		})
		.done(function(data) {
		 	$('#id').val(data.id);
		 	$('#edit_identificacion').val(data.identificacion);
		 	$('#edit_nombre').val(data.nombre);
		 	$('#edit_apellido').val(data.apellidos);
	  	});
	}

	function save(){
		var identificacion = $('#edit_identificacion');
		 var nombre = $('#edit_nombre');
		 var apellido = $('#edit_apellido');

		 if(identificacion.val() == ""){
		 	swal('Error!','Debe de ingresar una identificación para el empleado','error');
		 	return;
		 }

		 if(nombre.val() == ""){
		 	swal('Error!','Debe de ingresar una Nombre para el empleado','error');
		 	return;
		 }

		 if(apellido.val() == ""){
		 	swal('Error!','Debe de ingresar una Apellido para el empleado','error');
		 	return;
		 }

		 var data = $('#edit').serialize() + '&op=edit';

		 $.ajax({
		 	url: '../../php/Owner/empleado.php',
		 	type: 'POST',
		 	data: data,
		 })
		 .done(function(data) {
		 	if (data == "1") {
	  			swal({
	  				title: "Buen trabajo",
	  				text: "El empleado fue Editado correctamente!",
	  				icon: "success",
	  				button: true,
	  			}).then((res)=>{
	  				location.reload();
	  			});
	  		}else{
	  			swal("Error", data,"error");
	  		}
		 });
	}


</script>


</html>