var manageBrandTable;

$(document).ready(function () {
    // top bar active
    $('#navIngreso').addClass('active');

    // manage brand table
    manageIngresoTable = $("#manageIngresoTable").DataTable({
        'ajax': 'php_action/ordenarOrdenes.php',
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
                    manageIngresoTable.ajax.reload(null, false);

                    // reset the form text
                    $("#submitBrandForm")[0].reset();
                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');

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


function guardarDatos(id)
{
    //en base al id obtengo la info.
    
    
    
    $.ajax({
        url: 'php_action/setearProductos.php',
        type: 'post',
        data: {test: id},
        dataType: 'json',
        success: function (response) {

            $('#add-brand-messages').html('<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                    '</div>');

        }

    });
}


function generarPDF(codCertificacion)
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
                        manageIngresoTable.ajax.reload(null, true);
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