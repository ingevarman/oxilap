<!DOCTYPE html>
<html lang="en">
<!-- START: Head-->

<head>
    <meta charset="UTF-8">
    <title>Oxilap S.R.L.</title>
    <link rel="shortcut icon" href="<?php echo base_url('dist/images/favicon.ico'); ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors/jquery-ui/jquery-ui.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors/jquery-ui/jquery-ui.theme.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('dist/vendors/flags-icon/css/flag-icon.min.css'); ?>">
    <!-- END Template CSS-->


    <!-- START: Page CSS-->
    <?= $this->renderSection('pagestyles') ?>
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/main.css'); ?>">
    <!-- END: Custom CSS-->
</head>
<!-- END Head-->

<!-- START: Body-->

<body id="main-container" class="default  <?php echo isset($layout) ? $layout : 'semi-dark'; ?>" style=" <?php echo isset($color) ? $color : '--primarycolor:#C10000'; ?>">

    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <div class="loader"></div>
    </div>
    <!-- END: Pre Loader-->
    <?= $this->include('layouts/header') ?>

    <?php
    $session = session();
    $menuActual = 'menu';
    if (!empty($session->get('menu'))) {
        $menuActual = $session->get('menu');
    }

    ?>
    <?= $this->include('layouts/menu/' . $menuActual) ?>
    <!-- START: Main Content-->
    <main>
        <div class="container-fluid site-width">
            <?= $this->renderSection('content') ?>
        </div>
    </main>
    <!-- END: Content-->
    <?= $this->include('layouts/footer') ?>

    <div id="modal_reporte" class="modal fade text-left" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <script>
        var base_url = "<?= base_url('') ?>";
    </script>
    <!-- START: Template JS-->
    <script src="<?php echo base_url('dist/vendors/jquery/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('dist/vendors/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('dist/vendors/moment/moment.js'); ?>"></script>
    <script src="<?php echo base_url('dist/vendors/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('dist/vendors/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- END: Template JS-->


    <!-- START: Page JS-->
    <?= $this->renderSection('pagescript') ?>
    <!-- END: Page JS-->

    <!-- START: APP JS-->
    <script src="<?php echo base_url('dist/js/app.js'); ?>"></script>
    <!-- END: APP JS-->


    <script>
        $(document).ready(function() {
            $("a.reporte_pdf").click(function(event) {
                event.preventDefault();
                var href = $(this).attr('href');
                $('#modal_reporte div.modal-content').hide(0);
                $('#modal_reporte').modal("show");
                var contenido = '<div class="modal-header"><h4 class="modal-title"><i class="fa fa-file-pdf-o"></i> Imprimir</h4></div>' +
                    '<div class="modal-body" style="height: ' + Math.floor($(window).height() * .7) + 'px"><iframe src="' + href + '" style="width:100%;height:100%;"></iframe></div>' +
                    '<div class="modal-footer"><button type="button" class="btn grey btn-primary modal_cerrar"><i class="fa fa-close"></i> Cerrar</button></div>';

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

        $(document).ajaxComplete(function() {
            $("a.reporte_pdf").click(function(event) {
                event.preventDefault();
                var href = $(this).attr('href');
                $('#modal_reporte div.modal-content').hide(0);
                $('#modal_reporte').modal("show");
                var contenido = '<div class="modal-header"><h4 class="modal-title"><i class="fa fa-file-pdf-o"></i> Imprimir</h4></div>' +
                    '<div class="modal-body" style="height: ' + Math.floor($(window).height() * .7) + 'px"><iframe src="' + href + '" style="width:100%;height:100%;"></iframe></div>' +
                    '<div class="modal-footer"><button type="button" class="btn grey btn-primay modal_cerrar"><i class="fa fa-close"></i> Cerrar</button></div>';

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



</body>
<!-- END: Body-->

</html>