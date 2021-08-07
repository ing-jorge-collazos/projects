<?php
    include('conexionDB.php');

    $sql = "SELECT count(*) FROM pqrs";
    $result = mysqli_query($con,$sql);
    $rows = mysqli_fetch_row($result);
    echo $rows[0];
?>