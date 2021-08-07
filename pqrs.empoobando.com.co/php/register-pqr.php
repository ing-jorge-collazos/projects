<?php
    require_once ("conexionDB.php");

    $numRad = $_POST['numRad'];
    $modRad = $_POST['modRad'];
    $tipoRadicado = $_POST['tipoRadicado'];
    $tipoDoc = $_POST['tipoDoc'];
    $numDoc = $_POST['numDoc'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $tipoSolicitud = $_POST['tipoSolicitud'];
    $asunto = $_POST['asunto'];
    $area = $_POST['area'];
    $mensaje = $_POST['mensaje'];
    if(!isset($_FILES['archivo']) && !isset($_POST['type']))
    {
        $file = NULL;
        $type = NULL;
        $rutaDB = NULL;
    }else{
        $file = $_FILES['archivo'];
        $type = $_POST['type'];
        $rutaDB = 'files/'.$numRad.'.'.$type;
    }    

    $ruta = "../files/";
    if (!file_exists($ruta)) {
        echo 0;
    }else{

        $sql = "INSERT INTO `pqrs` (`id_ciudad`, `numero_radicado`, `modo_radicado`, `tipo_radicado`, `tipo_documento`, `identificacion`, `nombres`, `apellidos`, `direccion`, `telefono`, `email`, `tipo_solicitud`, `asunto`, `area`, `mensaje`, `ruta_archivo`, `estado`, `privacidad`) 
                VALUES (1, '$numRad', '$modRad', '$tipoRadicado','$tipoDoc', '$numDoc', '$nombre', '$apellido', '$direccion', '$telefono', '$email', '$tipoSolicitud', '$asunto', '$area', '$mensaje', '$rutaDB', 'Pendiente',1)";
        if(mysqli_query($con,$sql)){
            $id_pqrs =  mysqli_insert_id($con);
            $sql1 = "INSERT INTO `pqrs_seg` (`id_pqrs`,`estado`) 
                    VALUES($id_pqrs,'Pendiente')";
            mysqli_query($con,$sql1);
            if(isset($_FILES['archivo']) && isset($_POST['type']))
                move_uploaded_file($file["tmp_name"], $ruta.$numRad.'.'.$type);
            echo $numRad;
        }  
        else
        {
            echo 0;
        }
    }
?>