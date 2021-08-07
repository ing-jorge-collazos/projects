<?php

    $usuario=$_POST["username"];
    $password=$_POST["password"];

   $fp=fopen("usuarios.txt","r");
    //variante de lectura de archivo por pocisiones
    $loop=0;
    $validUser = false;
    while(!feof($fp)){
        $loop++;

        $line = fgets($fp);
        $field[$loop] = explode('|',$line);
        $nomusu = $field[$loop][2];
        $nompass = $field[$loop][3];
        
        $fp++;
        if($usuario==$nomusu && $password==$nompass){            
            session_start();
            $_SESSION['usuario']="$usuario";
            $validUser = true;
        }    
    }
    fclose($fp);
    if($validUser){
        if(!file_exists('../content/files/answers/'.$usuario))
        {
            mkdir('../content/files/answers/'.$usuario,0777,true);            
        }
        echo 1;
    }else
        echo 0;
?>