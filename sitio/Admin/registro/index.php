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
	<div class="container">
        <br>
	    <h1 class="text-center">Registro</h1>
        <br>
		<div class="row">
			<div class="col-12 col-md-4 text-center">
				<div class="card" data='labores_dia.php'>
					<i class="icon fas fa-clipboard-check"></i>
					<h3 class="title">Labores al día</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="labores_contrato.php">
					<i class="icon fas fa-file-invoice-dollar"></i>
					<h3 class="title">Labores al contrato</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="beneficios.php">
					<i class="icon fas fa-file-signature"></i>
					<h3 class="title">Beneficios PostCosecha</h3>
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
				<div class="card" data="administrativos.php">
					<i class="icon fas fa-dollar-sign"></i>
					<h3 class="title">Gastos Administrativos</h3>
				</div>
			</div>
			<div class="col-12 col-md-4 text-center">
				<div class="card" data="financieros.php">
					<i class="icon fas fa-dollar-sign"></i>
					<h3 class="title">Gastos Financieros</h3>
				</div>
			</div>
		</div>		
		<div class="row">
            <div class="col-12 col-md-4 text-center">
				<div class="card" data="otros.php">
					<i class="icon fas fa-dollar-sign"></i>
					<h3 class="title">Otros Gastos</h3>
				</div>
			</div>
            <div class="col-12 col-md-4 text-center">
				<div class="card" data="../index.php">
                    <i class="icon fas fa-arrow-alt-circle-left"></i>
					<h3 class="title">Volver al Inicio</h3>
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
