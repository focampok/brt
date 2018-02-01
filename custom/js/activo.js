var manageCategoriesTable;

$(document).ready(function () {
// active top navbar categories
    $('#navCategories').addClass('active');
    manageCategoriesTable = $('#manageCategoriesTable').DataTable({
        'ajax': 'php_action/ordenarActivos.php',
        'order': []
    }); // manage categories Data Table

    // on click on submit categories form modal
    $('#addCategoriesModalBtn').unbind('click').bind('click', function () {
        // reset the form text
        $("#submitCategoriesForm")[0].reset();
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');

        $("#imagenProducto").fileinput({
            overwriteInitial: true,
            maxFileSize: 30000,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
        });

        // submit categories form function
        $("#submitCategoriesForm").unbind('submit').bind('submit', function () {

            var form = $(this);
            // button loading
            $("#createCategoriesBtn").button('loading');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    // button loading
                    $("#createCategoriesBtn").button('reset');
                    if (response.success == true) {
                        // reload the manage member table 
                        manageCategoriesTable.ajax.reload(null, false);                        
                        // reset the form text
                        $("#submitCategoriesForm")[0].reset();
                        // remove the error text
                        $(".text-danger").remove();
                        // remove the form error
                        $('.form-group').removeClass('has-error').removeClass('has-success');                        
                        $('#addCategoriesModal').modal("hide");
                        $('#add-categories-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');
                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert
                    }// if
                } // /success
            }); // /ajax	
            return false;
        }); // submit categories form function
    }); // /on click on submit categories form modal	
}); // /document

function verActivo(id)
{
    if (id) {
        $.ajax({
            url: 'php_action/verActivo.php',
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function (response) {
                // modal spinner
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.ver-activo-result').removeClass('div-hide');
                //modal footer
                $(".verFooter").removeClass('div-hide');
                $("#verMarca").val(response.marca);
                $("#verModelo").val(response.modelo);
                $("#verSerie").val(response.serie);
            } // /success
        }); // /fetch the selected categories data

    } else {
        alert('Oops!! Refresh the page');
    }
}


function editarActivo(id)
{
    if (id) {
        $.ajax({
            url: 'php_action/editActivo.php',
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function (response) {
                // modal spinner
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.ver-activo-result').removeClass('div-hide');
                //modal footer
                $(".verFooter").removeClass('div-hide');
                $("#verInfo").val(response);
            } // /success
        }); // /fetch the selected categories data

    } else {
        alert('Oops!! Refresh the page');
    }
}



function certificarActivo(id)
{
    if (id)
    {
        // remove hidden id text
        $('#activoID').remove();
        // activo id 
        $(".certificarActivoFooter").after('<input type="hidden" name="activoID" id="activoID" value="' + id + '" />');

        // update brand form 
        $('#certificarActivoForm').unbind('submit').bind('submit', function () {

            // remove the error text
            $(".text-danger").remove();
            // remove the form error
            $('.form-group').removeClass('has-error').removeClass('has-success');
            var form = $(this);
            // submit btn
            $('#certificarActivoBtn').button('loading');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        console.log(response);
                        // submit btn
                        $('#certificarActivoBtn').button('reset');
                        // reload the manage member table                         
                        manageCategoriesTable.ajax.reload(null, false);
                        // remove the error text
                        $(".text-danger").remove();
                        // remove the form error
                        $('.form-group').removeClass('has-error').removeClass('has-success');

                        $('#certificar-activo-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert
                    }
                    else if (response.success == false)
                    {
                        $('#certificarActivoBtn').button('reset');

                        $('#certificar-activo-messages').html('<div class="alert alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> ' + response.messages +
                                '</div>');

                        $(".alert-danger").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert 
                    }

                }// /success
            });	 // /ajax
            return false;
        }); // /update brand form
    }
    else {
        alert('Oops!! Refresh the page');
    }
}

function bajarActivo(id)
{
    if (id)
    {
        // remove hidden id text
        $('#activoID').remove();
        // activo id 
        $(".bajarActivoFooter").after('<input type="hidden" name="activoID" id="activoID" value="' + id + '" />');

        // update brand form 
        $('#bajarActivoForm').unbind('submit').bind('submit', function () {

            // remove the error text
            $(".text-danger").remove();
            // remove the form error
            $('.form-group').removeClass('has-error').removeClass('has-success');
            var form = $(this);
            // submit btn
            $('#bajarActivoBtn').button('loading');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        console.log(response);
                        // submit btn
                        $('#bajarActivoBtn').button('reset');
                        // reload the manage member table                         
                        manageCategoriesTable.ajax.reload(null, false);
                        // remove the error text
                        $(".text-danger").remove();
                        // remove the form error
                        $('.form-group').removeClass('has-error').removeClass('has-success');

                        $('#bajar-activo-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert
                    }
                    else if (response.success == false)
                    {
                        $('#bajarActivoBtn').button('reset');

                        $('#bajar-activo-messages').html('<div class="alert alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> ' + response.messages +
                                '</div>');

                        $(".alert-danger").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        }); // /.alert 
                    }// /if

                }// /success
            });	 // /ajax
            return false;
        }); // /update brand form
    }
    else {
        alert('Oops!! Refresh the page');
    }
}
