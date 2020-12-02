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

<!-- Modal para agregar clientes -->
<div class="modal fade" id="agregar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar cliente </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add_cliente" method="POST">

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
	        <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_cliente();" class="btn btn-success"> Agregar cliente </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar cliente -->

<!-- Modal para editar clientes-->
<div class="modal fade" id="editar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar cliente </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="edit_cliente">
        	<input type="hidden" name="id" id="id">
        	<div class="form-group">
	           <label for="nit"> Nit del cliente </label>
	           <input name="nit" type="text" class="form-control" id="edit_nit">
	        </div>

	        <div class="form-group">
	           <label for="nombre"> Nombre del cliente </label>
	           <input name="nombre" type="text" class="form-control" id="edit_nombre">
	        </div>

	        <div class="form-group">
	           <label for="telefono"> Teléfono del cliente </label>
	           <input name="telefono" type="text" class="form-control" id="edit_telefono">
	        </div>
      	</form>

      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="guardar();" class="btn btn-success"> Guardar cambios </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre modal para editar clientes -->

<div class="container contenedor">

	<br><br>
    <h3> Clientes </h3>
  <br>

	<!-- Boton para agregar clientes -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregar_cliente">
		Crear clientes
	</button>

	<!-- Tabla para mostrar la información de clientes -->
	<!-- Tabla para mostrar la información de clientes -->
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
				$query = "SELECT * FROM cliente";
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
						?>
						<tr>
							<td> <?php echo $row['nit'] ?> </td>
							<td> <?php echo $row['nombre'] ?> </td>
							<td> <?php echo $row['telefono'] ?> </td>
							<td> 
								<a data-toggle="modal" data-target="#editar_cliente" onclick="upload_data(<?php echo $row['id']; ?>)" class="btn btn-primary">
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
  $('#add_cliente').trigger("reset");
}
 
//Agregar cliente
function add_cliente(){
	var data = $('#add_cliente').serialize() + "&op=insert";
	$.ajax({
	url: '../../php/Vendedor/cliente.php',
	type: 'POST',
	data: data,
	})
	.done(function(data) {
    console.log(data);
	if (data == "1") {
	swal({
		title: "Buen trabajo",
		text: "El cliente fue agregado correctamente",
		icon: "success",
		button: true,
	}).then((res)=>{
		if(res){
			location.reload();
		}
	});
		}else{
			swal("Error", "No se logró agregar el cliente","error");
		}
	});
}

//Editar cliente 
function guardar(){
    var data = $('#edit_cliente').serialize() + "&op=edit";
    $.ajax({
      url: '../../php/Vendedor/cliente.php',
      type: 'POST',
      data: data,
    })
    .done(function(data) {
      if (data == "1") {
        swal({
          title: "Buen trabajo",
          text:  "El cliente fue editado correctamente",
          icon:  "success",
          button: true,
        }).then((res)=>{
          if (res) {
            location.reload();
          }
        });
      } else {
        swal ("Error", "No se logro editar el cliente","error");
      }
    });
}

// Cargar los nombres al modal editar
function upload_data(id){

$.ajax({
  url: '../../php/Vendedor/cliente.php',
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