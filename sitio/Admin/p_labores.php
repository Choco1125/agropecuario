<?php 
  include "main.php";

?>
<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">

<style>
	.select2{
		width: 100% !important;
	}

</style>

<!-- Modal para agregar insumos -->
<div class="modal fade" id="add_insumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Agregar insumo a esta labor </h5>
        <button type="button" onclick="limpiar_i();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="data_insumos" method="POST">
          	<div class="row">
          		<div class="col-12 col-md-6">
          			<div class="form-group">
		          		<label for="insumo">Insumo</label>
		          		<select name="insumo" id="insumo" class="from-control" onchange="unidadF()">
		          	        <option value="">seleccione un insumo</option>
		          	<?php 
		          		include '../../php/conection.php';
						$query = "SELECT b.id,b.cantidad,i.nombre,i.unidad FROM insumo AS i INNER JOIN bodega as b WHERE b.insumo_id = i.id AND b.finca_id = '".$_SESSION['finca']."'";
						$sql = mysqli_query($conection,$query);
						if ($sql) {
							while ($row = mysqli_fetch_array($sql)) {
					?>
							<option value="<?php echo $row['id'].'#'.$row['nombre'] ?>"><?php echo $row['nombre'] ?></option>
					<?php
							}
						}
					 ?>
		          	    </select>
		          	</div>
          		</div>
          		<div class="col-12 col-md-3">
          			<div class="form-group">
          				<label for="existencia">Existencia</label>
          				<input id="existencia" type="text" class="form-control" readonly>
          			</div>
          		</div>
          		<div class="col-12 col-md-3">
          			<div class="form-group">
          				<label for="unidad">Unidad</label>
          				<input id="unidad" type="text" class="form-control" readonly>
          			</div>
          		</div>
          	</div>

          	<div class="form-group">
          		<label for="i_cantidad">cantidad</label>
          		<input class="form-control" name="i_cantidad" id="i_cantidad" type="number">
          	</div>

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" onclick="limpiar_i();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_insumo();" class="btn btn-success"> Agregar </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar insumos -->


<div class="container">
	<br>
	<a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
	<br>
	<br>
	<form id="data" method="POST">
		<div class="form-group">
			<label for="lote">Seleccione un lote</label>
			<select class="form-control" name="lote" id="lote">
				<option value="">Seleccione un lote</option>
				<?php 
					$query = "SELECT l.id,l.nombre,c.nombre AS 'cultivo' FROM lote AS l INNER JOIN cultivo AS c WHERE l.cultivo_id = c.id AND l.id_finca=".$_SESSION['finca'];
					$sql = mysqli_query($conection,$query);
					if ($sql) {
						while ($row = mysqli_fetch_array($sql)) {
				?>
						<option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'].' - '.$row['cultivo'] ?></option>
				<?php
						}
					}
				 ?>
			</select>
		</div>
		<div class="form-group">
			<label for="semana">Semana</label>
			<input id="semana" name="semana" type="week" class="form-control">
		</div>
		<div class="form-group">
			<label for="labor">Labor</label>
			<select name="labor" id="labor" class="form-control">
				<option value="">Seleccione una labor</option>
		<?php 
			$query = "SELECT * FROM labores";
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
		<div class="form-group">
			<label for="tipo"> Tipo </label>
			<select name="tipo" id="tipo" class="form-control">
				<option value="">seleccione el tipo de labor</option>
				<option value="1">Al contrato</option>
				<option value="0">Al día</option>
			</select>
		</div>
		<hr>
		<h4 class="text-center">Agregar insumos para esta labor</h4>
		<a data-toggle="modal" data-target="#add_insumo" class="btn btn-success">Agregar insumo</a>
		<br><br>
		<table class="table text-center">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody id="info_insumos">
			</tbody>
		</table>
		<hr>
	
		<div class="form-gorup">
			<label for="empleados">Número de Empelados</label>
			<input class="form-control" name="empleados" id="empleados" min="1" type="number">
		</div>

		<div class="form-gorup">
			<label for="valor">Valor</label>
			<input class="form-control" name="valor" id="valor" min="1000" type="number">
		</div>

		<div class="form-group">
			<label for="observacion">Observaciones</label>
			<textarea class="form-control" name="observacion" id="observacion" cols="30" rows="8"></textarea>
		</div>

		<div id="datos">
			
		</div>

		<div class="form-group text-center">
			<input onclick="limpiar_todo();" class="btn btn-secondary" value="Limpiar" type="button">
			<input onclick="return registrar()" class="btn btn-success" value="Registrar Labor" type="button">		
		</div>

	</form>
</div>

</body>

<?php
include "end.php";
?>

<script src="../../js/select2.min.js"></script>

