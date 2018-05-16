var pilotosTable;

$(document).ready(function () {
    // top bar active
    $('#navPiloto').addClass('active');

    // manage brand table
    pilotosTable = $("#pilotosTable").DataTable({
        'ajax': 'php_action/ordenarPilotos.php',
        'order': []

    });

    // submit brand form function
    $("#submitCertificacionForm").unbind('submit').bind('submit', function () {
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        var form = $(this);
        // button loading
        $("#createCertificacionBtn").button('loading');

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                // button loading
                $("#createCertificacionBtn").button('reset');

                if (response.success == true) {
                    // reload the manage member table 
                    pilotosTable.ajax.reload(null, false);

                    // reset the form text
                    $("#submitCertificacionForm")[0].reset();
                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');
                    
                    $('#addCertificacionModal').modal('hide');

                    $('#add-certificacion-messages').html('<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                            '</div>');

                    $(".alert-success").delay(500).show(10, function () {
                        $(this).delay(3000).hide(10, function () {
                            $(this).remove();
                        });
                    }); // /.alert
                }  // if

            } // /success
        }); // /ajax	


        return false;
    }); // /submit brand form function

});


function editarPiloto(brandId) {    
    if(brandId) {
		// remove hidden brand id text
		$('#brandId').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/ordenarPilotoSeleccionado.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');
                                // setting the brand name value 
				$('#codx').val(response.codigoPILOTO);
				// setting the brand name value 
				$('#nombrex').val(response.nombre);
				// setting the brand status value
				$('#carrox').val(response.carro);
				// brand id                                 
				$(".editBrandFooter").after('<input type="hidden" name="brandId" id="brandId" value="'+response.codigoPILOTO+'" />');

				// update brand form 
				$('#editBrandForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var brandName = $('#nombrex').val();
					var brandStatus = $('#carrox').val();

					if(brandName == "") {
						$("#nombrex").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#nombrex').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#nombrex").find('.text-danger').remove();
						// success out for form 
						$("#nombrex").closest('.form-group').addClass('has-success');	  	
					}

					if(brandStatus == "") {
						$("#carrox").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#carrox').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#carrox").find('.text-danger').remove();
						// success out for form 
						$("#carrox").closest('.form-group').addClass('has-success');	  	
					}

					if(brandName && brandStatus) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									pilotosTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
                                                                        $('#editHeatModal').modal("hide");
			  	  			
			  	  			$('#edit-brand-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
}

function eliminarPiloto(id)
{
    if (id) {
        // click on remove button to remove the brand
        $("#eliminarBodegaModalBtn").unbind('click').bind('click', function () {
            // button loading
            $("#eliminarBodegaModalBtn").button('loading');
            $.ajax({
                url: 'php_action/eliminarPiloto.php',
                type: 'post',
                data: {codigoBodega: id},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#eliminarBodegaModalBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#eliminarHeatModal').modal('hide');

                        // reload the brand table 
                        pilotosTable.ajax.reload(null, false);

                        $('.remove-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert
                    } else {

                    } // /else
                } // /response messages
            }); // /ajax function to remove the brand

        }); // /click on remove button to remove the brand

    } else {
        alert('error!! Refresh the page again');
    }
}




function anularCertificacion(id)
{
    if (id) {
        // click on remove button to remove the brand
        $("#anularCertificacionBtn").unbind('click').bind('click', function () {
            // button loading
            $("#anularCertificacionBtn").button('loading');
            $.ajax({
                url: 'php_action/anularCertificacion.php',
                type: 'post',
                data: {codigoCertificacion: id},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#anularCertificacionBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#anularCertificacionModal').modal('hide');

                        // reload the brand table 
                        pilotosTable.ajax.reload(null, false);

                        $('.remove-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert
                    } else {

                    } // /else
                } // /response messages
            }); // /ajax function to remove the brand

        }); // /click on remove button to remove the brand

    } else {
        alert('error!! Refresh the page again');
    }
}

function quitarActivo(codInventario, codProyecto)
{
    if (codInventario) {
        // click on remove button to remove the brand
        $("#quitarActivoBtn").unbind('click').bind('click', function () {
            // button loading
            $("#quitarActivoBtn").button('loading');
            $.ajax({
                url: 'php_action/quitarActivoCertificacion.php',
                type: 'post',
                data: {codigoInventario: codInventario, codigoProyecto: codProyecto},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#quitarActivoBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#quitarActivoModal').modal('hide');

                        // reload the brand table 
                        pilotosTable.ajax.reload(null, false);

                        $('.remove-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert
                    } else {

                    } // /else
                } // /response messages
            }); // /ajax function to remove the brand

        }); // /click on remove button to remove the brand

    } else {
        alert('error!! Refresh the page again');
    }
}

function generarCertificacion(codCertificacion)
{

    if (codCertificacion)
    {
        // remove hidden id text
        $('#codCertificacion').remove();
        // activo id 
        $(".generarCertificacionFooter").after('<input type="hidden" name="codCertificacion" id="codCertificacion" value="' + codCertificacion + '" />');

        // submit product form
        $("#generarCertificacionForm").unbind('submit').bind('submit', function () {

            // submit loading button
            $("#createCertificacionPDFBtn").button('loading');

            var form = $(this);
            var formData = new FormData(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {

                    if (response.success == true) {
                        // submit loading button
                        $("#createCertificacionPDFBtn").button('reset');

                        $("#generarCertificacionForm")[0].reset();

                        $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                        // shows a successful message after operation
                        $('#generar-certificacion-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        // reload the manage student table
                        pilotosTable.ajax.reload(null, true);
                        // remove text-error 
                        $(".text-danger").remove();
                        // remove from-group error
                        $(".form-group").removeClass('has-error').removeClass('has-success');
                    } // /if response.success

                } // /success function
            }); // /ajax function




            return false;
        }); // /submit product form
    }

}