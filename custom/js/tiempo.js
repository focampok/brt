var tiemposTable;

$(document).ready(function () {
    // top bar active
    $('#navIngreso').addClass('active');

    // manage brand table
    tiemposTable = $("#tiemposTable").DataTable({
        'ajax': 'php_action/ordenarTiempos.php',
        'order': []

    });

    // submit brand form function
    $("#submitBrandForm").unbind('submit').bind('submit', function () {
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        var form = $(this);
        // button loading
        $("#createBrandBtn").button('loading');

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                // button loading
                $("#createBrandBtn").button('reset');

                if (response.success == true) {
                    // reload the manage member table 
                    tiemposTable.ajax.reload(null, false);

                    // reset the form text
                    $("#submitBrandForm")[0].reset();
                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');                    
                    $('#addBrandModel').modal("hide");
                    $('#add-brand-messages').html('<div class="alert alert-success">' +
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

function generarOrdenPDF(codCertificacion)
{

    if (codCertificacion)
    {
        // remove hidden id text
        $('#codCertificacion').remove();
        // activo id 
        $(".generarCertificacionFooter").after('<input type="hidden" name="codCertificacion" id="codCertificacion" value="' + codCertificacion + '" />');

        // submit product form
        $("#generarOrdenForm").unbind('submit').bind('submit', function () {

            // submit loading button
            $("#createOrdenPDFBtn").button('loading');

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
                        $("#createOrdenPDFBtn").button('reset');

                        $("#generarOrdenForm")[0].reset();

                        $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                        // shows a successful message after operation
                        $('#generar-certificacion-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        // reload the manage student table
                        tiemposTable.ajax.reload(null, true);
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

function eliminarIngreso(id)
{
    if (id) {
        // click on remove button to remove the brand
        $("#eliminarIngresoModalBtn").unbind('click').bind('click', function () {
            // button loading
            $("#eliminarIngresoModalBtn").button('loading');
            $.ajax({
                url: 'php_action/eliminarIngreso.php',
                type: 'post',
                data: {codigoOrden: id},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#eliminarIngresoModalBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#eliminarIngresoModal').modal('hide');

                        // reload the brand table 
                        tiemposTable.ajax.reload(null, false);

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