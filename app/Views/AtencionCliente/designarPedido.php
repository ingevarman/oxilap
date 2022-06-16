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
                <h4 class="mb-0">Designar pedidos A:</h4>   
                <!-- $n_cliente = variable en numero para el regsitro-->
                <h5><?php echo $idOrdenCompra; ?></h5>
                <h5><?php echo $nombreCliente; ?></h5>
                <p>Registrar los Producto a la Orden de compra</p>
            </div>
            

        </div>
    </div>
</div>
<div class="row">
    <div class="col-16  align-self-center">
    <div class="table-responsive">
                                                                 <table class="table table-bordered table-hover" id="datatable" width="100%" cellspacing="0">
                                                                     <thead>
                                                                         <tr>
                                                                             <th></th>
                                                                             <th>Nombre del Producto</th>
                                                                             <th>Precio</th>                       
                                                                             <th>Fecha Proxima recarga</th>
                                                                             <th>Cantidad</th>
                                                                             <th>Sub Total</th>
                                                                         </tr>
                                                                     </thead>
                                                                 
                                                                     <?php 
                                                                     $total = 0;
                                                                     foreach ($datos as $dato):
                                                                     $total+=$dato->sub_total;
                                                                     ?>
                                                                         <tr> 
                                                                             <td><a href="<?= site_url('atencioncliente/designarPedido') ?>"  
                                                                             class="btn btn-danger"><i class="icon-trash"></i></a></td>
                                             
                                                                             <td><?= $dato->nombre_producto_tipo; ?></td>                          
                                                                             <td><?= $dato->	precio; ?></td>                             
                                                                             <td><?= $dato->	fecha_proxima_recarga; ?></td>
                                                                             <td><?= $dato->	cantidad; ?></td>
                                                                             <td><?= $dato->	sub_total; ?></td>
                                                                         </tr>
                                                                     <?php endforeach; ?>
                                                                 </table>
                                                          <h1>Total : <?=$total?><h1>
                                                             </div>
    </div>
</div>

<div class="row">
  <div class="card">
         
           
        
  
  </div>
</div>

