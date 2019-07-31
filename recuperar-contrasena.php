<?php require('header-ini.php');
include ('controllers/functions.php');
?>

<?php
if(isset($_REQUEST['enviar'])){
	
             if(empty($_POST['rut'])) { // comprobamos que el campo rut no esté vacío 
			     $error[] = "El campo <b>RUT</b> es requerido.";			  
             }
			 if($_POST['digito'] === "") { // comprobamos que el campo digito no esté vacío 
                 $error[] = "El <b>Digito Verificador</b> es requerido."; 
                 }
			 elseif(validarRUT($_POST['rut']) != strtoupper($_POST['digito'])) { // comprobamos que el campo digito verificador introducido sea igual al digito verificador que el validador no devuelve.
                 $error[] = "El <b>RUT</b> ingresado no es valido."; 
                 }			 

          if(!isset($error)){
			 
			 $rut = $_POST['rut']."-".strtoupper($_POST['digito']); // si el digito verificador es "K" lo guardamos en mayusculas

include ('controllers/connection.php');

             // comprobamos que el usuario ingresado haya sido registrado antes 
             $sql = mysql_query("SELECT rut, user, correo, password, bloqueo FROM usuario WHERE rut = '$rut'"); 
             
			 if(mysql_num_rows($sql) > 0) { //si existe se redirecciona a listar las mascotas asociadas al rut.
			                      $row = mysql_fetch_array($sql);
				                   		 
							      $bloqueo = $row['bloqueo'];
					
					if($bloqueo === '0'){
							
								  $clave = $row['password'];
								  $correo = $row['correo'];
								  $usuario = $row['user'];
                                   
								  $to = $correo; 
								  $subject = 'Recuperacion de Contraseña REDOM';
								  
								  $headers = "MIME-Version: 1.0\r\n";
								  $headers .= "Content-Type: text/html; charset=utf-8\r\n";
								  
								  $message = '<html><body style="font-family:Arial; font-size: 12px;">';
								  $message .= '<pre style="font-family:Arial; font-size: 13px;">Estimado Usuario:
					
	Los datos de su cuenta se adjuntan en este correo, recuerde que es única e intransferible.	   
						   </pre>';
								  $message .= '<pre style="font-family:Arial; font-size: 13px;">Los datos son:
	Usuario: <b>'.$usuario.'</b>				  
	Clave: <b>'.$clave.'</b>
								  </pre>';
								  $message .= '<pre style="font-family:Arial; font-size: 13px; font-weight:bold">*No conteste este correo. Si tiene algun problema, por favor contactarse con Departamento de Informatica - Area de Desarrollo, a cualquiera de nuestros anexos 4282-4047-4269.</pre>';
								  $message .= '</body></html>';
								  
  if(mail($to, $subject, $message, $headers)){
	  echo "<div class='exito'>Se ha enviado un correo, para recuperar su clave!.</div>"; 
  }
  else{
	  echo "<div class='error'>No se ha podido enviar el correo. Intentelo mas tarde.</div>"; 
	  }	
	}
	elseif($bloqueo === '1'){
		echo "<div class='error'>Este Usuario ha sido bloqueado por seguridad.</div>"; 	  
		}
    	}else {    //si no existe se redirecciona ingreso y registro del contribuyente y de la mascota.
			 
                		echo "<div id='alertas' class='error'>Usuario no existe!</div>";     
             }
             mysql_close();
          }
   
		  if(isset($error)){ // comprobamso si existen errores en los campos, si lo hay los mostrara en pantalla
			  echo "<div id='alertas' class='error'>";
              foreach($error as $errores){
                 echo $errores."<br>";
              }
			  echo "</div>";
		  }
}
?>

<div class="site4">

<div class="recuperar">
	<h2>Recuperar Contraseña</h2>
<form method="post">

    <div class="formulario">
    <div class="label col-1">	
     Ingrese RUT
    </div>
    <div class="col-3">
<input type="text" name="rut" id="rut" class="input-text rut" maxlength="8" autocomplete="off"> - <input type="text" name="digito" id="digito" class="input-text digito" maxlength="1" autocomplete="off">
    </div>
    </div>

    <div class="formulario">
        <div class="label col-2">	
<input name="enviar" type="submit" id="Ingresar" value="Enviar" class="input-btn"/>
        </div>
        <div class="label col-2" style="text-align:right;">
			<a href="index.php">Volver a Ingresar</a>
		</div>
   </div> 
     
     </form> 
</div>
</div> 
<?php require('footer.php')?>
