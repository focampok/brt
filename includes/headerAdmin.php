<?php require_once 'php_action/core.php'; ?>
<!DOCTYPE html>
<html>
    <head>

        <title>Sistema de Gestión de Inventario</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
        <!-- bootstrap theme-->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
        <!-- font awesome -->
        <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

        <!-- custom css -->
        <link rel="stylesheet" href="custom/css/custom.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

        <!-- file input -->
        <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

        <!-- jquery -->
        <script src="assests/jquery/jquery.min.js"></script>
        <!-- jquery ui -->  
        <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
        <script src="assests/jquery-ui/jquery-ui.min.js"></script>

        <!-- bootstrap js -->
        <script src="assests/bootstrap/js/bootstrap.min.js"></script>

    </head>
    <body>


        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      

                    <ul class="nav navbar-nav navbar-right">                                    
                        
                        <li id="navBitacora"><a href="bitacora.php"><i class="glyphicon glyphicon-bold"></i> Bitacora </a></li> 
                        
                        <li id="navUsuarios"><a href="usuarios.php"><i class="glyphicon glyphicon-user"></i> Usuarios </a></li>                                            
                        
                        <li class="dropdown" id="navOrder">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list-alt"></i> Reportes <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li id="topNavAddOrder"><a href="resumenAdiciones.php"> <i class="glyphicon glyphicon-th-list"></i> Resumen de Adiciones </a></li> 
                                <li id="topNavAddOrder"><a href="exportarExcel.php"> <i class="glyphicon glyphicon-export"></i> Libro </a></li>                                                     
                            </ul>
                        </li> 
                        
                        <li class="dropdown" id="navSetting">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-cog"></i> Perfil <span class="caret"></span></a>
                            <ul class="dropdown-menu">            
                                <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configuración</a></li>            
                                <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Salir</a></li>            
                            </ul>
                        </li>        

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container">