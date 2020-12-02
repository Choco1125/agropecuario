<?php
include "main.php";
?>
<link rel="stylesheet" href="../../css/datatables.min.css">
<style>
	.contenedor {
		overflow: auto;
		width: 100%;
	}

	th,
	td {
		text-align: center;
	}

	i {
		color: white;
	}
</style>
<link rel="stylesheet" href="../../css/datatables.min.css">

<!-- Modal para agregar -->
<div class="modal fade" id="add_maquinaria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Agregar al inventario de Máquinaria y equipo </h5>
				<button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="add" method="POST">

					<input type="hidden" name="finca" value="<?php echo $_SESSION['finca'] ?>">

					<div class="form-group">
						<label for="articulo"> Articulo </label>
						<input name="articulo" type="text" class="form-control" id="articulo" placeholder="Nombre del Articulo">
					</div>

					<div class="form-group">
						<label for="valor"> Valor </label>
						<input name="valor" type="text" class="form-control" id="valor" placeholder="Valor del articulo ">
					</div>

					<div class="form-group">
						<label for="fecha"> Fecha de ingreso </label>
						<input name="fecha" type="date" class="form-control" id="fecha" placeholder="Ingrese la fecha de ingreso">
					</div>

					<div class="form-group">
						<label for="n_factura"> Número de factura </label>
						<input name="n_factura" type="text" class="form-control" id="n_factura" placeholder="Ingrese el número de la factura">
					</div>

					<div class="form-group">
						<label for="cantidad"> Cantidad </label>
						<input name="cantidad" type="number" class="form-control" id="cantidad" placeholder="Ingrese la cantidad">
					</div>

					<div class="form-group">
						<label for="observacion"> Observaciones </label>
						<textarea name="observacion" id="observacion" cols="30" rows="10" class="form-control"></textarea>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
				<button type="button" onclick="add();" class="btn btn-success"> Agregar </button>
			</div>
		</div>
	</div>
</div>
<!-- Cierre de modal para agregar -->

<br>
<div class="container contenedor">
	<div class="row">
		<div class="col-2">
			<a class="btn btn-success" href="index.php">
				<i class="fas fa-arrow-left"></i>
			</a>
		</div>
		<div class="col-md-10">
			<h3>Maquinaria y Equipos -
				<?php
				include "../../php/conection.php";
				$query = "SELECT nombre FROM finca WHERE id = " . $_SESSION['finca'];
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					echo mysqli_fetch_array($sql)['nombre'];
				}
				?>
			</h3>
		</div>
	</div>
	<br>

	<!-- Boton para agregar lotes -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_maquinaria">
		Agregar
	</button>

	<br><br>

	<!-- Tabla de lote -->
	<table class="table" id="tabla">
		<thead>
			<tr>
				<th scope="col"> Articulo </th>
				<th scope="col"> Valor </th>
				<th scope="col"> Fecha Ingreso </th>
				<th scope="col"> Factura </th>
				<th scope="col"> Cantidad </th>
				<th scope="col"> Observación </th>
			</tr>
		</thead>
		<tbody>

			<?php

			//Imprimimos los registros de la base DB
			$id_finca = $_SESSION['finca'];
			include "../../php/conection.php";
			$query = "SELECT * FROM maquinaria WHERE finca_id='$id_finca'";
			$sql = mysqli_query($conection, $query);
			if ($sql) {
				while ($row = mysqli_fetch_array($sql)) {
			?>
					<tr>
						<td> <?php echo $row['articulo'] ?></td>
						<td> <?php echo $row['valor'] ?></td>
						<td> <?php echo $row['fecha'] ?></td>
						<td> <?php echo $row['n_factura'] ?></td>
						<td> <?php echo $row['cantidad'] ?></td>
						<td> <?php echo $row['observacion'] ?></td>
					</tr>

			<?php
				}
			}


			?>

		</tbody>
	</table>
	<!-- Cierre de tabla para lote -->

</div>

<?php
include 'end.php';
?>
<script src="../../js/datatables.min.js"></script>

<script>
	$(document).ready(function() {
		$('#tabla').DataTable({
			language: {
				search: "Buscar Registro",
				paginate: {
					first: "Primero",
					previous: "Anterior",
					next: "Siguiente",
					last: "Último"
				},
				"lengthMenu": "Mostar _MENU_ Por Página",
				"zeroRecords": "No Se Encontraron Registros",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "No Se Encontraron Registros",
				"infoFiltered": "(Se Filtraron _MAX_ Registros)",
			}
		})
	});

	//Limpiar
	function limpiar() {
		$('#add').trigger("reset");
	}

	function verificar_a() {
		var articulo = $('#articulo');
		var valor = $('#valor');
		var fecha = $('#fecha');
		var n_factura = $('#n_factura');
		var cantidad = $('#cantidad');
		var observacion = $('#observacion');

		if (articulo.val() == "") {
			swal({
				title: "Error!",
				text: "Debe ingresar el articulo",
				icon: "error",
				button: true,
			}).then((res) => {
				articulo.focus();
			});
			return false;
		}

		if (valor.val() == "") {
			swal({
				title: "Error!",
				text: "Debe ingresar el valor",
				icon: "error",
				button: true,
			}).then((res) => {
				valor.focus();
			});
			return false;
		}

		if (n_factura.val() == "") {
			swal({
				title: "Error!",
				text: "Debe ingresar el número de factura",
				icon: "error",
				button: true,
			}).then((res) => {
				n_factura.focus();
			});
			return false;
		}

		if (cantidad.val() == "") {
			swal({
				title: "Error!",
				text: "Debe ingresar el cantidad",
				icon: "error",
				button: true,
			}).then((res) => {
				cantidad.focus();
			});
			return false;
		}

		return true;
	}

	function add() {
		if (verificar_a()) {
			$.ajax({
					url: '../../php/Owner/maquinaria.php',
					type: 'POST',
					data: $('#add').serialize() + '&op=insert',
				})
				.done(function(data) {
					if (data == "1") {
						swal({
							title: "Buen trabajo",
							text: "El registro fue agregado correctamente",
							icon: "success",
							button: true,
						}).then((res) => {
							if (res) {
								location.reload();
							}
						});
					} else {
						swal("Error", "No se logro agregar el registro", "error");
					}
				});

		}
	}

	function read(id) {
		$.ajax({
				url: '../../php/Owner/maquinaria.php',
				type: 'POST',
				dataType: 'json',
				data: {
					id: id,
					op: 'read'
				},
			})
			.done(function(data) {
				$('#id').val(data.id);
				$('#edit_finca').val(data.finca_id);
				$('#edit_articulo').val(data.articulo);
				$('#edit_valor').val(data.valor);
				$('#edit_fecha').val(data.fecha);
				$('#edit_n_factura').val(data.n_factura);
				$('#edit_cantidad').val(data.cantidad);
				$('#edit_observacion').val(data.observacion);
			});

	}
</script>

</body>


</html>