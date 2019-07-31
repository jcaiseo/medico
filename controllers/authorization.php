<?php
include ('controllers/connection.php');
  
$user_check = $_SESSION['id_user']; // utilizamos la variables de sesion del acceso para comprobar que el usuario este logeado.

$query = mysql_query("SELECT id_user AS id_user, 
					  user AS user, 
					  perfil AS perfil
					  FROM usuarios 
					  WHERE id_user = '$user_check'") or die (mysql_error()); // consulta, trae datos de acceso a la aplicacion.

if(mysql_num_rows($query) > 0){		
			  
	$row = mysql_fetch_array($query);
	
	$id_user = $row['id_user'];
	$user_name = $row['user'];
	$perfil = $row['perfil'];
	$_SESSION['perfil'] = $row['perfil'];

	if(!isset($id_user)) // IMPORTANTE: id de user y aplicacion, si no existe la app o el registro en la bd, no podra acceder.
	{
		header("location: index.php?m=error");
	}
	
}else{
	header("location: index.php?m=error");

}

?>