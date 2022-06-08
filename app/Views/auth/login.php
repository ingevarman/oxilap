<?= $this->extend('layouts/front') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row vh-100 justify-content-between align-items-center">

        <div class="col-12">

            <!-- <form action="#" class="row row-eq-height lockscreen  mt-5 mb-5"> -->
            <?php echo form_open('auth/login', 'class="row row-eq-height lockscreen  mt-5 mb-5"'); ?>

            <div class="lock-image col-12 col-sm-5">
                <br><br>
                <img src="<?= base_url('dist/images/logo.png') ?>" width="230" height="230">
            </div>
            <div class="login-form col-12 col-sm-7">
                <center>
                    <h4>OXILAP S.R.L.</h4>
                    <p>Sistema Archivo Oxilap</p>
                </center>
                <div id="infoMessage"><?php echo $message; ?></div>
                <div class="form-group mb-3">
                    <label for="emailaddress">Usuario</label>
                    <?php
                    $identity['class'] = 'form-control';
                    $identity['required'] = '';
                    $identity['placeholder'] = 'Ingrese su Nro ci';

                    $password['class'] = 'form-control';
                    $password['required'] = '';
                    $password['placeholder'] = 'Ingrese su contraseña';
                    ?>
                    <?php echo form_input($identity); ?>
                    <!-- <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email"> -->
                </div>

                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <?php echo form_input($password); ?>
                    <!-- <input class="form-control" type="password" required="" id="password" placeholder="Enter your password"> -->
                </div>

                <div class="form-group mb-3">
                    <div class="custom-control custom-checkbox">
                        <!-- <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked=""> -->
                        <?php echo form_checkbox('remember', '1', false, 'id="remember"'); ?>
                        <label class="custom-control-label" for="checkbox-signin">Recuérdame</label>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <button class="btn btn-primary" type="submit"> Iniciar sesión </button>
                </div>

            </div>
            <?php echo form_close(); ?>

            
        </div>



    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pagestyles') ?>
<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/social-button/bootstrap-social.css'); ?>">
<!-- END: Page CSS-->
<script>
    $(document).ready(function() {
        $("a.reporte_pdf").click(function(event) {
            event.preventDefault();
            var href = $(this).attr('href');
            $('#modal_reporte div.modal-content').hide(0);
            $('#modal_reporte').modal("show");
            var contenido = '<div class="modal-header"><h4 class="modal-title"><i class="fa fa-file-pdf-o"></i> Imprimir</h4></div>' +
                '<div class="modal-body" style="height: ' + Math.floor($(window).height() * .7) + 'px"><iframe src="' + href + '" style="width:100%;height:100%;"></iframe></div>' +
                '<div class="modal-footer"><button type="button" class="btn grey btn-outline-secondary modal_cerrar"><i class="fa fa-close"></i> Cerrar</button><a id="enlace_pdf" class="btn btn-info" href="' + href + '/D" target="_blank"><i class="fa fa-download"></i> Descargar</a></div>';

            $('#modal_reporte div.modal-content').html(contenido).fadeIn("slow");
        });

        $('#modal_reporte').modal({
            "backdrop": "static",
            "keyboard": false,
            "show": false
        }).on('click', 'button.modal_cerrar', function() {
            $('#modal_reporte').modal('hide');
        });
    });
</script>
<?= $this->endSection() ?>