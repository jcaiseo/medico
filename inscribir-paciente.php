<?php include('header.php');
include('controllers/functions.php');

@$rut_full = $_REQUEST['rut'];
	
if(isset($_POST['guardar'])){	 

    $new_rut = explode("-", $rut_full);
    $rut = $new_rut[0];
	
    @$prevision = $_REQUEST['prevision'];
    @$llamado = $_REQUEST['llamado'];
    @$observacion = $_REQUEST['obs'];
    @$correo= $_REQUEST['correo'];
    @$prioridad= $_REQUEST['prioridad'];
    @$zona= $_REQUEST['zona'];   
				
	if(!isset($error)){	 					 
      /*cambiar hora a zona horaria DATE_SUB resta 1 hora, DATE_ADD suma 1 hora*/
    	$query = mysql_query("INSERT INTO ag_medico_paciente(rut, prevision, detalle_llamado, observacion, ag_fecha, zona, prioridad, id_user) VALUES ('$rut', '$prevision', '$llamado','$observacion', NOW(), '$zona', '$prioridad', '$id_user')")  or die(mysql_error());  
		  
      $id_sol = mysql_insert_id();				   					   
    
      $to = $correo;
      $subject = 'INGRESO DE ATENCIÓN MÉDICO A DOMILICIO - Municipalidad de La Florida';
                      
      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=utf-8\r\n";
      $headers .= "From: Municipalidad de La Florida <info@laflorida.cl>\r\n";
                            
      $message = '<html><body style="font-family:Arial; color:#124665">';
      $message .= '<p>Estimado/a Vecino/a:<br><br>Su atención ya ha sido registrada, en unos momentos sera contactado por nuestro personal.</p>';
      $message .= '</body></html>';
                        
      mail($to, $subject, $message, $headers); // envia el correo
        
		if($query) { //si esta ok se registra al nuevo usuario
		   
				$_SESSION['mensaje'] = "exito";
                /*echo "<script>window.open('print-solicitud.php?id=$id_sol&rut=$rut');</script>";*/
				echo "<script>location.href = 'consult.php';</script>";		

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
        
<h4>Registrar Paciente</h4>
  
   <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal" enctype="multipart/form-data">              
              
            <div class="form-group">
                <label class="control-label col-sm-2">Previsión</label>
                <div class="col-sm-3">
                  <select class="input-select" name="prevision" id="prevision">
                        <option value="SIN PREVISIÓN" selected>SIN PREVISIÓN</option>
                        <option value="FONASA">FONASA</option>
                        <option value="ISAPRE">ISAPRE</option>
                        <option value="DIPRECA">DIPRECA</option>
                        <option value="CAPREDENA">CAPREDENA</option>
                        <option value="PRAIS">PRAIS</option>
                    </select>
                </div>
                <div class="col-sm-3">
                  <div class="checkbox">
                    <label><input type="checkbox" name="prioridad" value="1"> Prioridad</label>
                  </div>
                </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2">Detalle Llamado</label>
            <div class="col-sm-10">
            <textarea class="input-text" name="llamado" id="llamado" rows="6" required/></textarea>
            </div>                        
            </div> 

            <div class="form-group">
            <label class="control-label col-sm-2">Observación Teléfonista</label>
            <div class="col-sm-10">
            <textarea class="input-text" name="obs" id="obs" rows="6"/></textarea>
            </div>                        
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2">Zona</label>
            <div class="col-sm-3">
              	<select class="input-select" name="zona" id="zona" required>
              		<option value="">Seleccione Opción</option>
                    <option value="1">ZONA 1</option>
                    <option value="2">ZONA 2</option>
                    <option value="3">ZONA 3</option>
                    <option value="4">ZONA 4</option>
                    <option value="5">ZONA 5</option>
                    <option value="6">ZONA 6</option>
                    <option value="7">ZONA 7</option>
                    <option value="8">ZONA 8</option>
                    <option value="9">ZONA 9</option>
                    <option value="10">ZONA 10</option>   
                </select>
            </div>                        

            <div class="col-sm-7">
           	<?php
           	$buscar = $direccion.' '.$numero.', '.$nombre_comuna;

      			$json_string = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($buscar).'&key=AIzaSyDdNia4ip8qFLt-SR63TTvx8tysu6rl3XM');
      			$parsed_json = json_decode($json_string, true);
      			$lat = $parsed_json['results']['0']['geometry']['location']['lat'];
      			$lng = $parsed_json['results']['0']['geometry']['location']['lng'];
      			?>
      			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdNia4ip8qFLt-SR63TTvx8tysu6rl3XM"></script>
      			<script>
      			function initMap(){

      			  var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 13,
                center: { lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?> }
              });
              
      			  var myLatLng = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};

      			  var marker = new google.maps.Marker({
      			    position: myLatLng,
      			    map: map
      			  })

      			  var mapLayer = new google.maps.KmlLayer({
      			    url: "http://app.laflorida.cl/medico/MEDICO_DOMICILIO_ZONAS2.kml",
                map: map
              });
      			}

      			google.maps.event.addDomListener(window, 'load', initMap);
      			</script>
            <p>* Debe pinchar sobre la capa para visualizar la zona a la que pertenece la dirección.</p>
            <div id="map-canvas" style="width: 100%; height: 300px;"></div>
      			</div>
      			</div>

            <input type="hidden" name="correo" value="<?php echo @$email; ?>">  
            <br />
            <br />    
            
            <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-7">
            <button type="submit" class="btn btn-primary" name="guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Ingresar Paciente</button>
            </div>
        </div>

    </form>

<script>
$(document).ready(function(){
	$("#datos").hide();
	
	$("#mas").click(function() {	  
		  $("#datos").slideToggle("fast");				
	});
 
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