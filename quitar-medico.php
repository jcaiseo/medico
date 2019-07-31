<?php session_start();
include('controllers/connection.php');
//include('controllers/exp-password.php');

$movil = $_REQUEST['m'];

$query = mysql_query("UPDATE ag_medico_movil SET medico='0'  WHERE id_movil = '".$movil."'") or die (mysql_error());
 	
if($query){
	   $_SESSION['mensaje'] = 'eliminado';
	   header('Location: ' . $_SERVER['HTTP_REFERER']);
       exit();
   }
	
?>