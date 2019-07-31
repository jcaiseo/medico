<?php session_start();
include('controllers/connection.php');
//include('controllers/exp-password.php');

$id = $_REQUEST['id'];

$query = mysql_query("DELETE FROM usuarios WHERE id_user = '".$id."' AND perfil = 99") or die (mysql_error());
 	
if($query){
	   $_SESSION['mensaje'] = 'eliminado';
	   header('Location: ' . $_SERVER['HTTP_REFERER']);
       exit();
   }
	
?>