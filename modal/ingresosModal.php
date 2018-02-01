<?php
// incluir el archivo de la conexion de datos
require_once("config/db.php");
// cargar la clase de login
require_once("classes/DBMaster.php");
//instancio el objeto de la clase sql
$conexion = new DBMaster();
$conexion->llenarComboProductos();
$cadenaProductos = $conexion->productos;
?>

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitBrandForm" action="php_action/createIngreso.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo Ingreso</h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="brandName" class="col-sm-3 control-label">Codigo  </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="codigo" placeholder="Código" name="codigo" autocomplete="off">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="fecha" class="col-sm-3 control-label">Fecha </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="fecha" placeholder="fecha" name="fecha" required="">
                        </div>
                    </div>                   
                    
                    
                    <!-- /form-group-->	         	        
                    <div class="form-group">
                        <label for="brandStatus" class="col-sm-3 control-label">Factura  </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="factura" placeholder="Factura" name="factura" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="brandStatus" class="col-sm-3 control-label">Proveedor  </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="proveedor" placeholder="Proveedor" name="proveedor" autocomplete="off">
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="codigoAdicion" class="col-sm-4 control-label">Producto </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <table id="myTable" class=" table order-list">
                                <thead>
                                    <tr>
                                        <td>Codigo</td>
                                        <td>Cantidad</td>
                                        <td>Precio</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd1" name="codProd1">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad1" name="cantidad1"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id="precio1" name="precio1"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd2" name="codProd2">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad2" name="cantidad2"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio2" name="precio2"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd3" name="codProd3">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad3" name="cantidad3"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio3" name="precio3"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd4" name="codProd4">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad4" name="cantidad4"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio4" name="precio4"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd5" name="codProd5">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad5" name="cantidad5"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio5" name="precio5"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd6" name="codProd6">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad6" name="cantidad6"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio6" name="precio6"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd7" name="codProd7">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad7" name="cantidad7"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio7" name="precio7"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd8" name="codProd8">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad8" name="cantidad8"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio8" name="precio8"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd9" name="codProd9">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad9" name="cantidad9"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio9" name="precio9"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codProd10" name="codProd10">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="cantidad10" name="cantidad10"  class="form-control"/>
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="precio10" name="precio10"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                </tbody>
                                <tfoot>                                    
                                    <tr>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div> <!-- /form-group--> 



                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add modal -->


<!-- GENERAR PDF -->
<div class="modal fade" id="generarContenedorPDFModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="generarCertificacionForm" action="php_action/createContPDF.php" method="POST" enctype="multipart/form-data">
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