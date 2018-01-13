<?php require_once 'includes/headerAdmin.php'; ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Bitacora</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Acciones </div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>							
				
				<table class="table" id="manageBitacoraTable">
					<thead>
						<tr>							
							<th>Código</th>
							<th>Fecha</th>
                                                        <th>Acción</th>
							<th style="width:15%;">Usuario</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/bitacora.js"></script>

<?php require_once 'includes/footer.php'; ?>