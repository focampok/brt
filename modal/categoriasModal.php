<?php
// incluir el archivo de la conexion de datos
require_once("config/db.php");
// cargar la clase de login
require_once("classes/DBMaster.php");
//instancio el objeto de la clase sql
$conexion = new DBMaster();
$conexion->llenarComboFechas();
$cadenaFechas = $conexion->fechas;
?>
<!-- AGREGAR CERTIFICACION -->
<div class="modal fade" id="addCertificacionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitCertificacionForm" action="php_action/createCategoria.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nueva Categoria</h4>
                </div>
                <div class="modal-body">

                    <div id="add-certificaciones-messages"></div>

                    <div class="form-group">
                        <label for="codCertificacion" class="col-sm-3 control-label">Código </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="codCertificacion" placeholder="Código" name="codCertificacion" required="">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="fechaCertificacion" class="col-sm-3 control-label">Nombre </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="fechaCertificacion" placeholder="Nombre" name="fechaCertificacion" required="">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="codigoAdicion" class="col-sm-4 control-label">Fecha * </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="codigoFecha" name="codigoFecha">
                                <?php echo $cadenaFechas ?>
                            </select>
                        </div>
                    </div> <!-- /form-group-->

                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>	        
                    <button type="submit" class="btn btn-primary" id="createCertificacionBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>


<div class="modal fade" id="editCategoriaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editBrandForm" action="php_action/editCategoria.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar Categoria</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-brand-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Cargando...</span>
                    </div>

                    <div class="edit-brand-result">
                        <div class="form-group">
                            <label for="editBrandName" class="col-sm-3 control-label">Código: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editBrandName" placeholder="Código" name="editBrandName" readonly="">
                            </div>
                        </div> <!-- /form-group-->	         	        
                        <div class="form-group">
                            <label for="editBrandStatus" class="col-sm-3 control-label">Nombre: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editBrandStatus" placeholder="Nombre" name="editBrandStatus" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                        <label for="codigoAdicion" class="col-sm-4 control-label">Fecha * </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="codigoFecha" name="codigoFecha">
                                <?php echo $cadenaFechas ?>
                            </select>
                        </div>
                    </div> <!-- /form-group-->
                    </div>         	        
                    <!-- /edit brand result -->

                </div> <!-- /modal-body -->

                <div class="modal-footer editBrandFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>	        
                    <button type="submit" class="btn btn-success" id="editBrandBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>


<!-- BORRAR CATEGORIA -->
<div class="modal fade" tabindex="-1" role="dialog" id="eliminarCategoriaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar Categoria</h4>
            </div>
            <div class="modal-body">
                <p> ¿Realmente desea eliminar la categoria seleccionada  y todos sus datos relacionados?</p>
            </div>
            <div class="modal-footer removeBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id="eliminarBodegaModalBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- QUITAR ACTIVO DE CERTIFICACION -->
<div class="modal fade" tabindex="-1" role="dialog" id="quitarActivoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Quitar activo </h4>
            </div>
            <div class="modal-body">
                <p> ¿Realmente desea quitar el activo de la certificación seleccionada?</p>
            </div>
            <div class="modal-footer quitarActivoFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id="quitarActivoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<!-- GENERAR PDF -->
<div class="modal fade" id="generarCertificacionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="generarCertificacionForm" action="php_action/createCertPDF.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-print"></i> Generar PDF </h4>
                </div>

                <div class="modal-body" style="max-height:450px; overflow:auto;">

                    <div id="generar-certificacion-messages"></div>

                    <div class="form-group">
                        <label for="fechaPDF" class="col-sm-3 control-label"> Fecha: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="fechaPDF" name="fechaPDF" required="">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="encabezadoPDF" class="col-sm-3 control-label"> Encabezado: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <textarea name="encabezadoPDF" id="encabezadoPDF" rows="6" cols="50" required=""></textarea>
                        </div>
                    </div> <!-- /form-group-->
                </div> <!-- /modal-body -->

                <div class="modal-footer generarCertificacionFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>	        
                    <button type="submit" class="btn btn-primary" id="createCertificacionPDFBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div> <!-- /modal-footer -->	      
            </form> <!-- /.form -->	
        </div> <!-- /modal-content -->    
    </div> <!-- /modal-dailog -->
</div> 











