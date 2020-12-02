<?php
include "main.php";
?>
<style>
	.card {
		margin: 10px;
		height: 250px;
		width: auto;
		padding: 10px;
		text-decoration: none;
		background: #28a745;
		color: white;
		cursor: pointer;
		transition: 0.8s;
		border: 2px solid #28a745;
		border-radius: 10px;
		box-shadow: 1px 1px 10px #ababab;
	}

	.card:hover {
		transition: 0.8s;
		color: #28a745;
		background: white;
	}

	.icon {
		padding-top: 25px;
		height: 200px;
		font-size: 140px;
	}
</style>
<br>
<div class="container">
	<div class="row">
		<div class="col-12 col-md-4 text-center">
			<div class="card" data='presupuesto'>
				<i class="icon fas fa-file-invoice-dollar"></i>
				<h3 class="title">Presupuesto</h3>
			</div>
		</div>
		<div class="col-12 col-md-4 text-center">
			<div class="card" data="registro">
				<i class="icon fas fa-file-signature"></i>
				<h3 class="title">Registro</h3>
			</div>
		</div>
		<div class="col-12 col-md-4 text-center">
			<div class="card" data="remision_ventas">
				<i class="icon fas fa-file-signature"></i>
				<h3 class="title">Remisión de Ventas</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-4 text-center">
			<div class="card" data='registro_ventas'>
				<i class="icon fas fa-file-invoice-dollar"></i>
				<h3 class="title">Registrar Ventas</h3>
			</div>
		</div>
		<div class="col-12 col-md-4 text-center">
			<div class="card" data="generar_comprobante">
				<i class="icon fas fa-file-signature"></i>
				<h3 class="title">Generar Comprobantes</h3>
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