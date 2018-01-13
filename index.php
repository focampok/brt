<?php
session_start();
if(isset($_SESSION['nit'])) {
	header('location: dashboard.php');	
}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Inventario GuateGas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Magical Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Custom Theme files -->
        <link href="loginStyle/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!-- //Custom Theme files -->
        <!-- web font -->
        <link href='//fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
        <!-- //web font -->
    </head>
    <body>  
        <?php
        $errorLogin = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nit = test_input($_POST["nit"]);
            $password = test_input($_POST["password"]);
            $errorLogin = login($nit,$password);
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <!-- main -->
        <div class="main-w3layouts wrapper">            
            <center><a href="index.php"><img src="loginStyle/images/logo_guategas.png" border="1" width="400" height="175"></a></center>
            <div class="main-agileinfo">
                <div class="agileits-top"> 
                    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                        <input class="text" type="text" name="nit" placeholder="N.I.T." required="">
                        <input class="text" type="password" name="password" placeholder="Password" required="">
                        <div class="wthree-text">                                                         
                            <div class="clear"> </div>
                            <br>                            
                            <center><font size="5" style="color:white;"><?php echo $errorLogin ?></font></center>
                        </div>
                        <input type="submit" value="Iniciar Sesión">

                    </form>                                         
                </div>	 
            </div>            
            <!-- copyright -->
            <div class="w3copyright-agile">
                <p> All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
            </div>
            <!-- //copyright -->
            <ul class="w3lsg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>	
        <!-- //main --> 
    </body> 
    <?php

    //creo una funcion para loguearme 
    function login($nit,$password) {
        //conexión a la base de datos...para verificar el login 
        // incluir el archivo de la conexion de datos
        require_once("config/db.php");
        // cargar la clase de login
        require_once("classes/DBMaster.php");
        //instancio el objeto de la clase Login
        $conexion = new DBMaster();
        //no esta logueado, consulto la base de datos...
        $conexion->iniciarSesion($nit,$password);
        return $conexion->info;
    }
    ?>
</html>