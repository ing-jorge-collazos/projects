<?php
    require_once ("conexionDB.php");

    session_start();
    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $username=mysqli_real_escape_string($con,$_POST['user']); 
        //$password=md5(mysqli_real_escape_string($con,$_POST['pass'])); 
        $password=md5($_POST['pass']); 
        //echo $password;
        $sql = "SELECT id, area FROM users WHERE usuario='$username' and contrasenia='$password'";

        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            $rows = mysqli_fetch_row($result);
            $_SESSION['login_user']=$rows[0]; 
            $_SESSION['area']=$rows[1]; 
            echo true;
        }        
        else
            echo false;
    }
?>