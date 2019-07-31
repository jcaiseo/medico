<?php session_start();
include('controllers/connection.php');
//include('controllers/exp-password.php');

$id = $_REQUEST['id'];

$query = mysql_query("UPDATE ag_medico_paciente SET estado='1'  WHERE id = '".$id."'") or die (mysql_error());
 	
if($query){
	   $_SESSION['mensaje'] = 'eliminado';
	   header('Location: ' . $_SERVER['HTTP_REFERER']);
       exit();
   }
	
?>