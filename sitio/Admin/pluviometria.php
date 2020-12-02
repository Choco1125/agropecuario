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

<!-- Modal para agregar-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar Registro </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add" method="POST">

            <div class="form-group">
	            <label for="fecha"> Fecha </label>
	            <input name="fecha" type="date" class="form-control" id="fecha">
            </div>

  			<div class="form-group">
	  			<label for="milimetros"> Milímetros </label>
	  			<input name="milimetros" type="number" class="form-control" id="milimetros" placeholder="ingrese la cantidad de lluvia en milímetros">
  			</div>

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add();" class="btn btn-success"> Agregar </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar-->

<!-- Modal para editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Editar Registro </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="edit">
        	<input type="hidden" id='id' name='id'>
        	<div class="form-group">
	            <label for="edit_fecha"> Fecha </label>
	            <input name="fecha" type="date" class="form-control" id="edit_fecha">
            </div>

  			<div class="form-group">
	  			<label for="edit_milimetros"> Milímetros </label>
	  			<input name="milimetros" type="number" class="form-control" id="edit_milimetros" placeholder="ingrese la cantidad de lluvia en milímetros">
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
<!-- Cierre modal para editar -->

<div class="container contenedor">
  <br>
  <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
  <br>

	<br>

  	<h3> Pluviometría - 
<?php 
	include "../../php/conection.php";
	$query = "SELECT nombre FROM finca WHERE id = ".$_SESSION['finca'];
	$sql = mysqli_query($conection, $query);
	if ($sql) {
	  echo mysqli_fetch_array($sql)['nombre'];
	}
?> 
  	</h3>
  	<br>

	<!-- Boton para agregar clientes -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">
		Agregar registro
	</button>

	<!-- Tabla para mostrar la información de clientes -->
	<!-- Tabla para mostrar la información de clientes -->
	<br><br>
	<table class="table" id="tabla">
	<thead>
	<tr>
	  <th scope="col"> Fecha </th>
	  <th scope="col"> Milímetros </th> 
	  <th scope="col"> Ver </th>
	</tr>
	</thead>
		<tbody>
			<?php 
				include "../../php/conection.php";
				$query = "SELECT * FROM pluviometria WHERE finca_id=".$_SESSION['finca'];
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
						?>
						<tr>
							<td> <?php echo $row['fecha'] ?> </td>
							<td> <?php echo $row['milimetros'] ?> </td>
							<td> 
								<a data-toggle="modal" data-target="#editar" onclick="upload_data(<?php echo $row['id']; ?>)" class="btn btn-success">
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
  $('#add').trigger("reset");
}
 
//Agregar 
function add(){
	var data = $('#add').serialize() + "&op=insert";
	$.ajax({
	url: '../../php/Admin/pluviometria.php',
	type: 'POST',
	data: data,
	})
	.done(function(data) {
		if (data == "1") {
			swal({
				title: "Buen trabajo",
				text: "El registro fue agregado correctamente",
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

//Eliminar
function eliminar(id){
      swal({
      title: "Advertencia",
      text: "¿Seguro de querer eliminar este registro?",
      icon: "warning",
      buttons: true,
     }).then((res)=>{
      if(res){
        $.ajax({
          url: '../../php/Admin/pluviometria.php',
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
              text: "Se eliminó correctamente el registro",
              icon: "success",
              button: true,
            }).then((res)=>{
              location.reload();
            });
          	} else {
            	swal("¡Error!",data, "error");
          }
        });
      }
    });
  }

//Editar cliente 
function guardar(){
    var data = $('#edit').serialize() + "&op=edit";
    $.ajax({
      url: '../../php/Admin/pluviometria.php',
      type: 'POST',
      data: data,
    })
    .done(function(data) {
      if (data == "1") {
        swal({
          title: "Buen trabajo",
          text:  "El registro fue editado correctamente",
          icon:  "success",
          button: true,
        }).then((res)=>{
          if (res) {
            location.reload();
          }
        });
      } else {
        swal ("Error", data,"error");
      }
    });
}

// Cargar los nombres al modal editar
function upload_data(id){

	$.ajax({
	  url: '../../php/Admin/pluviometria.php',
	  type: 'POST',
	  dataType: 'json',
	  data: {op: 'read',
	         id: id}
	}).done(function(datos) {
	  $('#id').val(datos['id']);
	  $('#edit_fecha').val(datos['fecha']);
	  $('#edit_milimetros').val(datos['milimetros']);
	});

}
</script>

</html>