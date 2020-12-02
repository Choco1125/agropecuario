<?php
	include 'key.php';
	if (!isset($_POST)) {
		return;
	}
 ?>
<table class="table" id="tabla_historial">
	<thead>
	<tr>
	  <th scope="col"> Fecha </th>
	  <th scope="col"> Cantidad </th>
	  <th scope="col"> Operación </th>
	  
	</tr>
	</thead>
	<tbody>

<?php 
	//Imprimimos los registros de la base DB
  	$bodega_id = $_POST['id'];
	include "../../php/conection.php";
	$query = "SELECT fecha, operacion,cantidad FROM historial WHERE bodega_id = $bodega_id";
	$sql = mysqli_query($conection, $query);
	if ($sql) {
		while ($row = mysqli_fetch_array($sql)) {
?>
	<tr>
	  <td> <?php echo $row['fecha'] ?> </td>
	  <td> <?php echo $row['cantidad'] ?> </td>
	  <td> 
			<?php 
				switch ($row['operacion']) {
					case '0':
						echo 'Retiro';
						break;
					case '1':
						echo 'Ingreso';
						break;
					case '2':
						echo 'Reajuste';
						break;
				}
			 ?>
	   </td>
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

