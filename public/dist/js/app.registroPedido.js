$(document).ready(function(){

});
function buscarProducto(e, tagCodigo, codigo){
 var  enterKey = 13;
 if(codigo != ''){
   if(e.which == enterKey){
     $.ajax({
       url: '<?= site_url(); ?>/Producto/buscarPorCodigo/' + codigo,
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
}