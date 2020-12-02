<?php 
  include "main.php";
?>

<style>
	.esconder{
		visibility: hidden;
	}

	#grafica{
		height: 500px !important;
		width: 500px !important;
	}
	.derecha{
		float: right;
	}
</style>
	<br>
	<h3 class="text-center"> Registro de Pluviometría -  
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
		<br>
		<div class="row justify-content-center text-center">
			<div id="datos" class="col-12 col-md-4">
				
			</div>
			<div class="col-12 col-md-8" id="grafica">
				<canvas id="densityChart" width="600" height="400"></canvas>		
			</div>			
		</div>
	</div>

</body>

<?php
include "end.php";
?>
<script src="../../js/Chart.js"></script>
<script>
	
	var densityCanvas = document.getElementById("densityChart");
	Chart.defaults.global.defaultFontSize = 16;

	

	function generar(){
		$('#grafica').html('<canvas id="densityChart" width="600" height="400"></canvas>');
		$('#datos').html('');
		var densityCanvas = document.getElementById("densityChart");
		var valores = new Array();
		var colores = new Array();
		var fechas = new Array();

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
			url: '../../php/Owner/pluviometria.php',
			type: 'POST',
			dataType:'json',
			data: {fecha_inicio: inicio,fecha_fin:fin},
		})
		.done(function(data) {
			for (var i = 0; i < data.length; i++) {
				valores.push(data[i].milimetros);
				fechas.push(data[i].fecha);
				$('#datos').append('<label for="">'+data[i].fecha+'</label><label class="derecha">'+data[i].milimetros+'</label><br/>')
			}
			var densityData = {
			  label: 'Cantidad de lluvia (milimetros/m2)',
			  data: valores,
			  fill:false,
			  borderColor:'orange',
			  backgroundColor:'orange',
			  pointBorderColor:'green',
			  pointBackgroundColor:'green',
			  pointRadius: 5,
			  pointHoverRadius: 10,
			};

			var barChart = new Chart(densityCanvas, {
			  type: 'line',
			  data: {
			    labels: fechas,
			    datasets: [densityData]
			  }
			});
		});
		
		//se hace una ajax y se pide la informacion
		//para mostrarla con chart.js
	}

</script>

</html>