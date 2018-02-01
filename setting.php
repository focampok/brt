<?php require_once 'includes/header.php'; ?>

<?php 
$nit = $_SESSION['nit'];
$sql = "SELECT * FROM USUARIO WHERE nit = '$nit'";
$query = $connect->query($sql);
$result = $query->fetch_assoc();
$connect->close();

?>

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Configuración</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Configuración</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">			

				<!--<form action="php_action/changeUsername.php" method="post" class="form-horizontal" id="changeUsernameForm">
					<fieldset>
						<legend>Cambiar Nombre</legend>

						<div class="changeUsenrameMessages"></div>			

						<div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Nombre</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $result['nombre']; ?>"/>
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="nit" id="nit" value="<?php echo $result['nit'] ?>" /> 
					      <button type="submit" class="btn btn-success" data-loading-text="Cargando..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios </button>
					    </div>
					  </div>
					</fieldset>
				</form>-->

				<form action="php_action/changePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
					<fieldset>
						<legend>Cambiar contraseña</legend>

						<div class="changePasswordMessages"></div>

						<div class="form-group">
					    <label for="password" class="col-sm-2 control-label">Contraseña actual</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña actual">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="npassword" class="col-sm-2 control-label">Nueva contraseña</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="npassword" name="npassword" placeholder="Nueva contraseña">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="cpassword" class="col-sm-2 control-label">Confirmar contraseña</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirmar contraseña">
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="nit" id="nit" value="<?php echo $_SESSION['nit'] ?>" /> 
					      <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios </button>
					      
					    </div>
					  </div>


					</fieldset>
				</form>

			</div> <!-- /panel-body -->		

		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->	
</div> <!-- /row-->


<script src="custom/js/setting.js"></script>
<?php require_once 'includes/footer.php'; ?>