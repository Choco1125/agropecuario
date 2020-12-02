<?php 
  include 'main.php';
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
.alto{
  height: 500px !important;
  overflow-y: auto;
  overflow-x: hidden;
}

#registrar>.modal-dialog{
  max-width: none !important;
  margin:3%;
}

</style>

<!-- Modal para agregar clientes -->
<div class="modal fade" id="clientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Crear cliente </h5>
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

<!-- Modal para registrar ventas -->
<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <di class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Registrar Venta </h5>
        <button type="button" onclick="limpiar_r();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              
            <div class="col-12 col-md-6 alto">
              <h2>Aquí puedes buscar los despaches de la finca en un rango de fecha</h2>
              <div class="row align-items-center">
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio</label>
                    <input name="fecha_inicio" id="fecha_inicio" class="form-control" type="date"></div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label for="fecha_final">Fecha final</label>
                    <input name="fecha_final" id="fecha_final" class="form-control" type="date"></div>
                </div>
                <div class="col-12 col-md-4 ">
                  <div class="form-group align-items-center">
                    <label style="visibility: hidden;" for=""> kjnksdnjksdnjfknsdjk </label>
                    <button onclick="consultar()" class="btn btn-success">Consultar</button>
                  </div>
                </div>
                <div style="width: 90%" id="datos">
                  
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
            <form class="alto" id="add_venta" method="POST">

              <div class="form-group">
                <label for="fecha"> Fecha </label>
                <input name="fecha" type="date" value="<?php 
                    $hoy = getdate();
                    if ($hoy['mon'] < 10){
                      $hoy['mon'] = '0'.$hoy['mon'];
                    }
                    if ($hoy['mday'] < 10){
                      $hoy['mday'] = '0'.$hoy['mday'];
                    }
                    echo $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                 ?>" class="form-control" id="r_fecha" placeholder="Ingrese el fecha">
              </div>


              <div class="form-group">
                <label for="n_remision"> Número de remisión </label>
                <input name="n_remision" type="number" class="form-control" id="n_remision" placeholder="Ingrese el número de remisión ">
              </div>




              <div class="form-group">
                <label for="r_lote">Lote</label>
                <select class="form-control" name="lote" id="r_lote" onchange="cargarProductos()">
                  <option value="">Seleccione el lote</option>
  <?php 
    include "../../php/conection.php";
    $query = "SELECT l.id,l.nombre,c.nombre AS 'cultivo' FROM lote AS l INNER JOIN cultivo AS c WHERE l.cultivo_id=c.id AND id_finca=".$_SESSION['finca'];
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

              <div class="row">
                <div class="col-12 col-md-8">
                  <div class="form-group">
                    <label for="r_producto">Producto</label>
                    <select class="form-control" name="producto" id="r_producto" onchange="unidadF();">
                      <option value="">Seleccione el producto</option>
     
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

              <div class="form-group">
                <label for="r_cantidad"> Cantidad </label>
                <input name="cantidad" onchange="calcular();" type="number" class="form-control" id="r_cantidad" placeholder="Ingrese el cantidad del producto">
              </div>

              <div class="form-group">
                <label for="valor_u"> Valor kilo </label>
                <input name="valor_u" onchange="calcular();" type="number" class="form-control" id="valor_u" placeholder="Ingrese el valor unitario">
              </div>

              <div class="form-group">
                <label for="valor"> Valor </label>
                <input name="valor" type="number" class="form-control" id="valor" placeholder="Ingrese el valor">
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
                  <a class="btn btn-success text-white" data-dismiss="modal"  data-toggle="modal" data-target="#clientes">Crear Cliente</a>
                </div>
              </div>
              <br>

              <div class="form-group">
                <label for="pago"> Tipo de Pago </label>
                <select class="form-control" name="pago" id="pago">
                  <option value="">seleccione el tipo de pago</option>
                  <option value="Efectivo">Efectivo</option>
                  <option value="Transferencia">Transferencia</option>
                </select>
              </div>

            </form>
              
            </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="limpiar_r();" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="add_venta();" class="btn btn-success"> Registrar </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre de modal para registrar ventas -->


<div class="container contenedor">

<!-- Boton para agregar usuarios -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#registrar">  Agregar Venta
</button>

<br><br>

<!-- Tabla para mostrar fincas -->
<link rel="stylesheet" href="../../css/datatables.min.css">

