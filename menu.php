<!-- menu -->
<div class="wrap-menu">

<!-- menu cargado izquierda --> 
<ul class="menu pull-left">

		<?php if($perfil === '2'){ ?>	
        <li><a href="consult.php">Ingresar Atención</a></li>
        <li>
            <a href="#">Pacientes <span class="caret"></span></a>
            <ul class="sub-menu">
            <li><a href="pacientes.php">Pacientes Pendiente o Proceso</span></a></li>
            <li><a href="pacientes-zona.php?z=1">Pacientes Zona 1</a></li>
            <li><a href="pacientes-zona.php?z=2">Pacientes Zona 2</a></li>
            <li><a href="pacientes-zona.php?z=3">Pacientes Zona 3</a></li>
            <li><a href="pacientes-zona.php?z=4">Pacientes Zona 4</a></li>
            <li><a href="pacientes-zona.php?z=5">Pacientes Zona 5</a></li>
            <li><a href="pacientes-zona.php?z=6">Pacientes Zona 6</a></li>
            <li><a href="pacientes-zona.php?z=7">Pacientes Zona 7</a></li>
            <li><a href="pacientes-zona.php?z=8">Pacientes Zona 8</a></li>
            <li><a href="pacientes-zona.php?z=9">Pacientes Zona 9</a></li>
            <li><a href="pacientes-zona.php?z=10">Pacientes Zona 10</a></li>        
            </ul>
        </li>    
        <li><a href="atenciones-usuario.php">Mis Atenciones</a></li>    
        </li>
        <li><</li>
        
		<li><a href="#">Buscar Pacientes <span class="caret"></span></a>
            <ul class="sub-menu">
            <li><a href="consult2.php">Buscar Paciente por RUT</a></li>
            <li><a href="consult-nombre.php">Buscar Paciente por Nombre</a></li>
            <li><a href="consult-fono.php">Buscar Paciente por Teléfono</a></li>    
            </ul>
        </li>            
        
        <li><a href="medicos.php">Lista de Médicos</span></a></li>          
    	<?php }else if($perfil === '1'){  ?>	
        <li>
            <a href="#">Pacientes <span class="caret"></span></a>
            <ul class="sub-menu">
            <li><a href="pacientes.php">Pacientes Pendiente o Proceso</span></a></li>
            <li><a href="pacientes-zona.php?z=1">Pacientes Zona 1</a></li>
            <li><a href="pacientes-zona.php?z=2">Pacientes Zona 2</a></li>
            <li><a href="pacientes-zona.php?z=3">Pacientes Zona 3</a></li>
            <li><a href="pacientes-zona.php?z=4">Pacientes Zona 4</a></li>
            <li><a href="pacientes-zona.php?z=5">Pacientes Zona 5</a></li>
            <li><a href="pacientes-zona.php?z=6">Pacientes Zona 6</a></li>
            <li><a href="pacientes-zona.php?z=7">Pacientes Zona 7</a></li>
            <li><a href="pacientes-zona.php?z=8">Pacientes Zona 8</a></li>
            <li><a href="pacientes-zona.php?z=9">Pacientes Zona 9</a></li>
            <li><a href="pacientes-zona.php?z=10">Pacientes Zona 10</a></li>
            <li><a href="pacientes-finalizado.php">Pacientes Finalizado</a></li> 
            <li><a href="pacientes-cancelado.php">Pacientes Cancelado</a></li>
            </ul>
        </li>
        <li><a href="medicos.php">Lista de Médicos</span></a></li>           
   		<?php }else if($perfil === '0'){  ?>
   		<li><a href="consult.php">Ingresar Atención</a></li>	
        <li>
            <a href="#">Pacientes <span class="caret"></span></a>
            <ul class="sub-menu">
            <li><a href="pacientes.php">Pacientes Pendiente o Proceso</span></a></li>
            <li><a href="pacientes-zona.php?z=1">Pacientes Zona 1</a></li>
            <li><a href="pacientes-zona.php?z=2">Pacientes Zona 2</a></li>
            <li><a href="pacientes-zona.php?z=3">Pacientes Zona 3</a></li>
            <li><a href="pacientes-zona.php?z=4">Pacientes Zona 4</a></li>
            <li><a href="pacientes-zona.php?z=5">Pacientes Zona 5</a></li>
            <li><a href="pacientes-zona.php?z=6">Pacientes Zona 6</a></li>
            <li><a href="pacientes-zona.php?z=7">Pacientes Zona 7</a></li>
            <li><a href="pacientes-zona.php?z=8">Pacientes Zona 8</a></li>
            <li><a href="pacientes-zona.php?z=9">Pacientes Zona 9</a></li>
            <li><a href="pacientes-zona.php?z=10">Pacientes Zona 10</a></li>
            <li><a href="pacientes-finalizado.php">Pacientes Finalizado</a></li> 
            <li><a href="pacientes-cancelado.php">Pacientes Cancelado</a></li>            
            </ul>
        </li>
        <li><a href="#">Exportar Atenciones <span class="caret"></span></a>
            <ul class="sub-menu">    
            <li><a href="atenciones-finalizado.php">Atenciones Finalizado</a></li> 
            <li><a href="atenciones-cancelado.php">Atenciones Cancelado</a></li>  
            </ul>
        </li>            
        <li><a href="atenciones-usuario.php">Mis Atenciones</a></li>  
		<li><a href="#">Buscar Pacientes <span class="caret"></span></a>
            <ul class="sub-menu">
            <li><a href="consult2.php">Buscar Paciente por RUT</a></li>
            <li><a href="consult-nombre.php">Buscar Paciente por Nombre</a></li>
            <li><a href="consult-fono.php">Buscar Paciente por Teléfono</a></li>    
            </ul>
        </li>       
        <li><a href="moviles.php">Móviles</a></li>
        <li>
            <a href="#">Médicos <span class="caret"></span></a>
            <ul class="sub-menu">
            <li><a href="medicos.php">Lista de Médicos</span></a></li>
            <li><a href="agregar-medico.php">Agregar Médico</a></li>         
            </ul>
        </li> 
        <li><a href="informe.php">Estadistica</a></li>                 
        <?php }else if($perfil === '99'){  ?>  
        <li><a href="pacientes-medico.php">Pacientes</a></li>
		<li><a href="#">Buscar Pacientes <span class="caret"></span></a>
            <ul class="sub-menu">
            <li><a href="consult2.php">Buscar Paciente por RUT</a></li>
            <li><a href="consult-nombre.php">Buscar Paciente por Nombre</a></li>
            <li><a href="consult-fono.php">Buscar Paciente por Teléfono</a></li>    
            </ul>
        </li>
        <?php }else if($perfil === '98'){  ?>  
        <li><a href="generar-carta-excel.php">Generar Cartas</a></li>
        <?php } ?>
</ul>
        
<!-- menu cargado derecha -->        
<ul class="menu pull-right">
    <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo @$user_name; ?> <span class="caret"></span></a>
        <ul class="sub-menu">
        <li><a href="reset-pass.php"><span class="glyphicon glyphicon-lock"></span> Cambiar Contraseña</a></li> 
        <li class="divider"></li> 
        <li><a href="cerrar-sesion.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
        </ul>
    </li>
</ul>
        
</div> <!-- aqui cierra el menu -->