<?php 
	include "main.php";
 ?>

<link rel="stylesheet" href="../../css/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">


<style>
	.contenedor{
		overflow: auto;
		width: 100%;
	}

th, td {
	text-align: center;
}

i.text-dark{
  float: right;
}

.fa-dollar-sign{
  margin-right: 8px;
}

#opciones{
  width: 220px;
}

.select2 {
  width: 100% !important;
}

</style>

<!-- Modal para agregar clientes -->
<div class="modal fade" id="clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar cliente </h5>
        <button type="button" onclick="limpiar_c();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add_cliente" method="POST">

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
          <button type="button" class="btn btn-danger" onclick="limpiar_c();" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="add_cliente();" class="btn btn-success"> Agregar cliente </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para agregar cliente -->

<!-- Modal para reportar los productos -->
<div class="modal fade" id="reportar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Registrar despache </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add" method="POST">

            <div class="form-group">
              <label for="fecha"> Fecha </label>
              <input name="fecha" type="date" class="form-control" id="fecha" placeholder="Ingrese el fecha">
            </div>

            <div class="form-group">
              <label for="producto">Producto</label>
              <select class="form-control" name="producto" id="producto">
                <option value="">Seleccione el producto</option>
<?php 
  include "../../php/conection.php";
  $query = "SELECT * FROM producto";
  $sql = mysqli_query($conection,$query);
  if ($sql) {
    while ($row = mysqli_fetch_array($sql)) {
?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'].' - '.$row['unidad'] ?></option>
<?php
    }
  }

 ?>
              </select>
            </div>

            <div class="form-group">
              <label for="cantidad"> Cantidad </label>
              <input name="cantidad" type="number" class="form-control" id="cantidad" placeholder="Ingrese el cantidad del producto">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="add();" class="btn btn-success"> Registrar </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para reportar los productos -->

<!-- Modal para registrar ventas -->
<div style="overflow-y: scroll;" class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Registrar Venta </h5>
        <button type="button" onclick="limpiar_r();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add_venta" method="POST">

            <div class="form-group">
              <label for="fecha"> Fecha </label>
              <input name="fecha" type="date" class="form-control" id="r_fecha" placeholder="Ingrese el fecha">
            </div>

            <div class="form-group">
              <label for="r_producto">Producto</label>
              <select class="form-control" name="producto" id="r_producto">
                <option value="">Seleccione el producto</option>
<?php 
  include "../../php/conection.php";
  $query = "SELECT * FROM producto";
  $sql = mysqli_query($conection,$query);
  if ($sql) {
    while ($row = mysqli_fetch_array($sql)) {
?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'].' - '.$row['unidad'] ?></option>
<?php
    }
  }

 ?>
              </select>
            </div>

            <div class="row align-items-end">
              <div class="col-12 col-md-9">
                <label for="cliente">Seleccione un cliente</label>
                <select name="cliente" id="cliente" class="form-control">
                  <option value="">Seleccione un cliente</option>
    <?php 
      $query = "SELECT * FROM cliente";
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
                <a class="btn btn-success" data-dismiss="modal"  data-toggle="modal" data-target="#clientes">Agregar Cliente</a>
              </div>
            </div>

            <div class="form-group">
              <label for="r_cantidad"> Cantidad </label>
              <input name="cantidad" type="number" class="form-control" id="r_cantidad" placeholder="Ingrese el cantidad del producto">
            </div>

            <div class="form-group">
              <label for="valor"> Valor </label>
              <input name="valor" type="number" class="form-control" id="valor" placeholder="Ingrese el valor">
            </div>

            <div class="form-group">
              <label for="n_remision"> Número de remisión </label>
              <input name="n_remision" type="number" class="form-control" id="n_remision" placeholder="Ingrese el número de remisión ">
            </div>

            <div class="form-group">
              <label for="pago"> Tipo de Pago </label>
              <select class="form-control" name="pago" id="pago">
                <option value="">seleccione el tipo de pago</option>
                <option value="Efectivo">Efectivo</option>
                <option value="Cheque">Cheque</option>
              </select>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="limpiar_r();" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="add_venta();" class="btn btn-success"> Registrar </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para registrar ventas -->

