var manageActasTable;

$(document).ready(function () {
    // top bar active
    $('#navActa').addClass('active');

    // manage brand table
    manageActasTable = $("#manageActasTable").DataTable({
        'ajax': 'php_action/ordenarActas.php',
        'order': []

    });

    // submit brand form function
    $("#submitActaForm").unbind('submit').bind('submit', function () {
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        var form = $(this);
        // button loading
        $("#createActaBtn").button('loading');

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                // button loading
                $("#createActaBtn").button('reset');

                if (response.success == true) {
                    // reload the manage member table 
                    manageActasTable.ajax.reload(null, false);

                    // reset the form text
                    $("#submitActaForm")[0].reset();
                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');

                    $('#add-acta-messages').html('<div class="alert alert-success">' +
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

function anularActa(id)
{
    if (id) {
        // click on remove button to remove the brand
        $("#anularActaBtn").unbind('click').bind('click', function () {
            // button loading
            $("#anularActaBtn").button('loading');
            $.ajax({
                url: 'php_action/anularActa.php',
                type: 'post',
                data: {codigoActa: id},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#anularActaBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#anularActaModal').modal('hide');

                        // reload the brand table 
                        manageActasTable.ajax.reload(null, false);

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

function quitarActivo(codInventario)
{
    if (codInventario) {
        // click on remove button to remove the brand
        $("#quitarActivoBtn").unbind('click').bind('click', function () {
            // button loading
            $("#quitarActivoBtn").button('loading');
            $.ajax({
                url: 'php_action/quitarActivoActa.php',
                type: 'post',
                data: {codigoInventario: codInventario},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#quitarActivoBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#quitarActivoModal').modal('hide');

                        // reload the brand table 
                        manageActasTable.ajax.reload(null, false);

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

function aprobarActa(id)
{
    if (id) {
        // click on remove button to remove the brand
        $("#aprobarActaBtn").unbind('click').bind('click', function () {
            // button loading
            $("#aprobarActaBtn").button('loading');
            $.ajax({
                url: 'php_action/aprobarActa.php',
                type: 'post',
                data: {codigoActa: id},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#aprobarActaBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#aprobarActaModal').modal('hide');

                        // reload the brand table 
                        manageActasTable.ajax.reload(null, false);

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


function generarActa(codActa)
{

    if (codActa)
    {
        // remove hidden id text
        $('#codActa').remove();        
        // activo id 
        $(".generarActaFooter").after('<input type="hidden" name="codActa" id="codActa" value="' + codActa + '" />');        
        
        // submit product form
        $("#generarActaForm").unbind('submit').bind('submit', function () {

            // submit loading button
            $("#createActaPDFBtn").button('loading');

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
                        $("#createActaPDFBtn").button('reset');

                        $("#generarActaForm")[0].reset();

                        $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

                        // shows a successful message after operation
                        $('#generar-acta-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        // reload the manage student table
                        manageActasTable.ajax.reload(null, true);
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