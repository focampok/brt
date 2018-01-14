<!-- add categories -->

<?php
// incluir el archivo de la conexion de datos
require_once("config/db.php");
// cargar la clase de login
require_once("classes/DBMaster.php");
//instancio el objeto de la clase sql
$conexion = new DBMaster();
$conexion->llenarComboDepartamentos();
$cadenaDepartamentos = $conexion->departamentos;

//instancio el objeto de la clase sql
$conexion = new DBMaster();
$conexion->llenarComboAdiciones();
$cadenaAdiciones = $conexion->adiciones;


//instancio el objeto de la clase sql
$conexion = new DBMaster();
$conexion->llenarComboCertificaciones();
$cadenaCertificaciones = $conexion->certificaciones;

?>


<!-- FORMULARIO PARA AGREGAR UN ACTIVO -->

<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">           

            <form class="form-horizontal" id="submitCategoriesForm" action="php_action/createActivo.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo producto</h4>
                </div>
                <div class="modal-body">

                    <div id="add-categories-messages"></div>

                    <div class="form-group">
                        <center><label for="info" class="col-sm-4 control-label"><font color="red">  Obligatorio * </font></label></center>                       
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="codigoInventario" class="col-sm-4 control-label">Código producto * </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="codigoInventario" placeholder="Código producto" name="codigoInventario" required="">
                        </div>
                    </div> <!-- /form-group-->
                     <!-- /form-group-->
                    <div class="form-group">
                        <label for="fecha" class="col-sm-4 control-label">Fecha * </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="date" class="form-control" id="fecha" placeholder="Fecha" name="fecha" required="">
                        </div>
                    </div> <!-- /form-group-->
                    
                    <div class="form-group">
                        <label for="cantidad" class="col-sm-4 control-label">Cantidad * </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="cantidad" placeholder="Cantidad" name="cantidad" required="">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="marca" class="col-sm-4 control-label">Marca </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="marca" placeholder="Marca" name="marca">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="modelo" class="col-sm-4 control-label">Modelo </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="modelo" placeholder="Modelo" name="modelo">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="serie" class="col-sm-4 control-label">Serie </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="serie" placeholder="Serie" name="serie">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-4 control-label">Descripción * </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="descripcion" placeholder="Descripción" name="descripcion" required="">
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <label for="precio_unitario" class="col-sm-4 control-label">Precio Unitario *</label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="precio_unitario" placeholder="Precio" name="precio_unitario" required="">
                        </div>
                    </div> <!-- /form-group-->                    
                    <div class="form-group">
                        <label for="codigoAdicion" class="col-sm-4 control-label">Contenedor * </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="codigoAdicion" name="codigoAdicion">
                                <?php echo $cadenaAdiciones ?>
                            </select>
                        </div>
                    </div> <!-- /form-group-->                     
                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="createCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div> <!-- /modal-footer -->	      
            </form> <!-- /.form -->           
        </div> <!-- /modal-content -->    
    </div> <!-- /modal-dailog -->
</div> 

<!-- formulario para ver activo -->
<div class="modal fade" id="verActivoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="verActivoForm" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-eye-open"></i> Detalle producto</h4>
                </div>
                <div class="modal-body">

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Cargando...</span>
                    </div>

                    <div class="ver-activo-result">
                        <div class="form-group">
                            <label for="verMarca" class="col-sm-4 control-label">Marca: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="verMarca" placeholder="Marca" name="verMarca" readonly="">
                            </div>
                        </div> <!-- /form-group-->                        

                        <div class="form-group">
                            <label for="verModelo" class="col-sm-4 control-label">Modelo: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="verModelo" placeholder="Modelo" name="verModelo" readonly="">
                            </div>
                        </div> <!-- /form-group--> 

                        <div class="form-group">
                            <label for="verSerie" class="col-sm-4 control-label">Serie: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="verSerie" placeholder="Serie" name="verSerie" readonly="">
                            </div>
                        </div> <!-- /form-group--> 

                    </div>         	        
                    <!-- /edit brand result -->

                </div> <!-- /modal-body -->
                <div class="modal-footer verFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>