<!-- Inicio del contenido de la página -->
<div class="container-fluid contenedor">
  <br>
  <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>

  <br><br>

  <h3> Lotes - 
  <?php 
    $query = "SELECT nombre FROM finca WHERE id = ".$_SESSION['finca'];
    $sql = mysqli_query($conection, $query);
    if ($sql) {
      echo mysqli_fetch_array($sql)['nombre'];
    }
  ?> 
  </h3>
  <br>

	<table class="table" id="tabla">
  <thead>
    <tr>
      <th scope="col"> Nombre Lote </th>
      <th scope="col"> Producto </th>
      <th scope="col"> Variedad </th>
      <th scope="col"> Cantidad </th>
      <th scope="col"> Fecha siembra </th>
      <th scope="col"> Distancia</th>
      <th scope="col"> Area </th>
      <th scope="col"> ASNM  </th>
      <th scope="col"> Labores  </th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  		include "../../php/conection.php";
      $id_finca  = $_SESSION['finca'];
  		$query = "SELECT l.id,l.nombre,c.nombre AS 'cultivo',l.variedad,l.cantidad,l.fecha_siembra,l.distancia_siembra,l.area,l.asnm FROM lote AS l INNER JOIN cultivo AS c WHERE l.id_finca='$id_finca' AND c.id = l.cultivo_id";
  		$sql = mysqli_query($conection, $query);
  		if ($sql) {
  			while ($row = mysqli_fetch_array($sql)) {
  			?> 
			<tr>
				<td> <?php echo $row['nombre'] ?> </td>
				<td> <?php echo $row['cultivo'] ?> </td>
				<td> <?php echo $row['variedad'] ?> </td>
				<td> <?php echo $row['cantidad'] ?> </td>
				<td> <?php echo $row['fecha_siembra'] ?> </td>
        <td> <?php echo $row['distancia_siembra'] ?> </td>
        <td> <?php echo $row['area'] ?> </td>
        <td> <?php echo $row['asnm'] ?> </td>
        <td>
        <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="acciones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opciones </button>
          <div id="opciones" class="dropdown-menu" aria-labelledby="acciones">
            <a class="dropdown-item" onclick="asignar_lote(<?php echo $row['id'] ?>);" href="#" data-toggle="modal" data-target="#registrar">
              Registrar Venta<i class="text-dark fas fa-pen"></i>
            </a> 
            <a class="dropdown-item" onclick="asignar_lote(<?php echo $row['id'] ?>);" href="#" data-toggle="modal" data-target="#reportar">
              Reportar productos<i class="text-dark fas fa-pen"></i>
            </a>            
          </div>
      </div>
        </td>
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
<script src="../../js/select2.min.js"></script>
<script>
var lote;

function asignar_lote(id){
  lote = id;
}

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
      })
    });

//Limpiar
function limpiar(){
  $('#add').trigger("reset");
}

function limpiar_c(){
  $('#add_cliente').trigger("reset");
  $('#registrar').modal('show');
}

function limpiar_r(){
  $('#add_venta').trigger("reset");
}

//reportar envio de producto
function add(){
  var fecha = $('#fecha');    
  var producto = $('#producto');    
  var cantidad = $('#cantidad');

  if (fecha.val() == "") {
    swal('Error!','Dede de seleccionar un fecha','error').then((res)=>{
      fecha.focus();
    });
    return;
  }

  if (producto.val() == "") {
    swal('Error!','Dede de seleccionar un producto','error').then((res)=>{
      producto.focus();
    });
    return;
  }

  if (cantidad.val() == "") {
    swal('Error!','Dede de ingresar una cantidad','error').then((res)=>{
      cantidad.focus();
    });
    return;
  }

  $.ajax({
    url: '../../php/Admin/lotes.php',
    type: 'POST',
    data: $('#add').serialize()+'&op=add_reporte&lote='+lote,
  })
  .done(function(data) {
    if (data == '1') {
      swal('Buen Trabajo!','Reporte agregado correctamente','success').then((res)=>{
        location.reload();
      });      
    }else{
      swal('Error!',data,'error');
    }
  });
}

//registra una venta de producto
function add_venta(){
  var fecha = $('#r_fecha');
  var producto = $('#r_producto');
  var cliente = $('#cliente');
  var cantidad = $('#r_cantidad');
  var valor = $('#valor');
  var pago = $('#pago');

  if (fecha.val() == "") {
    swal('Error!','Dede de ingresar una fecha','error').then((res)=>{
      fecha.focus();
    });
    return;
  }

  if (producto.val() == "") {
    swal('Error!','Dede seleccionar un producto','error').then((res)=>{
      producto.focus();
    });
    return;
  }

  if (cliente.val() == "") {
    swal('Error!','Dede seleccionar un cliente','error').then((res)=>{
      cliente.focus();
    });
    return;
  }

  if (cantidad.val() == "") {
    swal('Error!','Dede de ingresar una cantidad','error').then((res)=>{
      cantidad.focus();
    });
    return;
  }

  if (valor.val() == "") {
    swal('Error!','Dede de ingresar un valor','error').then((res)=>{
      valor.focus();
    });
    return;
  }

  if (pago.val() == "") {
    swal('Error!','Dede seleccionar el tipo de pago','error').then((res)=>{
      pago.focus();
    });
    return;
  }

  $.ajax({
    url: '../../php/Admin/lotes.php',
    type: 'POST',
    data: $('#add_venta').serialize()+'&op=add_venta&lote='+lote,
  })
  .done(function(data) {
    if (data == '1') {
      swal('Buen Trabajo!','Venta registrado correctamente','success').then((res)=>{
        location.reload();
      });      
    }else{
      swal('Error!',data,'error');
    }
  });  
}


//registrar cliente
function add_cliente(){
  var nit = $('#nit');
  var nombre = $('#nombre');
  var telefono = $('#telefono');

  if (nit.val() == "") {
    swal('Error!','Dede de ingresar un nit','error').then((res)=>{
      nit.focus();
    });
    return;
  }

  if (nombre.val() == "") {
    swal('Error!','Dede de ingresar un nombre','error').then((res)=>{
      nombre.focus();
    });
    return;
  }

  if (telefono.val() == "") {
    swal('Error!','Dede de ingresar un telefono','error').then((res)=>{
      telefono.focus();
    });
    return;
  }

  $.ajax({
    url: '../../php/Admin/lotes.php',
    type: 'POST',
    dataType: 'json',
    data: $('#add_cliente').serialize()+'&op=add_cliente',
  })
  .done(function(data) {
    $('#cliente').prepend('<option value="'+data.id+'">'+data.nit+' - '+data.nombre+'</option>');
    $('#clientes').modal('hide');
    $('#registrar').modal('show');
  });
}
</script>

</html>
