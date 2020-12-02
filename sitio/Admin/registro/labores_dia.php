<?php
include "main.php";
?>
<link rel="stylesheet" type="text/css" href="../../../css/select2.min.css">

<style>
	.select2 {
		width: 100% !important;
	}
</style>

<!-- Modal para agregar empleado -->
<div class="modal fade" id="empleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"> Agregar empleado </h5>
				<button type="button" onclick="limpiar('add_empleado');" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="add_empleado">
					<input name="op" value="add" type="hidden">
					<div class="form-group">
						<label for="identificacion"> Identificación </label>
						<input name="identificacion" type="text" class="form-control" id="nit" placeholder="Ingrese la identificación">
					</div>

					<div class="form-group">
						<label for="nombre"> Nombre </label>
						<input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre">
					</div>

					<div class="form-group">
						<label for="apellidos"> Apellidos </label>
						<input name="apellidos" type="text" class="form-control" id="apellidos" placeholder="Ingrese los apellidos">
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" onclick="limpiar('add_empleado');" data-dismiss="modal"> Cerrar </button>
				<button type="button" onclick="addEmpleado();" class="btn btn-success"> Agregar empleado </button>
			</div>
		</div>
	</div>
</div>
<!-- Cierre de modal para agregar proveedor -->

<!-- Modal para agregar empleados a la labor -->
<div class="modal fade" id="add_empleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Agregar empleado a esta labor </h5>
				<button type="button" onclick="limpiar('add_empleados');" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="data_empleados" method="POST">
					<div class="row">

						<div class="col-12">
							<div class="form-group">
								<a class="btn btn-success" href="#" data-toggle="modal" data-target="#empleados" data-dismiss="modal">Crear Empleado</a>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="empleado">Empleado</label>
								<select name="empleado" id="empleado" class="from-control">
									<option value="">seleccione un empleado</option>
									<?php
									include '../../../php/conection.php';
									$query = "SELECT * FROM empleado";
									$sql = mysqli_query($conection, $query);
									if ($sql) {
										while ($row = mysqli_fetch_array($sql)) {
											?>
											<option value="<?php echo $row['id'] ?>"><?php echo $row['identificacion'] . ' - ' . $row['nombre'] . ' ' . $row['apellidos'] ?></option>
										<?php
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<div id="aux" style="display:none;">
						<div class="form-group">
							<label for="kilos">Kilos</label>
							<input class="form-control" id="kilos" name="kilos" type="text">
						</div>
					</div>

					<div class="form-group">
						<label for="valor">Valor Jornal</label>
						<input id="valor" name="valor" class="form-control" type="text">
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" onclick="limpiar('add_empleados');" data-dismiss="modal"> Cerrar </button>
				<button type="button" onclick="addEmpleadoLabor(true);" class="btn btn-success"> Agregar </button>
			</div>
		</div>
	</div>
</div>
<!-- Cierre de modal para agregar empleados -->


<!-- Modal para agregar insumos -->
<div class="modal fade" id="add_insumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Agregar insumo a esta labor </h5>
				<button type="button" onclick="limpiar('add_insumo');" class="close" data-dismiss="modal" aria-label="Close">
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
									include '../../../php/conection.php';
									$query = "SELECT b.id,i.nombre FROM insumo AS i INNER JOIN bodega as b WHERE b.insumo_id = i.id AND b.finca_id = '" . $_SESSION['finca'] . "'";
									$sql = mysqli_query($conection, $query);
									if ($sql) {
										while ($row = mysqli_fetch_array($sql)) {
											?>
											<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
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
				<button type="button" class="btn btn-danger" onclick="limpiar('add_insumo');" data-dismiss="modal"> Cerrar </button>
				<button type="button" onclick="add_insumo(true);" class="btn btn-success"> Agregar y Cerrar </button>
				<button type="button" onclick="add_insumo(false);" class="btn btn-success"> Agregar y Continuar </button>
			</div>
		</div>
	</div>
</div>
<!-- Cierre de modal para agregar insumos -->


<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-7">
			<br>
			<div class="row align-items-center">
				<div class="col-1">
					<a class="btn btn-success" href="index.php">
						<i class="fas fa-arrow-left"></i>
					</a>
				</div>
				<div class="col-11">
					<h1>Registro / Labores al día</h1>
				</div>
			</div>
			<br>
			<br>
			<form id="data" method="POST">
				<input type="hidden" name="tipo" id="tipo" value="0">
				<input type="hidden" name="cantidad_insumos" id="cantidad_insumos" value="0">
				<input type="hidden" name="cantidad_empleados" id="cantidad_empleados" value="0">
				<?php
				$fechaHoy = date('Y-m-d');
				?>
				<div class="form-group">
					<label for="fecha">Fecha</label>
					<input id="fecha" value="<?php echo $fechaHoy ?>" name="fecha" type="date" class="form-control" readonly>
				</div>
				<?php
				//consultar si existe un registro de pluviometria para hoy
				/********************************************************/
				$query = "SELECT id FROM pluviometria  WHERE fecha='$fechaHoy' and finca_id = '" . $_SESSION['finca'] . "'";
				$sql = mysqli_query($conection, $query);
				if (mysqli_num_rows($sql) == 0) {
					?>
					<div class="form-group">
						<label for="pluviometria">Pluviometria (milimetros)</label>
						<input id="pluviometria" name="pluviometria" type="number" class="form-control">
					</div>
				<?php
				}
				?>
				<div class="form-group">
					<label for="lote">Lote</label>
					<select class="form-control" name="lote" id="lote">
						<option value="">Seleccione un lote</option>
						<?php
						$query = "SELECT l.id,l.nombre,c.nombre AS 'cultivo' FROM lote AS l INNER JOIN cultivo AS c WHERE l.cultivo_id = c.id AND l.id_finca=" . $_SESSION['finca'];
						$sql = mysqli_query($conection, $query);
						if ($sql) {
							while ($row = mysqli_fetch_array($sql)) {
								?>
								<option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] . ' - ' . $row['cultivo'] ?></option>
							<?php
							}
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="labor">Labor</label>
					<select name="labor" id="labor" class="form-control" onchange="selectLabor()">
						<option value="">Seleccione una labor</option>
						<?php
						$query = "SELECT * FROM labores";
						$sql = mysqli_query($conection, $query);
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

				<div id="fumigacion" style="display:none;">
					<div class="form-group">
						<label for="ph_inicial">Ph inicial</label>
						<input id="ph_inicial" name="ph_inicial" type="number" class="form-control">
					</div>
					<div class="form-group">
						<label for="ph_final">Ph final</label>
						<input id="ph_final" name="ph_final" type="number" class="form-control">
					</div>
				</div>

				<!-- <div id="recoleccion" style="display:none;">
					<div class="form-group">
						<label for="valor_kilo">Valor por Kilo</label>
						<input id="valor_kilo" name="valor_kilo" type="number" class="form-control">
					</div>
				</div> -->

				<hr>
				<h4 class="text-center">Agregar empleados para esta labor</h4>
				<a onclick="openModalAddEmpleado()" class="btn btn-success text-white">Agregar empleado</a>
				<br><br>
				<table class="table text-center">
					<thead>
						<tr id="headEmpleado">
						</tr>
					</thead>
					<tbody id="info_empleados">
					</tbody>
				</table>
				<hr>

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
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody id="info_insumos">
					</tbody>
				</table>
				<hr>
				<div class="form-group">
					<label for="">Labor terminada</label>
					<select class="form-control" name="estado" id="estado">
						<option value="1">Si</option>
						<option value="0">No</option>
					</select>
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
	</div>
</div>

</body>
<?php
include "end.php";
?>
<script src="../../../js/jquery.maskMoney.min.js" type="text/javascript"></script>
<script src="../../../js/select2.min.js"></script>

<script>
	$(document).ready(function() {
		$('#empleado').select2({
			dropdownParent: $('#add_empleados')
		});
	});

	function openModalAddEmpleado() {
		if (tipoLabor != null) {
			if (tipoLabor == 'recoleccion') {
				$('#aux').css('display', 'block');
			}
			$('#add_empleados').modal('show');
		} else {
			swal('Error!', 'Primero debe de seleccionar una labor', 'error');
		}
	}

	function addEmpleado() {
		$.ajax({
			type: "POST",
			url: "../../../php/Admin/empleados.php",
			data: $('#add_empleado').serialize(),
			dataType: "json"
		}).done((res) => {
			switch (res.res) {
				case 0:
					swal('Error!', res.msg, 'erorr');
					break;
				case 1:
					swal('Logrado!', res.msg, 'success').then(() => {
						listarEmpleados();
						$('#empleados').modal('hide');
						$('#add_empleados').modal('show');
						$('#add_empleado').trigger('reset');
					});
					break;
			}
		}).fail((res) => {
			swal('Error!', 'Ocurrio un error en el servidor', 'erorr');
		});
	}

	function listarEmpleados() {
		$.ajax({
			type: "POST",
			url: "../../../php/Admin/empleados.php",
			data: {
				op: 'list'
			},
			dataType: "json",
		}).done((res) => {

			let select = $('#empleado').html('');

			res.forEach(element => {
				select.append(`<option value="${element.id}">${element.identificacion} - ${element.nombre} ${element.apellidos}</option>`)
			});

			$('#empleado').select2({
				dropdownParent: $('#add_empleados')
			});
		});
	}

	function calcular() {
		$('#valor').val($('#jornales').val() * $('#valor_jornales').val().replace(/,/g, ""));
		$('#valor_jornales').focus();
	}

	//consultar unidad y existencia
	function unidadF() {
		var id = $('#insumo').val().split('#')[0];
		$.ajax({
				url: '../../../php/Admin/labor.php',
				type: 'POST',
				dataType: 'json',
				data: {
					op: 'unidad',
					id: id
				},
			})
			.done(function(data) {
				$('#existencia').val(data.cantidad);
				$('#unidad').val(data.unidad);
			});
	}

	// funcion para limpiar un formulario
	function limpiar(id) {
		$('#' + id).trigger('reset');
	}

	var n_insumos = 1;
	var n_empleados = 1;
	let tipo;
	let tipoLabor = null;

	$('#insumo').select2({
		dropdownParent: $('#add_insumo')
	});
	$('#labor').select2();
	$('#valor_jornales').maskMoney({
		precision: 0
	});
	$('#valor').maskMoney({
		precision: 0
	});


	function selectLabor() {
		searchLaborById($('#labor').val(), (res) => {

			//reiniciar todos los datos
			$('#aux').css('display', 'none');
			tipoLabor = null;
			var n_insumos = 1;
			var n_empleados = 1;
			$('#headEmpleado').html('');
			$('#fumigacion').css('display', 'none');
			$('#recoleccion').css('display', 'none');
			$('#info_empleados').html('');
			$('#cantidad_empleados').val(0);
			$('#info_insumos').html('');
			$('#cantidad_insumos').val(0);
			$('#datos').html('');

			if (res != null) {
				tipoLabor = res.tipo;
				switch (res.tipo) {
					case 'recoleccion':
						$('#headEmpleado').html(`
							<th>Nombre</th>
							<th>Kilos</th>
							<th>Valor</th>
							<th>Eliminar</th>
						`);
						// $('#recoleccion').css('display', 'block');
						$('#fumigacion').css('display', 'none');
						break;
					case 'fumigacion':
						$('#headEmpleado').html(`
							<th>Nombre</th>
							<th>Valor</th>
							<th>Eliminar</th>
						`);
						$('#fumigacion').css('display', 'block');
						// $('#recoleccion').css('display', 'none');
						break;
					case 'ninguno':
						$('#headEmpleado').html(`
							<th>Nombre</th>
							<th>Valor</th>
							<th>Eliminar</th>
						`);
						$('#fumigacion').css('display', 'block');
						// $('#recoleccion').css('display', 'none');
						break;
					default:
						$('#headEmpleado').html(`
							<th>Nombre</th>
							<th>Valor</th>
							<th>Eliminar</th>
						`);
						$('#fumigacion').css('display', 'none');
						// $('#recoleccion').css('display', 'none');
						break;
				}
			} else {
				tipoLabor = null;
				$('#headEmpleado').html('');
				$('#fumigacion').css('display', 'none');
				$('#recoleccion').css('display', 'none');
			}
		});
	}

	function searchLaborById(id, succes) {
		$.ajax({
			type: "POST",
			url: "../../../php/Admin/labores.php",
			data: {
				op: 'search',
				id: id
			},
			dataType: "json"
		}).done((res) => {
			succes(res);
		});
	}

	function limpiar_todo() {
		swal({
			title: 'Advertencia!',
			text: '¿Seguro de querer borrar toda la información ingresada?',
			icon: 'warning',
			buttons: true
		}).then((res) => {
			if (res) {
				location.reload();
			}
		});
	}

	function limpiar_i() {
		$('#data_insumos').trigger("reset");
		$('#insumo').select2({
			dropdownParent: $('#add_insumo')
		});
	}

	function add_insumo(action) {

		var insumo = $('#insumo');
		var cantidad = $('#i_cantidad');
		if (insumo.val() == "") {
			swal('Error!', 'Debe de seleccionar un insumo', 'error');
			return;
		}

		if (cantidad.val() == "") {
			swal('Error!', 'Debe ingresar la cantidad', 'error');
			return;
		}

		if (($('#existencia').val() - cantidad.val()) < 0) {
			swal('Error!', 'No puede ingresar una cantidad mayor a la existencia', 'error');
			return;
		}


		var n_insumo = insumo.children("option:selected").text();
		var id_insumo = insumo.val();
		var unidad = $('#unidad').val();

		$('#info_insumos').append(
			'<tr delete-data="' + `insumo${n_insumos}` + '" >' +
			'<td>' + n_insumo + '</td>' +
			'<td>' + cantidad.val() + '</td>' +
			'<td>' + unidad + '</td>' +
			'<td><a onclick="deleteInsumo(' + `'insumo${n_insumos}'` + ')" class="btn btn-danger text-white">' +
			'<i class="fas fa-trash"></i></a></td>' +
			'</tr>');

		$('#datos').append(
			'<input delete-data="' + `insumo${n_insumos}` + '" value="' + id_insumo + '" name="id_insumo' + n_insumos + '" type="hidden"/>' +
			'<input delete-data="' + `insumo${n_insumos}` + '" value="' + cantidad.val() + '" name="i_cantidad' + n_insumos + '" type="hidden"/>');

		$('#cantidad_insumos').val(n_insumos);
		n_insumos++;

		if (action) {
			$('#add_insumo').modal('hide');
		}
		limpiar('data_insumo');
	}

	function deleteInsumo(delete_data) {
		swal({
			title:'¿Eliminar?',
			text: '',
			icon: 'warning',
			buttons: true
		}).then((res) => {
			if (res) {
				$(`[delete-data="${delete_data}"]`).remove();
			}
		});
	}

	function deleteEmpleado(delete_data) {
		swal({
			title:'¿Eliminar?',
			text: '',
			icon: 'warning',
			buttons: true
		}).then((res) => {
			if (res) {
				$(`[delete-data="${delete_data}"]`).remove();
			}
		});
	}

	function verificar() {
		var lote = $('#lote');
		var semana = $('#semana');
		var labor = $('#labor');

		if (lote.val() == "") {
			swal({
				title: "Error!",
				text: "Debe de seleccionar un lote",
				icon: "error",
				button: true,
			}).then((res) => {
				lote.focus();
			});
			return false;
		}

		if (semana.val() == "") {
			swal({
				title: "Error!",
				text: "Debe de ingresar una semana",
				icon: "error",
				button: true,
			}).then((res) => {
				semana.focus();
			});
			return false;
		}

		if (labor.val() == "") {
			swal({
				title: "Error!",
				text: "Debe de seleccionar una labor",
				icon: "error",
				button: true,
			}).then((res) => {
				labor.focus();
			});
			return false;
		}

		var inputs = $('[check=true]');
		for (var i = 0; i < inputs.length; i++) {
			if (inputs[i].value == "") {
				swal('Error!', 'Debe ingresar un valor en este campo!', 'error').then(() => {
					inputs[i].focus();
				});
				return false;
			}
		}

		return true;
	}

	function addEmpleadoLabor(action) {
		let idEmpleado = $('#empleado').val();
		searchById(idEmpleado, (empleado) => {
			var valor = $('#valor').val();

			if (empleado == null) {
				swal('Error!', 'Debe de seleccionar un empleado', 'error');
				return;
			}

			if (valor == "") {
				swal('Error!', 'Debe ingresar el valor', 'error');
				return;
			}

			if (tipoLabor == 'recoleccion') {
				let kilos = $('#kilos').val();
				$('#info_empleados').append(
					'<tr delete-data="' + `empleado${n_empleados}` + '" >' +
					'<td>' + empleado.nombre + '</td>' +
					'<td>$ ' + valor + '</td>' +
					'<td>' + kilos + '</td>' +
					'<td><a onclick="deleteEmpleado(' + `'empleado${n_empleados}'` + ')" class="btn btn-danger text-white">' +
					'<i class="fas fa-trash"></i></a></td>' +
					'</tr>');

				$('#datos').append(
					`<input delete-data="empleado${n_empleados}" value="${empleado.id}" name="id_empleado${n_empleados}" type="hidden">
							<input delete-data="empleado${n_empleados}" value="${valor.replace(/,/g,"")}" name="valor${n_empleados}" type="hidden">
							<input delete-data="empleado${n_empleados}" value="${kilos}" name="kilos${n_empleados}" type="hidden">`);

			} else {
				$('#info_empleados').append(
					'<tr delete-data="' + `empleado${n_empleados}` + '" >' +
					'<td>' + empleado.nombre + '</td>' +
					'<td>$ ' + valor + '</td>' +
					'<td><a onclick="deleteEmpleado(' + `'empleado${n_empleados}'` + ')" class="btn btn-danger text-white">' +
					'<i class="fas fa-trash"></i></a></td>' +
					'</tr>');

				$('#datos').append(
					`<input delete-data="empleado${n_empleados}" value="${empleado.id}" name="id_empleado${n_empleados}" type="hidden">
							<input delete-data="empleado${n_empleados}" value="${valor.replace(/,/g,"")}" name="valor${n_empleados}" type="hidden">`);
			}


			$('#cantidad_empleados').val(n_empleados);
			n_empleados++;

			if (action) {
				$('#add_empleados').modal('hide');
			}
			limpiar('data_empleados');
		});
	}

	function searchById(id, retorno) {
		$.ajax({
			type: "POST",
			url: "../../../php/Admin/empleados.php",
			data: {
				op: 'search',
				id: id
			},
			dataType: "json"
		}).done((res) => {
			retorno(res);
		});
	}

	function registrar() {
		if (verificar()) {
			$.ajax({
					url: '../../../php/Admin/labor.php',
					type: 'POST',
					data: $('#data').serialize() + `&op=add&tipoLabor=${tipoLabor}`,
				})
				.done(function(data) {
					if (data == "1") {
						swal({
							title: "Buen Trabajo!",
							text: "Se registro la labor correctamente",
							icon: "success",
							button: true,
						}).then((res) => {
							location.reload();
						});
					} else {
						swal('Error!', data, 'error');
					}
				});

		}
		return false;
	}
</script>

</html>