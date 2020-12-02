<?php 
  include "main.php";

?>
<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">

<style>
	.select2{
		width: 100% !important;
	}

</style>

<!-- Modal para agregar empleados -->
<div class="modal fade" id="add_empleado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Agregar empleado a esta labor </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="data_empleados" method="POST">
          	<div class="row">
          		<div class="col-12 col-md-9">
          			<div class="form-group">
		          		<label for="empleado">Empleado</label>
		          		<select onchange="change_empleado();" name="empleado" id="empleado" class="from-control">
		          	        <option value="">seleccione un empleado</option>
		          	        <option value="0">Otro</option>
		          	<?php 
						include '../../php/conection.php';
						$query = "SELECT * FROM empleado";
						$sql = mysqli_query($conection,$query);
						if ($sql) {
							while ($row = mysqli_fetch_array($sql)) {
					?>
							<option value="<?php echo $row['id'].'#'.$row['nombre'] ?>"><?php echo $row['identificacion'].' - '.$row['nombre'] ?></option>
					<?php
							}
						}
					 ?>
		          	    </select>
		          	</div>
          		</div>
          		<div class="col-12 col-md-3">
          			<div class="form-group">
          				<label style="visibility: hidden;" for="">aja</label>
          				<button onclick="return empleadoF()" class="btn btn-success text-white">Crear Empleado</button>
          			</div>
          		</div>
          	</div>
          	
          	<div id="aux">
          		
          	</div>

          	<div id="modal_valor" class="form-group">
          		
          	</div>  

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_empleado();" class="btn btn-success"> Agregar </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar empleados -->

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

	<h2 class="text-center">Registro de Labores</h2>
	<form id="data" method="POST" onsubmit="return false;">
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
			<label for="fecha">Fecha</label>
			<input id="fecha" name="fecha" value="<?php 
                  $hoy = getdate();
                  if ($hoy['mon'] < 10){
                    $hoy['mon'] = '0'.$hoy['mon'];
                  }
                  if ($hoy['mday'] < 10){
                    $hoy['mday'] = '0'.$hoy['mday'];
                  }
                  echo $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
               ?>" type="date" class="form-control">
		</div>
		<div class="form-group">
			<label for="labor">Labor</label>
			<select name="labor" id="labor" class="form-control" onchange="labores();">
				<option value="">Seleccione una labor</option>
		<?php 
			$query = "SELECT * FROM labores";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				while ($row = mysqli_fetch_array($sql)) {
		?>
				<option value="<?php echo $row['id'].'-'.$row['recoleccion'] ?>"><?php echo $row['nombre'] ?></option>
		<?php
				}
			}
		 ?>
			</select>
		</div>
		<div id="recoleccion">
			
		</div>
		<div class="form-group">
			<label for="tipo"> Tipo </label>
			<select name="tipo" id="tipo" class="form-control" onchange="cuerpo();">
				<option value="">seleccione el tipo de labor</option>
				<option value="1">Al contrato</option>
				<option value="0">Al día</option>
			</select>
		</div>

		<div id="what_empleado">
						
		</div>

		<hr>
		<h4 class="text-center">Agregar insumos para esta labor</h4>
		<a data-toggle="modal" data-target="#add_insumo" class="btn btn-success text-white">Agregar insumo</a>
		<br><br>
		<table class="table text-center">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th>Unidad</th>
				</tr>
			</thead>
			<tbody id="info_insumos">
			</tbody>
		</table>
		<hr>
	
		<!-- se modifica de acuerdo a el tipo de labor -->
		<div id="cuerpo">
			
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

	//selecciona otro en el select de empleado
	function empleadoF(){
		var empleado = $('#empleado').val('0');
		change_empleado()
		return false;	
	}

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

	var n_empleados = 0;
	var n_insumos = 0;
	var kilos = 0;
	var tipo;
	
	$('#empleado').select2({
	    dropdownParent: $('#add_empleado')
	});
	$('#insumo').select2({
	    dropdownParent: $('#add_insumo')
	});
	$('#labor').select2();

	function limpiar_todo(){
		 location.reload();
	}

	function limpiar(){
		$('#data_empleados').trigger("reset");
		$('#empleado').select2({
			dropdownParent: $('#add_empleado')
		});		
	}

	function limpiar_i(){
		$('#data_insumos').trigger("reset");
		$('#insumo').select2({
			dropdownParent: $('#add_insumo')
		});	
	}

	function cuerpo(){
		var labor = $('#labor');
		if (labor.val() == "") {
			swal('Error!','Primero debe seleccionar la labor','error').then((res) => {
				labor.focus();
			});
			$('#tipo').val('')
			return;
		}
		if (labor.val().split('-')[1] == '1' && $('#valor_kilo').val() == "" ) {
			swal('Error!','Primero debe ingresar el valor por kilo','error').then((res) => {
				$('#valor_kilo').focus();
			});
			$('#tipo').val('')
			return;
		}
		tipo = $('#tipo').val();
		$('#modal_valor').html('');
		if(tipo == 1){//contrato
			$('#what_empleado').html(
				'<hr>'+
				'<h4 class="text-center">Agregar empleados para esta labor</h4>'+
				'<a onclick="recoleccion();" class="btn btn-success text-white">Agregar '+'empleado</a>'+
				'<br><br>'+
				'<table class="table text-center">'+
					'<thead>'+
						'<tr>'+
							'<th>Nombre</th>'+
							'<th>Valor</th>'+
						'</tr>'+
					'</thead>'+
					'<tbody id="info_empleados">'+
					'</tbody>'+
				'</table>'+
				'<hr>');
			if (labor.val().split('-')[1] == "1") {
				$('#modal_valor').append('<label for="kilos">Kilos</label>'+
          		'<input class="form-control" onkeyup="calcular();" name="kilos" id="kilos" type="number">');
			}
			$('#modal_valor').append(
				'<div class="form-group">'+
					'<label for="e_valor">Valor</label>'+
					'<input id="e_valor" name="e_valor" type="number" class="form-control">'+
				'</div>');
		}else if(tipo == 0){//al dia
			$('#what_empleado').html(
				'<hr>'+
				'<h4 class="text-center">Agregar empleados para esta labor</h4>'+
				'<a onclick="recoleccion();" class="btn btn-success text-white">Agregar '+'empleado</a>'+
				'<br><br>'+
				'<table class="table text-center">'+
					'<thead>'+
						'<tr>'+
							'<th>Nombre</th>'+
							'<th>Valor</th>'+
						'</tr>'+
					'</thead>'+
					'<tbody id="info_empleados">'+
					'</tbody>'+
				'</table>'+
				'<hr>');
			$('#cuerpo').html(
				'<div class="form-group">'+
					'<label for="estado">Labor Finalizada</label>'+
					'<select name="estado" id="estado" class="form-control">'+
						'<option value="">seleccione el estado de la labor</option>'+
						'<option value="1">Sí</option>'+
						'<option value="0">No</option>'+
					'</select>'+
				'</div>');
			if (labor.val().split('-')[1] == "1") {
				$('#modal_valor').append('<label for="kilos">Kilos</label>'+
          		'<input class="form-control" onkeyup="calcular();" name="kilos" id="kilos" type="number">');
			}
			$('#modal_valor').append(
				'<label for="e_valor">Valor</label>'+
          		'<input class="form-control" name="e_valor" id="e_valor" type="number">');
		}else{
			$('#what_empleado').html('');
			$('#cuerpo').html('');
			$('#modal_valor').html('');
		}
		$('#datos').html('');
	}

	function change_empleado(){
		if ($('#empleado').val() == 0) {
			$('#aux').html(
				'<div class="form-group">'+
					'<label for="identificacion">Identificación</label>'+
					'<input id="identificacion" name="identificacion" type="number" class="form-control">'+
				'</div>'+
				'<div class="form-group">'+
					'<label for="nombre">Nombre</label>'+
					'<input id="nombre" name="nombre" type="text" class="form-control">'+
				'</div>'+
				'<div class="form-group">'+
					'<label for="apellido">Apellido</label>'+
					'<input id="apellido" name="apellido" type="text" class="form-control">'+
				'</div>');
		}else{
			$('#aux').html('');
		}
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
				'<td>'+$('#unidad').val()+'</td>'+
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

	function add_empleado(){


		if (tipo == 1) {//labores al contrato
			var empleado = $('#empleado').val();
			var identificacion = $('#identificacion').val();
			var name = $('#nombre').val();
			var apellido = $('#apellido').val();
			var valor = $('#e_valor').val();
			var socio = 0;

			if(empleado == ""){
				swal('Error!','Debe de seleccionar un empleado o agregar un nombre','error');
				return;
			}

			if (empleado == 0 && (name == "" || apellido == "" || identificacion == "")) {
				swal('Error!','Debe ingresar todos los datos','error');
				return;
			}
			var v_identificacion;
			var v_name;
			var v_apellido;
			if (empleado != 0) {
				name = empleado.split('#')[1];
				socio = 1;
				v_name = empleado.split('#')[0];
			}else{
				v_name = name;
				v_apellido = apellido;
				v_identificacion = identificacion;
			}


			$('#info_empleados').append(
				'<tr>'+
					'<td>'+name+'</td>'+
					'<td>'+valor+'</td>'+
				'</tr>');

			$('#datos').append(
				'<input value="'+v_identificacion+'" name="e_identificacion'+n_empleados+'" type="hidden"/>'+
				'<input value="'+v_name+'" name="e_nombre'+n_empleados+'" type="hidden"/>'+
				'<input value="'+v_apellido+'" name="e_apellido'+n_empleados+'" type="hidden"/>'+
				'<input value="'+socio+'" name="socio'+n_empleados+'" type="hidden"/>'+
				'<input value="'+valor+'" name="e_valor'+n_empleados+'" type="hidden"/>');
		}else if(tipo == 0){//labores al dia
			var empleado = $('#empleado').val();
			var identificacion = $('#identificacion').val();
			var name = $('#nombre').val();
			var apellido = $('#apellido').val();
			var valor = $('#e_valor').val();
			var socio = 0;
			if(empleado == ""){
				swal('Error!','Debe ingresar todos los datos','error');
				return;
			}

			if (empleado == 0 && (name == "" || apellido == "" || identificacion == "")) {
				swal('Error!','Al seleccionar otro debe ingresar el nombre','error');
				return;
			}

			if (valor == "") {
				swal('Error!','Debe ingresar el valor','error');
				return;
			}

			var v_identificacion;
			var v_name;
			var v_apellido;
			if (empleado != 0) {
				name = empleado.split('#')[1];
				socio = 1;
				v_name = empleado.split('#')[0];
			}else{
				v_name = name;
				v_apellido = apellido;
				v_identificacion = identificacion;
			}


			$('#info_empleados').append(
				'<tr>'+
					'<td>'+name+'</td>'+
					'<td>'+valor+'</td>'+
				'</tr>');

			$('#datos').append(
				'<input value="'+v_identificacion+'" name="e_identificacion'+n_empleados+'" type="hidden"/>'+
				'<input value="'+v_name+'" name="e_nombre'+n_empleados+'" type="hidden"/>'+
				'<input value="'+v_apellido+'" name="e_apellido'+n_empleados+'" type="hidden"/>'+
				'<input value="'+socio+'" name="socio'+n_empleados+'" type="hidden"/>'+			
				'<input value="'+valor+'" name="e_valor'+n_empleados+'" type="hidden"/>');
		}

		if ($('#labor').val().split('-')[1] == '1') {
			kilos = Number(kilos) + Number($('#kilos').val());
			console.log(kilos);
		}

		n_empleados++;

		$('#add_empleado').modal('hide');
		$('#aux').html('');
		limpiar();
	}

	function verificar(){
		var fecha = $('#fecha');
		var labor = $('#labor');
		var tipo = $('#tipo');

		if(fecha.val() == ""){
			swal({
	          title: "Error!",
	          text:  "Debe de ingresar una fecha",
	          icon:  "error",
	          button: true,
	        }).then((res)=>{
	            fecha.focus();
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

		if (n_empleados == 0) {
			swal({
	          title: "Error!",
	          text:  "Debe de ingresar empleados",
	          icon:  "error",
	          button: true,
	        }).then((res)=>{
	            $('#cuerpo').focus();
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
			console.log($('#data').serialize()+'&op=add&kilos='+kilos);
			$.ajax({
				url: '../../php/Admin/labor.php',
				type: 'POST',
				data: $('#data').serialize()+'&op=add&kilos='+kilos,
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

	function labores(){
		var tipo = $('#labor').val().split('-')[1];
		if (tipo == '1') {
			$('#recoleccion').html(
					'<div class="form-group">'+
						'<label for="valor_kilo">Valor por kilo</label>'+
						'<input id="valor_kilo" name="valor_kilo" type="number" class="form-control" />'+
					'</div>');
		}else{
			$('#recoleccion').html('');
		}
	}

	function recoleccion(){
		var tipo = $('#labor');
		if (tipo.val() == "") {
			swal('Error!','Primero debe seleccionar la labor','error').then((res) => {
				tipo.focus();
			});
		}else if(tipo.val().split('-')[1] != '1'){
			$('#add_empleado').modal('show');
		}else{
			var valor = $('#valor_kilo');
			if(valor.val() == ""){
				swal('Error!','Primero debe ingresar el valor por Kilo','error').then((res) => {
					valor.focus();
				});
			}else{
				$('#add_empleado').modal('show');
			}
		}

	}

	function calcular(){
		$('#e_valor').val($('#valor_kilo').val()*$('#kilos').val());
	}

</script>

</html>