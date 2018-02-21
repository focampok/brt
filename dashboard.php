<?php require_once 'includes/header.php'; ?>

<?php 

$consultaActivos = "SELECT * FROM PRODUCTO;";
$query = $connect->query($consultaActivos);
$totalActivos = $query->num_rows;

$consultaAdiciones = "SELECT * FROM CONTENEDOR";
$query2 = $connect->query($consultaAdiciones);
$totalAdiciones = ($query2->num_rows) - 1;

$consultaActas = "SELECT * FROM PROYECTO";
$query3 = $connect->query($consultaActas);
$totalActas = ($query3->num_rows) - 1;

$consultaTotal = "call obtenerTotalIngresos(@total)";
$connect->query($consultaTotal);
$c = "select @total as salida";
$query4 = $connect->query($c);
$rs = $query4->fetch_assoc();
$totalIngresos =  $rs['salida'];

$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="productos.php" style="text-decoration:none;color:black;">
					Total de Productos
					<span class="badge pull pull-right"><?php echo $totalActivos; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="bodegas.php" style="text-decoration:none;color:black;">
					Total de Bodegas
					<span class="badge pull pull-right"><?php echo $totalAdiciones; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="proyectos.php" style="text-decoration:none;color:black;">
					Total de Proyectos/Ordenes
					<span class="badge pull pull-right"><?php echo $totalActas ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d').' / '.date('m').' / '.date('Y'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php echo "Q ". number_format($totalIngresos,2)."<br>"; ?></h1>
		  </div>

		  <div class="cardContainer">
                      <p><b> Ingresos totales</b></p>
		  </div>
		</div> 

	</div>

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendario</div>
			<div class="panel-body">
				<div id="calendar"></div>
			</div>	
		</div>
		
	</div>

	
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();
	 


      $('#calendar').fullCalendar({
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<?php require_once 'includes/footer.php'; ?>