<script>

	//consultar unidad y existencia
	function unidadF(){
		var id = $('#insumo').val().split('#')[0];
		$.ajax({
			url: '../../php/Admin/labor.php',
			type: 'POST',
			dataType: 'json',
			data: {op: 'unidad',id:id},
		})
		.done(function(data) {
			$('#existencia').val(data.cantidad);
			$('#unidad').val(data.unidad);
		});		
	}

	var n_insumos = 0;
	var tipo;

	$('#insumo').select2({
	    dropdownParent: $('#add_insumo')
	});
	$('#labor').select2();

	function limpiar_todo(){
		 // $('#data').trigger("reset");
		 // $('#tipo').val('');
		 // n_empleados = 0;
		 // n_insumos = 0;
		 // cuerpo();
		 // $('#info_insumos').html('');
		 location.reload();
	}

	function limpiar_i(){
		$('#data_insumos').trigger("reset");
		$('#insumo').select2({
			dropdownParent: $('#add_insumo')
		});	
	}

	function add_insumo(){
		
		var insumo = $('#insumo');
		var cantidad = $('#i_cantidad');
		if(insumo.val() == ""){
			swal('Error!','Debe de seleccionar un insumo','error');
			return;
		}

		if (cantidad.val() == "") {
			swal('Error!','Debe ingresar la cantidad','error');
			return;
		}

		var n_insumo = insumo.val().split('#')[1];
		var id_insumo = insumo.val().split('#')[0];


		$('#info_insumos').append(
			'<tr>'+
				'<td>'+n_insumo+'</td>'+
				'<td>'+cantidad.val()+'</td>'+
			'</tr>');

		$('#datos').append(
			'<input value="'+id_insumo+'" name="id_insumo'+n_insumos+'" type="hidden"/>'+
			'<input value="'+cantidad.val()+'" name="i_cantidad'+n_insumos+'" type="hidden"/>');

		n_insumos++;

		var aux = $('#insumo option[value="'+insumo.val()+'"]');
		var total = aux.html().split('-')[0]-cantidad.val();
		var nombre = aux.html().split('-')[1];
		aux.text(total +' - '+ nombre);

		$('#add_insumo').modal('hide');
		limpiar_i();
	}

	function verificar(){
		var lote = $('#lote');
		var semana = $('#semana');
		var labor = $('#labor');
		var tipo = $('#tipo');

		if(lote.val() == ""){
			swal({
	          title: "Error!",
	          text:  "Debe de seleccionar un lote",
	          icon:  "error",
	          button: true,
	        }).then((res)=>{
	            lote.focus();
	        });
	        return false;
		}

		if(semana.val() == ""){
			swal({
	          title: "Error!",
	          text:  "Debe de ingresar una semana",
	          icon:  "error",
	          button: true,
	        }).then((res)=>{
	            semana.focus();
	        });
	        return false;
		}

		if(labor.val() == ""){
			swal({
	          title: "Error!",
	          text:  "Debe de seleccionar una labor",
	          icon:  "error",
	          button: true,
	        }).then((res)=>{
	            labor.focus();
	        });
	        return false;
		}

		if(tipo.val() == ""){
			swal({
	          title: "Error!",
	          text:  "Debe de seleccionar un tipo",
	          icon:  "error",
	          button: true,
	        }).then((res)=>{
	            tipo.focus();
	        });
	        return false;
		}

		if(tipo.val() == 1){//al contrato
			var valor = $('#valor');
			if(valor.val() == ""){
				swal({
		          title: "Error!",
		          text:  "Debe de ingresar un valor",
		          icon:  "error",
		          button: true,
		        }).then((res)=>{
		            valor.focus();
		        });
		        return false;
			}
		}else if(tipo.val() == 2){//al dia
			var estado = $('#estado');
			if(estado.val() == ""){
				swal({
		          title: "Error!",
		          text:  "Debe de seleccionar un estado",
		          icon:  "error",
		          button: true,
		        }).then((res)=>{
		            estado.focus();
		        });
		        return false;
			}
		}
		return true;
	}

	function registrar(){
		if (verificar()) {
			var dato = $('#semana').val().split('-W');
			var year = dato[0];
			var week = dato[1];
			var anio = new Date(year,0,1);
			var primerdia = anio.getDay();
			var correccion = -anio.getDay() + 1;

			if(primerdia > 4){
				week++;
			}
			var inicio = new Date(year ,0 ,(week-1) * 7 + correccion);
			var a = ''+inicio;
			fecha = (inicio.getYear()+1900)+'-'+(inicio.getMonth()+1)+'-'+a.split(' ')[2];

			$.ajax({
				url: '../../php/Admin/labor.php',
				type: 'POST',
				data: $('#data').serialize()+'&op=presupuestar&fecha='+fecha,
			})
			.done(function(data) {
				if(data == "1"){
					swal({
				          title: "Buen Trabajo!",
				          text:  "Se registro la labor correctamente",
				          icon:  "success",
				          button: true,
			        }).then((res)=>{
			          location.reload();
			        });
				}else{
					swal('Error!',data,'error');
				}
			});
			
		}
		return false;
	}

</script>

</html>