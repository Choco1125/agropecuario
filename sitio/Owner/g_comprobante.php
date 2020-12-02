<?php 
	if (!isset($_GET['employee'])) {
		header('location: index.php');
	}
  	include "main.php";
?>
	<style>
		.logo{
			width: 70%;
		}
	</style>
	<br>
	<h3 class="text-center"> Generar Comporbante -  
  <?php 
  	$nombre;
  	$apellido;
  	$identificacion;
    include "../../php/conection.php";
    $query = "SELECT nombre,apellidos,identificacion FROM empleado WHERE id = ".$_GET['employee'];
    $sql = mysqli_query($conection, $query);
    if ($sql) {
    	$aux = mysqli_fetch_array($sql);
      	$nombre = $aux['nombre'];
      	$apellido = $aux['apellidos'];
      	$identificacion = $aux['identificacion'];
      	echo $nombre;
    }
  ?> 
	</h3>
	<br>

	<div class="container">
		<br><br>
		<div class="row align-items-end">
			<div class="col-4">
				<label for="fecha_inicio">Seleccione la fecha inicial para el reporte</label>
				<input name="fecha_inicio" id="fecha_inicio" class="form-control" type="date">
			</div>
			<div class="col-4">
				<label for="fecha_fin">Seleccione la fecha final para el reporte</label>
				<input name="fecha_fin" id="fecha_fin" class="form-control" type="date">
			</div>
			<div class="col-4 text-center">
				<input onclick="generar();" class="btn btn-success" type="button" value="Generar">
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<hr>

	<div id="reporte" class="container">
		<form id="data">
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
					<input name="fecha" id="fecha" class="text-center form-control" value="<?php echo date('Y-m-d');  ?>" type="date" readonly>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-2">
					<label for="">Nombre y apellidos: </label>
				</div>
				<div class="col-10">
					<input name="nombre" class="text-center form-control" value="<?php echo $nombre.' '.$apellido ?>" type="text" readonly>
				</div>
				<br><br>
				<div class="col-2">
					<label for="">Cédula o Nit: </label>
				</div>
				<div class="col-10">
					<input name="identificacion" class="text-center form-control" value="<?php echo $identificacion ?>" type="text" readonly>
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
			<div class="row">
				<div class="col-3">
					<label for="">Retención en la fuente practicada: </label>
				</div>
				<div class="col-6">
					<input class="text-center form-control" type="text" disabled>
				</div>
				<div class="col-3">
					<input class="text-center form-control" type="text" disabled>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-3">
					<label for="">Firma beneficiario de pago: </label>
				</div>
				<div class="col-9">
					<input class="text-center form-control" type="text" disabled>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-4 text-center">
					<input type="text" class="form-control" disabled>
					<label for="">Contabilizó</label>
				</div>
				<div class="col-4 text-center">
					<input type="text" class="form-control" disabled>
					<label for="">Revisó</label>
				</div>
				<div class="col-4 text-center">
					<input type="text" class="form-control" disabled>
					<label for="">Aprovó</label>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-12 text-center">
					<input onclick="registrar();" class="btn btn-success" value="Registrar y Generar factura" type="button">
				</div>
			</div>
			<br><br>			
		</form>
	</div>


</body>

<?php
include "end.php";
?>
<script>
	var employee = <?php echo $_GET['employee'] ?>;
	
	function generar(){
		var inicio = $('#fecha_inicio').val();
		var fin = $('#fecha_fin').val();

		if (inicio == "") {
			swal('Error!','Debe de seleccionar la fecha de inicio para generar el registro','error');
			return;
		}

		if (fin == "") {
			swal('Error!','Debe de seleccionar la fecha final para generar el registro','error');
			return;
		}
		
		$.ajax({
			url: '../../php/Owner/comprobante.php',
			type: 'POST',
			dataType:'json',
			data: {
				fecha_inicio: inicio,
				fecha_fin:fin,
				employee:employee,
				op:'generar'
			},
		})
		.done(function(data) {
			console.log(data);
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
		}).fail(function(data){
			console.log(data);
		});		
	}

	function registrar(){
		var concepto = $('#concepto');
		var valor = $('#valor');

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
			url: '../../php/Owner/comprobante.php',
			type: 'POST',
			data: $('#data').serialize()+'&op=add',
		})
		.done(function(data) {
			if (data == "1") {
	  			swal({
	  				title: "Buen trabajo",
	  				text: "Comprobante guardado Correctamente!",
	  				icon: "success",
	  				button: true,
	  			}).then((res)=>{
	  				alert('la factura en pdf aún esta en desarrolo')
	  				location.reload();
	  			});
	  		}else{
	  			swal("Error", data,"error");
	  		}
		});
	}

</script>

</html>