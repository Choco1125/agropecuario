<?php
include 'key.php';
if (isset($_POST['op'])) {

    $op = $_POST['op'];

    include '../conection.php';


    //listar todos los clientes
    if ($op == 'list') {
        $query = "SELECT * FROM empleado";
        $sql = mysqli_query($conection, $query);
        if ($sql) {
            $salida = array();
            while ($row = mysqli_fetch_array($sql)) {
                $salida[] = $row;
            }
            echo json_encode($salida);
            return;
        }
    }


    //agregar un empleado
    if ($op == 'add') {
        $identificacion  = $_POST['identificacion'];
        $nombre  = $_POST['nombre'];
        $apellidos  = $_POST['apellidos'];

        $query = "INSERT INTO empleado(identificacion,nombre,apellidos) VALUES('$identificacion','$nombre','$apellidos')";
        $sql = mysqli_query($conection, $query);
        if ($sql) {
            echo json_encode(array('res'=> 1,'msg' => 'Empleado agregado Correctamente'));
            return;
        }else{
            echo json_encode(array('res'=> 0,'msg' => 'No se logro agregar el empleado'));
            return;
        }
    }

    //buscar un empleado por id
    if ($op == 'search') {
       $id = $_POST['id'];

       $query = "SELECT * FROM empleado WHERE id='$id'";
       $sql = mysqli_query($conection,$query);
       if($sql){
           echo json_encode(mysqli_fetch_array($sql));
           return;
       }
    }

}
