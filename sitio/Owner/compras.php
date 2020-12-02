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

</style>

<br><br>
<div class="container contenedor ">

<?php 
  if (isset($_GET['finca'])){
?>


<!-- Tabla de bodega -->
<table class="table" id="tabla">
  <thead>
    <tr>
      <th scope="col"> Comprador </th>
      <th scope="col"> Nombre </th>
      <th scope="col"> Valor </th>
      <th scope="col"> Cantidad </th>
    </tr>
  </thead>
  <tbody>

<?php

  //Imprimimos los registros de la base DB
  $id_finca = $_GET['finca'];
  include "../../php/conection.php";
  $query = "SELECT e.nombre, c.producto, c.valor, c.cantidad FROM empleado AS e INNER JOIN compras AS c WHERE v.id_finca = '$id_finca'";
  $sql = mysqli_query($conection, $query);
  if ($sql) {
    while ($row = mysqli_fetch_array($sql)) {
?>
  <tr>
    <td> <?php echo $row['nombre'] ?></td>
    <td> <?php echo $row['producto'] ?></td>
    <td> <?php echo $row['valor'] ?></td>
    <td> <?php echo $row['cantidad'] ?></td>
  </tr>

<?php
    }
  }


 ?>
  
  </tbody>
  </table>
<!-- Cierre de tabla del modal para ver bodega -->
         <?php
      }else{
        ?> 
        
<!-- Select para selecionar finca -->
<div class="row justify-content-center">
  <div class="form-group"> 
      <form method="GET" class="text-center">
      
                <label for="finca"> Seleccione la finca para ver las compras </label>
                  <select name="finca" class="form-control" id="finca"> 
                  <?php 

                    //Imprimimos las fincas desde la DB

                  include "../../php/conection.php";
                  $query = "SELECT * FROM finca";
                  $sql = mysqli_query($conection,$query);
                  if ($sql) {
                    while ($row = mysqli_fetch_array($sql)) {
                  ?>

                  <option value="<?php echo $row['id'] ?>"> <?php echo $row['nombre'] ?>
                    
                  </option>


                  <?php
                      }
                    }


                   ?>

                  </select>
                    <br>
                  <div class="form-group">

                    <input class="form-control btn btn-dark" type="submit" value="Ver compras">
                    
                  </div>
      </form>
    </div>
  </div>
</div>



     <?php
  }
 ?>



<?php
include "end.php";
?>

<script src="../../js/datatables.min.js"> </script>

<script>
//Paginacion de los datos
//Paginacion de los datos
//Paginacion de los datos
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



</script>

 </html>