var manageBitacoraTable;

$(document).ready(function() {
	// top bar active
	$('#navBitacora').addClass('active');
	
	// manage brand table
	manageBitacoraTable = $("#manageBitacoraTable").DataTable({
		'ajax': 'php_action/ordenarBitacora.php',
		'order': []
		
	});
});

