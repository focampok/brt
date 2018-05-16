<?php require_once 'includes/header.php'; ?>
<?php include('modal/pilotosModal.php');?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Pilotos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Pilotos</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addCertificacionModal" id="addCertificacionModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Nuevo Piloto </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="pilotosTable">
					<thead>
						<tr>							
							<th>Codigo</th>
							<th>Piloto</th>
                                                        <th>Carro</th>
                                                        <th>Cod. Categoria</th>
                                                        <th>Categoria</th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/piloto.js"></script>

<?php require_once 'includes/footer.php'; ?>