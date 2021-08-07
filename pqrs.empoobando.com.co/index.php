<?php
  session_start();
  if(isset($_SESSION['login_user']))
  {
    header('Location: views/admin/');
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PQRS - Login</title>

    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/styles.css" rel="stylesheet" media="screen">
</head>
<body>         
    <div id="login">
        <div class="container">            
            <div id="login-row" class="row justify-content-center align-items-center">            
                <div id="login-column" class="col-md-6">
                    <center>
                        <div id="img-content">
                            <img id="img-login" src="images/banner.png" class="img-fluid" alt="Header Image" >
                        </div>
                    </center>
                    <div id="login-box" class="col-md-12">                        
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Inicio de Sesión</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Usuario:</label><br>
                                <input type="text" name="username" id="username" class="form-control">  
                                <span id="error-user"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Contraseña:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                                <span id="error-pass"></span>
                            </div>
                            <div class="form-group">
                                <button type="button" name="login" class="btn btn-info btn-md" id="btn-login">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<script src="js/login.js"></script>