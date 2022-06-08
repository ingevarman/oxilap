<!-- START: Main Menu-->
<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Administrador</a>                  
                <ul>
                    <li><a href="<?php echo site_url('administrador');?>"><i class="icon-home"></i> Inicio</a></li>
                </ul>
            </li>

         
            <li class="dropdown"><a href="#"><i class="icon-settings mr-1"></i> Configurar Producto</a>                  
                <ul>
                    <li><a href="<?php echo site_url('administrador/tipo_producto');?>"><i class="icon-list"></i> Tipo de Productos</a></li>
                    <li><a href="<?php echo site_url('administrador/producto');?>"><i class="icon-list"></i> Productos</a></li>
                    <li><a href="<?php echo site_url('administrador/precio');?>"><i class="icon-list"></i> Precios</a></li>
                    <li><a href="<?php echo site_url('administrador/zona');?>"><i class="icon-list"></i> Zona</a></li>
                    <li><a href="<?php echo site_url('administrador/sucursal');?>"><i class="icon-list"></i> Sucursal</a></li>
                    
                    
                </ul>
            </li>

            <li class="dropdown"><a href="#"><i class="icon-settings mr-1"></i> Parametros Pedidos</a>                  
                <ul>
                    <li><a href="#"><i class="icon-list"></i> Generar Cotizaciones</a></li>
                    <li><a href="#"><i class="icon-list"></i> Registrar Pedidos</a></li>  
                    <li><a href="#"><i class="icon-list"></i> Asignar Distribucion</a></li>                  
                </ul>
            </li>
            
        </ul>
        
    </div>
</div>
<!-- END: Main Menu-->