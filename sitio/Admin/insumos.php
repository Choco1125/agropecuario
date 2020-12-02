<?php 
  include "main.php";
?>
<link rel="stylesheet" href="../../css/datatables.min.css">

<!-- modal para registrar compra -->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Registrar Compra </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add" class="container-fluid">

	        <label for="fecha"> Fecha </label>
	        <input name="fecha" type="date" class="form-control" id="fecha">

            <div class="form-group">
		        <label for="factura"> Número de Factura </label>
		        <input name="factura" type="text" class="form-control" id="factura">
            </div>

            <div class="row">
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <label for="insumo">Seleccione un insumo</label>
                  <select name="insumo" id="insumo" class="form-control" onchange="unidadF()"> 
                    <option value="">Seleccione un insumo</option>
      <?php 
        include '../../php/conection.php';
        $query = "SELECT * FROM insumo";
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
                
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label for="">Unidad</label>
                  <input id="unidad" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>

            <div class="row align-items-end">
            	<div class="col-12 col-md-9">
	            	<label for="proveedor">Seleccione un proveedor</label>
		            <select name="proveedor" id="proveedor" class="form-control">
		            	<option value="">Seleccione un proveedor</option>
		<?php 
			$query = "SELECT * FROM proveedor";
			$sql = mysqli_query($conection,$query);
			if ($sql) {
				while ($row = mysqli_fetch_array($sql)) {
		?>
						<option value="<?php echo $row['id'] ?>"><?php echo $row['nit'] ?> - <?php echo $row['nombre'] ?></option>
		<?php
				}
			}

		 ?>
		            </select>
	            </div>
            	<div class="col-12 col-md-3">
            		<a class="btn btn-success" href="#"  data-toggle="modal" data-target="#proveedores" data-dismiss="modal">Agregar Proveedor</a>
            	</div>
            </div>

			
	       <label for="valor_u"> Valor Unitario </label>
          <input name="valor_u" onchange="calcular();" type="number" class="form-control" id="valor_u">
                  
          <label for="cantidad"> Cantidad </label>
          <input name="cantidad" onchange="calcular();" type="number" class="form-control" id="cantidad">

          <label for="valor"> Valor Total </label>
          <input name="valor" type="number" class="form-control" id="valor">

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add();" class="btn btn-success"> Registrar </button>
	      </div>
    </div>
  </div>
</div>
<!-- cierre modal para registrar compra -->

<!-- Modal para agregar proveedor -->
<div class="modal fade" id="proveedores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar proveedor </h5>
        <button type="button" onclick="limpiar_p();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add_proveedor">

            <div class="form-group">
            <label for="nit"> Nit </label>
            <input name="nit" type="text" class="form-control" id="nit" placeholder="Ingrese el nit">
            </div>

      			<div class="form-group">
      			<label for="nombre"> Nombre </label>
      			<input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre">
      			</div>

      			<div class="form-group">
      			<label for="telefono"> Teléfono </label>
      			<input name="telefono" type="number" class="form-control" id="telefono" placeholder="Ingrese el teléfono">
      			</div>

          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" onclick="limpiar_p();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add_proveedor();" class="btn btn-success"> Agregar proveedor </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar proveedor -->

<div class="container">
	<br>
	<a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
	<br>

	<br>
	<a class="btn btn-success text-white" data-toggle="modal" data-target="#agregar"> Registrar Compra </a>
	<br><br>

	<!-- lista de los insumos de la finca -->
	<table id="tabla" class="table">
		<thead>
			<tr>
				<th>Insumo</th>
				<th>Unidad</th>
				<th>Cantidad</th>
				<th>Valor Unitario</th>
			</tr>
		</thead>
		<tbody>
	<?php 
		$query = "SELECT b.id,b.cantidad,b.valor,i.nombre,i.unidad FROM bodega AS b INNER JOIN insumo AS i WHERE b.insumo_id = i.id AND finca_id=".$_SESSION['finca'];
		$sql = mysqli_query($conection,$query);
		if ($sql) {
			while ($row = mysqli_fetch_array($sql)) {
		?>
				<tr>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['unidad'] ?></td>
					<td><?php echo $row['cantidad'] ?></td>
					<td><?php echo $row['valor'] ?></td>
				</tr>
		<?php
			}
		}
		 ?>
		</tbody>
	</table>
</div>

</body>
<?php
include "end.php";
?>
<script src="../../js/datatables.min.js"></script>

