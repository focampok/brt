<!-- AGREGAR CERTIFICACION -->
<div class="modal fade" id="addCertificacionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitCertificacionForm" action="php_action/createCertificacion.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo Proyecto</h4>
                </div>
                <div class="modal-body">

                    <div id="add-certificaciones-messages"></div>

                    <div class="form-group">
                        <label for="codCertificacion" class="col-sm-3 control-label">Código Proyecto </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="codCertificacion" placeholder="Código" name="codCertificacion" required="">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="fechaCertificacion" class="col-sm-3 control-label">Fecha </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="fechaCertificacion" placeholder="Fecha" name="fechaCertificacion" required="">
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

<!-- ANULAR CERTIFICACION -->
<div class="modal fade" tabindex="-1" role="dialog" id="anularCertificacionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Anular Proyecto</h4>
            </div>
            <div class="modal-body">
                <p> ¿Realmente desea anular el proyecto seleccionado ?</p>
            </div>
            <div class="modal-footer removeBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id="anularCertificacionBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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











