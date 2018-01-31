<?php require_once 'includes/header.php'; ?>
<?php include('modal/activosModal.php'); ?>

<div class="row">
    <div>
        <ol class="breadcrumb">
            <li><a href="dashboard.php">Inicio</a></li>		  
            <li class="active">Productos</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de productos</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body">

                <div class="remove-messages"></div>

                <div class="div-action pull pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default button1" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Nuevo producto </button>
                </div> <!-- /div-action -->				

                <table class="table" id="manageCategoriesTable">
                    <thead>
                        <tr>                            
                            <th><font size="1">Código</font></th>
                            <th><font size="1">Fecha</font></th>
                            <th><font size="1">Estado</font></th>
                            <th><font size="1">Cantidad</font></th>                            
                            <th><font size="1">Descripción</font></th>
                            <th><font size="1">Precio Unitario</font></th>
                            <th><font size="1">Subtotal</font></th>
                            <th><font size="1">Bodega</font></th>
                            <th><font size="1">Proyecto</font></th>  
                            <th style="width:15%;">Opciones</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->		
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->
<script src="custom/js/activo.js"></script>
<?php require_once 'includes/footer.php'; ?>