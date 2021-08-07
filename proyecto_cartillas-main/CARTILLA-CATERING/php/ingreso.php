<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caterin and Cooking - Inicio de sesion</title>

    <!--estilos CSS-->
    <link href="../css\estilos.css" rel="stylesheet" media="screen">
    <!-- <link href="../css\bootstrap.min.css" rel="stylesheet" media="screen"> -->

    <script type="text/javascript"></script>
</head>

<?php


?>
<body>
    <div id="login">
        <div class="container">            
                    <div  class="form-container" class="formulario">
                            <div class="container-banner-2" class="formulario">             
                                <img class="img-1" id="img-index" src="../Imagenes/ImagesUnit1/Banners/index2.png" class="">
                            </div> 

                            <form id="" class="" action="valida_user.php" method="POST">
                                    
                                <div class="">

                                        <!-- <label for="username" class="text-info">Usuario:</label> -->
                                        <input type="text" name="username" id="username" placeholder="Ingrese su usuario" class="textbox" REQUIRED>  
                                        <span id="error-user"></span>
                                    </div>
                                    <div class="">
                                        <!-- <label for="password" class="text-info">Contraseña:</label> -->
                                        <input type="password" name="password" id="password" placeholder="Contraseña" class="textbox" REQUIRED>
                                        
                                        
                                        <?php
                                        if(isset($_GET['registro'])){
                                            $estado=$_GET['registro'];
                                                    if($estado=="registrado"){
                                                    echo "<h3 class='h3-texto'>El usuario se ha registrado con exito</h3>";
                                                }
                                        }
                                        ?>
                                        
                                        <span id="error-pass"></span>
                                    </div>


                                    <div class="">
                                        <input type="submit" name="login" class="botones" id="btn-login" value="Ingresar">
                                        <a href="registro.php">Registrarme</a>
                                    </div>
                                </form>
                            
                        </div>
                                         
                    </div>
        </div>
    </div>
</body>
</html>