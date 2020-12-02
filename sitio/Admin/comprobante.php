<?php 
  include "main.php";
?>

<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">
<link rel="stylesheet" href="../../css/datatables.min.css">
<style>
	.select2{
		width: 100% !important;
	}
	
	.logo{
		width: 70%;
	}
</style>

<!-- Modal para agregar -->
<div style="overflow-y: scroll;" class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar Comprobante </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add">
			<div class="row">
				<div class="col-10">
					<h5>DOCUMENTO EQUIVALENTE PARA PERSONAS NATURALES NO OBLIGADAS A EXPEDIR FACTURA</h5>
				</div>
				<div class="col-2">
					<input class="form-control text-right" name="n_factura" type="text" value="<?php 
						//consultar finca y sociedad
						$query = "SELECT nombre,id_sociedad FROM finca WHERE id = ".$_SESSION['finca'];
						$finca;
						$sociedad;
					    $sql = mysqli_query($conection, $query);
					    if ($sql) {
					    	$aux = mysqli_fetch_array($sql);
				      		$finca = $aux['nombre'];
				      		$sociedad = $aux['id_sociedad'];
				      		$query = "SELECT * FROM sociedad WHERE id = '$sociedad'";
					    	$sql = mysqli_query($conection, $query);
					    	if($sql){
					    		$sociedad = mysqli_fetch_array($sql);
					    	}
					    }
						//generar consecutivo
						$query = "SELECT n_factura FROM comprobante WHERE sociedad_id='".$sociedad['id']."' ORDER BY n_factura DESC LIMIT 0,1";
						$sql = mysqli_query($conection,$query);
						if($sql){
							$num = mysqli_num_rows($sql);
							if($num > 0){
								$num = mysqli_fetch_array($sql)['n_factura']+1;
								if($num < 10){//un solo digito
									$num = "0000".$num;
								}elseif($num < 100){
									$num = "000".$num;
								}elseif($num < 1000){
									$num = "00".$num;
								}elseif($num < 10000){
									$num = "0".$num;
								}
								echo $num;
							}else{
								echo '00001';
							}
						}else{
							echo "asd";
						}
					 ?>" readonly>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-4 text-center">
					<h6><?php echo $sociedad['nombre'] ?></h6>
					<P><?php echo $sociedad['nit'] ?></P>
					<P>Cra. 23 A No. 74 - 71</P>
					<P>Edificio Andi Of: 503</P>
				</div>
				<div class="col-4 text-center">
					<h4 class="text-center">
	<?php 
	    echo $finca;
	?> 
					</h4>
					<img class="logo" src="<?php echo $sociedad['logo'] ?>">
				</div>
				<div class="col-4 text-center">
					<label for="fecha">Fecha factura</label>
					<input name="fecha" id="fecha" class="text-center form-control" value="<?php echo date('Y-m-d');  ?>" type="date">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<label for="nombre">Nombre y apellidos: </label>
				</div>
				<div class="col-10">
					<input id="nombre" name="nombre" class="text-center form-control" type="text">
				</div>
				<br><br>
				<div class="col-2">
					<label for="identificacion">Cédula o Nit: </label>
				</div>
				<div class="col-10">
					<input name="identificacion" id="identificacion" class="text-center form-control" type="text">
				</div>
				<br><br>
				<div class="col-2">
					<label for="">Dirección: </label>
				</div>
				<div class="col-4">
					<input name="direccion" class="text-center form-control" type="text">
				</div>
				<div class="col-2 text-right">
					<label for="">Teléfono: </label>
				</div>
				<div class="col-4">
					<input name="telefono" class="text-center form-control" type="text">
				</div>
			</div>
			<br>
			<div class="row">
				<label for="concepto">Descripción del bien o servicio prestado: </label>
				<textarea class="form-control" name="concepto" id="concepto" cols="30" rows="5"></textarea>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<label for="">Valor en letras: </label>
				</div>
				<div class="col-7">
					<input id="valor_letras" name="valor_letras" class="text-center form-control" type="text">
				</div>
				<div class="col-3">
					<input id="valor" name="valor" class="text-center form-control" type="text">
				</div>
			</div>
			<br>		
		</form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add();" class="btn btn-success"> Agregar </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre modal para agregar -->


