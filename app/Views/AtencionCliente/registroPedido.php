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
                <h4 class="mb-0">Registro de Pedidos</h4>   
                <p>Regsitro de los pedidos</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
 
     <form method="post" action="<?= site_url(); ?>insertar" autocomplete="off">
  
       <div class="form-group">
         <div class="row">
            <div class="col-12 col-sm-4">
                <input type="hidden" id="id_precio" name="id_precio" >
                <label>Nombre Producto</label>
                <input class="form-control" id="id_producto" name="id_producto" type="text" 
                placeholder="Ingrese el id Producto" onKeyup="buscarProducto(event, this, this.value)" autofocus/>


             <label for="n_producto" id="resultado_error" style="color: red;"></label>
             </div>
            <div class="col-12 col-sm-4">
                <label>Tipo de Servicio</label>
                <input class="form-control" id="tipo_servicio" name="tipo_servicio" type="text" diseble />
            </div>
            <div class="col-12 col-sm-4">
                <label>Precio <abel>
                <input class="form-control" id="precio" name="precio" type="text"/>
             </div>
        </div>
      </div>

      <div class="form-group">
         <div class="row">
            <div class="col-12 col-sm-4">
                <label>Cantidad</label>
                <input class="form-control" id="cantidad" name="cantidad" type="text" diseble />
            </div>
            <div class="col-12 col-sm-4">
                <label>sub Total</label>
                <input class="form-control" id="subtotal" name="subtotal" type="text" diseble />
            </div>
            <div class="col-12 col-sm-4">
                <label></br>&nbsp;<abel>
                <button  id="agregar_producto" name="agregar_producto" type="button"
                class="btn btn-primary">Agregar Producto</button>
             </div>
        </div>
      </div>
  
      <div class="row">
          <table class="table table-hover table-striped table-sm table-responsive tableProductos" id="tableProductos" width="100%">
               <thead class="thead-dark">
                   <tr>
                       <th>#</th>
                       <th>Codigo</th>
                       <th>Nombre</th>
                       <th>Precio</th>
                       <th>Cantidad</th>
                       <th>Total</th>
                       <th width="1%"></th>
                   </tr>
               </thead>               
               <tbody>
               
               </tbody>
          </table>
      </div>
      <div class="row">
         <div class="col-12 col-sm-6 offset-md-6">
         <label style="font-weight: bold; font-size: 30px; text-align: center;">Total $</label>
         <<input type="text" id="total" name="total" size="7" readonly="true" value="0.00"
         style="font-weight: bold; font-size: 30px; text-align: center;"/>
         <button  id="completa_compra" name="completa_compra" type="button"
                class="btn btn-success">Completa Pedido</button>
         </div>
      </div>
    </form>
</div>    
  
<script>
$(document).ready(function(){

});
function buscarProducto(e, tagCodigo, codigo){
 var  enterKey = 13;
 if(codigo != ''){
   if(e.which == enterKey){
     $.ajax({
       url: '<?= base_url(); ?>. /Producto/buscarPorCodigo/' + codigo,
       dataType: 'json',
       success: function(resultado){
         if(resultado == 0){
           $(tagCodigo).val('');
         }else{
           $(tagCodigo).removeClass('has-error');
           $("#resultado_error").html(resultado.error);
           if(resultado.existe){
             $("#id_precio").val(resultado.datos.id_precio);
             $("#tipo_servicio").val(resultado.datos.tipo_servicio);
             $("#precio").val(resultado.datos.precio);
             $("#cantidad").val(1);
             $("#subtotal").val(resultado.datos.precio);
             $("#cantidad").focus();
           }else{
            $("#id_precio").val('');
            $("#tipo_servicio").val('');
            $("#precio").val('');
            $("#cantidad").val('');
            $("#subtotal").val('');
           
           }

         }
       }
     });
   }
 }
}</script>

<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- START: Page JS-->

 
<!-- END: Page JS-->
<?= $this->endSection() ?>