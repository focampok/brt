var manageUsuariosTable;

$(document).ready(function () {
    // top bar active
    $('#navUsuarios').addClass('active');

    // manage brand table
    manageUsuariosTable = $("#manageUsuariosTable").DataTable({
        'ajax': 'php_action/ordenarUsuarios.php',
        'order': []

    });
});

function eliminarUsuario(id)
{
    if (id) {
        // click on remove button to remove the brand
        $("#eliminarUsuarioBtn").unbind('click').bind('click', function () {
            // button loading
            $("#eliminarUsuarioBtn").button('loading');
            $.ajax({
                url: 'php_action/eliminarUsuario.php',
                type: 'post',
                data: {nit: id},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // button loading
                    $("#eliminarUsuarioBtn").button('reset');
                    if (response.success == true) {

                        // hide the remove modal 
                        $('#eliminarUsuarioModal').modal('hide');

                        // reload the brand table 
                        manageUsuariosTable.ajax.reload(null, false);

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
