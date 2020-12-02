<table class="table" id="tabla_historial">
	<thead>
	<tr>
	  <th scope="col"> Fecha </th>
	  <th scope="col"> Nombre Empleado </th>
	  <th scope="col"> Operación </th>
	  
	</tr>
	</thead>
	<tbody>

<?php 
	//Imprimimos los registros de la base DB
  $id_insumo = $_POST['id'];
	include "../../php/conection.php";
	$query = "SELECT fecha, nombre_empleado, operacion FROM historial WHERE id_insumo = $id_insumo";
	$sql = mysqli_query($conection, $query);
	if ($sql) {
		while ($row = mysqli_fetch_array($sql)) {
?>
	<tr>
	  <td> <?php echo $row['fecha'] ?> </td>
	  <td> <?php echo utf8_encode($row['nombre_empleado']) ?> </td>
	  <td> <?php echo $row['operacion'] ?> </td>
	</tr>

<?php
		}
	}

 ?>
	
	</tbody>
</table>

<script src="../../js/datatables.min.js">  </script>

<script>
  //Paginacion de los datos
  $(document).ready(function() {
    $('#tabla_historial').DataTable({
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
</script>

