<?php 
	if (!isset($_GET['rubro'])) {
		header('location: index.php');
	}
	$rubro = "";
	$tabla = "";
	switch ($_GET['rubro']) {
		case '1':
			$rubro = "Rubros gastos administrativos";
			$tabla = "rubro_administrativo";
			break;
		case '2':
			$rubro = "Rubros gastos financieros";			
			$tabla = "rubro_financiero";
			break;
		case '3':
			$rubro = "Rubros otros gastos";			
			$tabla = "rubros_otros";
			break;
		case '4':
			$rubro = "Rubros beneficios post-cosecha";			
			$tabla = "rubros_post";
			break;
	}
	include 'main.php';
 ?>

<link rel="stylesheet" href="../../css/datatables.min.css">
<style>
	th,td{
		text-align: center;
	}
</style>


 <!-- Modal agregar rubro-->
<div class="modal fade" id="add_rubro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <?php echo $rubro ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="contenido">
		<div class="form-group">
			<label for="nombre">Nombre del Rubro</label>
			<input class="form-control" id="nombre" name="nombre" type="text">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-success" onclick="add();"> Agregar </button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal agregar rubro -->


 <!-- Modal Editar rubro-->
<div class="modal fade" id="edit_rubro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <?php echo $rubro ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="contenido">
		<div class="form-group">
			<input id="id" name="id" type="hidden">
			<label for="edit_nombre">Nombre del Rubro</label>
			<input class="form-control" id="edit_nombre" name="edit_nombre" type="text">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
        <button type="button" class="btn btn-success" onclick="save();"> Guardar </button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal Editar rubro -->

	<script>var rubro=<?php echo $_GET['rubro'] ?>;</script>
	<div class="container">
		<br><br>
		<h2><?php echo $rubro ?></h2>
		<a data-toggle="modal" data-target="#add_rubro" class="btn btn-success" href="#">Agregar <?php echo $rubro ?></a>
		<br><br>
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				include "../../php/conection.php";
				$query = "SELECT * FROM ".$tabla;
				$sql = mysqli_query($conection,$query);
				if($sql){
					while ($row = mysqli_fetch_array($sql)) {
				?>
				<tr>
					<td><?php echo $row['nombre'] ?></td>
					<td>
						<a data-toggle="modal" href="#" data-target="#edit_rubro" onclick="read(<?php echo $row['id']; ?>)" class="btn btn-success"> 
			  				<i class="far fa-edit"> </i>  
			  			</a> 

			  			<a href="#" onclick="eliminar(<?php  echo $row['id'] ?>)" class="btn btn-secondary"> 
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
	include 'end.php';
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

 		
 		function add(){
 			var nombre = $('#nombre');
 			if(nombre.val() == ""){
 				swal('Error!','Debe ingresar un Nombre para el rubro','error');
 				return;
 			}

 			$.ajax({
 				url: '../../php/Owner/rubro.php',
 				type: 'POST',
 				data: {nombre: nombre.val(),rubro:rubro,op:'add'},
 			})
 			.done(function(data) {
 				if (data == "1") {
	 				swal({
						title: "Buen trabajo",
						text: "El rubro fue agregado correctamente.",
						icon: "success",
						button: true,
					}).then((res)=>{
						if(res){
							location.reload();
						}
					});
	 			}else{
	 				swal("Error", data,"error");
	 			}
 			});
 		}

 		function eliminar(id){
 			swal({
				title: "Advertencia",
				text: "¿Seguro de Querer eliminar este rubro?",
				icon: "warning",
				button: true,
				}).then((res)=>{
					if(res){
						$.ajax({
							url: '../../php/Owner/rubro.php',
			 				type: 'POST',
			 				data: {id: id,rubro:rubro,op:'delete'},
						})
						.done(function(data) {
							if (data == "1") {
				 				swal({
									title: "Buen trabajo",
									text: "El rubro fue eliminado correctamente.",
									icon: "success",
									button: true,
								}).then((res)=>{
									if(res){
										location.reload();
									}
								});
				 			}else{
				 				swal("Error", data,"error");
				 			}
						});
						
					}
				});
 		}


 		function read(id){
 			$.ajax({
				url: '../../php/Owner/rubro.php',
 				type: 'POST',
 				dataType: 'json',
 				data: {id: id,rubro:rubro,op:'read'},
			})
			.done(function(data) {
				$('#id').val(id);
				$('#edit_nombre').val(data.nombre);
			});
 		}

 		function save(){
 			var nombre = $('#edit_nombre');
 			var id = $('#id').val();
 			if(nombre.val() == ""){
 				swal('Error!','Debe ingresar un Nombre para el rubro','error');
 				return;
 			}

 			$.ajax({
 				url: '../../php/Owner/rubro.php',
 				type: 'POST',
 				data: {nombre: nombre.val(),rubro:rubro,op:'edit',id:id},
 			})
 			.done(function(data) {
 				if (data == "1") {
	 				swal({
						title: "Buen trabajo",
						text: "El rubro fue editado correctamente.",
						icon: "success",
						button: true,
					}).then((res)=>{
						if(res){
							location.reload();
						}
					});
	 			}else{
	 				swal("Error", data,"error");
	 			}
 			});
 		}

 </script>
 </html>