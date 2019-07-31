<?php include('header.php');
include('controllers/functions.php');

$rut_full = $_REQUEST['rut']; 

if(isset($_POST['guardar'])){
  
	$new_rut = explode("-", $rut_full);
	$rut = $new_rut[0];
	$digito = $new_rut[1];
				
	$nombres = mysql_real_escape_string(strtoupper($_REQUEST['nombres']));
	$apellido_paterno = mysql_real_escape_string(strtoupper($_REQUEST['apellido_paterno']));
	$apellido_materno = mysql_real_escape_string(strtoupper($_REQUEST['apellido_materno']));
	$direccion = mysql_real_escape_string(strtoupper($_REQUEST['direccion']));
	$numero = strtoupper($_REQUEST['numero']);
	$uv = strtoupper($_REQUEST['uv']);  
	$referencia_direc = mysql_real_escape_string(strtoupper($_REQUEST['referencia_direc']));
	$nombre_comuna = strtoupper($_REQUEST['nombre_comuna']);
	$email = $_REQUEST['email'];
	$telefono = $_REQUEST['telefono'];
	$telefono2 = $_REQUEST['telefono2'];
	@$fecha_nac = fecha_rev($_REQUEST['fecha_nac']);
	$sexo = $_REQUEST['sexo'];  

				
  if(!isset($error)){	 					 
			 
	 $query = mysql_query("UPDATE personas SET nombres='$nombres', apellidopaterno='$apellido_paterno', apellidomaterno='$apellido_materno', nombre_calle='$direccion', numdirec='$numero',  referenciadir='$referencia_direc', nombre_comuna='$nombre_comuna', fono='$telefono', fono_2='$telefono2', email='$email', fecha_nacimiento='$fecha_nac', sexo='$sexo', unidad_v='$uv' WHERE rut = '$rut' AND
	 	vrut = '$digito'")  or die(mysql_error());
					 
	  if($query) { //si esta ok se registra al nuevo usuario
							  
			   	  echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>Informacion ingresada correctamente.</div>"; 
			  
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

if(isset($_POST['inscribir'])){
  
  $new_rut = explode("-", $rut_full);
  $rut = $new_rut[0];
  $digito = $new_rut[1];
        
	$nombres = mysql_real_escape_string(strtoupper($_REQUEST['nombres']));
	$apellido_paterno = mysql_real_escape_string(strtoupper($_REQUEST['apellido_paterno']));
	$apellido_materno = mysql_real_escape_string(strtoupper($_REQUEST['apellido_materno']));
	$direccion = mysql_real_escape_string(strtoupper($_REQUEST['direccion']));
	$numero = strtoupper($_REQUEST['numero']);
	$uv = strtoupper($_REQUEST['uv']);  
	$referencia_direc = mysql_real_escape_string(strtoupper($_REQUEST['referencia_direc']));
	$nombre_comuna = strtoupper($_REQUEST['nombre_comuna']);
	$email = $_REQUEST['email'];
	$telefono = $_REQUEST['telefono'];
	$telefono2 = $_REQUEST['telefono2'];
	@$fecha_nac = fecha_rev($_REQUEST['fecha_nac']);
	$sexo = $_REQUEST['sexo'];   

        
  if(!isset($error)){            
       
   $query = mysql_query("UPDATE personas SET nombres='$nombres', apellidopaterno='$apellido_paterno', apellidomaterno='$apellido_materno', nombre_calle='$direccion', numdirec='$numero',  referenciadir='$referencia_direc', nombre_comuna='$nombre_comuna', fono='$telefono', fono_2='$telefono2', email='$email', fecha_nacimiento='$fecha_nac', sexo='$sexo', unidad_v='$uv' WHERE rut = '$rut' AND
    vrut = '$digito'")  or die(mysql_error());
           
    if($query) { //si esta ok se registra al nuevo usuario          
        echo "<script>window.location.href =  'inscribir-paciente.php?rut=".$rut_full."';</script>";    
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

    $new_rut = explode("-", $rut_full);
    $rut = $new_rut[0];
    $digito = $new_rut[1];

	$query = mysql_query("SELECT * FROM personas WHERE rut = '".$rut."' AND vrut ='".$digito."'");
	$row = mysql_fetch_array($query);
	
	$nombre = $row['nombres'];
    $apellido_paterno = $row['apellidopaterno'];
    $apellido_materno = $row['apellidomaterno'];
	$direccion = $row['nombre_calle'];
	$numero = $row['numdirec'];
    $referencia_direc = $row['referenciadir'];
    $nombre_comuna = $row['nombre_comuna'];
	$email = $row['email']; 
	$telefono = $row['fono'];
	$telefono2 = $row['fono_2'];
    $uv = $row['unidad_v'];
    @$fecha_nac = fecha_esp($row['fecha_nacimiento']);
    $sexo = $row['sexo'];    

if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'exito'){
		echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>Información editada correctamente.</div>"; 
		unset($_SESSION['mensaje']);	
	}
?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Editar Persona
</div>    
    
<h3>Editar Persona</h3>
    

<form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal">

     <div class="form-group">
      <label class="control-label col-sm-2">R.U.T</label>
      <div class="col-sm-3">
        <input class="input-text readonly"  name="rut" id="rut" value="<?php echo @$rut_full; ?>" readonly/> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Nombres</label>
      <div class="col-sm-3">          
         <input class="input-text"  name="nombres" id="nombres" value="<?php echo @$nombre ?>" required/> 
      </div>     
   </div>

     <div class="form-group">
      <label class="control-label col-sm-2">Apellido Paterno</label>
      <div class="col-sm-3">
         <input class="input-text"  name="apellido_paterno" id="apellido_materno" value="<?php echo @$apellido_paterno ?>" required/> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Apellido Materno</label>
      <div class="col-sm-3">          
         <input class="input-text"  name="apellido_materno" id="apellido_materno" value="<?php echo @$apellido_materno ?>" required/> 
      </div>     
   </div>

  <script>
  $(function() {
  $( "#fecha_nac" ).datepicker({dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: '1900:'});
  });
  </script>       
    
   <!-- Inicio Dirección y Número -->

   <!-- Inicio Dirección y Número -->
        <script>
        $(document).ready(function() { 
          $("#direccion").autocomplete({
            source:'controllers/source.php?function=one',
            search  : function(){$("#direccion").addClass('loading');},
            open    : function(){$("#direccion").removeClass('loading');}
          });
        });
        </script>      
	
        <div class="form-group">      
        	 <label class="control-label col-sm-2">Dirección</label>
            <div class="col-sm-3">
             <input class="input-text" name="direccion" id="direccion" value="<?php echo @$direccion ?>" required/> 
            </div> 
        	 <label class="control-label col-sm-2">Número</label>
            <div class="col-sm-1">
	         <input class="input-text" name="numero" id="numero" value="<?php echo @$numero ?>" required/> 
            </div>    
        </div>
            
        <div class="form-group">                    
            <label class="control-label col-sm-2">Unidad Vecinal</label>
          <div class="col-sm-1">
           <input class="input-text" name="uv" id="uv" value="<?php echo @$uv ?>"/> 
            </div>        
        </div>

        <div class="form-group">      
           <label class="control-label col-sm-2">Referecia Direc.</label>
            <div class="col-sm-3">
             <input class="input-text" name="referencia_direc" id="referencia_direc" value="<?php echo @$referencia_direc ?>"/> 
            </div> 
           <label class="control-label col-sm-2">Comuna</label>
            <div class="col-sm-3">
           <input class="input-text" name="nombre_comuna" id="nombre_comuna" value="<?php echo @$nombre_comuna ?>"/> 
            </div>    
        </div>      

		<div class="form-group">
          	 <label class="control-label col-sm-2">Teléfono 1</label>
            <div class="col-sm-3">
	        <input class="input-text" name="telefono" id="telefono" value="<?php echo @$telefono ?>" required/> 
            </div>
             <label class="control-label col-sm-2">Teléfono 2</label>
            <div class="col-sm-3">
	        <input class="input-text" name="telefono2" id="telefono2" value="<?php echo @$telefono2 ?>"/> 
            </div>            	
        </div>


		<div class="form-group">
        	 <label class="control-label col-sm-2">Email</label>
            <div class="col-sm-3">
	       <input class="input-text" name="email" type="email" id="email" value="<?php echo @$email ?>"/> 
            </div>       
        </div>

<script>
$(function() {
  $("#fecha_nac").change(function() {
     var fecha = $("#fecha_nac").val();
     fecha = fecha.split("-").reverse().join("-");
     fecha = new Date(fecha);
     hoy = new Date();
     edad = parseInt((hoy - fecha)/365/24/60/60/1000);
     $("#edad").val(edad);
  }); 
});
</script>

    <div class="form-group">
           <label class="control-label col-sm-2">Fecha Nacimiento/Edad</label>
            <div class="col-sm-2">
          <input class="input-text" name="fecha_nac" id="fecha_nac" value="<?php echo @$fecha_nac ?>" required/> 
            </div>
            <div class="col-sm-1">
          <input class="input-text readonly" name="edad" id="edad" value="<?php echo edad(@$fecha_nac); ?>" readonly/> 
            </div>
          
          <label class="control-label col-sm-2">Sexo</label>
            <div class="col-sm-3">
              <select class="input-select" name="sexo" id="sexo" required>
                    <option value="" selected>Seleccione Opción</option>
                    <option <?php if(@$sexo === 'Masculino') { echo "selected"; } ?> value="Masculino">Masculino</option>
                  <option <?php if(@$sexo === 'Femenino') { echo "selected"; } ?> value="Femenino">Femenino</option>
                </select>
            </div>
    </div>                   

         <br />
         <br />     
       
        <div class="formulario pull-center">
    	        <button type="submit" class="btn btn-primary" name="guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Datos</button>
              <button type="submit" class="btn btn-primary" name="inscribir"><span class="glyphicon glyphicon-repeat"></span> Continuar Inscripción</button>
        </div>
    </form>

<?php include('footer.php')?>