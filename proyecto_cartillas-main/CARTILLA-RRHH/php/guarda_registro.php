<?php

$archivo=fopen("usuarios.txt","a");
/*
fputs($archivo,$_REQUEST['nombre']);

fputs($archivo,"\t");

fputs($archivo,$_REQUEST['apellido']);

fputs($archivo,"\t");

fputs($archivo,$_REQUEST['nomuser']);

fputs($archivo,"\t");

fputs($archivo,$_REQUEST['pass']);

fputs($archivo,"\t\n");

fclose($archivo);

echo "Se guardaron los datos de registro";
header("Location:ingreso.php");
*/


fwrite($archivo,$_POST['nombre']);
fwrite($archivo,"|");

fwrite($archivo,$_POST['apellido']);
fwrite($archivo,"|");

fwrite($archivo,$_POST['nomuser']);
fwrite($archivo,"|");

fwrite($archivo,$_POST['pass']);
fwrite($archivo,"|");
fwrite($archivo,"\n");


fclose($archivo);

$estado ="registrado";
     
header("Location: ingreso.php?registro=$estado");
?>


