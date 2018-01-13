<!-- AGREGAR ACTA -->
<div class="modal fade" id="addActaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitActaForm" action="php_action/createActa.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo Acta</h4>
                </div>
                <div class="modal-body">

                    <div id="add-acta-messages"></div>

                    <div class="form-group">
                        <label for="codActa" class="col-sm-3 control-label">Código Acta </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="codActa" placeholder="Código" name="codActa" required="">
                        </div>
                    </div> <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="fechaActa" class="col-sm-3 control-label">Fecha </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="fechaActa" placeholder="Fecha" name="fechaActa" required="">
                        </div>
                    </div> <!-- /form-group-->	         	        

                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>	        
                    <button type="submit" class="btn btn-primary" id="createActaBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>

<!-- ANULAR ACTA -->
<div class="modal fade" tabindex="-1" role="dialog" id="anularActaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Anular acta</h4>
            </div>
            <div class="modal-body">
                <p> ¿Realmente desea anular el acta seleccionada ?</p>
            </div>
            <div class="modal-footer removeBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id="anularActaBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- QUITAR ACTIVO DE ACTA -->
<div class="modal fade" tabindex="-1" role="dialog" id="quitarActivoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Quitar activo </h4>
            </div>
            <div class="modal-body">
                <p> ¿Realmente desea quitar el activo del acta seleccionado?</p>
            </div>
            <div class="modal-footer quitarActivoFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id="quitarActivoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- APROBAR ACTA -->
<div class="modal fade" id="aprobarActaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="certificarActivoForm" action="php_action/certificarActivo.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-pencil"></i> Aprobar Acta de Baja </h4>
                </div>
                <div class="modal-body">

                    <div id="certificar-activo-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Cargando...</span>
                    </div>

                    <div class="certificar-activo-result">
                        <div class="form-group">                            
                            <center><label class="col-sm-9 control-label">¿Realmente desea aprobar el acta de baja?</label></center>                            
                        </div>
                        <div class="form-group">
                            <label for="motivo" class="col-sm-4 control-label"> Motivo </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <select class="form-control" id="codigoCertificacion" name="codigoCertificacion">
                                    <?php echo $cadenaCertificaciones ?>
                                </select>
                            </div>
                        </div>                        
                    </div>         	        
                    <!-- /edit brand result -->
                </div> <!-- /modal-body -->
                <div class="modal-footer removeBrandFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" id="aprobarActaBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>

<!-- GENERAR PDF -->
<div class="modal fade" id="generarActaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="generarActaForm" action="php_action/createActaPDF.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-print"></i> Generar PDF </h4>
                </div>

                <div class="modal-body" style="max-height:450px; overflow:auto;">

                    <div id="generar-acta-messages"></div>                      

                    <div class="form-group">
                        <label for="horaPDF" class="col-sm-3 control-label"> Hora Inicio: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="horaPDF" name="horaPDF" required="" placeholder="las nueve horas con cuarenta y cinco minutos (9.45)">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="fechaPDF" class="col-sm-3 control-label"> Fecha: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="fechaPDF" name="fechaPDF" required="" placeholder="del día lunes quince de Abril del año dos mil diecisiete">
                        </div>
                    </div> <!-- /form-group-->


                    <div class="form-group">
                        <label for="personasPDF" class="col-sm-3 control-label"> Personas: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <textarea name="personasPDF" id="personasPDF" rows="7" cols="50" required=""> José Edwin Maoluf Méndez, Director General Administrativo,  Ana Leticia Aragón Castillo, Jefa del Departamento Financiero, Francisco José Ocampo González, Encargado de Inventarios, todos de la Dirección General Administrativa.</textarea>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="horaFinPDF" class="col-sm-3 control-label"> Hora Fin: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="horaFinPDF" name="horaFinPDF" required="" placeholder="las nueve horas con cuarenta y cinco minutos (9.45)">
                        </div>
                    </div> <!-- /form-group-->


                </div> <!-- /modal-body -->
                <div class="modal-footer generarActaFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>	        
                    <button type="submit" class="btn btn-primary" id="createActaPDFBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div> <!-- /modal-footer -->	      
            </form> <!-- /.form -->	
        </div> <!-- /modal-content -->    
    </div> <!-- /modal-dailog -->
</div>