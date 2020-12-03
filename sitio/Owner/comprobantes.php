<?php
include "main.php";
?>
<link rel="stylesheet" href="../../css/datatables.min.css">
<style>
	.logo {
		width: 70%;
	}
</style>

<!-- Modal para agregar -->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
																																													include '../../php/conection.php';
																																													$query = "SELECT nombre,id_sociedad FROM finca WHERE id = " . $_SESSION['finca'];
																																													$finca;
																																													$sociedad;
																																													$sql = mysqli_query($conection, $query);
																																													if ($sql) {
																																														$aux = mysqli_fetch_array($sql);
																																														$finca = $aux['nombre'];
																																														$sociedad = $aux['id_sociedad'];
																																														$query = "SELECT * FROM sociedad WHERE id = '$sociedad'";
																																														$sql = mysqli_query($conection, $query);
																																														if ($sql) {
																																															$sociedad = mysqli_fetch_array($sql);
																																														}
																																													}
																																													//generar consecutivo
																																													$query = "SELECT n_factura FROM comprobante WHERE sociedad_id='" . $sociedad['id'] . "' ORDER BY n_factura DESC LIMIT 0,1";
																																													$sql = mysqli_query($conection, $query);
																																													if ($sql) {
																																														$num = mysqli_num_rows($sql);
																																														if ($num > 0) {
																																															$num = mysqli_fetch_array($sql)['n_factura'] + 1;
																																															if ($num < 10) { //un solo digito
																																																$num = "0000" . $num;
																																															} elseif ($num < 100) {
																																																$num = "000" . $num;
																																															} elseif ($num < 1000) {
																																																$num = "00" . $num;
																																															} elseif ($num < 10000) {
																																																$num = "0" . $num;
																																															}
																																															echo $num;
																																														} else {
																																															echo '00001';
																																														}
																																													} else {
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
							<input name="identificacion" class="text-center form-control" type="text">
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

<!-- Modal para Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"> Editar Comprobante </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="edit">
					<div class="row">
						<div class="col-10">
							<h5>DOCUMENTO EQUIVALENTE PARA PERSONAS NATURALES NO OBLIGADAS A EXPEDIR FACTURA</h5>
						</div>
						<div class="col-2">
							<input class="form-control text-right" id="n_factura" name="n_factura" type="text" value="" readonly>
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
							<input name="fecha" id="edit_fecha" class="text-center form-control" value="<?php echo date('Y-m-d');  ?>" type="date">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-2">
							<label for="nombre">Nombre y apellidos: </label>
						</div>
						<div class="col-10">
							<input id="edit_nombre" name="nombre" class="text-center form-control" type="text">
						</div>
						<br><br>
						<div class="col-2">
							<label for="edit_identificacion">Cédula o Nit: </label>
						</div>
						<div class="col-10">
							<input id="edit_identificacion" name="identificacion" class="text-center form-control" type="text">
						</div>
						<br><br>
						<div class="col-2">
							<label for="edit_direccion">Dirección: </label>
						</div>
						<div class="col-4">
							<input id="edit_direccion" name="direccion" class="text-center form-control" type="text">
						</div>
						<div class="col-2 text-right">
							<label for="edit_telefono">Teléfono: </label>
						</div>
						<div class="col-4">
							<input id="edit_telefono" name="telefono" class="text-center form-control" type="text">
						</div>
					</div>
					<br>
					<div class="row">
						<label for="edit_concepto">Descripción del bien o servicio prestado: </label>
						<textarea class="form-control" name="concepto" id="edit_concepto" cols="30" rows="5"></textarea>
					</div>
					<br>
					<div class="row">
						<div class="col-2">
							<label for="edit_valor_letras">Valor en letras: </label>
						</div>
						<div class="col-7">
							<input id="edit_valor_letras" name="valor_letras" class="text-center form-control" type="text">
						</div>
						<div class="col-3">
							<input id="edit_valor" name="valor" class="text-center form-control" type="text">
						</div>
					</div>
					<br>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
				<button type="button" onclick="save();" class="btn btn-success"> Guardar </button>
			</div>
		</div>
	</div>
</div>
<!-- Cierre modal para Editar -->

<div class="container">
	<br><br>
	<h3> Comprobantes -
		<?php
		include "../../php/conection.php";
		$query = "SELECT nombre FROM finca WHERE id = " . $_SESSION['finca'];
		$sql = mysqli_query($conection, $query);
		if ($sql) {
			echo mysqli_fetch_array($sql)['nombre'];
		}
		?>
	</h3>
	<br>
	<a class="btn btn-primary" data-toggle="modal" data-target="#agregar" href="#"> Agregar Comprobante </a>
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
			$query = "SELECT * FROM comprobante WHERE finca_id=" . $_SESSION['finca'];
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
							<a href="#" data-toggle="modal" data-target="#editar" onclick="upload(<?php echo $row['id']; ?>)" class="btn btn-primary">
								<i class="far fa-edit"> </i>
							</a>

							<a href="#" class="btn btn-danger" onclick="eliminar(<?php echo $row['id'] ?>);">
								<i class="fas fa-trash-alt"> </i>
							</a>
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


<?php
include "end.php";
?>

<script src="../../js/datatables.min.js"> </script>
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

	function limpiar() {
		$('#add').trigger("reset");
	}

	function add() {
		var fecha = $('#fecha');
		var nombre = $('#nombre');
		var identificacion = $('#identificacion');
		var concepto = $('#concepto');
		var valor = $('#valor');

		//Validaciones-------------------------------
		if (fecha.val() == "") {
			swal({
				title: "Error!",
				text: "Debe seleccionar una fecha",
				icon: "error",
				button: true,
			}).then((res) => {
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
			}).then((res) => {
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
			}).then((res) => {
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
			}).then((res) => {
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
			}).then((res) => {
				valor.focus();
			});
			return;
		}
		//--------------------------------------
		$.ajax({
				url: '../../php/Owner/comprobante.php',
				type: 'POST',
				data: $('#add').serialize() + '&op=add',
			})
			.done(function(data) {
				if (data == "1") {
					swal({
						title: "Buen trabajo",
						text: "Comprobante guardado Correctamente!",
						icon: "success",
						button: true,
					}).then((res) => {
						location.reload();
					});
				} else {
					swal("Error", data, "error");
				}
			});
	}

	function eliminar(id) {
		swal({
			title: "Advertencia",
			text: "¿Seguro de Querer eliminar este comprobante?",
			icon: "warning",
			buttons: true,
		}).then((res) => {
			if (res) {
				$.ajax({
						url: '../../php/Owner/comprobante.php',
						type: 'POST',
						data: {
							id: id,
							op: 'delete'
						},
					})
					.done(function(data) {
						if (data == "1") {
							swal({
								title: "Buen trabajo",
								text: "El comprobante fue eliminado correctamente!",
								icon: "success",
								button: true,
							}).then((res) => {
								location.reload();
							});
						} else {
							swal("Error", data, "error");
						}
					});
			}
		});
	}

	function upload(id) {
		$.ajax({
				url: '../../php/Owner/comprobante.php',
				type: 'POST',
				dataType: 'json',
				data: {
					id: id,
					op: 'read'
				},
			})
			.done(function(data) {
				$('#n_factura').val(data.n_factura);
				$('#edit_fecha').val(data.fecha);
				$('#edit_nombre').val(data.nombre);
				$('#edit_identificacion').val(data.identificacion);
				$('#edit_direccion').val(data.direccion);
				$('#edit_telefono').val(data.telefono);
				$('#edit_concepto').val(data.concepto);
				$('#edit_valor_letras').val(data.valor_letras);
				$('#edit_valor').val(data.valor);
			});
	}

	function save() {
		var fecha = $('#edit_fecha');
		var nombre = $('#edit_nombre');
		var identificacion = $('#edit_identificacion');
		var concepto = $('#edit_concepto');
		var valor = $('#edit_valor');
		if (fecha.val() == "") {
			swal({
				title: "Error!",
				text: "Debe seleccionar una fecha",
				icon: "error",
				button: true,
			}).then((res) => {
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
			}).then((res) => {
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
			}).then((res) => {
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
			}).then((res) => {
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
			}).then((res) => {
				valor.focus();
			});
			return;
		}

		$.ajax({
				url: '../../php/Owner/comprobante.php',
				type: 'POST',
				data: $('#edit').serialize() + '&op=edit',
			})
			.done(function(data) {
				if (data == "1") {
					swal({
						title: "Buen trabajo",
						text: "Comprobante guardado Correctamente!",
						icon: "success",
						button: true,
					}).then((res) => {
						location.reload();
					});
				} else {
					swal("Error", data, "error");
				}
			});
	}
</script>


</html>