<!-- END: Breadcrumbs-->
  <!-- START: Card Data-->
  <div class="row row-eq-height">
                    <div class="col-12 col-lg-2 mt-3 todo-menu-bar flip-menu pr-lg-0">
                        <a href="#" class="d-inline-block d-lg-none mt-1 flip-menu-close"><i class="icon-close"></i></a>
                        <div class="card border h-100 contact-menu-section">

                        <a href="#"  class="bg-primary py-2 px-2 rounded ml-auto text-white w-100 text-center" data-toggle="modal" data-target="#newcontact">
                                    <i class="icon-plus align-middle text-white"></i> <span class="d-none d-xl-inline-block">Ver Lista Registrada</span>
                        </a>


                            <!-- Add Contact -->
                            <div class="modal fade" id="newcontact">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="icon-pencil"></i>Lista del Pedido Registrado
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </div>
                                            
                                            <form class="#" method="post"  autocomplete="off">
                                                  
                                            <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-200 rounded">
                                                      <div class="w-sm-100 mr-auto">
                                               
                                                         </div>
                                                     </div>



                                                <div class="modal-footer">
                                                    <button type="submit" href="<?= site_url(); ?>/atencioncliente/registroPedido" class="btn btn-primary add-todo">Registrar el Detalle</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

     <!--inicio titulos de busqueda por grupos-->
                            <ul class="nav flex-column contact-menu">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#" data-contacttype="contact">
                                        <i class="icon-list"></i> Recarga de Productos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-contacttype="family-contact">
                                        <i class="icon-people"></i>Oxigeno Medicinal Por Zona
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-contacttype="friend-contact">
                                        <i class="icon-user-follow"></i> Friends
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  href="#" data-contacttype="office-contact">
                                        <i class="icon-check"></i> Office
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  href="#" data-contacttype="business-contact">
                                        <i class="icon-layers"></i> Business
                                    </a>
                                </li>

                            </ul>         
     <!--Fin titulos de busqueda por grupos-->
                        </div>  
                    </div>

                    <div class="col-12 col-lg-10 mt-3 pl-lg-0">
                        <div class="card border h-100 contact-list-section">
                            <div class="card-header border-bottom p-1 d-flex">
                                <a href="#" class="d-inline-block d-lg-none flip-menu-toggle"><i class="icon-menu"></i></a>
                                <input type="text" class="form-control border-0 p-2 w-100 h-100 contact-search" placeholder="Busqueda Rapida ...">
                                <a href="#" class="list-style search-bar-menu border-0 active"><i class="icon-list"></i></a>
                                <a href="#" class="grid-style search-bar-menu"><i class="icon-grid"></i></a>
                            </div>

                            <div class="card-body p-0"><!-- inicia card-body -->
                                <div class="contacts list"> 
          <!-- inicia los grupos -->
                    <?php foreach ($r_oxigeno as $r_oxigenos): ?>
                                    <div class="contact family-contact"> 
                                      <form class="edit-contact-form" method="post" action="<?= site_url('atencioncliente/registrarDetalle');?>"  autocomplete="off">

                                        <div class="contact-content">
                                            <div class="contact-profile">                                                   
                                                <!--<img src="dist/images/contact-1.jpg" alt="avatar" class="user-image img-fluid">-->
                                                <div class="contact-info">
                                                <input type="hidden"  name="id_orden_compra" value="<?php echo $idOrdenCompra; ?>" required="" > 
                                                    
                                                    <input type="hidden"  name="id_orden" value="<?php echo $idCliente; ?>" required="" > 
                                                    <input type="hidden"  name="id_sucursal" value="<?php echo $idCliente; ?>" required="" > 
                                                    <p class="contact-name mb-0" name="nombre"><?= $r_oxigenos->nombre_producto_tipo; ?></p>
                                                    <input type="hidden"  name="id_precio" value="<?= $r_oxigenos->id_precio; ?>" required="" > 
                                                    <p class="contact-position mb-0 small font-weight-bold text-muted">
                                                        Capcidad de: <?= $r_oxigenos->capacidad; ?><?= $r_oxigenos->unidad; ?> 
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="contact-email">
                                                <p class="mb-0 small">Tipo de material: </p>
                                                <p class="user-email"><?= $r_oxigenos->tipo_material; ?></p>
                                            </div>
                                            <div class="contact-location">
                                                <p class="mb-0 small">Zona: </p>
                                                <p class="user-location"><?= $r_oxigenos->zona; ?></p>
                                            </div>
                                            <div class="contact-phone">
                                                <input type="hidden"  name="precioProducto" value="<?= $r_oxigenos->precio; ?>" required="" > 
                                                <p class="mb-0 small">Precio: </p>
                                                <p class="user-phone"><?= $r_oxigenos->precio; ?></p>
                                            </div>

                                            <div class="card-body border brd-gray border-top-0 border-right-0 border-left-0">
                                                    <div class="d-inline-block mr-3">
                                                        <p class="dark-color f-weight-600">Cantidad: </p>
                                                    </div>
                                                    <div class="d-inline-block mr-3">
                                                        <div class="form-group">
                                                            <input type="number" name="cantidad" class="form-control" value="1">
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="line-h-1 h5">
                                            <a class="text-success edit-contact" href="#" data-toggle="modal" data-target="#edittask"><i class="icon-pencil"></i></a>
                                                <button type="submit" class="btn btn-success" data-toggle="modal">Guardar</button>                          
                                            </div>
                                        </div>
                                      </form>
                                    </div>
                    <?php endforeach; ?>
                    
                   
                                    <div class="contact friend-contact"> 
                                     
                                    </div>                                   
                        
          <!-- termina los grupos -->
                                </div>
                            </div><!-- termina card-body -->

                        </div>
                    </div>
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>
        <!-- END: Content-->


     
   
<!-- END: Card DATA-->
<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- START: Page JS-->
<script src="<?php echo base_url('dist/js/app.contactlist.js'); ?>"></script>  
<!-- END: Page JS-->
<?= $this->endSection() ?>