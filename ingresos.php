<?php require_once 'includes/header.php'; ?>
<?php include('modal/ingresosModal.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Ingresos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Ingresos</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Nuevo Ingreso </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageIngresoTable">
					<thead>
						<tr>
                                                        
							<th>Código</th>
							<th>Factura</th>
                                                        <th>Proveedor</th>
                                                        <th>Total</th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/ingreso.js"></script>

<?php require_once 'includes/footer.php'; ?>