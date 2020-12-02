<?php 
	include ("main.php");
 ?>

<link rel="stylesheet" href="../../css/datatables.min.css">

<style>

	.contenedor {
	overflow: auto;
	width: 100%;
	}

	th, tr {
		text-align: center;
	}

	a {
	color: black;
	}

</style>


<!-- Modal para insumos -->
<div class="modal fade" id="modal_insumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Insumos </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"> &times; </span>
        </button>
      </div>
      <div id="contenido_insumos" class="modal-body">

      	<!-- Aqui se muestra el contenido con un ajax -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para emplados -->
<div class="modal fade" id="modal_empleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Empleados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="contenido_empleados" class="modal-body">
      	
      	<!-- Aqui se muestra el contenido con un ajax -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar </button>
      </div>
    </div>
  </div>
</div>

<!-- Menu labores -->
<div class="container-fluid contenedor">
	<br>
	<h2>Lote: <?php 
		include "../../php/conection.php";
		$query = "SELECT nombre FROM lote WHERE id=".$_GET['lote'];
		$sql = mysqli_query($conection,$query);
		if ($sql) {
			echo mysqli_fetch_array($sql)['nombre'];
		}

	 ?></h2>
	<br><br>
	<ul class="nav nav-tabs" id="myTab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#menu1" role="tab" aria-controls="home" aria-selected="true"> Ejecutadas </a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#menu2" role="tab" aria-controls="profile" aria-selected="false"> Pendientes </a>
	  </li>
	</ul>

	<div class="tab-content" id="myTabContent">
	  <div class="tab-pane fade show active" id="menu1" role="tabpanel" aria-labelledby="home-tab">
	  <br><br> 
  		<!-- Se muestran las tareas ejecutadas -->
		<table id="labores_e" class="table">
			<thead>
				<tr>
				<th scope="col"> Fecha </th>
				<th scope="col"> Trabajo </th>
				<th scope="col"> Empelado(s) </th>
				<th scope="col"> Costo </th>
				<th scope="col"> Insumos </th>
				<th scope="col"> Costo Total </th>
				<th scope="col"> Observaciones </th>
				<th scope="col"> Tipo de labor </th>
				<th scope="col"> Eliminar </th>
				</tr>
			</thead>
		<?php
		// Imprimimos los registros de la base DB
		// Imprimimos los registros de la base DB
		$lote_id = $_GET['lote'];
		$query = "SELECT r.id,r.fecha,r.valor,r.observacion,r.tipo,r.estado,l.nombre FROM registro_labor AS r INNER JOIN labores AS l WHERE r.lote_id='$lote_id' AND l.id=r.labor_id AND r.labor=1";
		$sql = mysqli_query($conection,$query);
		if ($sql) {
			while ($row = mysqli_fetch_array($sql)) {
		?>			
			<tbody>
			<tr>
				<td> <?php echo $row['fecha'] ?></td>
				<td> <?php echo $row['nombre'] ?></td>
		  		<td>
					<button type="button" onclick="empleados(<?php echo $row['id'].','.$row['tipo'] ?>);" class="btn btn-primary" data-toggle="modal" data-target="#modal_empleados"> Ver </button> 
		  		</td>
		  		<td> <?php echo $row['valor'] ?> </td>
		  		<td> 
		  			<button type="button" onclick="insumos(<?php echo $row['id'] ?>);" class="btn btn-primary" data-toggle="modal" data-target="#modal_insumos"> Ver </button> 
		  		</td>
		  		<td>
		  			<?php 
		  				$valor = $row['valor'];
		  				$query = "SELECT * FROM bodega_labor WHERE registro_id=".$row['id'];
						$insumos = mysqli_query($conection,$query);
						if (mysqli_num_rows($insumos) > 0) {
							$query = "SELECT id,nombre FROM insumo";
							$insumos = mysqli_query($conection,$query);
							if ($insumos) {
								while ($dat = mysqli_fetch_array($insumos)) {
									$query = "SELECT SUM(r.valor*r.cantidad) AS 'valor' FROM bodega_labor AS r INNER JOIN bodega AS b WHERE registro_id=".$row['id']." AND bodega_id=b.id AND b.insumo_id=".$dat['id'];
									$aux = mysqli_query($conection,$query);
									if ($aux) {
										$num = mysqli_num_rows($aux);
										$aux = mysqli_fetch_array($aux);
										if ($num > 0) {
											$valor += $aux['valor'];
										}
									}
								}
							}
						}
						echo $valor;
		  			 ?>		  			 
		  		</td>
		  		<td><?php echo $row['observacion'] ?></td>
		  		<td>
		  			<?php 
		  				switch ($row['tipo']) {
		  					case '0':
		  						echo 'Al día';
		  						break;
		  					case '1':
		  						echo 'Al contrato';
		  						break;		  					
		  				}
		  			 ?>
		  		</td>
		  		<td> 
		  			<button type="button" onclick="eliminar_e(<?php echo $row['id'] ?>);" class="btn btn-primary"> Eliminar </button> 
		  		</td> 		
			</tr>

		<?php
		}
	}


 ?>
			
		</tbody>
	</table>
</div>
		
<br><br>

