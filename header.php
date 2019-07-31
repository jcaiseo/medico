<?php 
session_start();
 include ('controllers/authorization.php');
 include ('controllers/connection.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">	
<link rel="shortcut icon" href="img/icon.ico">
<title>Municipalidad de La Florida</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="icon.ico">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.font.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script src="fancybox/jquery.fancybox.js"></script>
<script src="fancybox/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" media="screen" />
<script>
$(document).ready(function() {
	 $("#cerrar").click( function(){ $("#alerta").remove(); });// funcion para eliminar mensajes con opacidad.
     
	 $("form input").keypress(function(e) {
			  if (e.which == 13) {
				  return false;
			  }
		  });  
});
</script>

</head>
<body>
<!-- header --> 
<div class="header">
	<div class="logo">
		<img src="img/logo-lf.png" alt=""/>
    </div>
    <h1>MÉDICO A DOMICILIO</h1>
</div>

<?php include('menu.php'); ?>

<div class="container site">