<?php require_once 'includes/header.php'; ?>
<?php include('modal/tiemposModal.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Tiempos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Tiempos</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Nuevo Registro </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="tiemposTable">
					<thead>
						<tr>
                                                        
							<th># de Carro</th>
							<th>Piloto</th> 
                                                        <th>Fecha</th>
                                                        <th>Categoria</th>                                                        
                                                        <th>Heat</th> 
                                                        <th>Vuelta</th>
                                                        <th>Tiempo</th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/tiempo.js"></script>

<?php require_once 'includes/footer.php'; ?>