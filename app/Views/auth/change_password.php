<?= $this->extend('layouts/admin') ?>
<?= $this->section('pagestyles') ?>
<!-- START: Page CSS-->

<!-- END: Page CSS-->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid site-width">
      <!-- START: Breadcrumbs-->
      <div class="row ">
            <div class="col-12  align-self-center">

                  <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                                    <h4 class="mb-0"><?php echo lang('Auth.change_password_heading'); ?></h4>
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
                        <div class="card-body">

                              <div id="infoMessage"><?php echo $message; ?></div>

                              <?php echo form_open('auth/change_password'); ?>

                              <p>
                                    <?php echo form_label(lang('Auth.change_password_old_password_label'), 'old_password'); ?> <br />
                                    <?php echo form_input($old_password); ?>
                              </p>

                              <p>
                                    <label for="new_password"><?php echo sprintf(lang('Auth.change_password_new_password_label'), $minPasswordLength); ?></label> <br />
                                    <?php echo form_input($new_password); ?>
                              </p>

                              <p>
                                    <?php echo form_label(lang('Auth.change_password_new_password_confirm_label'), 'new_password_confirm'); ?> <br />
                                    <?php echo form_input($new_password_confirm); ?>
                              </p>

                              <?php echo form_input($user_id); ?>
                              <p><?php echo form_submit('submit', lang('Auth.change_password_submit_btn')); ?></p>

                              <?php echo form_close(); ?>



                              <!-- </div> -->
                        </div>
                  </div>



            </div>
            <!-- END: Card DATA-->
      </div>
      <?= $this->endSection() ?>



      <?= $this->section('pagescript') ?>
      <!-- START: Page JS-->

      <!-- END: Page JS-->
      <?= $this->endSection() ?>