<?php include('header.php');
include('controllers/functions.php');

$id = $_REQUEST['id'];

if(isset($_POST['guardar'])){
  
  $nombres = strtoupper($_REQUEST['nombres']);
  $apellido_paterno = strtoupper($_REQUEST['apellido_paterno']);
  $apellido_materno = strtoupper($_REQUEST['apellido_materno']);

  $nombre = $nombres.' '.$apellido_paterno.' '.$apellido_materno;
  $email = $_REQUEST['email'];

  $usuario = strtolower($_REQUEST['usuario']);
  $contrasena = $_REQUEST['contrasena'];

  if(!isset($error)){	 					 
			 
	 $query = mysql_query("UPDATE usuarios SET nombre='".$nombre."', user='".$usuario."', password='".$contrasena."', correo='".$email."' WHERE id_user = ".$id."")  or die(mysql_error());
					 
	  if($query) { //si esta ok se registra al nuevo usuario
				 $_SESSION['mensaje'] = 'exito';		  
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

$query = mysql_query("SELECT * FROM usuarios WHERE id_user = ".$id."");
$row = mysql_fetch_array($query);

$rut = $row['rut'];

$nombre = explode(" ", $row['nombre']);
$nombres = $nombre[0];
$apellido_paterno = $nombre[1];
$apellido_materno = $nombre[2];

$email = $row['email'];

$usuario = $row['user'];
$contrasena = $row['password'];

?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Editar Médico
</div>    
    
<h3>Editar Médico</h3>
    
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal">

    <div class="form-group">
          <label class="control-label col-md-2">R.U.T (11111111-1)</label>
        <div class="col-md-3">
        <input type="text" name="rut" id="rut" class="input-text rut" maxlength="8" autocomplete="off"disabled value="<?php echo @$rut; ?>" />
        </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Nombres</label>
      <div class="col-sm-3">          
         <input class="input-text" name="nombres" id="nombres" value="<?php echo @$nombres ?>" required/> 
      </div>     
   </div>

   <div class="form-group">
      <label class="control-label col-sm-2">Apellido Paterno</label>
      <div class="col-sm-3">
         <input class="input-text"  name="apellido_paterno" id="apellido_paterno" value="<?php echo @$apellido_paterno ?>" required/> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Apellido Materno</label>
      <div class="col-sm-3">          
         <input class="input-text"  name="apellido_materno" id="apellido_materno" value="<?php echo @$apellido_materno ?>"/> 
      </div>     
   </div>  

		<div class="form-group">
        	 <label class="control-label col-sm-2">Email</label>
            <div class="col-sm-3">
	          <input class="input-text" name="email" type="email" id="email" value="<?php echo @$email ?>"/> 
            </div>       
    </div>
 

<script>
$(document).ready(function(){

  $("#nombres").bind("keyup", function(){
    var nombre = $(this).val();
    nombre = nombre.substring(0, 1);
    $('#usuario').val(nombre);
  });

  $("#apellido_paterno").bind("keyup", function(){
    var apellido_paterno = $(this).val();
    var usuario = $('#usuario').val();
    usuario = usuario.substring(1 , 0);
    $('#usuario').val(usuario+apellido_paterno);
  });
});
</script>

   <div class="form-group">
      <label class="control-label col-sm-2">Usuario</label>
      <div class="col-sm-3">
         <input class="input-text" name="usuario" id="usuario" required value="<?php echo @$usuario; ?>" /> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Contraseña</label>
      <div class="col-sm-3">          
         <input type="password" class="input-text" name="contrasena" id="contrasena" value="<?php echo @$contrasena; ?>"/> 
      </div>     
   </div>  

    <br />
    <br />     
       
    <div class="formulario pull-center">
	        <button type="submit" class="btn btn-primary" name="guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Datos</button>
    </div>
        
     
    </form>

<?php include('footer.php')?>