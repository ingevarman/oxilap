<!-- START: Main Menu-->
<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown"><a href="#"><i class="icon-home mr-1"></i> Gerente</a>                  
                <ul>
                    <li><a href="<?php echo site_url('administrador');?>"><i class="icon-home"></i> Inicio</a></li>
                    <li><a href="<?php echo site_url('gerente');?>"><i class="icon-home"></i> Principio Gerente</a></li>
                </ul>
            </li>

         
            <li class="dropdown"><a href="#"><i class="icon-settings mr-1"></i> Registros de Personas</a>                  
                <ul>
                    <li><a href="<?php echo site_url('gerente/empleado');?>"><i class="icon-list"></i> Registro de Empleados</a></li>
                    <li><a href="<?php echo site_url('gerente/usuario'); ?>"><i class="icon-list"></i>Registros de usuarios</a></li>
                    <li><a href="<?php echo site_url('gerente/cliente'); ?>"><i class="icon-list"></i>Registros de Clientes</a></li>
                    
                </ul>
            </li>

         
            
        </ul>
        
    </div>
</div>
<!-- END: Main Menu-->