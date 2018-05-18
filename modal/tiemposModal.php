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

<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitBrandForm" action="php_action/createTiempo.php" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo Registro</h4>
                </div>
                <div class="modal-body">

                    <div id="add-brand-messages"></div>

                    <div class="form-group">
                        <label for="fecha" class="col-sm-4 control-label">Fecha  </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="codigoFecha" name="codigoFecha" onchange="obtenerCategorias()">
                                <option value="">-- Seleccionar --</option> 
                                <?php echo $cadenaFechas ?>
                            </select>
                        </div>
                    </div> <!-- /form-group--> 

                    <div class="form-group">
                        <label for="categoria" class="col-sm-4 control-label">Categoria  </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="codigoCategoria" name="codigoCategoria" onchange="obtenerHeats();
                                    obtenerPilotos()" >

                            </select>
                        </div>
                    </div> <!-- /form-group--> 

                    <div class="form-group">
                        <label for="heat" class="col-sm-4 control-label">HEAT  </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <select class="form-control" id="codigoHeat" name="codigoHeat">

                            </select>
                        </div>
                    </div> <!-- /form-group--> 

                    <!-- llamada ajax -->
                    <script>
                        function obtenerCategorias() {
                            //obtengo el formulario
                            oFormObject = document.forms['submitBrandForm'];
                            //obtengo el codigo del producto...    
                            var cod = document.getElementById("codigoFecha").value;
                            $.ajax({
                                url: 'php_action/obtenerCategorias.php?codigoFecha=' + cod,
                                complete: function (response) {
                                    //obtengo el combo
                                    var z = document.getElementById("codigoCategoria");

                                    //limpio el combo antes de agregar las opciones
                                    z.options.length = 0;

                                    //obtengo las opciones
                                    var info = response.responseText;
                                    //hago un split por cada opcion
                                    var arr = info.split(";");
                                    for (x = 0; x < arr.length - 1; x++) {
                                        //otro split para opcion y nombre
                                        var arr2 = arr[x].split("-");
                                        var option = document.createElement("option");
                                        option.value = arr2[0];
                                        option.text = arr2[0] + " - " + arr2[1];
                                        //las agrego...
                                        z.add(option);
                                    }
                                },
                                error: function () {
                                    $('#output').html('Imposible obtener datos');
                                },
                            });
                        }

                        function obtenerHeats() {
                            //obtengo el formulario
                            oFormObject = document.forms['submitBrandForm'];
                            //obtengo el codigo del producto...    
                            var cod = document.getElementById("codigoCategoria").value;
                            $.ajax({
                                url: 'php_action/obtenerHeats.php?codigoCategoria=' + cod,
                                complete: function (response) {
                                    //obtengo el combo
                                    var z = document.getElementById("codigoHeat");

                                    //limpio el combo antes de agregar las opciones
                                    z.options.length = 0;

                                    //obtengo las opciones
                                    var info = response.responseText;
                                    //hago un split por cada opcion
                                    var arr = info.split(";");
                                    for (x = 0; x < arr.length - 1; x++) {
                                        //otro split para opcion y nombre
                                        var arr2 = arr[x].split("-");
                                        var option = document.createElement("option");
                                        option.value = arr2[0];
                                        option.text = arr2[0] + " - " + arr2[1];
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
                        <label for="codigoAdicion" class="col-sm-4 control-label">Registro </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-7">
                            <table id="myTable" class=" table order-list">
                                <thead>
                                    <tr>
                                        <td>Piloto</td>
                                        <td>Vuelta</td>
                                        <td>Tiempo</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto1" name="codPiloto1">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta1" name="vuelta1"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo1" name="tiempo1"  class="form-control" />
                                        </td>                                          
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto2" name="codPiloto2">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta2" name="vuelta2"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo2" name="tiempo2"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto3" name="codPiloto3">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta3" name="vuelta3"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo3" name="tiempo3"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto4" name="codPiloto4">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta4" name="vuelta4"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo4" name="tiempo4"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto5" name="codPiloto5">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta5" name="vuelta5"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo5" name="tiempo5"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto6" name="codPiloto6">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta6" name="vuelta6"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo6" name="tiempo6"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto7" name="codPiloto7">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta7" name="vuelta7"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo7" name="tiempo7"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto8" name="codPiloto8">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta8" name="vuelta8"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo8" name="tiempo8"  class="form-control"  />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto9" name="codPiloto9">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta9" name="vuelta9"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo9" name="tiempo9"  class="form-control" />
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col-sm-4">
                                            <select class="form-control" id="codPiloto10" name="codPiloto10">
                                                <?php echo $cadenaProductos ?>
                                            </select>
                                        </td>
                                        <td class="col-sm-4">
                                            <input type="text" id ="vuelta10" name="vuelta10"  class="form-control" />
                                        </td>
                                        <td class="col-sm-3">
                                            <input type="text" id ="tiempo10" name="tiempo10"  class="form-control" />
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


                    <script>
                        function obtenerPilotos() {
                            //obtengo el formulario
                            oFormObject = document.forms['submitBrandForm'];
                            //obtengo el codigo del producto...    
                            var cod = document.getElementById("codigoCategoria").value;
                            $.ajax({
                                url: 'php_action/obtenerPilotos.php?codigoCategoria=' + cod,
                                complete: function (response) {

                                    for (c = 1; c <= 10; c++)
                                    {
                                        //obtengo el combo
                                        var z = document.getElementById("codPiloto" + c);
                                        //limpio el combo antes de agregar las opciones
                                        z.options.length = 0;
                                        //obtengo las opciones
                                        var info = response.responseText;
                                        //hago un split por cada opcion
                                        var arr = info.split(";");
                                        for (x = 0; x < arr.length - 1; x++) {
                                            //otro split para opcion y nombre
                                            var arr2 = arr[x].split("-");
                                            var option = document.createElement("option");
                                            option.value = arr2[0];
                                            option.text = arr2[0] + " - " + arr2[1];
                                            //las agrego...
                                            z.add(option);
                                        }
                                    }
                                },
                                error: function () {
                                    $('#output').html('Imposible obtener datos');
                                },
                            });
                        }
                    </script>
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
<div class="modal fade" id="generarOrdenModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="generarOrdenForm" action="php_action/createFactPDF.php" method="POST" enctype="multipart/form-data">
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
                            <input type="date" class="form-control" id="fechaPDF" name="fechaPDF" >
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group">
                        <label for="encabezadoPDF" class="col-sm-3 control-label"> Encabezado: </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
                            <textarea name="encabezadoPDF" id="encabezadoPDF" rows="6" cols="50" ></textarea>
                        </div>
                    </div> <!-- /form-group-->
                </div> <!-- /modal-body -->

                <div class="modal-footer generarCertificacionFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>	        
                    <button type="submit" class="btn btn-primary" id="createOrdenPDFBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div> <!-- /modal-footer -->	      
            </form> <!-- /.form -->	
        </div> <!-- /modal-content -->    
    </div> <!-- /modal-dailog -->
</div>

<!-- BORRAR INGRESO -->
<div class="modal fade" tabindex="-1" role="dialog" id="eliminarIngresoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar Ingreso</h4>
            </div>
            <div class="modal-body">
                <p> ¿Realmente desea eliminar el ingreso seleccionado?</p>
            </div>
            <div class="modal-footer removeBrandFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" id="eliminarIngresoModalBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>