<table class="table" id="tabla">
  <thead>
    <tr>
      <th>Fecha</th>
      <th># Remisión</th>
      <th>Lote</th>
      <th>Producto</th>
      <th>Usuario</th>
      <th>Cliente</th>
      <th>Cantidad</th>
      <th>Tipo de Pago</th>
      <th>Valor</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      include "../../php/conection.php";

      //lote producto cliente usuario
      $finca_id = $_SESSION['finca'];
      $query = "SELECT v.fecha,v.valor,v.cantidad,v.n_remision,v.pago,l.nombre AS 'lote',p.nombre AS 'producto',c.nombre AS 'cliente',u.nombre,u.apellido FROM ventas AS v INNER JOIN lote AS l INNER JOIN producto AS p INNER JOIN cliente AS c INNER JOIN usuarios AS u WHERE l.id_finca='$finca_id' AND v.lote_id=l.id AND v.producto_id=p.id AND v.cliente_id=c.id AND v.usuario_id=u.id";
      $sql = mysqli_query($conection,$query);
      if ($sql) {
        while ($row = mysqli_fetch_array($sql)) {
      ?>
      <tr>
        <td> <?php echo $row['fecha'] ?> </td>
        <td> <?php echo $row['n_remision'] ?> </td>
        <td> <?php echo $row['lote'] ?> </td>
        <td> <?php echo $row['producto'] ?> </td>
        <td> <?php echo $row['nombre'].' '.$row['apellido'] ?> </td>
        <td> <?php echo $row['cliente'] ?> </td>
        <td> <?php echo $row['cantidad'] ?> </td>
        <td> <?php echo $row['pago'] ?> </td>
        <td> <?php echo $row['valor'] ?> </td>
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
  include 'end.php';
 ?>
<script src="../../js/select2.min.js"></script>

<script>

  $(document).ready(function() {
    $('#cliente').select2({
      dropdownParent: $('#add_venta')
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

  function consultar(){
    fecha_inicio = $('#fecha_inicio');
    fecha_final = $('#fecha_final');

    if (fecha_inicio.val() == '') {
      swal('Error!','Debe de seleccionar una fecha de inicio','error').then((res)=>{
        fecha_inicio.focus();
      });
      return;
    }

    if (fecha_final.val() == '') {
      swal('Error!','Debe de seleccionar una fecha final','error').then((res)=>{
        fecha_final.focus();
      });
      return;
    }



    $.ajax({
      url: '../../php/Vendedor/ventas.php',
      type: 'POST',
      dataType: 'html',
      data: {op: 'consultar',
      fecha_inicio:fecha_inicio.val(),
      fecha_final:fecha_final.val()},
    })
    .done(function(data) {
      $('#datos').html(data);
    });
    
  }

  function cargarProductos(){
    var lote = $('#r_lote').val();
    if (lote != ''){
      var cultivo = $('#r_lote option[value='+lote+']').html().split(' - ');
      cultivo = cultivo[cultivo.length-1];
      $.ajax({
        url: '../../php/Vendedor/ventas.php',
        type: 'POST',
        dataType: 'html',
        data: {op: 'productos',cultivo: cultivo},
      })
      .done(function(data) {
        $('#r_producto').html(data);
        unidadF();
      });
      
    }
  }
  
  function limpiar_c(){
    $('#add_cliente').trigger("reset");
    $('#registrar').modal('show');
  }

  //mostrar la unidad
  function unidadF(){
    var productoId = $('#r_producto').val();
    $.ajax({
      url: '../../php/Vendedor/ventas.php',
      type: 'POST',
      dataType: 'json',
      data: {op: 'unidad',id:productoId},
    })
    .done(function(data) {
      $('#unidad').val(data.unidad);
    });
    
  }


//calcular valor total
function calcular(){
  var cantidad = $('#r_cantidad').val();
  var valorUnitario = $('#valor_u').val();
  var total = cantidad * valorUnitario;
  $('#valor').val(total);
}

function limpiar_r(){
  $('#add_venta').trigger("reset");
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
    url: '../../php/Vendedor/ventas.php',
    type: 'POST',
    data: $('#add_venta').serialize()+'&op=add_venta',
  })
  .done(function(data) {
    if (data == '1') {
      swal('Buen Trabajo!','Venta registrado correctamente','success').then((res)=>{
        limpiar_r();
      });      
    }else{
      swal('Error!',data,'error');
    }
  });  
}


//registrar cliente
function add_cliente(){
  alert('jsdbfdsbhfsd');
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
    url: '../../php/Vendedor/ventas.php',
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
<html>
