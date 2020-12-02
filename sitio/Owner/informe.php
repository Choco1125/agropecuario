<?php 
  include "main.php";
?>

<style>

</style>

<div class="container">
	<h2 class="text-center"> Informe - 
<?php 
    include "../../php/conection.php";
    $query = "SELECT nombre FROM finca WHERE id = ".$_SESSION['finca'];
    $sql = mysqli_query($conection, $query);
    if ($sql) {
      echo mysqli_fetch_array($sql)['nombre'];
    }
?> </h2>
	
	<!-- semana -->
	<div class="form-group">
		<label for="semana">Semana</label>
		<input class="form-control" id='semana' name="semana" type="week">
	</div>
	
	<!-- cultivo -->
	<div class="form-group">
		<label for="cultivo">Cultivo</label>
		<select class="form-control" id='cultivo' name="cultivo">
			<option value="">Seleccione un cultivo</option>
<!-- listar los cultivos -->

<?php 
	$query = "SELECT * FROM cultivo";
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
	
	<div class="form-group text-center">
		<input onclick="generar();" class="btn btn-success" type="button" value="Generar">
	</div>

	<div id="cuerpo">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-md-6">
					<h3 class="text-center" >Al día</h3>
					<canvas id="dia"></canvas>
				</div>
				<div class="col-12 col-md-6">
					<h3 class="text-center" >Al contrato</h3>
					<canvas id="contrato">></canvas>				
				</div>
			</div>
		</div>
	</div>

	<br><br>

</div>


</body>

<?php
include "end.php";
?>
<script src="../../js/Chart.js"></script>
<script>

	var lotes = 0;
	var labores = 0;

	function generar(){
		var semana = $('#semana');
		var cultivo = $('#cultivo');

		if (semana.val() == '') {
			swal('Error!','Debe seleccionar una semana','error').then((res)=>{
				semana.focus();
			});
			return;
		}

		if (cultivo.val() == '') {
			swal('Error!','Debe seleccionar un cultivo','error').then((res)=>{
				cultivo.focus();
			});
			return;
		}

		var dato = semana.val().split('-W');
		var year = dato[0];
		var week = dato[1];
		var anio = new Date(year,0,1);
		var primerdia = anio.getDay();
		var correccion = -anio.getDay() + 1;

		if(primerdia > 4){
			week++;
		}
		var inicio = new Date(year ,0 ,(week-1) * 7 + correccion);		
		var fin = new Date(year ,0 ,(week-1) * 7 + correccion + 6);		

		var a = ''+inicio;
		var b = ''+fin;

		fecha_inicio = (inicio.getYear()+1900)+'-'+(inicio.getMonth()+1)+'-'+a.split(' ')[2];
		fecha_fin = (fin.getYear()+1900)+'-'+(fin.getMonth()+1)+'-'+b.split(' ')[2];

		//ajax para cargar los datos
		$.ajax({
			url: '../../php/Owner/informe.php',
			type: 'POST',
			dataType: 'json',
			data: {op: 'informe',inicio:fecha_inicio,fin:fecha_fin,cultivo:cultivo.val()},
		})
		.done(function(data) {
			console.log(data);
			pintar(data);
		}).fail(function(data){
			console.log(data);
		});		
	}

	function pintar(labores){
		console.table(labores);
		$('#cuerpo').html('<div class="container-fluid">'+
			'<div class="row"><div class="col-12 col-md-6">'+
					'<h3 class="text-center" >Al día</h3>'+
					'<canvas id="dia"></canvas>'+
				'</div>'+
				'<div class="col-12 col-md-6">'+
					'<h3 class="text-center" >Al contrato</h3>'+
					'<canvas id="contrato"></canvas>'+				
				'</div>'+
			'</div></div>');
		var labels = new Array();
		var e_d = new Array();
		var p_d = new Array();
		var e_c = new Array();
		var p_c = new Array();
		for (var i = 0; i < labores.length; i++) {
			labels.push(labores[i].nombre);
			e_d.push(labores[i].e_valor_dia);
			p_d.push(labores[i].p_valor_dia);
			e_c.push(labores[i].e_valor_contrato);
			p_c.push(labores[i].p_valor_contrato);
		}

		//labores al dia
		data = {
		    datasets: [
		    {
		    	backgroundColor : 'rgba(20, 170, 49, 0.7)',
		    	borderColor : 'rgba(20, 170, 49, 1)',
		    	label : 'Ejecutadas',
		        data: e_d,
		    },
		    {
		    	backgroundColor : 'rgba(234, 16, 16, 0.7)',
		    	borderColor : 'rgba(234, 16, 16, 1)',
		    	label : 'Presupuestadas',
		    	data: p_d,
		    }
		    ],
		    labels: labels,
		};

		var myDoughnutChart = new Chart($('#dia'), {
		    type: 'bar',
		    data: data,
		});

		//labores al contrato
		data = {
		    datasets: [
		    {
		    	backgroundColor : 'rgba(20, 170, 49, 0.7)',
		    	borderColor : 'rgba(20, 170, 49, 1)',
		    	label : 'Ejecutadas',
		        data: e_c,
		    },
		    {
		    	backgroundColor : 'rgba(234, 16, 16, 0.7)',
		    	borderColor : 'rgba(234, 16, 16, 1)',
		    	label : 'Presupuestadas',
		    	data: p_c,
		    }
		    ],
		    labels: labels,
		};

		var myDoughnutChart = new Chart($('#contrato'), {
		    type: 'bar',
		    data: data,
		});


		lotes++;
	}

	
</script>

</html>