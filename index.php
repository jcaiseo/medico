<?php include('header-ini.php');

include('controllers/connection.php');

if (isset($_POST['enviar'])) { // se comprueba el submit 
  
  if(empty($_POST['user'])) { // comprobamos que el campo email no esté vacío 
             $error[] = "El campo <b>Usuario</b> es requerido."; 
  }      
  if(empty($_POST['password'])) { // comprobamos que el campo clave no esté vacío 
             $error[] = "El campo <b>Clave</b> es requerido."; 
  }
  
  $usuario = addslashes($_POST['user']); // se limpia el campo
  $pass = addslashes($_POST['password']);	
   
  if(!isset($error)){
	  
	$query = mysql_query("SELECT user FROM usuarios WHERE user = '".$usuario."'"); 
  
	if(mysql_num_rows($query) > 0){ 
	  //$pass = md5($pass);
	   
	  $query = mysql_query("SELECT * FROM usuarios WHERE MD5(LOWER(user)) = MD5(LOWER('".$usuario."')) AND MD5(password) = MD5('".$pass."')");
	  
	  if(mysql_num_rows($query) > 0){ 
		  
		$row = mysql_fetch_array($query);		
		$_SESSION['id_user'] = $row['id_user'];	
		$perfil = $row['perfil'];			

		if($perfil === '2'){
        	header('location: consult.php');	
    	}else if($perfil === '1'){
       	 	header('location: pacientes.php');
   		}else if($perfil === '0'){
   		 	header('location: consult.php');	
        }else if($perfil === '99'){
        header('location: pacientes-medico.php');  
        }else if($perfil === '98'){
        header('location: generar-carta-excel.php');  
        }         		
	  }else{
		 echo '<div id="alerta" class="error"><div><a id="cerrar" title="Cerrar">x</a></div>Contraseña incorrecta!</div>';
	  }			
	}else{
	   echo '<div id="alerta" class="error"><div><a id="cerrar" title="Cerrar">x</a></div>Usuario no existe!</div>';
	}
  }
	
  if(isset($error)){
		echo "<div id='alerta' class='alerta'>";
		echo "<div><a id='cerrar' title='Cerrar'>x</a></div>";
              foreach($error as $errores){
                 echo $errores."<br>";
              }
			  echo "</div>";
  }        
}


if(@$_REQUEST['m'] === "error"){ 
	  echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Debe Iniciar Sesión para ingresar a esta Página</div>";
	}
?>  


<div class="site4">



<div class="recuperar">

	<h3>Acceso</h3>

        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal">
     	           
<div class="form-group">
  <label class="control-label col-md-3">Usuario</label>
  <div class="col-md-9"><input type="text" name="user" class="input-text" autocomplete="off"></div>
</div>   

<div class="form-group">
  <label class="control-label col-md-3">Contraseña</label>
  <div class="col-md-9"><input type="password" name="password" class="input-text" autocomplete="off"></div>
</div>            

<div class="form-group">
  <div class="col-md-4"><input type="submit" name="enviar" class="btn btn-primary" value="Ingresar"></div>
  <div class="col-md-8 text-right"><a href="recuperar-contrasena.php" title="Recuperar su Contraseña" class="btn btn-link">¿Olvido su contraseña?</a></div>
</div>        
        
        </form>
</div>        
        
</div>
<?php include('footer.php')?>