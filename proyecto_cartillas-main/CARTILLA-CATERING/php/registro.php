<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>

    <!--estilos CSS-->
    <link href="../css\estilos.css" rel="stylesheet" media="screen">
    <!-- <link href="_css/bootstrap.min.css" rel="stylesheet" media="screen"> -->

    <!--JavaScript-->

<script type="text/javascript" >



</script>


</head>
<body>

<div class="container">
    <div class="form-container" class="formulario">

            <div class="container-banner-2" class="formulario">             
                <img class="img-1" id="img-index" src="../Imagenes/ImagesUnit1/Banners/index2.png" class="">
            </div> 

        <form action="guarda_registro.php" method="POST">
            
            
                <input type="text" name="nombre" id="nombre" class="textbox" placeholder="Ingresa nombre" REQUIRED> 
            
                <input type="text" name="apellido" id="apellido" class="textbox" placeholder="Ingresa apellido" REQUIRED>
            

        
                <input type="text" name="nomuser" id="nomuser" class="textbox" placeholder="Nombre de usuario" REQUIRED>
            
                <input type="password" name="pass" id="pass" class="textbox" placeholder="Elija su contraseña" REQUIRED>
        
                <input type="password" name="pass2" id="pass2" class="textbox" placeholder="Repita la contraseña" REQUIRED>
        

                <input class="botones" type="submit" value="Registrar" onsubmit="valida();">
                <a href="ingreso.php">Regresar
        </form>
    </div>

            
</div>
</body>


</html>