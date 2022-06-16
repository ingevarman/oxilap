<!-- START: Main Menu-->
<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> ATENCION CLIENTE</a>
                <ul>
                    <li><a href="<?php echo site_url('atencioncliente/principal'); ?>"><i class="icon-home"></i> Inicio</a></li>
              
                </ul>
            </li>

            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> REGISTRO DE CLIENTE</a>
                <ul>
        
                        <li><a href="<?php echo site_url('atencioncliente/cliente'); ?>"><i class="icon-credit-card"></i> Clientes</a></li>
                        <li><a href="<?php echo site_url('atencioncliente/ubicacionCliente'); ?>"><i class="icon-credit-card"></i> Ubicacion de Clientes</a></li>                  
                    
                </ul>
            </li>

            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> REGISTRO DE PEDIDOS</a>
                <ul>
                    <li><a href="<?php echo site_url('atencioncliente/registroPedidos'); ?>"><i class="icon-credit-card"></i> Registro de pedidos</a></li>
                    <li><a href="<?php echo site_url('atencioncliente/designarPedido'); ?>"><i class="icon-credit-card"></i> *Designacion de pedios</a></li>
                </ul>
            </li>

        </ul>

    </div>
</div>
<!-- END: Main Menu-->