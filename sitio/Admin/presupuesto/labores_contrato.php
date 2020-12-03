<?php
include "main.php";
?>
<link rel="stylesheet" type="text/css" href="../../../css/select2.min.css">

<style>
	.select2 {
		width: 100% !important;
	}
</style>


<!-- Modal para agregar insumos -->
<div class="modal fade" id="add_insumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"> Agregar insumo a esta labor </h5>
				<button type="button" onclick="limpiar_i();" class="close" data-dismiss="modal" aria-label="Close">
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
											<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] ?></option>
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
				<button type="button" class="btn btn-danger" onclick="limpiar_i();" data-dismiss="modal"> Cerrar </button>
				<button type="button" onclick="add_insumo(true);" class="btn btn-success"> Agregar y Cerrar </button>
				<button type="button" onclick="add_insumo(false);" class="btn btn-success"> Agregar y Continuar </button>
			</div>
		</div>
	</div>
</div>
<!-- Cierre de modal para agregar insumos -->


<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-6">
			<br>
			<div class="row align-items-center">
				<div class="col-2 col-md-1">
					<a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
				</div>
				<div class="col-10 col-md-11">
					<h2 class="text-center">Presupuesto / Labores al contrato</h2>
				</div>
			</div>
			<br>
			<br>
			<form id="data" method="POST">
				<input type="hidden" name="tipo" id="tipo" value="1">
				<input type="hidden" name="cantidad_insumos" id="cantidad_insumos" value="1">
				<div class="form-group">
					<label for="semana">Semana</label>
					<input id="semana" name="semana" type="week" class="form-control">
				</div>
				<div class="form-group">
					<label for="lote">Lote - Cultivo</label>
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
								<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
						<?php
							}
						}
						?>
					</select>
				</div>
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

				<div id="body">
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
	function calcular1() {
		$('#valor').val($('#kilos').val() * $('#valor_kilo').val().replace(/,/g, ""));
	}

	function calcular2() {
		$('#valor_kilo').val($('#valor').val().replace(/,/g, "") / $('#kilos').val());
	}

	//consultar unidad y existencia
	function unidadF() {
		var id = $('#insumo').val();
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

	var n_insumos = 1;
	let tipo;
	let recoleccion = null;

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
		var datos = $('#labor').val().split('-');
		if (datos.length == 1) {
			recoleccion = null;
		} else {
			recoleccion = (datos[1] == '1');
		}

		if (recoleccion) {

			$('#body').html(`
            <div class="row">
                <div class="col-12 col-md-4">
                    <label for="">Kilos</label>
                    <input class="form-control" type="number" name="kilos" id="kilos">
                </div>
                <div class="col-12 col-md-4">
                    <label for="">Valor Kilo</label>
                    <input onblur="calcular1();" class="form-control" type="text" name="valor_kilo" id="valor_kilo"></div>
                <div class="col-12 col-md-4">
                    <label for="">Valor Total</label>
                    <input onblur="calcular2();" class="form-control" type="text" name="valor" id="valor">
                </div>
            </div>
            `);
			$('#valor_kilo').maskMoney({
				precision: 0
			});
			$('#valor').maskMoney({
				precision: 0
			});
		} else {
			$('#body').html('<div class="form-group">' +
				'<label for="">Valor Total</label>' +
				'<input id="valor" name="valor" type="text" class="form-control" check="true" />' +
				'</div>');
			$('#valor').maskMoney({
				precision: 0
			});
		}

	}

	function limpiar_todo() {
		location.reload();
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
		limpiar_i();
	}

	function deleteInsumo(delete_data) {
		console.log('holi');
		$(`[delete-data="${delete_data}"]`).remove();
		$(`[delete-data="${delete_data}"]`).remove();
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

	function registrar() {
		if (verificar()) {
			var dato = $('#semana').val().split('-W');
			var year = dato[0];
			var week = dato[1];
			var anio = new Date(year, 0, 1);
			var primerdia = anio.getDay();
			var correccion = -anio.getDay() + 1;

			if (primerdia > 4) {
				week++;
			}
			var inicio = new Date(year, 0, (week - 1) * 7 + correccion);
			var a = '' + inicio;
			fecha = (inicio.getYear() + 1900) + '-' + (inicio.getMonth() + 1) + '-' + a.split(' ')[2];

			$.ajax({
					url: '../../../php/Admin/labor.php',
					type: 'POST',
					data: $('#data').serialize() + '&op=presupuestar&fecha=' + fecha,
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