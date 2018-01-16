<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php 
require_once 'php_action/core.php';
?>
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
        // incluir el archivo de la conexion de datos
        require_once("config/db.php");
        // cargar la clase de login
        require_once("classes/DBMaster.php");
        //instancio el objeto de la clase sql
        $conexion = new DBMaster();
        $conexion->llenarComboDepartamentos();
        $cadena = $conexion->departamentos;

        $errorInfo = "";
        $errorInsert = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //obtengo los datos del formulario...
            $codigo_departamento = htmlspecialchars($_POST['codDepartamento']);
            $nit = test_input($_POST["nit"]);
            $nombre = test_input($_POST["nombre"]);
            $apellido = test_input($_POST["apellido"]);
            $puesto = test_input($_POST["puesto"]);
            $password = test_input($_POST["password"]);
            $password_n = test_input($_POST["password_confirmacion"]);

            if (strcmp($password, $password_n) == 0) {
                //verifico las contraseñas
                $errorInsert = nuevoUsuario($nit, $nombre, $apellido, $puesto, $password, 1, $codigo_departamento);
                //redirecciono despues de 2 segundos...
                header("refresh:2; url=index.php");
            } else {
                $errorInfo = "Las contraseñas no coinciden.";
            }
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
                        <center><label><font size="6" color="white"> Departamento: </font></label>
                            <br>
                            <select name="codDepartamento">                                        
                                <?php echo $cadena ?>
                            </select>
                        </center>
                        <input class="text" type="text" name="nit" placeholder="N.I.T" required="">
                        <input class="text" type="text" name="nombre" placeholder="Nombre" required="">
                        <input class="text" type="text" name="apellido" placeholder="Apellido" required="">
                        <input class="text" type="text" name="puesto" placeholder="Puesto" required="">                        
                        <input class="text" type="password" name="password" placeholder="Password" required="">
                        <input class="text" type="password" name="password_confirmacion" placeholder="Confirmar Password" required="">
                        <br>

                        <div class="wthree-text">
                            <div class="clear"> </div>
                            <br>
                            <center><font size="5" style="color:white;"><?php echo $errorInfo ?></font></center> 
                            <center><font size="5" style="color:white;"><?php echo $errorInsert ?></font></center>
                        </div>
                        <input type="submit" value="ACEPTAR">

                    </form>                     
                    <p><a href="dashboard.php">¡Volver!</a></p>
                </div>	 
            </div>            
            <!-- copyright -->
            <div class="w3copyright-agile">
                <p>All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
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

//creo una funcion para ingresar usuario 
    function nuevoUsuario($nit, $nombre, $apellido, $puesto, $password, $tipo, $codigoDepartamento) {
        //conexión a la base de datos...para verificar el login 
        // incluir el archivo de la conexion de datos
        require_once("config/db.php");
        // cargar la clase de login
        require_once("classes/DBMaster.php");
        //instancio el objeto de la clase Login
        $conexion = new DBMaster();
        //no esta logueado, consulto la base de datos...
        $conexion->insertarUsuario($nit, $nombre, $apellido, $puesto, $password, $tipo, $codigoDepartamento);

        return $conexion->info;
    }
    ?>
</html>