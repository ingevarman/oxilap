<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<!-- START: Breadcrumbs-->
<div class="row ">
    <div class="col-12  align-self-center">
        <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto"><span class="h4 my-auto">ARCHIVO DOCENTE</span></div>
        </div>
    </div>
</div>
<!-- END: Breadcrumbs-->
<!-- START: Card Data-->
<div class="row">
    <div class="col-12 mt-3">
        <div class="position-relative">
            <div class="background-image-maker py-5"></div>
            <div class="holder-image">
                <img src="<?php echo base_url('dist/images/gradient-bg13.png'); ?>" alt="" class="img-fluid d-none">
            </div>
            <div class="position-relative px-3 py-4">
                <div class="media d-md-flex d-block">
                    <a href="#"><img src="<?php echo base_url('dist/images/contact-3.jpg'); ?>" width="110" alt="" class="img-fluid rounded-circle"></a>
                    <div class="media-body z-index-1">
                        <div class="pl-4">
                            <h1 class="display-5 text-uppercase text-white mb-2"><?= ucwords(strtolower($rowDocente->nombre.' '.$rowDocente->paterno.' '.$rowDocente->materno)); ?></h1>
                            <h6 class="text-uppercase text-white mb-0"><?= ucwords(strtolower($rowDocente->ci)); ?></h6>
                            <h2 class="text-white mb-0 text-right">Archivo Nro: <?= str_pad($rowDocente->codigo_archivo,5,"0", STR_PAD_LEFT); ?></h2>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-menu mt-4 theme-background border  z-index-1 p-2">
            <div class="d-sm-flex">
                <div class="align-self-center">
                    <ul class="nav nav-pills flex-column flex-sm-row" id="myTab" role="tablist">
                        <li class="nav-item ml-0">
                            <a class="nav-link  py-2 px-3 px-lg-4  <?= $botonActivo == 'kardex' ? 'active' : ''; ?>" href="<?= site_url('archivo/kardex/' . $rowDocente->id_docente_codificado); ?>">Kardex</a>
                        </li>
                        <li class="nav-item ml-0">
                            <a class="nav-link  py-2 px-4 px-lg-4 <?= $botonActivo == 'titulo' ? 'active' : ''; ?>" href="<?= site_url('archivo/titulo/' . $rowDocente->id_docente_codificado); ?>"> Titulos Profesionales</a>
                        </li>
                        <li class="nav-item ml-0">
                            <a class="nav-link  py-2 px-4 px-lg-4 <?= $botonActivo == 'produccion-intelectual' ? 'active' : ''; ?>" href="<?= site_url('archivo/produccionintelectual/' . $rowDocente->id_docente_codificado); ?>"> Produccion Intelectual</a>

                        </li>
                        <li class="nav-item ml-0">
                            <a class="nav-link  py-2 px-4 px-lg-4 <?= $botonActivo == 'actividad-academica' ? 'active' : ''; ?>" href="<?= site_url('archivo/actividadacademica/' . $rowDocente->id_docente_codificado); ?>">Actividad Academica</a>
                        </li>                        
                        <li class="nav-item ml-0">
                            <a class="nav-link  py-2 px-4 px-lg-4 <?= $botonActivo == 'vida-universitaria' ? 'active' : ''; ?>" href="<?= site_url('archivo/vidauniversitaria/' . $rowDocente->id_docente_codificado); ?>">Vida Universitaria</a>
                        </li>
                        <li class="nav-item ml-0">
                            <a class="nav-link  py-2 px-4 px-lg-4 <?= $botonActivo == 'evaluacion' ? 'active' : ''; ?>" href="<?= site_url('archivo/evaluacion/' . $rowDocente->id_docente_codificado); ?>">Evaluaciones</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <?php
                    if (empty($output)) : ?>
                        <div class="alert alert-dark mb-0" role="alert">
                            <p class="lead">Bienvenido a la administracion de Archivo Docente</p>
                        </div>
                    <?php else :
                        echo $output;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Card DATA-->
<?= $this->endSection() ?>
<?= $this->section('pagestyles') ?>
<!-- START: Page CSS-->
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/fontawesome/css/all.min.css'); ?>"> 
<?php
if (!empty($css_files)) :
    foreach ($css_files as $file) :
        if (!strpos($file, 'bootstrap.css')) :
?>

            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php
        endif;
    endforeach;
endif;
?>

<!-- END: Page CSS-->
<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- START: Page JS-->

<?php
if (!empty($js_files)) :
    foreach ($js_files as $file) :
        if (!strpos($file, '/jquery.js')) :
?>
            <script src="<?php echo $file; ?>"></script>
<?php endif;
    endforeach;
endif; ?>
<!-- END: Page JS-->
<?= $this->endSection() ?>