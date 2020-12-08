<?php

include "main.php";

?>

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

<div class="container contenedor">
  <br>
  <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
  <br>

  <br>
  <h3> Registrar Ventas</h3>
  <br>
  <form id="add_venta" method="POST">
    <div class="form-group">
      <label for="lote">Seleccione un lote</label>
      <select class="form-control" name="lote" id="lote">
        <option value="">Seleccione un lote</option>
        <?php
        require '../../php/conection.php';
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
      <label for="fecha"> Fecha </label>
      <input name="fecha" type="date" class="form-control" id="r_fecha" placeholder="Ingrese el fecha">
    </div>

    <div class="form-group">
      <label for="r_producto">Producto</label>
      <select class="form-control" name="producto" id="r_producto">
        <option value="">Seleccione el producto</option>
        <?php
        $query = "SELECT * FROM producto";
        $sql = mysqli_query($conection, $query);
        if ($sql) {
          while ($row = mysqli_fetch_array($sql)) {
        ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] . ' - ' . $row['unidad'] ?></option>
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
          $sql = mysqli_query($conection, $query);
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
        <a class="btn btn-success text-white" data-dismiss="modal" data-toggle="modal" data-target="#clientes">Crear Cliente</a>
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

    <div class="form-group text-center">
      <button type="button" onclick="add_venta();" class="btn btn-success"> Registrar </button>
    </div>

  </form>
</div>

</body>

<?php
include "end.php";
?>

<script>
  //registra una venta de producto
  function add_venta() {
    var fecha = $('#r_fecha');
    var producto = $('#r_producto');
    var cliente = $('#cliente');
    var cantidad = $('#r_cantidad');
    var valor = $('#valor');
    var pago = $('#pago');

    if (fecha.val() == "") {
      swal('Error!', 'Dede de ingresar una fecha', 'error').then((res) => {
        fecha.focus();
      });
      return;
    }

    if (producto.val() == "") {
      swal('Error!', 'Dede seleccionar un producto', 'error').then((res) => {
        producto.focus();
      });
      return;
    }

    if (cliente.val() == "") {
      swal('Error!', 'Dede seleccionar un cliente', 'error').then((res) => {
        cliente.focus();
      });
      return;
    }

    if (cantidad.val() == "") {
      swal('Error!', 'Dede de ingresar una cantidad', 'error').then((res) => {
        cantidad.focus();
      });
      return;
    }

    if (valor.val() == "") {
      swal('Error!', 'Dede de ingresar un valor', 'error').then((res) => {
        valor.focus();
      });
      return;
    }

    if (pago.val() == "") {
      swal('Error!', 'Dede seleccionar el tipo de pago', 'error').then((res) => {
        pago.focus();
      });
      return;
    }

    $.ajax({
        url: '../../php/Admin/lotes.php',
        type: 'POST',
        data: $('#add_venta').serialize() + '&op=add_venta',
      })
      .done(function(data) {
        if (data == '1') {
          swal('Buen Trabajo!', 'Venta registrado correctamente', 'success').then((res) => {
            location.reload();
          });
        } else {
          swal('Error!', data, 'error');
        }
      });
  }

  //registrar cliente
  function add_cliente() {
    var nit = $('#nit');
    var nombre = $('#nombre');
    var telefono = $('#telefono');

    if (nit.val() == "") {
      swal('Error!', 'Dede de ingresar un nit', 'error').then((res) => {
        nit.focus();
      });
      return;
    }

    if (nombre.val() == "") {
      swal('Error!', 'Dede de ingresar un nombre', 'error').then((res) => {
        nombre.focus();
      });
      return;
    }

    if (telefono.val() == "") {
      swal('Error!', 'Dede de ingresar un telefono', 'error').then((res) => {
        telefono.focus();
      });
      return;
    }

    $.ajax({
        url: '../../php/Admin/lotes.php',
        type: 'POST',
        dataType: 'json',
        data: $('#add_cliente').serialize() + '&op=add_cliente',
      })
      .done(function(data) {
        $('#cliente').prepend('<option value="' + data.id + '">' + data.nit + ' - ' + data.nombre + '</option>');
        $('#clientes').modal('hide');
        $('#registrar').modal('show');
      });
  }
</script>


</html>