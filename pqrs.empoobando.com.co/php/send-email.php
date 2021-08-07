<?php
    if(isset($_POST['area']) && isset($_POST['email']) && 
        isset($_POST['msg'])){
        $area = $_POST['area'];
        $email = $_POST['email'];
        $msg = $_POST['msg'];
        $from = $area=='Proyectos'?'proyectos@empoobando.com.co':
                ($area=='Operación y Mantenimiento'?'mantenimiento@empoobando.com.co':
                ($area=='Atención al usuario'?'atencionusuario@empoobando.com.co':
                ($area=='Daños'?'atencion_danos@empoobando.com.co':'')));
        if($from != ''){
            $to = $email;
            $subject = 'Respuesta solicitud PQR';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ' . $from . "\r\n" .
                        'Bcc: ' . $from . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            $message = $msg;
            if(mail($to, $subject, $message, $headers))
                echo 1;
            else
                echo 0;
        }            
        else
            echo 'No es posible enviar el mensaje';
    }
?>