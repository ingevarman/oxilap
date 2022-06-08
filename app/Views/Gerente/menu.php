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
                <h4 class="mb-0">Gerente</h4>
                <p>Bienvenido al panel principal del sistema</p>
            </div>
            

        </div>
    </div>
</div>

<div class="row">
<div class="card">
            <div class="card-content">
                <div class="card-body p-4 text-center">
                    <div class="content my-3">
                        <span class="mb-0 font-w-600 h5">Mi nombre esta aqui</span><br>
                        <p class="mb-0 font-w-500 tx-s-12">Parte de la descripcion es aqui</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="card">
            <div class="card-content">
                <div class="card-body p-4 text-center">
                    <div class="content my-3">
                        <span class="mb-0 font-w-600 h5">Mi nombre esta aqui</span><br>
                        <p class="mb-0 font-w-500 tx-s-12">Parte de la descripcion es aqui</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="card">
            <div class="card-content">
                <div class="card-body p-4 text-center">
                    <div class="content my-3">
                        <span class="mb-0 font-w-600 h5">Mi nombre esta aqui</span><br>
                        <p class="mb-0 font-w-500 tx-s-12">Parte de la descripcion es aqui</p>
                    </div>
                </div>
            </div>
            </div>


</div>

<!-- END: Breadcrumbs-->


<!-- END: Card DATA-->
<?= $this->endSection() ?>