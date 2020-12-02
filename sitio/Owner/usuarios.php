
<?php

include "main.php";

?>

<link rel="stylesheet" href="../../css/datatables.min.css">

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

hr{
	margin: 0px;
}

</style>


<!-- Modal para agregar usuarios -->
<!-- Modal para agregar usuarios -->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Agregar usuario </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

		<form id="add_data" >
			<div class="form-group">
				<label for="identificacion"> Identificación </label>
				<input name="identificacion" type="number" class="form-control" id="identificacion" placeholder="Identificación">
			</div>
			<div class="form-group">
			    <label> Seleccione la(s) finca(s) </label>
			    <br>
<?php 
	/********************************************/
	//Imprimimos las fincas desde la DB separadas 
	//por sociedades
	/********************************************/
	include "../../php/conection.php";
	$query = "SELECT * FROM sociedad";
	$sql = mysqli_query($conection,$query);
	if ($sql) {
		while ($row = mysqli_fetch_array($sql)) {
?>				
				<label for=""><?php echo $row['nombre'] ?></label>
				<hr>
<?php

		$query = "SELECT * FROM finca WHERE id_sociedad=".$row['id'];
		$sql1 = mysqli_query($conection,$query);
		if ($sql1) {
			while ($row1 = mysqli_fetch_array($sql1)) {
		?>
				<input value="1" name="finca_<?php echo $row1['id'] ?>" id="finca_<?php echo $row1['id'] ?>" type="checkbox">
				<label for="finca_<?php echo $row1['id'] ?>"><?php echo $row1['nombre'] ?></label><br>
		<?php
			}
		}
?>
				<hr>
				<br>
<?php
	}
}
?>
			</div>
			<div class="form-group">
				<label for="nombre_usuario"> Nombre de usuario </label>
				<input name="nombre_usuario" type="text" class="form-control" id="nombre_usuario" placeholder="Ingrese nombre de usuario">
			</div>
			<div class="form-group">
			    <label for="tipo"> Seleccione el tipo de usuario </label>
			    	<select name="tipo" class="form-control" id="tipo">
				      <option value="2"> Gerente </option>
				      <option value="1"> Administrador </option>
				      <option value="3"> Bodega </option>
				      <option value="4"> Vendedor </option>
			    	</select>
			 </div>
			 <div class="form-group">
				<label for="nombreE"> Nombre </label>
				<input name="nombreE" type="text" class="form-control" id="nombreE" placeholder="Ingrese nombre" >
			</div>
			<div class="form-group">
				<label for="apellidoE"> Apellido </label>
				<input name="apellidoE" type="text" class="form-control" id="apellidoE" placeholder="Ingrese apellido" >
			</div>
			
		</form>
        
      </div>
      <div class="modal-footer">
        <button onclick="limpiar();" type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
        <button onclick="add();" type="button" class="btn btn-success"> Agregar Usuario </button>
      </div>
    </div>
  </div>

</div>

	<!-- Modal para editar usuarios -->
	<!-- Modal para editar usuarios -->
	<!-- Modal para editar usuarios -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Editar usuario </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	  <form id="add_edit" >
		<input id="id" type="hidden" name="id">
		<div class="form-group">
			<label for="edit_identificacion"> Identificación </label>
			<input name="identificacion" type="text" class="form-control" id="edit_identificacion" placeholder="Identificación" >
		</div>

		<div class="form-group">
			    <label> Seleccione la(s) finca(s) </label>
			    <br>
<?php 
	/********************************************/
	//Imprimimos las fincas desde la DB separadas 
	//por sociedades
	/********************************************/
	include "../../php/conection.php";
	$query = "SELECT * FROM sociedad";
	$sql = mysqli_query($conection,$query);
	if ($sql) {
		while ($row = mysqli_fetch_array($sql)) {
?>
				<label for=""><?php echo $row['nombre'] ?></label>
				<hr>
<?php

		$query = "SELECT * FROM finca WHERE id_sociedad=".$row['id'];
		$sql1 = mysqli_query($conection,$query);
		if ($sql1) {
			while ($row1 = mysqli_fetch_array($sql1)) {
		?>
				<input value="1" name="finca_<?php echo $row1['id'] ?>" id="edit_finca_<?php echo $row1['id'] ?>" type="checkbox">
				<label for="edit_finca_<?php echo $row1['id'] ?>"><?php echo $row1['nombre'] ?></label><br>
		<?php
			}
		}
?>
				<hr><br>
<?php
	}
}
?>
			</div>

		<div class="form-group">
			<label for="edit_nombre_usuario"> Nombre de usuario </label>
			<input name="nombre_usuario" type="text" class="form-control" id="edit_nombre_usuario" placeholder="Ingrese nombre de usuario" >
		</div>
		<div class="form-group">
		    <label for="edit_tipo"> Seleccione el tipo de usuario </label>
		    	<select name="tipo" class="form-control" id="edit_tipo" >
			      <option value="2"> Gerente </option>
			      <option value="1"> Administrador </option>
			      <option value="3"> Bodega </option>
			      <option value="4"> Vendedor </option>
			      <option value="5"> Comprador </option>
		    	</select>
		 </div>
		 <div class="form-group">
			<label for="edit_nombreE"> Nombre </label>
			<input name="nombreE" type="text" class="form-control" id="edit_nombreE" placeholder="Ingrese nombre" >
		</div>
		<div class="form-group">
			<label for="edit_apellidoE"> Apellido </label>
			<input name="apellidoE" type="text" class="form-control" id="edit_apellidoE" placeholder="Ingrese apellido" >
		</div>
	</form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
        <button onclick="edit();" type="button" class="btn btn-success"> Guardar Cambios </button>
      </div>
    </div>
  </div>