<div class="tab-pane fade show" id="menu2" role="tabpanel" aria-labelledby="profile-tab">
	<!-- Se muestran las tareas pendientes  -->
	<table id="labores_p" class="table">
			<thead>
				<tr>
				<th scope="col"> Fecha </th>
				<th scope="col"> Trabajo </th>
				<th scope="col"> Empelado(s) </th>
				<th scope="col"> Costo </th>
				<th scope="col"> Insumos </th>
				<th scope="col"> Costo Total </th>
				<th scope="col"> Observaciones </th>
				<th scope="col"> Tipo de labor </th>
				<th scope="col"> Eliminar </th>
				</tr>
			</thead>
		<?php
		// Imprimimos los registros de la base DB
		// Imprimimos los registros de la base DB
		$lote_id = $_GET['lote'];
		include "../../php/conection.php";
		$query = "SELECT r.id,r.fecha,r.valor,r.observacion,r.tipo,r.estado,l.nombre FROM registro_labor AS r INNER JOIN labores AS l WHERE r.lote_id='$lote_id' AND l.id=r.labor_id AND r.labor=0";
		$sql = mysqli_query($conection,$query);
		if ($sql) {
			while ($row = mysqli_fetch_array($sql)) {
		?>			
			<tbody>
			<tr>
				<td> <?php echo $row['fecha'] ?></td>
				<td> <?php echo $row['nombre'] ?></td>
		  		<td> <?php echo $row['estado'] ?> </td>
		  		<td> <?php echo $row['valor'] ?> </td>
		  		<td> 
		  			<button type="button" onclick="insumos(<?php echo $row['id'] ?>);" class="btn btn-primary" data-toggle="modal" data-target="#modal_insumos"> Ver </button> 
		  		</td>
		  		<td>
		  			<?php 
		  				$valor = $row['valor'];
		  				$query = "SELECT * FROM bodega_labor WHERE registro_id=".$row['id'];
						$insumos = mysqli_query($conection,$query);
						if (mysqli_num_rows($insumos) > 0) {
							$query = "SELECT id,nombre FROM insumo";
							$insumos = mysqli_query($conection,$query);
							if ($insumos) {
								while ($dat = mysqli_fetch_array($insumos)) {
									$query = "SELECT SUM(r.valor*r.cantidad) AS 'valor' FROM bodega_labor AS r INNER JOIN bodega AS b WHERE registro_id=".$row['id']." AND bodega_id=b.id AND b.insumo_id=".$dat['id'];
									$aux = mysqli_query($conection,$query);
									if ($aux) {
										$num = mysqli_num_rows($aux);
										$aux = mysqli_fetch_array($aux);
										if ($num > 0) {
											$valor += $aux['valor'];
										}
									}
								}
							}
						}
						echo $valor;
		  			 ?>
		  		</td>
		  		<td><?php echo $row['observacion'] ?></td>
		  		<td>
		  			<?php 
		  				switch ($row['tipo']) {
		  					case '0':
		  						echo 'Al día';
		  						break;
		  					case '1':
		  						echo 'Al contrato';
		  						break;		  					
		  				}
		  			 ?>
		  		</td>
		  		<td> 
		  			<button type="button" onclick="eliminar_p(<?php echo $row['id'] ?>);" class="btn btn-primary"> Eliminar </button> 
		  		</td> 		
			</tr>

		<?php
		}
	}


 ?>
			
		</tbody>
	</table>
	  </div>
	</div>
</div>

</body>

<?php 
	include ("end.php");
 ?>

<script src="../../js/datatables.min.js"> </script>
<script>
	
	$(document).ready(function() {
	    $('.table').DataTable({
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

 	function eliminar_p(id){
 		swal({
			title: "Advertencia",
			text: "¿Seguro de querer eliminar este registro?",
			icon: "warning",
			buttons: true,
		}).then((res)=>{
			if(res){
				$.ajax({
					url: '../../php/Owner/labores.php',
					type: 'POST',
					data: {id: id,op:'eliminar_p'},
				})
				.done(function(data) {
					if (data == "1") {
						swal('Buen Trabajo!','Registro eliminado correctamente','succes').then((res)=>{
							location.reload();
						});		
					}else{
						swal('Error!',data,'error');
					}
				});
				
			}
		});
 	}

 	function eliminar_e(id){
 		swal({
			title: "Advertencia",
			text: "¿Seguro de querer eliminar este registro?",
			icon: "warning",
			buttons: true,
		}).then((res)=>{
			if(res){
				$.ajax({
					url: '../../php/Owner/labores.php',
					type: 'POST',
					data: {id: id,op:'eliminar_e'},
				})
				.done(function(data) {
					if (data == "1") {
						swal('Buen Trabajo!','Registro eliminado correctamente','succes').then((res)=>{
							location.reload();
						});						
					}else{
						swal('Error!',data,'error');
					}
				});
				
			}
		});
 	}

 	function insumos(id){
 		$.ajax({
	 		url: '../../php/Owner/labores.php',
	 		type: 'POST',
	 		data: {id: id, op:'insumos'}
 		}).done(function(data) {
 			console.log(data);
	 		$('#contenido_insumos').html(data);
	 		$('#tabla_i').DataTable({
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
 		}).fail(function(data){
 			console.lo(data);
 		});
 	}

 	function empleados(id,tipo){
 		switch(tipo){
 			case 0:
 				tipo ='empleados_dia';
 			break;
 			case 1:
 				tipo ='empleados_contrato';
 			break;
 		}
 		$.ajax({
	 		url: '../../php/Owner/labores.php',
	 		type: 'POST',
	 		data: {id: id, op:tipo}
	 	})
	 	.done(function(data) {
	 		$('#contenido_empleados').html(data);
	 		$('#tabla_e').DataTable({
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

 	}

 </script>
</html>