<!-- Modal para Mostrar -->
<div class="modal fade" id="mostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Mostrar Comprobante </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="mostrar">
			<div class="row">
				<div class="col-10">
					<h5>DOCUMENTO EQUIVALENTE PARA PERSONAS NATURALES NO OBLIGADAS A EXPEDIR FACTURA</h5>
				</div>
				<div class="col-2">
					<input class="form-control text-right" name="n_factura" type="text" value="<?php 
						//consultar finca y sociedad
						$query = "SELECT nombre,id_sociedad FROM finca WHERE id = ".$_SESSION['finca'];
						$finca;
						$sociedad;
					    $sql = mysqli_query($conection, $query);
					    if ($sql) {
					    	$aux = mysqli_fetch_array($sql);
				      		$finca = $aux['nombre'];
				      		$sociedad = $aux['id_sociedad'];
				      		$query = "SELECT * FROM sociedad WHERE id = '$sociedad'";
					    	$sql = mysqli_query($conection, $query);
					    	if($sql){
					    		$sociedad = mysqli_fetch_array($sql);
					    	}
					    }
						//generar consecutivo
						$query = "SELECT n_factura FROM comprobante WHERE sociedad_id='".$sociedad['id']."' ORDER BY n_factura DESC LIMIT 0,1";
						$sql = mysqli_query($conection,$query);
						if($sql){
							$num = mysqli_num_rows($sql);
							if($num > 0){
								$num = mysqli_fetch_array($sql)['n_factura']+1;
								if($num < 10){//un solo digito
									$num = "0000".$num;
								}elseif($num < 100){
									$num = "000".$num;
								}elseif($num < 1000){
									$num = "00".$num;
								}elseif($num < 10000){
									$num = "0".$num;
								}
								echo $num;
							}else{
								echo '00001';
							}
						}else{
							echo "asd";
						}
					 ?>" readonly>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-4 text-center">
					<h6><?php echo $sociedad['nombre'] ?></h6>
					<P><?php echo $sociedad['nit'] ?></P>
					<P>Cra. 23 A No. 74 - 71</P>
					<P>Edificio Andi Of: 503</P>
				</div>
				<div class="col-4 text-center">
					<h4 class="text-center">
	<?php 
	    echo $finca;
	?> 
					</h4>
					<img class="logo" src="<?php echo $sociedad['logo'] ?>">
				</div>
				<div class="col-4 text-center">
					<label for="fecha">Fecha factura</label>
					<input id="mostrar_fecha" class="text-center form-control" value="" type="date" readonly>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<label for="nombre">Nombre y apellidos: </label>
				</div>
				<div class="col-10">
					<input id="mostrar_nombre" class="text-center form-control" type="text" readonly>
				</div>
				<br><br>
				<div class="col-2">
					<label for="identificacion">Cédula o Nit: </label>
				</div>
				<div class="col-10">
					<input id="mostrar_identificacion" class="text-center form-control" type="text" readonly>
				</div>
				<br><br>
				<div class="col-2">
					<label for="">Dirección: </label>
				</div>
				<div class="col-4">
					<input id="mostrar_direccion" class="text-center form-control" type="text" readonly>
				</div>
				<div class="col-2 text-right">
					<label for="">Teléfono: </label>
				</div>
				<div class="col-4">
					<input id="mostrar_telefono" class="text-center form-control" type="text" readonly>
				</div>
			</div>
			<br>
			<div class="row">
				<label for="mostrar_concepto">Descripción del bien o servicio prestado: </label>
				<textarea class="form-control" id="mostrar_concepto" cols="30" rows="5" readonly></textarea>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<label for="">Valor en letras: </label>
				</div>
				<div class="col-7">
					<input id="mostrar_valor_letras" class="text-center form-control" type="text" readonly>
				</div>
				<div class="col-3">
					<input id="mostrar_valor" class="text-center form-control" type="text" readonly>
				</div>
			</div>
			<br>		
		</form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="pdf();" class="btn btn-success"> Exportar Pdf </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre modal para mostrar -->

