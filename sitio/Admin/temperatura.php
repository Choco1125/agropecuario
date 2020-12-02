<?php 
	include "main.php";
 ?>

<link rel="stylesheet" href="../../css/datatables.min.css">

</body>

<style>
  .contenedor{
    overflow: auto;
    width: 100%;
  }

th, td {
  text-align: center;
}

i {
	color: white;
}

.swal-text {
  text-align: center !important; 
}

#imagen,#edit_imagen{
  display: none;
}

#previo{
  display: none;
}

#preview,#edit_preview{
  margin: 0px;
  height: 200px;
  width: 300px;
  display: block;
}

#preview>img{
  display: inline-block;
  height: 100%;
  width: 100%;
}

#edit_preview>img{
  display: inline-block;
  height: 100%;
  width: 100%;
}

.logos{
  height: 40px;
  width: 40px;
}

.logo_modal{
  height: 100%;
  width: 100%;
}

</style>

<!-- Modal para agregar -->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Agregar Registro </h5>
        <button type="button" onclick="limpiar();" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form id="add">

            <div class="form-group">
              <label for="semana"> Semana </label>
              <input name="semana" type="week" class="form-control" id="semana">
            </div>
            <label for="imagen" class="btn btn-success">Seleccione una imagen</label>
            <input id="imagen" type="file" />
            <hr>
            <div id="previo">
              <div class="row justify-content-center">
                <div id="preview"></div>                
              </div>
              <br>
              <div class="row justify-content-center"><button onclick="return limpiar_imagen();" class="btn btn-danger"> Quitar Imagen </button></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="limpiar();" data-dismiss="modal"> Cerrar </button>
          <button type="button" onclick="add();" class="btn btn-success"> Agregar Registro </button>
        </div>
    </div>
  </div>
</div>
<!-- Cierre modal para agregar -->

<!-- Modal para Mostrar imagenes -->
<div class="modal fade" id="logo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Ver </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="logo_modal" class="logo_modal" src="" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
      </div>
    </div>
  </div>
</div>
<!-- Cierre modal para Mostrar imagenes -->


<div class="container contenedor">

  <br>
  <a class="btn btn-success" href="index.php"><i class="fas fa-arrow-left"></i></a>
  <br>


<h3> Temperaturas - 
	<?php 
	    include "../../php/conection.php";
	    $query = "SELECT nombre FROM finca WHERE id = ".$_SESSION['finca'];
	    $sql = mysqli_query($conection, $query);
	    if ($sql) {
	      echo mysqli_fetch_array($sql)['nombre'];
	    }
	?>  
</h3>
  <br>

<!-- Boton para agregar-->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar">	Agregar Registro
</button>

<br><br>

<!-- Tabla para mostrar sociedades -->
<table class="table" id="tabla">
  <thead>
    <tr>
      <th scope="col"> Semana </th>
      <th scope="col"> Imagen </th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  		include "../../php/conection.php";
  		$query = "SELECT * FROM temperatura WHERE finca_id=".$_SESSION['finca'];
  		$sql = mysqli_query($conection, $query);
  		if ($sql) {
  			while ($row = mysqli_fetch_array($sql)) {
  		?>
  		<tr>
        <td> <?php 
        		$dato = explode('-W',$row['semana']);
        		echo 'Semana '.$dato[1].' del '.$dato[0];
        	 ?> </td>
  			<td> <img class="logos" src="<?php echo $row['imagen'] ?>" alt=""> </td>
  		</tr>
  		<?php
  			}
  		}
  	 ?>
   
  </tbody>
</table>
</div>




<?php
	include "end.php"; 
 ?>

<script src="../../js/datatables.min.js"> </script>
<script>

  $(document).ready(function() {
    $(".logos").click(function(){
      console.log(this.src);
      $('#logo_modal').attr('src',this.src);
      $('#logo').modal('show');
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
	});
  });

  //previsualizar imagen agregar
  document.getElementById("imagen").onchange = function(e) {
    let reader = new FileReader();

    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);
    
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function(){
      let preview = document.getElementById('preview'),
          image = document.createElement('img');
      image.src = reader.result;    
      preview.innerHTML = '';
      preview.prepend(image);
      $('#previo').css('display', 'block');
    };
  }

  //limpiar imagen
  function limpiar_imagen(){
    $('#imagen').val('');
    $('#previo').css('display', 'none');
    return false;
  }

  //Limpiar
  function limpiar(){
    $('#add').trigger("reset");
  }
  
  //Agregar
  function add(){
    var semana = $('#semana').val();
    var imagen = document.getElementById('imagen');
    var file = imagen.files[0];
    if(semana == ""){
      swal('Error!','Debe ingresar una semana','error');
      return;
    }
    if (file == undefined) {
      swal('Error!','Debe ingresar una imagen para el registro','error');
      return;
    }
  	var data = new FormData();
    data.append('semana',semana);
    data.append('imagen',file);
    data.append('op',"add");
  	$.ajax({
  		url: '../../php/Admin/temperatura.php',
  		type: 'POST',
		contentType: false,
		data: data,
		cache: false,
		processData: false
  	})
  	.done(function(data) {
  		if (data == "1") {
  			swal({
  				title: "Buen trabajo",
  				text: "El registro due agregado correctamente",
  				icon: "success",
  				button: true,
  			}).then((res)=>{
  				location.reload();
  			});
  		}else{
  			swal("Error", data,"error");
  		}
  	});
  }

</script>

</html>