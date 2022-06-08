(function ($) {
    "use strict";

    $("#form-buscar").submit(function (event) {
        if (this.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            this.classList.add('was-validated');
        } else {


            event.preventDefault();
            var html = '';
            var dataForm = $('#formBuscar').serialize();

            $.ajax({
                url: site_url + 'abonado/insert',
                data: dataForm,
                type: 'POST',
                dataType: 'json',
                success: function (json) {

                    html = `
                <div class="contact ` + json.id_paquete + `">
                            <div class="contact-content">
                                <!-- <div class="contact-profile"> -->
                                <!-- <img src="<?php echo base_url(
                                                    'dist/images/contact-13.jpg'
                                                ); ?>" alt="avatar" class="user-image img-fluid"> -->
                                <!-- </div> -->
                                <div class="contact-codigo">
                                    <p class="mb-0 small">Codigo Abonado: </p>
                                    <p class="user-codigo">`+ json.codigo_abonado + `</p>
                                </div>
                                <div class="contact-nombre">
                                    <p class="user-nombre mb-0">`+ json.nombre_completo_abonado + `</p>
                                    <p class="user-paquete mb-0 small font-weight-bold text-muted">CI: `+ json.ci_expedito + `</p>
                                </div>

                                <div class="contact-ci">
                                    <p class="mb-0 small">`+ json.codigo_categoria + ` </p>
                                    <p class="user-ci">` + json.nombre + `|P-` + json.regular_puntos + `|A-` + json.ampliacion_puntos + `</p>
                                </div>
                                <div class="contact-telefono">
                                    <p class="mb-0 small">Contrato: </p>
                                    <p class="user-telefono">`+ json.fecha_contrato + `</p>
                                </div>
                                <div class="contact-telefono">
                                    <p class="mb-0 small">Instalacion: </p>
                                    <p class="user-telefono">`+ json.fecha_instalacion + `</p>
                                </div>
                                <div class="line-h-1 h5">
                                    
                                    <a class="text-success reporte-pdf" href="`+ site_url + `abonado/contrato/` + json.id_abonado + `"><i class="icon-printer"></i></a>
                                    <a class="text-success" href="`+ site_url + `abonado/kardex/` + json.id_abonado + `" ><i class="icon-notebook"></i></a>
                                    
                                </div>
                            </div>
                        </div>
                    `;

                    $(".contacts").prepend(html);
                    $(".datos-personales").prop('disabled', false);

                    $('#add-ci').val('');
                    $('#add-expedito').val('');
                    $('#add-fechaNacimiento').val('');
                    $('#add-nombres').val('');
                    $('#add-primerApellido').val('');
                    $('#add-segundoApellido').val('');
                    $('#add-email').val('');
                    $('#add-telefono').val('');

                    $('#add-idPaquete').val('');
                    $('#add-ampliacionPuntos').val('');
                    $('#add-fechaContrato').val('');
                    $('#add-fechaInstalacion').val('');
                    $('#add-idZona').val('');
                    $('#add-direccion').val('');
                    $('#add-facturaNombre').val('');
                    $('#add-facturaNit').val('');

                    $("#class-add-ci .invalid-tooltip").html('');
                    document.getElementById("formNuevoAbonado").classList.remove('was-validated');
                    document.getElementById("class-add-ci").classList.remove('was-validated');
                    // document.getElementById("class-add-email").classList.remove('was-validated');

                    $('#newcontact').modal('toggle');
                    swal("Exito!", "Los datos se almacenaron de forma correcta!", "success");
                },
                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error: function (xhr, status) {
                    swal("Error!", "Disculpe, existió un problema!", "error");
                },

                // código a ejecutar sin importar si la petición falló o no
                // complete : function(xhr, status) {
                //     alert('Petición realizada');
                // }
            });

        }

    });








    var contact;

    $('.scrollertodo').slimScroll({
        height: '500px',
        color: '#fff'
    });

    $('.contact-menu a').on('click', function () {
        $('.contact-menu a').removeClass('active');
        $(this).addClass('active');
        $('.contact').hide();
        $('.' + $(this).data("contacttype")).show(500);
        return false;
    });
    $('.list-style').on('click', function () {
        $('.grid-style').removeClass('active');
        $('.contacts').removeClass('grid');
        $(this).addClass('active');
        $('.contacts').addClass('list');
        return false;
    });
    $('.grid-style').on('click', function () {
        $('.list-style').removeClass('active');
        $('.contacts').removeClass('list');
        $(this).addClass('active');
        $('.contacts').addClass('grid');
        return false;
    });
    $(".contacts").on("click", ".delete-contact", function () {
        $(this).closest('.contact').addClass('outline-badge-danger');
        $(this).closest('.contact').slideUp(550, function () {
            $(this).closest('.contact').remove();
        });
    });

    $(".add-contact-form").submit(function (event) {
        var name = $('#contact-name').val();
        var email = $('#contact-email').val();
        var occupation = $('#contact-occupation').val();
        var phone = $('#contact-phone').val();
        var location = $('#contact-location').val();

        var html = `<div class="contact family-contact"> 
                                            <div class="contact-content">
                                            <div class="contact-profile">                                                   
                                                <img src="dist/images/contact-dummy.jpg" alt="avatar" class="user-image img-fluid">
                                                <div class="contact-info">
                                                    <p class="contact-name mb-0">` + name + `</p>
                                                    <p class="contact-position mb-0 small font-weight-bold text-muted">` + occupation + `</p>
                                                </div>
                                            </div>
                                            <div class="contact-email">
                                                <p class="mb-0 small">Email: </p>
                                                <p class="user-email">` + email + `</p>
                                            </div>
                                            <div class="contact-location">
                                                <p class="mb-0 small">Location: </p>
                                                <p class="user-location">` + location + `</p>
                                            </div>
                                            <div class="contact-phone">
                                                <p class="mb-0 small">Phone: </p>
                                                <p class="user-phone">` + phone + `</p>
                                            </div>
                                            <div class="line-h-1 h5">
                                                <a class="text-success edit-contact" href="#" data-toggle="modal" data-target="#editcontact"><i class="icon-pencil"></i></a>
                                                <a class="text-danger delete-contact" href="#"><i class="icon-trash"></i></a>                                 
                                            </div>
                                            </div>
                                        </div>`;

        $(".contacts").prepend(html);
        $('#contact-name').val('');
        $('#contact-email').val('');
        $('#contact-occupation').val('');
        $('#contact-phone').val('');
        $('#contact-location').val('');
        $('#newcontact').modal('toggle');
        event.preventDefault();
    });


    $(".todo-list").on("click", ".delete", function () {
        $(this).closest('.todo-item').addClass('bg-danger');
        $(this).closest('.todo-item').slideUp(550, function () {
            $(this).closest('.todo-item').remove();
        });
    });

    $(".contacts").on("click", ".edit-contact", function () {
        contact = $(this).closest('.contact');
        $('#edit-contact-name').val($(this).closest('.contact').find('.contact-name').html());
        $('#edit-contact-email').val($(this).closest('.contact').find('.user-email').html());
        $('#edit-contact-occupation').val($(this).closest('.contact').find('.contact-position').html());
        $('#edit-contact-phone').val($(this).closest('.contact').find('.user-phone').html());
        $('#edit-contact-location').val($(this).closest('.contact').find('.user-location').html());

        $("#editcontact").modal();

    });
    $(".edit-contact-form").submit(function (event) {
        var name = $('#edit-contact-name').val();
        var email = $('#edit-contact-email').val();
        var occupation = $('#edit-contact-occupation').val();
        var phone = $('#edit-contact-phone').val();
        var location = $('#edit-contact-location').val();

        contact.find('.contact-name').html(name);
        contact.find('.user-email').html(email);
        contact.find('.contact-position').html(occupation);
        contact.find('.user-phone').html(phone);
        contact.find('.user-location').html(location);

        $('#editcontact').modal('toggle');
        event.preventDefault();
    });
    $(".contact-search").on("keyup", function () {
        var v = $(".contact-search").val().toLowerCase();
        var rows = $('.' + $('.contact-menu li a.active').data("contacttype"));

        for (var i = 0; i < rows.length; i++) {
            var fullname = rows[i].getElementsByClassName("contact-content");
            fullname = fullname[0].innerHTML.toLowerCase();
            if (fullname) {
                if (v.length == 0 || (v.length < 1 && fullname.indexOf(v) == 0) || (v.length >= 1 && fullname.indexOf(v) > -1)) {
                    rows[i].style.animation = 'fadein 7s';
                    rows[i].style.display = "block";
                } else {
                    rows[i].style.display = "none";
                    rows[i].style.animation = 'fadeout 7s';
                }
            }
        }
    });

})(jQuery);