</div>
<!-- Cierre div modal para editar usuarios -->
<br><br>
<div class="container contenedor">

	<h3> Administrar Usuarios </h3>

	<br>
	<!-- Boton para agregar usuarios -->
	<!-- Boton para agregar usuarios -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
	  Agregar Usuario
	</button>

	<!-- Tabla para mostrar la información de usuarios -->
	<!-- Tabla para mostrar la información de usuarios -->
	<br><br>
	<table class="table" id="tabla">
	<thead>
	<tr>
	  <th scope="col"> Identificación </th>
	  <th scope="col"> Nombre de Usuario</th>
	  <th scope="col"> Rol </th>
	  <th scope="col"> Nombre </th>
	  <th scope="col"> Apellidos </th>
	  <th scope="col"> Opciones </th>
	</tr>
	</thead>
		<tbody>

		<?php
			//Imprimimos los registros de la base DB

			include "../../php/conection.php";
			$query = "SELECT u.id, u.nombre_usuario,u.identificacion,u.nombre,u.apellido,t.id AS 'rol' FROM usuarios AS u INNER JOIN tipo_usuario AS t WHERE u.id_rol = t.id AND u.id != ".$_SESSION['id'];
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				while ($row = mysqli_fetch_array($sql)) {
		?>
			<tr>
			  <td> <?php echo $row['identificacion'] ?> </td>
			  <td> <?php echo $row['nombre_usuario'] ?> </td>
			  <td> <?php 
			  switch ($row['rol']) {
			  	case '1':
			  		echo 'Administrador';
			  		break;
			  	case '2':
			  		echo 'Gerente';
			  		break;
			  	case '3':
			  		echo 'Bodega';
			  		break;
			  	case '4':
			  		echo 'Vendedor';
			  		break;
			  	
			  }
			  ?> </td>
			  <td> <?php echo $row['nombre'] ?> </td>
			  <td> <?php echo $row['apellido'] ?> </td>
			  <td> 
			  	<a data-toggle="modal" data-target="#editar" onclick="upload_data(<?php echo $row['id']; ?>)" class="btn btn-success"> 
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

</body>

<?php

include "end.php";

 ?>

 <script src="../../js/datatables.min.js"></script>

 <script>
	
//Paginar registros
	$(document).ready(function() {
		$('.table').DataTable({
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
 		$('#add_data').trigger("reset");
 	}


	//Guarda la informacion editada
 	function edit(){
 		var data = $('#add_edit').serialize() + "&op=edit";
 		console.log(data);
 		$.ajax({
 			url: '../../php/Owner/usuarios.php',
 			type: 'POST',
 			data: data,
 		})
 		.done(function(data) {
 			console.log(data);
 			if (data == "1") {
 				swal({
					title: "Buen trabajo",
					text: "El usuario fue editado correctamente.",
					icon: "success",
					button: true,
				}).then((res)=>{
					if(res){
						location.reload();
					}
				});
 			}else{
 				swal("Error", "No se logro editar el usuario","error");
 			}
 		});
 		
 	}

 	//Guarda la información nueva de un registro
 	function upload_data(id){
 		$.ajax({
 			url: '../../php/Owner/usuarios.php',
 			type: 'POST',
 			data: {op: 'read',id: id},
 			dataType: 'json'
 		})
 		.done(function(data) {
 			$('[type=checkbox]').removeAttr('checked');
 			$('#id').val(data.id);
 			$('#edit_identificacion').val(data.identificacion);
 			$('#edit_nombre_usuario').val(data.nombre_usuario);
 			$('#edit_tipo option[value = '+data.id_rol+']').attr('selected', true);
 			$('#edit_nombreE').val(data.nombre);
 			$('#edit_apellidoE').val(data.apellido);
 			for (var i = 0; i < data.fincas.length; i++) {
 				$('#edit_'+data.fincas[i][0]).attr('checked','false');
 			}
 		});
 	}

	// Verificar formulario de agregar
	function verificar_add(){
		var identificacion = $('#identificacion').val();
		if (identificacion == '') {
			swal({
			title: "Error",
			text: "Debe ingresar una identificación",
			icon: "error",
			button: true,
		}).then((res)=>{
				$('#identificacion').focus();
		});
			return false;
		}
		return true;
	}

	//Agregar
	function add(){
		if (verificar_add()) {
			var data = $('#add_data').serialize() + "&op=insert";
 		$.ajax({
 			url: '../../php/Owner/usuarios.php',
 			type: 'POST',
 			data: data,
 		})
 		.done(function(data) {
 			console.log(data);
 			if (data == "1") {
 				swal({
					title: "Buen trabajo",
					text: "El usuario fue agregado correctamente.",
					icon: "success",
					button: true,
				}).then((res)=>{
					if(res){
						location.reload();
					}
				});
 			}else{
 				swal("Error", "No se logró agregar el usuario.","error");
 			}
 		});
		}
}

 	//Eliminar 
 	function eliminar(id){

		swal({
		title: "Advertencia",
		text: "¿Seguro de querer eliminar este usuario?",
		icon: "warning",
		buttons: true,
	  }).then((res)=>{
		if(res){
			$.ajax({
				url: '../../php/Owner/usuarios.php',
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
						text: "Se elimino correctamente el usuario.",
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


 </script>



</html>