<script>
	$(document).ready(function() {
      $('#tabla').DataTable({
        language: {
            search: "Buscar Registro",
                paginate: {
                  first:      "Primero",
                  previous:   "Anterior",
                  next:       "Siguiente",
                  last:       "Último"
                },
                "lengthMenu":     "Mostar _MENU_ Por Página",
                "zeroRecords": "No Se Encontraron Registros",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No Se Encontraron Registros",
                "infoFiltered": "(Se Filtraron _MAX_ Registros)",
            }
      });
    });

	//mostrar la unidad
	function unidadF(){
	var productoId = $('#insumo').val();
	$.ajax({
	  url: '../../php/Comprador/bodega.php',
	  type: 'POST',
	  dataType: 'json',
	  data: {op: 'unidad',id:productoId},
	})
	.done(function(data) {
	  $('#unidad').val(data.unidad);
	});

	}

	//calcular el valor total
	function calcular(){
	var valorUnidad = $('#valor_u').val();
	var cantidad = $('#cantidad').val();
	$('#valor').val(valorUnidad*cantidad)
	}


	function limpiar(){
		$('#add').trigger('reset');
	}

	function limpiar_p(){
		$('#agregar').modal('show');
		$('#add_proveedor').trigger('reset');
	}

	function add(){
		if (verificar()) {
			$.ajax({
				url: '../../php/Admin/insumo.php',
				type: 'POST',
				data: $('#add').serialize()+'&op=add',
			})
			.done(function(data) {
				if (data == "1") {
					swal('Buen Trabajo!','La Compra se registro correctamente','success')
					.then((res)=>{
						location.reload();
					});
				}else{
					swal('Error!',data,'error');
				}
			});
			
		}
	}

	function verificar(){
		var fecha = $('#fecha');
		var factura = $('#factura');
		var insumo = $('#insumo');
		var cantidad = $('#cantidad');
		var valor = $('#valor');

		if(fecha.val() == ""){
			swal({
				title: "Error!",
				text: "Debe ingresar una fecha para el registro",
				icon: "error",
				button: true,
			}).then((res)=>{
				fecha.focus();
			});
			return false;
		}

		if(factura.val() == ""){
			swal({
				title: "Error!",
				text: "Debe ingresar una factura para el registro",
				icon: "error",
				button: true,
			}).then((res)=>{
				factura.focus();
			});
			return false;
		}

		if(insumo.val() == ""){
			swal({
				title: "Error!",
				text: "Debe seleccionar un insumo para el registro",
				icon: "error",
				button: true,
			}).then((res)=>{
				insumo.focus();
			});
			return false;
		}

		if(cantidad.val() == ""){
			swal({
				title: "Error!",
				text: "Debe ingresar una cantidad para el registro",
				icon: "error",
				button: true,
			}).then((res)=>{
				cantidad.focus();
			});
			return false;
		}

		if(valor.val() == ""){
			swal({
				title: "Error!",
				text: "Debe ingresar un valor para el registro",
				icon: "error",
				button: true,
			}).then((res)=>{
				valor.focus();
			});
			return false;
		}
		return true;
	}

	function add_proveedor(){
		if (verificar_p()) {
			$.ajax({
				url: '../../php/Admin/proveedor.php',
				type: 'POST',
				dataType: 'json',
				data: $('#add_proveedor').serialize()+'&op=add',
			})
			.done(function(data) {
				$('#proveedor').prepend('<option value="'+data.id+'">'+data.nit+' - '+data.nombre+'</option>');
				$('#proveedores').modal('hide');
				$('#agregar').modal('show');
				$('#proveedor').focus();
			});
		}
	}

	function verificar_p(){
		var nit = $('#nit');
		var nombre = $('#nombre');
		var telefono = $('#telefono');

		if(nit.val() == ""){
			swal({
				title: "Error!",
				text: "Debe ingresar una nit para el proveedor",
				icon: "error",
				button: true,
			}).then((res)=>{
				nit.focus();
			});
			return false;
		}

		if(nombre.val() == ""){
			swal({
				title: "Error!",
				text: "Debe ingresar una nombre para el proveedor",
				icon: "error",
				button: true,
			}).then((res)=>{
				nombre.focus();
			});
			return false;
		}

		if(telefono.val() == ""){
			swal({
				title: "Error!",
				text: "Debe ingresar una telefono para el proveedor",
				icon: "error",
				button: true,
			}).then((res)=>{
				telefono.focus();
			});
			return false;
		}

		return true;
	}

</script>
</html>