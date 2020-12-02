<?php 
	include 'key.php';
    if (isset($_POST['op'])) {
       
        include '../conection.php';
        $op = $_POST['op'];

        //consultar una labor por id
        /***************************/
        if ($op == 'search') {
            $id = $_POST['id'];
            $query ="SELECT * FROM labores WHERE id = '$id'";
            $sql = mysqli_query($conection,$query);
            if($sql){
                echo json_encode(mysqli_fetch_array($sql));
                return;
            }
        }

    }
