<?php
    require_once ("conexionDB.php");

    if(isset($_POST['id'])){
        $id = $_POST['id'];  
        $state = $_POST['state'];

        $sql = "UPDATE pqrs SET estado='$state' WHERE id ='$id'";
        $sql1 = "INSERT INTO pqrs_seg(id_pqrs,estado) VALUES('$id','$state')";
        //$result = mysqli_query($con,$sql);
        if(mysqli_query($con,$sql)){
            mysqli_query($con,$sql1);
            echo true.' '.$id.' '.$state;
        }
        else{
            echo false;
        }
    }
?>