<!-- formulario para editar activo -->
<div class="modal fade" id="editActivoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="editActivoForm" action="php_action/editActivo.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Editar Activo</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-activo-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Cargando...</span>
                    </div>

                    <div class="edit-activo-result">
                        <div class="form-group">
                            <label for="editCodigoDepartamento" class="col-sm-4 control-label">Departamento </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <select class="form-control" id="editCodigoDepartamento" name="editCodigoDepartamento" onchange="obtenerEditUsuarios()">
                                    <?php echo $cadenaDepartamentos ?>
                                </select>
                            </div>
                        </div> <!-- /form-group-->

                        <script>
                            function obtenerEditUsuarios() {
                                //obtengo el formulario
                                oFormObject = document.forms['editarActivoForm'];
                                //obtengo el codigo del producto...    
                                var cod = document.getElementById("editCodigoDepartamento").value;
                                $.ajax({
                                    url: 'php_action/obtenerUsuarios.php?codigoDepartamento=' + cod,
                                    complete: function (response) {
                                        //obtengo el combo
                                        var z = document.getElementById("editCodigoNit");
                                        //limpio el combo antes de agregar las opciones
                                        z.options.length = 0;
                                        //obtengo las opciones
                                        var info = response.responseText;
                                        //hago un split por cada opcion
                                        var arr = info.split(";");
                                        for (x = 0; x < arr.length - 1; x++) {
                                            //otro split para opcion y nombre
                                            var arr2 = arr[x].split("*");
                                            var option = document.createElement("option");
                                            option.value = arr2[0];
                                            option.text = arr2[0] + " / " + arr2[1];
                                            //las agrego...
                                            z.add(option);
                                        }
                                    },
                                    error: function () {
                                        $('#output').html('Imposible obtener datos');
                                    },
                                });
                            }
                        </script>                      

                        <div class="form-group">
                            <label for="editCodigoNit" class="col-sm-4 control-label">N.I.T </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <select class="form-control" id="editCodigoNit" name="editCodigoNit">
                                    <option value="">-- Seleccionar --</option>                                
                                </select>
                            </div>
                        </div>
                    </div>         	        
                    <!-- /edit brand result -->
                </div> <!-- /modal-body -->
                <div class="modal-footer editActivoFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>	        
                    <button type="submit" class="btn btn-success" id="editActivoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>

<!-- formulario para certificar activo -->
<div class="modal fade" id="certificarActivoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="certificarActivoForm" action="php_action/certificarActivo.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-pencil"></i> Asignar proyecto</h4>
                </div>
                <div class="modal-body">

                    <div id="certificar-activo-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Cargando...</span>
                    </div>

                    <div class="certificar-activo-result">
                        <div class="form-group">
                            <label for="codigoCertificacion" class="col-sm-4 control-label"> Proyecto </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <select class="form-control" id="codigoCertificacion" name="codigoCertificacion">
                                    <?php echo $cadenaCertificaciones ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cantidad" class="col-sm-4 control-label"> Cantidad </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="cantidad" placeholder="Cantidad" name="cantidad" required="">
                                </div>
                            </div>
                        </div><!-- /form-group--> 
                    </div>         	        
                    <!-- /edit brand result -->
                </div> <!-- /modal-body -->
                <div class="modal-footer certificarActivoFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>	        
                    <button type="submit" class="btn btn-success" id="certificarActivoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>


<!-- formulario para bajar activo -->
<div class="modal fade" id="bajarActivoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="bajarActivoForm" action="php_action/bajarActivo.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-circle-arrow-down"></i> Dar de baja al activo</h4>
                </div>
                <div class="modal-body">

                    <div id="bajar-activo-messages"></div>

                    <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Cargando...</span>
                    </div>

                    <div class="bajar-activo-result">
                        <div class="form-group">
                            <label for="codigoActa" class="col-sm-4 control-label"> Acta </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <select class="form-control" id="codigoActa" name="codigoActa">
                                    <?php echo $cadenaActas ?>
                                </select>
                            </div>
                        </div>                        
                    </div>         	        
                    <!-- /edit brand result -->
                </div> <!-- /modal-body -->
                <div class="modal-footer bajarActivoFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>	        
                    <button type="submit" class="btn btn-success" id="bajarActivoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>





