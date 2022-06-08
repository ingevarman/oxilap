<?= $this->extend('layouts/admin') ?>
<?= $this->section('pagestyles') ?>
<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/fontawesome/css/all.min.css'); ?>">
<!-- <link rel="stylesheet" href="<?php echo base_url('dist/vendors/fontawesome/scss/_reboot.scss'); ?>"> -->
<!-- END: Page CSS-->
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<!-- START: Breadcrumbs-->

<div class="row">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto">
                <h4 class="mb-0">Principal</h4>
                <p>Bienvenido al panel principal del sistema</p>
            </div>

            <!-- <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->
        </div>
    </div>
</div>

<!-- END: Breadcrumbs-->

<div class="row">

<?php
$impar = true;
$class = '';
foreach ($groups as $row) :
    if ($impar) {
        $class = 'col-md-6 col-lg-4 mt-3';
        $impar = false;
    } else {
        $class = 'col-12 col-md-6 col-lg-4  mt-3';
        $impar = true;
    }
?>


    <div class="<?= $class ?>">

        <div class="card">
            <div class="card-content">
                <div class="card-body p-4 text-center">

                    <div class="my-auto">
                        <i class="<?= $row->icon ?> icons card-liner-icon font-size-60 my-auto mt-2 text-nowrap"></i>
                    </div>
                    <div class="content my-3">
                        <span class="mb-0 font-w-600 h5"><?= strtoupper($row->name) ?></span><br>
                        <p class="mb-0 font-w-500 tx-s-12"><?= $row->description ?></p>
                    </div>

                    <div class="my-auto">
                        <a href="<?= site_url($row->url) ?>" class="btn btn-outline-primary font-w-600 my-auto text-nowrap">Ingresar al modulo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

</div>
<!-- END: Card DATA-->
<?= $this->endSection() ?>