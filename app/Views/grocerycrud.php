<?= $this->extend('layouts/admin') ?>
<?= $this->section('pagestyles') ?>
<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/fontawesome/css/all.min.css'); ?>">

<?php
foreach ($css_files as $file) :
    if (!strpos($file, 'bootstrap.css')) :
?>

        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php
    endif;
endforeach;
?>


<style type="text/css">
    .gc-caption-title-container {
        visibility: hidden;
        display: none;
    }
</style>

<!-- END: Page CSS-->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid site-width">
    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">

            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto">
                    <?php if (!empty($tituloGrocerycrud)) : ?>
                        <h4 class="mb-0"><?= empty($tituloGrocerycrud) ? '' : $tituloGrocerycrud ?></h4>
                    <?php endif; ?>

                    <?php if (!empty($botonVolver)) : ?>
                        <a href="<?= site_url($botonVolver) ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"> Volver </i></a>
                    <?php endif; ?>
                </div>


            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <!-- START: Card Data-->
    <div class="row">
        <div class="col-12  mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title"><?= empty($subTituloGrocerycrud) ? '' : $subTituloGrocerycrud ?></h4>
                </div>
                <!-- <div class="card-body"> -->
                <!-- <div class="card"> -->
                    <?= $output; ?>
                <!-- </div> -->
            </div>
        </div>



    </div>
    <!-- END: Card DATA-->
</div>
<?= $this->endSection() ?>



<?= $this->section('pagescript') ?>
<!-- START: Page JS-->
<?php foreach ($js_files as $file) :
    if (!strpos($file, '/jquery.js')) :

?>

        <script src="<?php echo $file; ?>"></script>
<?php endif;
endforeach; ?>
<!-- END: Page JS-->
<?= $this->endSection() ?>