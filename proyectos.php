<?php require_once 'includes/header.php'; ?>
<?php include('modal/certificacionesModal.php');?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Proyectos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Proyectos</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addCertificacionModal" id="addCertificacionModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Nuevo Proyecto </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageCertificacionesTable">
					<thead>
						<tr>							
							<th>Código Proyecto</th>
							<th>Fecha</th>
                                                        <th>Estado</th>
                                                        <th>Productos</th>
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

<script src="custom/js/certificacion.js"></script>

<?php require_once 'includes/footer.php'; ?>