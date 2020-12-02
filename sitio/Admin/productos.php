<?php

include "main.php";

?> 
<link rel="stylesheet" type="text/css" href="../../css/select2.min.css">

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


<div class="container contenedor">
  <br>
  <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
  <br>
  <h2>Reportar Productos</h2>
  <br>
  <form id="add" method="POST">    

    <div class="form-group">
      <label for="fecha"> Fecha </label>
      <input name="fecha" type="date" class="form-control" id="fecha" placeholder="Ingrese el fecha" value="<?php 
                  $hoy = getdate();
                  if ($hoy['mon'] < 10){
                    $hoy['mon'] = '0'.$hoy['mon'];
                  }
                  if ($hoy['mday'] < 10){
                    $hoy['mday'] = '0'.$hoy['mday'];
                  }
                  echo $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
               ?>">
    </div>

    <div class="form-group">
      <label for="n_remision"> Número de remisión </label>
      <input name="n_remision" type="number" class="form-control" id="n_remision" placeholder="Ingrese el número de remisión">
    </div>

    <div class="form-group">
      <label for="lote">Seleccione un lote</label>
      <select class="form-control" name="lote" id="lote" onchange="cargarProductos()">
        <option value="">Seleccione un lote</option>
        <?php
          require '../../php/conection.php';
          $query = "SELECT l.id,l.nombre,c.nombre AS 'cultivo' FROM lote AS l INNER JOIN cultivo AS c WHERE l.cultivo_id = c.id AND l.id_finca=".$_SESSION['finca'];
          $sql = mysqli_query($conection,$query);
          if ($sql) {
            while ($row = mysqli_fetch_array($sql)) {
        ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'].' - '.$row['cultivo'] ?></option>
        <?php
            }
          }
         ?>
      </select>
    </div>
    <div class="form-group">
      <label for="producto">Producto</label>
      <select class="form-control" name="producto" id="producto">
        <option value="">Seleccione el producto</option>
      </select>
    </div>

    <div class="form-group">
      <label for="cantidad"> Cantidad </label>
      <input name="cantidad" type="number" class="form-control" id="cantidad" placeholder="Ingrese el cantidad del producto">
    </div>
    
    <div class="form-group">
      <label for="unidad"> Unidad / racimo </label>
      <input name="unidad" type="text" class="form-control" id="unidad" placeholder="Ingrese la unidad / racimo">
    </div>
    
    <div class="form-group">
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

    <div class="form-group">
      <label for="observacion"> Observaciones </label>
      <textarea class="form-control" name="observacion" id="observacion" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group text-center">
        <button type="button" onclick="add();" class="btn btn-success"> Registrar </button>      
    </div>

  </form>
</div>

</body>

<?php 
	include "end.php";
?>
<script src="../../js/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('#cliente').select2({
      dropdownParent: $('#add')
    });
    $('#lote').select2({
      dropdownParent: $('#add')
    });
  }); 

  //cargar productos del lote
  function cargarProductos(){
    var lote = $('#lote').val();
    if (lote != ''){
      var cultivo = $('#lote option[value='+lote+']').html().split(' - ');
      cultivo = cultivo[cultivo.length-1];
      $.ajax({
        url: '../../php/Admin/lotes.php',
        type: 'POST',
        dataType: 'html',
        data: {op: 'productos',cultivo: cultivo},
      })
      .done(function(data) {
        console.log(data);
        $('#producto').html(data);
        $('#producto').select2({
          dropdownParent: $('#add')
        });
      }).fail((res)=>{
        console.log(res);
      });
      
    }
  }


 //reportar envio de producto
function add(){
  var fecha = $('#fecha');    
  var n_remison = $('#n_remison');
  var lote = $('#lote'); 
  var producto = $('#producto'); 
  var cantidad = $('#cantidad');
  var unidad = $('#unidad');
  var cliente = $('#cliente');

  if (fecha.val() == "") {
    swal('Error!','Dede de seleccionar un fecha','error').then((res)=>{
      fecha.focus();
    });
    return;
  }

  if (n_remison.val() == "") {
    swal('Error!','Dede de ingresar un número de remisión','error').then((res)=>{
      n_remison.focus();
    });
    return;
  }

  if (lote.val() == "") {
    swal('Error!','Dede de seleccionar un lote','error').then((res)=>{
      lote.focus();
    });
    return;
  }

  if (cantidad.val() == "") {
    swal('Error!','Dede de ingresar una cantidad','error').then((res)=>{
      cantidad.focus();
    });
    return;
  }

  if (unidad.val() == "") {
    swal('Error!','Dede de ingresar una unidad / racimo','error').then((res)=>{
      unidad.focus();
    });
    return;
  }

   if (cliente.val() == "") {
    swal('Error!','Dede de seleccionar un cliente','error').then((res)=>{
      cliente.focus();
    });
    return;
  }

  $.ajax({
    url: '../../php/Admin/lotes.php',
    type: 'POST',
    data: $('#add').serialize()+'&op=add_reporte',
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
</script>


</html>