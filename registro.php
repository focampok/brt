<?php
// incluir el archivo de la conexion de datos
require_once("config/db.php");
// cargar la clase de login
require_once("classes/DBMaster.php");
?>
<!--
        Author: W3layouts
        Author URL: http://w3layouts.com
        License: Creative Commons Attribution 3.0 Unported
        License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
//instancio el objeto de la clase sql
$conexion = new DBMaster();
$errorInfo = "";
$errorInsert = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //obtengo los datos del formulario...        
    $nombre = test_input($_POST["nombre"]);
    $apellido = test_input($_POST["apellido"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $password_n = test_input($_POST["password_confirmacion"]);

    if (strcmp($password, $password_n) == 0) {
        //verifico las contraseñas

        if ($_SESSION["estado"] == 1) {
            $tipoUser = $_POST["tipoUser"];
        } else {
            $tipoUser = 1;
        }
        $errorInsert = nuevoUsuario($nombre, $apellido, $username, $password, $tipoUser);
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

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>BRT - REGISTRO</title>
        <!-- Meta-Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta name="keywords" content="Switch Login Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
        <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <!-- //Meta-Tags -->
        <!-- Index-Page-CSS -->
        <link rel="stylesheet" href="loginStyle/css/style.css" type="text/css" media="all">
        <!-- //Custom-Stylesheet-Links -->
        <!--fonts -->
        <link href="//fonts.googleapis.com/css?family=Mukta+Mahee:200,300,400,500,600,700,800" rel="stylesheet">
        <!-- //fonts -->
        <!-- Font-Awesome-File-Links -->
        <link rel="stylesheet" href="loginStyle/css/font-awesome.css" type="text/css" media="all">
    </head>
    <body>
        <h1 class="title-agile text-center">Registro </h1>
        <div class="content-w3ls">
            <div class="content-top-agile">
                <h2>Nuevo usuario</h2>
            </div>
            <div class="content-bottom">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="nombre" id="nombre" type="text" value="" placeholder="nombre" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="apellido" id="apellido" type="text" value="" placeholder="apellido" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="username" id="username" type="text" value="" placeholder="username" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="password" id="password" type="Password" placeholder="password" required>
                        </div>
                    </div> 
                    <div class="field-group">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="password_confirmacion" id="password_confirmacion" type="Password" placeholder="confirmar password" required>
                        </div>
                    </div>  
                    <div class="field-group">

                        <?php
                        if ($_SESSION["estado"] == 1) {
                            echo '<center>';                            
                            echo '<input type = "radio" name = "tipoUser" value = "0" checked> <font size="5" color="white">Administrador</font><br>
                            <input type = "radio" name = "tipoUser" value = "1"><font size="5" color="white">Usuario</font><br>';
                            echo '</center>';
                        }
                        ?>

                    </div> 
                    <div class="wthree-text">
                        <div class="clear"> </div>
                        <br>
                        <center><font size="5" style="color:blue;"><?php echo $errorInfo ?></font></center> 
                        <center><font size="5" style="color:blue;"><?php echo $errorInsert ?></font></center>
                    </div>
                    <div class="wthree-field">
                        <input id="saveForm" name="saveForm" type="submit" value="Registrar" />
                    </div>
                </form>
                <center><p><a href="dashboard.php">¡Volver!</a></p></center>
            </div>
        </div>
        <div class="copyright text-center">
            <p>© 2018 Switch Login Form. All rights reserved | Design by
                <a href="http://w3layouts.com">W3layouts</a>
            </p>
        </div>
    </body>
    <?php

//creo una funcion para ingresar usuario 
    function nuevoUsuario($nombre, $apellido, $username, $password, $tipo) {
        //conexión a la base de datos...para verificar el login 
        // incluir el archivo de la conexion de datos
        require_once("config/db.php");
        // cargar la clase de login
        require_once("classes/DBMaster.php");
        //instancio el objeto de la clase Login
        $conexion = new DBMaster();
        //no esta logueado, consulto la base de datos...
        $conexion->insertarUsuario($nombre, $apellido, $username, $password, $tipo);
        return $conexion->info;
    }
    ?>
</html>