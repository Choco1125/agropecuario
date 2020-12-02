<?php 
	include 'simplexlsx.class.php';
	include '../php/conection.php';

    // cargar insumos
  //   $xlsx = new SimpleXLSX( 'INSUMOS.xlsx' );
  //   foreach ($xlsx->rows() as $fields){//1:Nombre 2:unidad
  //   	$query = "INSERT INTO insumo (nombre, unidad) VALUES ('".$fields[1]."','".$fields[2]."')";
		// $sql = mysqli_query($conection, $query);
  //   }

    //cargar las labores
  //   $xlsx = new SimpleXLSX( 'LABORES.xlsx' );
  //   foreach ($xlsx->rows() as $fields){//1:Nombre
  //       $rec = 0;
  //       //si es una labor de recoleccion
  //       $aux = explode('.', $fields[1]);
  //       if (count($aux) > 0) {
  //           if ($aux[0] == 'REC') {
  //               $rec = 1;
  //           }
  //       }

  //   	$query = "INSERT INTO labores (nombre,recoleccion) VALUES ('".$fields[1]."','$rec')";
		// $sql = mysqli_query($conection, $query);
  //   }

    //cargar rubros administrativos
  //   $xlsx = new SimpleXLSX( 'RUBROS ADMON.xlsx' );
  //   foreach ($xlsx->rows() as $fields){//1:Nombre
  //   	$query = "INSERT INTO rubro_administrativo (nombre) VALUES ('".$fields[1]."')";
		// $sql = mysqli_query($conection, $query);
  //   }

    //cargar beneficios post cosecha
    // $xlsx = new SimpleXLSX( 'beneficio.xlsx' );
    // foreach ($xlsx->rows() as $fields){//1:Nombre
    //     $query = "INSERT INTO rubros_post(nombre) VALUES ('".$fields[0]."')";
    //     $sql = mysqli_query($conection, $query);
    // }

    //cargar clientes
    // $xlsx = new SimpleXLSX( 'clientes.xlsx' );
    // foreach ($xlsx->rows() as $fields){//1:Nombre 2:nit 3:telefono
    //     $aux1 = explode('.', $fields[1]);
    //     $valor = "";
    //     foreach ($aux1 as $valor1) {
    //         $aux = explode('-', $valor1);
    //         if (count($aux) > 0) {
    //             foreach ($aux as $valor2) {
    //                 $valor .= $valor2;
    //             }
    //         }else{
    //             $valor .= $valor;
    //         }
    //     }
    //     $query = "INSERT INTO cliente(nombre, nit, telefono) VALUES ('".$fields[0]."','$valor','".$fields[2]."')";
    //     $sql = mysqli_query($conection, $query);
    // }

    // //cargar cultivos
    // $xlsx = new SimpleXLSX( 'cultivos.xlsx' );
    // foreach ($xlsx->rows() as $fields){//1:Nombre
    //     $query = "INSERT INTO cultivo(nombre) VALUES ('".$fields[0]."')";
    //     $sql = mysqli_query($conection, $query);
    // }

    // //cargar cultivos
    // $xlsx = new SimpleXLSX( 'cultivos.xlsx' );
    // foreach ($xlsx->rows() as $fields){//1:Nombre
    //     $query = "INSERT INTO cultivo(nombre) VALUES ('".$fields[0]."')";
    //     $sql = mysqli_query($conection, $query);
    // }

    //cargar rubros financieros
    // $xlsx = new SimpleXLSX( 'financieros.xlsx' );
    // foreach ($xlsx->rows() as $fields){//1:Nombre
    //     $query = "INSERT INTO rubro_financiero(nombre) VALUES ('".$fields[0]."')";
    //     $sql = mysqli_query($conection, $query);
    // }

    // //cargar rubros otros gastos
    // $xlsx = new SimpleXLSX( 'otrosGastos.xlsx' );
    // foreach ($xlsx->rows() as $fields){//1:Nombre
    //     $query = "INSERT INTO rubros_otros(nombre) VALUES ('".$fields[0]."')";
    //     $sql = mysqli_query($conection, $query);
    // }

    // //cargar productouctos
    // $xlsx = new SimpleXLSX( 'productos.xlsx' );
    // foreach ($xlsx->rows() as $fields){//1:Nombre 2:cultivo 3: Kilogramos

    //     //se verifica si existe el cultivo al que esta asociado el producto
    //     $query = "SELECT id FROM cultivo WHERE nombre = '".$fields[1]."'";
    //     $sql = mysqli_query($conection,$query);
    //     $id = null;
    //     if ($sql) {
    //         $num = mysqli_num_rows($sql);
    //         if ($num > 0) {
    //             $id = mysqli_fetch_array($sql)['id'];
    //         }
    //     }

    //     //si no lo esta se crea uno nuevo
    //     if ($id == null) {
    //         $query = "INSERT INTO cultivo(nombre) VALUES ('".$fields[1]."')";
    //         $sql = mysqli_query($conection, $query);
    //         if ($sql) {
    //             $query = "SELECT id FROM cultivo WHERE nombre = '".$fields[1]."'";
    //             $sql = mysqli_query($conection,$query);
    //             if ($sql) {
    //                 $num = mysqli_num_rows($sql);
    //                 if ($num > 0) {
    //                     $id = mysqli_fetch_array($sql)['id'];
    //                 }
    //             }
    //         }
    //     }

    //     //si se tiene un id se inserta en la tabla
    //     if ($id != null) {
    //         $query = "INSERT INTO producto(nombre, unidad, cultivo_id) VALUES ('".$fields[0]."','Kilogramos','$id')";
    //         $sql = mysqli_query($conection, $query);           
    //     }
    // }

    // //cargar proveedores
    // $xlsx = new SimpleXLSX( 'proveedores.xlsx' );
    // foreach ($xlsx->rows() as $fields){//0:Nit 1:Nombre 3:telefono
    //     $aux1 = explode('.', $fields[0]);
    //     $valor = "";
    //     foreach ($aux1 as $valor1) {
    //         $aux = explode('-', $valor1);
    //         if (count($aux) > 0) {
    //             foreach ($aux as $valor2) {
    //                 $valor .= $valor2;
    //             }
    //         }else{
    //             $valor .= $valor;
    //         }
    //     }
    //     $query = "INSERT INTO proveedor(nit, nombre, telefono) VALUES ('$valor','".$fields[1]."','".$fields[3]."')";
    //     $sql = mysqli_query($conection, $query);
    // }


    //cargar de lotes
    // $xlsx = new SimpleXLSX( 'lotes.xlsx' );
    // foreach ($xlsx->rows() as $fields){
        //id sociedades 2: BLACK QUEEN  3: ARBOTEK SAS  4:GOMEX RIVERA
        //id fincas  2: SINAI - BLACK QUEEN 3:CAMELIA  4:PALMERA 5:SINAI - GOMEZ RIVERA

        //orden de datos
        //[0]:Finca [1]:Cultivo [2]:Nombre [3]:Variedad [4]:Cantidad [5]:Fecha Siembre 
        //[6]:Distancia Siembra [7]:Area [8]:ASNM [9]:sociedad

        //se verifica si existe el cultivo al que esta asociado el producto
    //     $query = "SELECT id FROM cultivo WHERE nombre = '".$fields[1]."'";
    //     $sql = mysqli_query($conection,$query);
    //     $id = null;
    //     if ($sql) {
    //         $num = mysqli_num_rows($sql);
    //         if ($num > 0) {
    //             $id = mysqli_fetch_array($sql)['id'];
    //         }
    //     }

    //     //si no lo esta se crea uno nuevo
    //     if ($id == null) {
    //         $query = "INSERT INTO cultivo(nombre) VALUES ('".$fields[1]."')";
    //         $sql = mysqli_query($conection, $query);
    //         if ($sql) {
    //             $query = "SELECT id FROM cultivo WHERE nombre = '".$fields[1]."'";
    //             $sql = mysqli_query($conection,$query);
    //             if ($sql) {
    //                 $num = mysqli_num_rows($sql);
    //                 if ($num > 0) {
    //                     $id = mysqli_fetch_array($sql)['id'];
    //                 }
    //             }
    //         }
    //     }

    //      //si se tiene un id se inserta en la tabla
    //     if ($id != null) {

    //         $finca_id;
    //         switch ($fields[0]) {
    //             case 'SINAI':
    //                     switch ($fields[9]) {
    //                         case 'BLACK QUEEN':
    //                             $finca_id = 2;
    //                             break;
                            
    //                         case 'GOMEZ RIVERA':
    //                             $finca_id = 5;
    //                             break;
    //                     }
    //                 break;
    //             case 'CAMELIA':
    //                 $finca_id = 3;
    //                 break;
    //             case 'PALMERA':
    //                 $finca_id = 4;
    //                 break;
    //         }


    //         $cultivo_id = $id;
    //         $nombre = $fields[2];
    //         $variedad = $fields[3];
    //         $cantidad = $fields[4];
    //         $fecha_siembra = $fields[5];
    //         $distancia_siembra = $fields[6];
    //         $area = $fields[7];
    //         $asnm = $fields[8];

    //         $query ="INSERT INTO lote(id_finca, cultivo_id, nombre, variedad, cantidad, fecha_siembra, distancia_siembra, area, asnm) VALUES ('$finca_id','$cultivo_id','$nombre','$variedad','$cantidad','$fecha_siembra','$distancia_siembra','$area','$asnm')";
    //         $sql = mysqli_query($conection, $query);
    //         echo $query.'<br>';
    //     }
    // }
	
 ?>