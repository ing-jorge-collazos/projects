<?php
	define('DB_HOST','localhost');
	define('DB_USER','empooban_userpqr');
	define('DB_PASS','zFKx2X8SLkpY');
	define('DB_NAME','empooban_pqr');
    
    $con=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>