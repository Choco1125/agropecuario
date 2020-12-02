<?php 
	include "main.php";
 ?>
<style>
	.card{
		margin : 10px;
		height: 250px;
		width: auto;
		padding: 10px;
		text-decoration: none;
		background: #28a745;
		color: white;
		cursor: pointer;
        transition: 1s;
        border: 2px solid #28a745;
	}

	.card:hover{
        transition: 1s;
        color: #28a745;
		background: white;
	}

	.icon{
		padding-top: 25px;
		height: 200px;
		font-size: 140px;
	}

</style>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-4 text-center">
				<div class="card" data='p_labores.php'>
					<i class="icon fas fa-file-invoice-dollar"></i>
					<h3 class="title">Presupuestar</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="contratos.php">
					<i class="icon fas fa-clipboard-check"></i>
					<h3 class="title">Revisar Contratos(falta)</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="r_labores.php">
					<i class="icon fas fa-file-signature"></i>
					<h3 class="title">Registrar Labores(falta)</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="ventas.php">
					<i class="icon fas fa-file-signature"></i>
					<h3 class="title">Registrar ventas</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="productos.php">
					<i class="icon fas fa-bullhorn"></i>
					<h3 class="title">Remisión ventas</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="lotes.php">
					<i class="icon fas fa-bars"></i>
					<h3 class="title">Lotes</h3>
				</div>
			</div>
		</div>		
		<div class="row">
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="insumos.php">
					<i class="icon fas fa-vials"></i>
					<h3 class="title">Insumos</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="pluviometria.php">
					<i class="icon fas fa-cloud-rain"></i>
					<h3 class="title">Pluviometría</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="temperatura.php">
					<i class="icon fas fa-temperature-high"></i>
					<h3 class="title">Temperatura</h3>
				</div>
			</div>
		</div>
				<div class="row">
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="comprobante.php">
					<i class="icon fas fa-money-check-alt"></i>
					<h3 class="title">Comprobantes de Pago</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="administrativos.php">
					<i class="icon fas fa-dollar-sign"></i>
					<h3 class="title">Gastos Administrativos</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="financieros.php">
					<i class="icon fas fa-dollar-sign"></i>
					<h3 class="title">Costos Financieros</h3>
				</div>
			</div>
		</div>
				<div class="row">
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="beneficios.php">
					<i class="icon fas fa-dollar-sign"></i>
					<h3 class="title">Beneficios Post-cosecha</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="otros.php">
					<i class="icon fas fa-dollar-sign"></i>
					<h3 class="title">Otros Gastos</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="maquinaria.php">
					<i class="icon fas fa-tractor"></i>
					<h3 class="title">Máquinaria y Equipos</h3>
				</div>
			</div>
		</div>
	</div>


</body>

<?php 
	include "end.php";
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.card').click(function(e) {
			let ruta = $(this).attr('data');
			if (ruta != undefined) {
				location.replace(ruta);				
			}
		});
	});
</script>

</html>