<!-- Modal para generar comprobante -->
<div class="modal fade" id="generar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Generar reporte </h5>
        <button onclick="limpiar_g();" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="data_generar">
        	<div class="row">
			<div class="col-4">
				<label for="fecha_inicio">Seleccione la fecha inicial </label>
				<input name="fecha_inicio" id="fecha_inicio" class="form-control" type="date">
			</div>
			<div class="col-4">
				<label for="fecha_fin">Seleccione la fecha final </label>
				<input name="fecha_fin" id="fecha_fin" class="form-control" type="date">
			</div>
			<div class="col-4">
				<label for="empleado">Empleado</label>
          		<select name="empleado" id="empleado" class="from-control">
          	        <option value="">seleccione un empleado</option>
          	<?php 
				$query = "SELECT * FROM empleado";
				$sql = mysqli_query($conection,$query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
			?>
					<option value="<?php echo $row['id'] ?>"><?php echo $row['identificacion'].' - '.$row['nombre'] ?></option>
			<?php
					}
				}
			 ?>
          	    </select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-12 text-center">
				<input onclick="generar();" class="btn btn-success" type="button" value="Generar">
			</div>			
		</div>
      	</form>

      </div>
        <div class="modal-footer">
          <button type="button" onclick="limpiar_g();" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre modal para generar comprobante -->


	
	<div class="container">
		<br>
		<a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
		<br>

		<br>
		<h3> Comprobantes - 
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
		<a class="btn btn-secondary" data-toggle="modal" data-target="#agregar" href="#"> Agregar Comprobante </a>
		<a class="btn btn-success" data-toggle="modal" data-target="#generar" href="#"> Generar Comprobante </a>
		<br><br>
		<!-- Tabla de Comprobantes -->
		<table class="table" id="tabla">
		  <thead>
		    <tr>
		      <th scope="col"> No Factura </th>
		      <th scope="col"> Fecha </th>
		      <th scope="col"> Identificación </th>
		      <th scope="col"> Nombre </th>
		      <th scope="col"> Concepto </th>
		      <th scope="col"> Valor </th>
		      <th scope="col"> Acciones </th>
		    </tr>
		  </thead>
		  <tbody>

		<?php 
			//lsitar los registros
			include '../../php/conection.php';
			$query = "SELECT * FROM comprobante WHERE finca_id=".$_SESSION['finca'];
			$sql = mysqli_query($conection, $query);
		  	if ($sql) {
		    	while ($row = mysqli_fetch_array($sql)) {
		?>
					  <tr>
					    <td> <?php echo $row['n_factura'] ?></td>
					    <td> <?php echo $row['fecha'] ?></td>
					    <td> <?php echo $row['identificacion'] ?></td>
					    <td> <?php echo $row['nombre'] ?></td>
					    <td> <?php echo $row['concepto'] ?></td>
					    <td> <?php echo $row['valor'] ?></td>
					    <td>
					    	<a onclick="read(<?php echo $row['id'] ?>);" data-toggle="modal" data-target="#mostrar" class="btn btn-success" href=""><i class="fas fa-search"></i></a>
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
</body>

<?php
include "end.php";
?>
<script src="../../js/select2.min.js"></script>
<script src="../../js/datatables.min.js">  </script>
<script>

	$('#empleado').select2({
	    dropdownParent: $('#generar')
	});

	function generar(){
		var inicio = $('#fecha_inicio').val();
		var fin = $('#fecha_fin').val();
		var empleado = $('#empleado').val();

		if (inicio == "") {
			swal('Error!','Debe de seleccionar la fecha de inicio para generar el registro','error');
			return;
		}

		if (fin == "") {
			swal('Error!','Debe de seleccionar la fecha final para generar el registro','error');
			return;
		}

		if (empleado == "") {
			swal('Error!','Debe de seleccionar un empleado para generar el reporte','error');
			return;
		}
		
		$.ajax({
			url: '../../php/Admin/lotes.php',
			type: 'POST',
			dataType:'json',
			data: {
				fecha_inicio: inicio,
				fecha_fin:fin,
				employee:empleado,
				op:'generar'
			},
		})
		.done(function(data) {
			$('#concepto').text('');
			$('#valor').val('');
			for (var i = 0; i < data.labores.length; i++) {
				if (i > 0) {
					if (data.labores[i] != data.labores[i-1]) {
						$('#concepto').text($('#concepto').text()+','+data.labores[i]);
					}
				}else{
					$('#concepto').text($('#concepto').text()+data.labores[i]);		
				}
			}
			$('#valor').val(data.valor);
			$('#identificacion').val(data.identificacion);
			$('#nombre').val(data.nombre + ' ' + data.apellido);
			$('#generar').modal('hide');
			limpiar_g();
			$('#agregar').modal('show');
		});		
	}

	function limpiar_g(){
		$('#data_generar').trigger('reset');
	}

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

	function limpiar(){
		$('#add').trigger("reset");
	}

	function add(){
		var fecha = $('#fecha');
		var nombre = $('#nombre');
		var identificacion = $('#identificacion');
		var concepto = $('#concepto');
		var valor = $('#valor');
		if (fecha.val() == "") {
			swal({
  				title: "Error!",
  				text: "Debe seleccionar una fecha",
  				icon: "error",
  				button: true,
  			}).then((res)=>{
  				fecha.focus();
  			});
  			return;
		}

		if (nombre.val() == "") {
			swal({
  				title: "Error!",
  				text: "Debe de ingresar un nombre",
  				icon: "error",
  				button: true,
  			}).then((res)=>{
  				nombre.focus();
  			});
  			return;
		}

		if (identificacion.val() == "") {
			swal({
  				title: "Error!",
  				text: "Debe de escribir una identificación",
  				icon: "error",
  				button: true,
  			}).then((res)=>{
  				identificacion.focus();
  			});
  			return;
		}

		if (concepto.val() == "") {
			swal({
  				title: "Error!",
  				text: "Debe de escribir los servicios prestados",
  				icon: "error",
  				button: true,
  			}).then((res)=>{
  				concepto.focus();
  			});
  			return;
		}

		if (valor.val() == "") {
			swal({
  				title: "Error!",
  				text: "Debe de escribir el valor de la factura",
  				icon: "error",
  				button: true,
  			}).then((res)=>{
  				valor.focus();
  			});
  			return;
		}

		$.ajax({
			url: '../../php/Admin/comprobante.php',
			type: 'POST',
			data: $('#add').serialize()+'&op=add',
		})
		.done(function(data) {
			if (data == "1") {
	  			swal({
	  				title: "Buen trabajo",
	  				text: "Comprobante guardado Correctamente!",
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

	function read(id){
		$.ajax({
			url: '../../php/Admin/comprobante.php',
			type: 'POST',
			dataType: 'json',
			data: {op:'read',id: id},
		})
		.done(function(data) {
			$('#mostrar_n_factura').val(data.n_factura);
			$('#mostrar_fecha').val(data.fecha);
			$('#mostrar_nombre').val(data.nombre);
			$('#mostrar_identificacion').val(data.identificacion);
			$('#mostrar_direccion').val(data.direccion);
			$('#mostrar_telefono').val(data.telefono);
			$('#mostrar_concepto').val(data.concepto);
			$('#mostrar_valor_letras').val(data.valor_letras);
			$('#mostrar_valor').val(data.valor);
		})
		.fail(function(data) {
			console.log(data);
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}

	function pdf(){
		alert('aun no se ha desarrollado');
	}

</script>


</html>