<?php require_once 'includes/headerAdmin.php'; ?>
<?php include('modal/usuariosModal.php');?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Usuarios</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Usuarios</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>								
				
				<table class="table" id="manageUsuariosTable">
					<thead>
						<tr>							
							<th>Nit</th>
							<th>Nombre</th>
                                                        <th>Apellido</th>
                                                        <th>Puesto</th>
                                                        <th>Departamento</th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/usuarios.js"></script>

<?php require_once 'includes/footer.php'; ?>