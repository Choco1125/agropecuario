<?php

include "main.php";

?>

 <link rel="stylesheet" type="text/css" href="../../../css/select2.min.css">
<link rel="stylesheet" href="../../../css/datatables.min.css">

<style>
.select2{
    width: 100% !important;
  }

.contenedor {
	overflow: auto;
	width: 100%;
}

th, td {
	text-align: center;
}

i {
	color: white;
}

</style>

<!-- Modal para agregar -->
<div class="modal fade" id="agregar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar Gasto </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add" method="POST">
            <input type="hidden" value="0" name="tipo">

            <div class="form-group">
              <label for="fecha"> Fecha </label>
              <input name="fecha" type="date" class="form-control" id="fecha" placeholder="Ingrese el fecha">
            </div>

            <!-- rubros -->
            <div class="form-group">
              <label for="rubro">Seleccione un rubro</label>
              <select class="form-control" name="rubro" id="rubro">
                <option value="">seleccione un rubro</option>
<?php 
  include '../../../php/conection.php';
  $query = "SELECT * FROM rubro_administrativo";
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


      			<div class="form-group">
        			<label for="valor"> Valor </label>
        			<input name="valor" type="number" class="form-control" id="valor" placeholder="Ingrese el valor">
      			</div>

      			<div class="form-group">
        			<label for="n_factura"> Número de Factura </label>
        			<input name="n_factura" type="text" class="form-control" id="n_factura" placeholder="Ingrese el teléfono">
      			</div>

            <div class="form-group">
              <label for="observacion">Observaciones</label>
              <textarea class="form-control" name="observacion" id="observacion" cols="30" rows="10"></textarea>
            </div>


          </form>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
	        <button type="button" onclick="add();" class="btn btn-success"> Registrar </button>
	      </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar -->


<div class="container contenedor">
  <br>
  <div class="row">
    <div class="col-2 text-center">
      <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="col-10">
      <h3 class="text-center"> Presupuesto / Gastos Administrativos </h3>
    </div>
  </div>
  <br>

	<!-- Boton para agregar clientes -->
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar_cliente">
		Agregar Gasto
	</button>

	<!-- Tabla para mostrar los gastos -->
	<br><br>
	<table class="table" id="tabla">
	<thead>
	<tr>
	  <th scope="col"> Fecha </th>
	  <th scope="col"> # Factura </th>
    <th scope="col"> Rubro </th> 
    <th scope="col"> Valor </th>
    <th scope="col"> Observaciones </th>
	</tr>
	</thead>
		<tbody>
			<?php 
				$query = "SELECT g.fecha,g.n_factura,r.nombre,g.valor,g.observacion FROM gastos_administrativos AS g INNER JOIN rubro_administrativo AS r WHERE g.rubro_id = r.id AND g.tipo = 0 AND g.finca_id=".$_SESSION['finca'];
				$sql = mysqli_query($conection, $query);
				if ($sql) {
					while ($row = mysqli_fetch_array($sql)) {
						?>
						<tr>
							<td> <?php echo $row['fecha'] ?> </td>
							<td> <?php echo $row['n_factura'] ?> </td>
              <td> <?php echo $row['nombre'] ?> </td>
              <td> $<?php echo number_format($row['valor']) ?> </td>
              <td> <?php echo $row['observacion'] ?> </td>
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

<script src="../../../js/select2.min.js"></script>
<script src="../../../js/datatables.min.js"></script>

<script>

  $(document).ready(function() {
    $('#rubro').select2({
      dropdownParent: $('#add')
    });
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
      })
   });

 //Limpiar
function limpiar(){
  $('#add').trigger("reset");
}
 
//Agregar
function add(){
	if (verificar()) {
    $.ajax({
      url: '../../../php/Admin/gastos_otros.php',
      type: 'POST',
      data: $('#add').serialize()+'&op=add_administrativos',
    })
    .done(function(data) {
      if (data == '1') {
        swal('Buen Trabajo!','Gasto registrado correctamente','success').then((res)=>{
          location.reload();
        });
      }else{
        swal("Error!",data,'error');
      }
    });
    
  }
}

function verificar(){
  var fecha = $('#fecha');
  var rubro = $('#rubro');
  var valor = $('#valor');

  if (fecha.val() == "") {
    swal('Error!','Debe ingresar la fecha para poder registrar el gasto.','error')
    .then((res)=>{fecha.focus()});
    return false;
  }

   if (rubro.val() == "") {
    swal('Error!','Debe seleccionar un rubro para poder registrar el gasto.','error')
    .then((res)=>{rubro.focus()});
    return false;
  }

   if (valor.val() == "") {
    swal('Error!','Debe ingresar el valor para poder registrar el gasto.','error')
    .then((res)=>{valor.focus()});
    return false;
  }

  return true;

}

</script>


</html>