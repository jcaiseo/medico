<?php include('header.php');
include('controllers/functions.php');

@$id = $_REQUEST['id'];
@$rut = $_REQUEST['rut'];
  
if(isset($_POST['guardar'])){  
    
    $movil = $_REQUEST['movil'];
    $hora_inicio = date('Y-m-d').' '.$_REQUEST['hora_inicio'];
    $hora_despacho = date('Y-m-d').' '.$_REQUEST['hora_despacho'];    
    $observacion_medico = $_REQUEST['observacion_medico'];
        
  if(!isset($error)){            
 
      $query = mysql_query("UPDATE ag_medico_paciente 
                            SET hora_inicio ='$hora_inicio',
                            hora_despacho ='$hora_despacho',
                            movil = '$movil',
                            id_user_2 = '$id_user'
                            WHERE id = '$id'")  or die(mysql_error());
        
    if($query) { //si esta ok se registra al nuevo usuario  
        echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>Información actualizada correctamente.</div>"; 
    }else {    //si ocurre error se arroja mensaje
        echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Ha ocurrido un error y no se pudo registrar al vecino</div>"; 
    }
  }   
  
    if(isset($error)){ // comprobamso si existen errores en los campos, si lo hay los mostrara en pantalla
      echo "<div id='alerta' class='error'>";
      echo "<div><a id='cerrar' title='Cerrar'>x</a></div>";
        foreach($error as $errores){
          echo $errores."<br>";
        }
      echo "</div>";
    }
         
} 

if(isset($_POST['finalizar'])){  
    
    if(empty($_REQUEST['hora_termino'])){
        $error[] = "El campo <b>Hora termino</b> es requerido."; 
    }elseif($_REQUEST['hora_termino'] === "00:00"){
      $error[] = "El campo <b>Hora termino</b> es requerido."; 
    }
    if(empty($_REQUEST['observacion_medico'])){
          $error[] = "El campo <b>Observación médico</b> es requerido.";   
    }

    $hora_termino = date('Y-m-d').' '.$_REQUEST['hora_termino'];
    $observacion_medico = $_REQUEST['observacion_medico'];
        
  if(!isset($error)){            
 
      $query = mysql_query("UPDATE ag_medico_paciente 
                            SET hora_termino='$hora_termino',
                            observacion_medico='$observacion_medico',
                            id_user_2 = '$id_user', estado='2'
                            WHERE id = '$id'")  or die(mysql_error());
        
    if($query) { //si esta ok se registra al nuevo usuario  
        $_SESSION['mensaje'] = "exito";
                /*echo "<script>window.open('print-solicitud.php?id=$id_sol&rut=$rut');</script>";*/
        echo "<script>window.close();</script>";   
    }else {    //si ocurre error se arroja mensaje
        echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Ha ocurrido un error y no se pudo registrar al vecino</div>"; 
    } 
  }   
      
    if(isset($error)){ // comprobamso si existen errores en los campos, si lo hay los mostrara en pantalla
      echo "<div id='alerta' class='error'>";
      echo "<div><a id='cerrar' title='Cerrar'>x</a></div>";
        foreach($error as $errores){
          echo $errores."<br>";
        }
      echo "</div>";
    }
         
} 
    

if(isset($_POST['cancelar'])){  

  if(empty($_REQUEST['observacion_medico'])){
        $error[] = "El campo <b>Observación médico</b> es requerido.";   
  }

  $observacion_medico = $_REQUEST['observacion_medico'];
        
  if(!isset($error)){            
 
      $query = mysql_query("UPDATE ag_medico_paciente 
                            SET observacion_medico='$observacion_medico',
                            id_user_2 = '$id_user', estado='3'
                            WHERE id = '$id'")  or die(mysql_error());
        
    if($query) { //si esta ok se registra al nuevo usuario  
        $_SESSION['mensaje'] = "exito";
                /*echo "<script>window.open('print-solicitud.php?id=$id_sol&rut=$rut');</script>";*/
        echo "<script>window.close();</script>";   
    }else {    //si ocurre error se arroja mensaje
        echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Ha ocurrido un error y no se pudo registrar al vecino</div>"; 
    } 
  }   
      
    if(isset($error)){ // comprobamso si existen errores en los campos, si lo hay los mostrara en pantalla
      echo "<div id='alerta' class='error'>";
      echo "<div><a id='cerrar' title='Cerrar'>x</a></div>";
        foreach($error as $errores){
          echo $errores."<br>";
        }
      echo "</div>";
    }
         
} 

if(isset($_POST['restablecer'])){  
        
  if(!isset($error)){            
 
      $query = mysql_query("UPDATE ag_medico_paciente 
                            SET observacion_medico='',
                            id_user_2 = '$id_user', estado='0'
                            WHERE id = '$id'")  or die(mysql_error());
        
    if($query) { //si esta ok se registra al nuevo usuario  
        $_SESSION['mensaje'] = "exito";
                /*echo "<script>window.open('print-solicitud.php?id=$id_sol&rut=$rut');</script>";*/
        echo "<script>window.close();</script>";   
    }else {    //si ocurre error se arroja mensaje
        echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Ha ocurrido un error y no se pudo registrar al vecino</div>"; 
    } 
  }   
      
    if(isset($error)){ // comprobamso si existen errores en los campos, si lo hay los mostrara en pantalla
      echo "<div id='alerta' class='error'>";
      echo "<div><a id='cerrar' title='Cerrar'>x</a></div>";
        foreach($error as $errores){
          echo $errores."<br>";
        }
      echo "</div>";
    }
         
} 

  $query = mysql_query("SELECT * FROM personas WHERE rut = '".$rut."'");
  $row = mysql_fetch_array($query);
  
  $nombre = $row['nombres'];
  $rut_full = $row['rut'].'-'.$row['vrut'];
  $apellido_paterno = $row['apellidopaterno'];
  $apellido_materno = $row['apellidomaterno'];
  $direccion = $row['nombre_calle'];
  $numero = $row['numdirec'];
  $depto = $row['depto'];
  $referencia_direc = $row['referenciadir'];
  $nombre_comuna = $row['nombre_comuna'];
  $email = $row['email']; 
  $telefono = $row['fono'];
  $telefono2 = $row['fono_2'];
  $uv = $row['unidad_v'];
  @$fecha_nac = fecha_esp($row['fecha_nacimiento']);
  $sexo = $row['sexo'];    
?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Registrar Paciente
</div>    
    
<h4>Datos Vecino<span class="pull-right glyphicon glyphicon-plus" id="mas" title="Ver Datos Vecino" style="cursor: pointer;"></span></h4>
   
 <div class="form-horizontal">
    
    <div class="form-group">
      <label class="control-label col-sm-2">R.U.T</label>
      <div class="col-sm-3">
        <input class="input-text readonly"  name="rut" id="rut" value="<?php echo @$rut_full; ?>" disabled/> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Nombres</label>
      <div class="col-sm-3">          
         <input class="input-text"  name="nombres" id="nombres" value="<?php echo @$nombre ?>" disabled/> 
      </div>     
   </div>

     <div class="form-group">
      <label class="control-label col-sm-2">Apellido Paterno</label>
      <div class="col-sm-3">
         <input class="input-text"  name="apellido_paterno" id="apellido_materno" value="<?php echo @$apellido_paterno ?>" disabled/> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Apellido Materno</label>
      <div class="col-sm-3">          
         <input class="input-text"  name="apellido_materno" id="apellido_materno" value="<?php echo @$apellido_materno ?>" disabled/> 
      </div>     
   </div>   
    
   <!-- Inicio Dirección y Número -->

  <div id="datos" class="form-horizontal">   
    
        <div class="form-group">      
             <label class="control-label col-sm-2">Dirección</label>
            <div class="col-sm-3">
             <input class="input-text" name="direccion" id="direccion" value="<?php echo @$direccion ?>" disabled/> 
            </div> 
             <label class="control-label col-sm-2">Número</label>
            <div class="col-sm-1">
             <input class="input-text" name="numero" id="numero" value="<?php echo @$numero ?>" disabled/> 
            </div>    
        </div>
            
        <div class="form-group">                    
             <label class="control-label col-sm-2">Depto.</label>
            <div class="col-sm-3">
             <input class="input-text" name="depto" id="depto" value="<?php echo @$depto ?>" disabled/> 
            </div>
            <label class="control-label col-sm-2">Unidad Vecinal</label>
          <div class="col-sm-1">
           <input class="input-text" name="uv" id="uv" value="<?php echo @$uv ?>" disabled/> 
            </div>        
        </div>

        <div class="form-group">      
           <label class="control-label col-sm-2">Referecia Direc.</label>
            <div class="col-sm-3">
             <input class="input-text" name="referencia_direc" id="referencia_direc" value="<?php echo @$referencia_direc ?>" disabled/> 
            </div> 
           <label class="control-label col-sm-2">Comuna</label>
            <div class="col-sm-3">
           <input class="input-text" name="nombre_comuna" id="nombre_comuna" value="<?php echo @$nombre_comuna ?>" disabled/> 
            </div>    
        </div>      

        <div class="form-group">
             <label class="control-label col-sm-2">Teléfono 1</label>
            <div class="col-sm-3">
            <input class="input-text" name="telefono" id="telefono" value="<?php echo @$telefono ?>" disabled/> 
            </div>
             <label class="control-label col-sm-2">Teléfono 2</label>
            <div class="col-sm-3">
            <input class="input-text" name="telefono2" id="telefono2" value="<?php echo @$telefono2 ?>" disabled/> 
            </div>              
        </div>

        <div class="form-group">
             <label class="control-label col-sm-2">Email</label>
            <div class="col-sm-3">
           <input class="input-text" name="email" id="email" value="<?php echo @$email ?>" disabled/> 
            </div>       
        </div>

    <div class="form-group">
           <label class="control-label col-sm-2">Fecha Nacimiento/Edad</label>
            <div class="col-sm-2">
          <input class="input-text" name="fecha_nac" id="fecha_nac" value="<?php echo @$fecha_nac ?>" disabled/> 
            </div>
            <div class="col-sm-1">
          <input class="input-text readonly" name="edad" id="edad" value="<?php echo edad(@$fecha_nac); ?>" disabled/> 
            </div>
          
          <label class="control-label col-sm-2">Sexo</label>
            <div class="col-sm-3">
              <select class="input-select" name="sexo" id="sexo" disabled>
                    <option value="0" selected>Seleccione Opción</option>
                    <option <?php if(@$sexo === 'Masculino') { echo "selected"; } ?> value="Masculino">Masculino</option>
                  <option <?php if(@$sexo === 'Femenino') { echo "selected"; } ?> value="Femenino">Femenino</option>
                </select>
            </div>
    </div>                     
       <!-- <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-7">
            <a href="editar-vecino.php?rut=<?php echo $rut; ?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-floppy-disk"></span> Editar</a>
            </div>
        </div>-->
        
    </div>      
    
    </div>     
        
<h4>Datos de Ingreso</h4>
       
<?php 

  $query2 = mysql_query("SELECT prevision, detalle_llamado, observacion, DATE_FORMAT(ag_fecha, '%d-%m-%Y %H:%i') 
                          AS fecha_ingreso, zona, movil, DATE_FORMAT(hora_inicio, '%H:%i') AS hora_inicio, DATE_FORMAT(hora_despacho, '%H:%i') AS hora_despacho, DATE_FORMAT(hora_termino, '%H:%i') AS hora_termino,
                          observacion_medico
                          FROM ag_medico_paciente WHERE id = '".$id."'");
  $row2 = mysql_fetch_array($query2);
  
  $prevision = $row2['prevision'];
  $detalle_llamado = $row2['detalle_llamado'];
  $observacion = $row2['observacion'];
  $fecha_ingreso = $row2['fecha_ingreso'];
   
  $movil = $row2['movil'];
  $hora_inicio = $row2['hora_inicio'];
  $hora_despacho = $row2['hora_despacho'];  
  $hora_termino = $row2['hora_termino'];
  $observacion_medico = $row2['observacion_medico'];

  $zona = $row2['zona'];
  $estado = $row2['estado'];
?>

      <div class="form-horizontal">      
            <div class="form-group">
                <label class="control-label col-sm-2">Previsión</label>
                <div class="col-sm-3">
                <input class="input-text" name="prevision" id="prevision" value="<?php echo @$prevision; ?>" disabled/> 
                </div>

                <label class="control-label col-sm-2">Fecha/Hora Ingreso</label>
                <div class="col-sm-3">
                <input class="input-text" name="fecha_ingreso" id="fecha_ingreso" value="<?php echo @$fecha_ingreso ?>" disabled/> 
                </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2">Detalle Llamado</label>
            <div class="col-sm-10">
            <textarea class="input-text" name="llamado" id="llamado" rows="6" disabled/><?php echo @$detalle_llamado ?></textarea>
            </div>                        
            </div> 

            <div class="form-group">
            <label class="control-label col-sm-2">Observación Teléfonista</label>
            <div class="col-sm-10">
            <textarea class="input-text" name="obs" id="obs" rows="6" disabled /><?php echo @$observacion ?></textarea>
            </div>                        
            </div>  

            <div class="form-group">
            <label class="control-label col-sm-2">Zona</label>
            <div class="col-sm-10">
            <textarea class="input-text" name="zona" id="zona" rows="6" disabled /><?php echo @$zona ?></textarea>
            </div>                       
            </div>           
        </div>

<h4>Datos de Movil y Médico</h4>

  <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal" enctype="multipart/form-data">              
     
		 <?php
         if($perfil === "99"){
         ?>
           
            <div class="form-group">
                <label class="control-label col-sm-2">Movil</label>
                <div class="col-sm-3">
                  <select name="movil" id="movil" class="input-select" disabled>
                  <option>Seleccione Móvil</option>
                  <?php 
                  $query3 = mysql_query("SELECT id_movil FROM ag_medico_movil");
                  while($row3 = mysql_fetch_array($query3)){
                  ?>
                  <option value="<?php echo $row3['id_movil']; ?>" <?php if($movil === $row3['id_movil']){ echo "selected";} ?>><?php echo $row3['id_movil']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Hora Despacho Móvil</label >
                <div class="col-sm-3">
                <input class="input-text" name="hora_despacho" id="hora_despacho" value="<?php echo @$hora_despacho; ?>" placeholder="00:00" disabled/> 
                </div>
            </div>
          <?php
          }else{
             ?>    
            <div class="form-group">
                <label class="control-label col-sm-2">Movil</label>
                <div class="col-sm-3">
                  <select name="movil" id="movil" class="input-select">
                  <option>Seleccione Móvil</option>
                  <?php 
                  $query3 = mysql_query("SELECT id_movil FROM ag_medico_movil");
                  while($row3 = mysql_fetch_array($query3)){
                  ?>
                  <option value="<?php echo $row3['id_movil']; ?>" <?php if($movil === $row3['id_movil']){ echo "selected";} ?>><?php echo $row3['id_movil']; ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Hora Despacho Móvil</label >
                <div class="col-sm-3">
                <input class="input-text" name="hora_despacho" id="hora_despacho" value="<?php echo @$hora_despacho; ?>" placeholder="00:00"/> 
                </div>
            </div>            
          <?php } ?> 

            <div class="form-group">
                <label class="control-label col-sm-2">Hora Inicio Atención</label >
                <div class="col-sm-3">
                <input class="input-text" name="hora_inicio" id="hora_inicio" value="<?php echo @$hora_inicio; ?>" placeholder="00:00"/> 
                </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2">Observación Médico</label>
            <div class="col-sm-10">
            <textarea class="input-text" name="observacion_medico" id="observacion_medico" rows="6" placeholder="Ingrese aqui la observacion del médico..."/><?php echo @$observacion_medico; ?></textarea>
            </div>                        
            </div> 

            <div class="form-group">
                <label class="control-label col-sm-2">Hora Termino Atención</label>
                <div class="col-sm-3">
                <input class="input-text" name="hora_termino" id="hora_termino" value="<?php echo @$hora_termino; ?>" placeholder="00:00"/> 
                </div>
            </div>

            <br />
            <br />    
            
            <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-7">
             <?php
             if($perfil === "99"){
             ?>
             <button type="submit" class="btn btn-success" name="finalizar"><span class="glyphicon glyphicon-ok"></span> Finalizar Atención</button>
             <?php
             }else if($perfil === "2"){
             ?>
             <button type="submit" class="btn btn-danger" name="cancelar"><span class="glyphicon glyphicon-remove"></span> Cancelar Atención</button>
			 <?php 
             }else{
             ?>
             <button type="submit" class="btn btn-primary" name="guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Información</button>
             <button type="submit" class="btn btn-success" name="finalizar"><span class="glyphicon glyphicon-ok"></span> Finalizar Atención</button>
             <button type="submit" class="btn btn-danger" name="cancelar"><span class="glyphicon glyphicon-remove"></span> Cancelar Atención</button>
             <?php if($estado != "0"){ ?>
             <button type="submit" class="btn btn-default" name="restablecer"><span class="glyphicon glyphicon-refresh"></span> Restablecer a Pendiente</button>
             
             <?php
			 	}
			 }
             ?>
            </div>
        </div>
    </form>

<script>
$(document).ready(function(){
	$("#datos").hide();
	
	$("#mas").click(function() {	  
		  $("#datos").slideToggle("fast");				
	});

  $("#hora_inicio").mask("00:00"); 
  $("#hora_termino").mask("00:00"); 

  $("#hora_despacho").mask("00:00"); 
   /*
    $("#di_otros").change(function() {
        if ($(this).prop("checked")) {
            $("#di_observ").prop('disabled', false);
        } else {
            $("#di_observ").prop('disabled', true);
            $("#di_observ").val('');
        }
    });

    $("#co_otros").change(function() {
        if ($(this).prop("checked")) {
            $("#co_observ").prop('disabled', false);
        } else {
            $("#co_observ").prop('disabled', true);
            $("#co_observ").val('');
        }
    });

    $("#dao_otros").change(function() {
        if ($(this).prop("checked")) {
            $("#dao_observ").prop('disabled', false);
        } else {
            $("#dao_observ").prop('disabled', true);
            $("#dao_observ").val('');
        }
    });

    $("#tr_otros").change(function() {
        if ($(this).prop("checked")) {
            $("#tr_observ").prop('disabled', false);
        } else {
            $("#tr_observ").prop('disabled', true);
            $("#tr_observ").val('');
        }
    });   

    $("#inaguracion_carino").change(function() {
        if ($(this).prop("checked")) {
            $("#dimaao").fadeIn('fast');          
        } else {
        	$("#dimaao").fadeOut('fast');
        }
    });  

    $("#otros").change(function() {
        if ($(this).prop("checked")) {
            $("#dideco").fadeIn('fast');
            $("#comudef").fadeIn('fast');
            $("#dimaao").fadeIn('fast');        
            $("#transito").fadeIn('fast');        
        } else {
            $("#dideco").fadeOut('fast');
            $("#comudef").fadeOut('fast');
            $("#dimaao").fadeOut('fast');        
            $("#transito").fadeOut('fast');  
        }
    });      

    $("#dao_mascota").change(function() {
        if ($(this).prop("checked")) {
            $("#ver_mascota").fadeIn('fast');
        } else {
            $("#ver_mascota").fadeOut('fast');
            $("#entrega_chip").prop('checked', false); 
            $("#vacuna").prop('checked', false); 
            $("#desparasitacion").prop('checked', false); 
        }
    });            
    */
});
</script>

<?php include('footer.php')?>