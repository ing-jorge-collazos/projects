<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidades</title>
    <link rel="stylesheet" href="../css/Styles_U1_Page2.css">
</head>
<body>

    
    <div class="container-index">
        <div class="container-index-2">
            <div class="usuario">
                <h4 class="h5">
                    <?php
                        session_start();
                        if($ses=$_SESSION['usuario']){
                            echo "Usuario: $ses ";

                        }else{

                            session_destroy();
                            header("Location: ingreso.php");
                            
                        }
                    ?>
                </h4>
                
            </div>
           

                <div class="csesion">
                    <a href="cerrarsesion.php">Cerrar sesion</a>
                </div>
            </div>
        </div> 
        
    <div class="container-2-unidades">
            
        <div class="container-unidades-logo">

        <div class="container-centrar">
                <img  src="../Imagenes/ImagesUnit1/Banners/index2.png" class="imagen6" alt="">  
            </div>        
        
            <div  class="container-unidades">
                
            <a href="../Unidad_1/U1_Pag1.php"><input class="imagen6" type="image" name="unidad1" src="../botones/Interfaz/unit_1_but.png" alt="unidad1" class="img-logos" onmouseover="this.src='../botones/Interfaz/unit_1_but_sobre.png';" onmouseout="this.src='../botones/Interfaz/unit_1_but.png';" onclick="this.src='../botones/Interfaz/unit_1_but_press.png';"></a>
                    
            <a href="../Unidad_2/U2_Pag1.php"><input class="imagen6" type="image" name="home" src="../botones/Interfaz/unit_2_but.png" alt="home" class="img-logos" onmouseover="this.src='../botones/Interfaz/unit_2_but_sobre.png';" onmouseout="this.src='../botones/Interfaz/unit_2_but.png';" onclick="this.src='../botones/Interfaz/unit_2_but_press.png';"></a>
                
            <a href="../Unidad_3/U3_Pag1.php"><input class="imagen6" type="image" name="home" src="../botones/Interfaz/unit_3_but.png" alt="home" class="img-logos" onmouseover="this.src='../botones/Interfaz/unit_3_but_sobre.png';" onmouseout="this.src='../botones/Interfaz/unit_3_but.png';" onclick="this.src='../botones/Interfaz/unit_3_but_press.png';"></a>
                
            <a href="../Unidad_4/U4_Pag1.php"><input class="imagen6" type="image" name="home" src="../botones/Interfaz/unit_4_but.png" alt="home" class="img-logos" onmouseover="this.src='../botones/Interfaz/unit_4_but_sobre.png';" onmouseout="this.src='../botones/Interfaz/unit_4_but.png';" onclick="this.src='../botones/Interfaz/unit_4_but_press.png';"></a>  
                
            <a href="../Unidad_5/U5_Pag1.php"><input class="imagen6" type="image" name="home" src="../botones/Interfaz/unit_5_but.png" alt="home" class="img-logos" onmouseover="this.src='../botones/Interfaz/unit_5_but_sobre.png';" onmouseout="this.src='../botones/Interfaz/unit_5_but.png';" onclick="this.src='../botones/Interfaz/unit_5_but_press.png';"></a>
                
            <a href="../Unidad_6/U6_Pag1.php"><input class="imagen6" type="image" name="home" src="../botones/Interfaz/unit_6_but.png" alt="home" class="img-logos" onmouseover="this.src='../botones/Interfaz/unit_6_but_sobre.png';" onmouseout="this.src='../botones/Interfaz/unit_6_but.png';" onclick="this.src='../botones/Interfaz/unit_6_but_press.png';"></a> 
                    
            </div>
            </div>
            <div class="container-2-footer1"></div>
        </div>
        


</body>
</html>