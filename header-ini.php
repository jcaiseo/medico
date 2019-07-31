<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Municipalidad de La Florida</title>
<link rel="shortcut icon" href="icon.ico">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui-css.css"/>
</head>
<body>

<div class="header">
		<div class="logo">
			<img src="img/logo-lf.png"/>
</div>
    <h1>MÉDICO A DOMICILIO</h1>
</div>

<script>
$(document).ready(function() {
	 $("#cerrar").click( function(){ $("#alerta").remove(); });// funcion para eliminar mensajes con opacidad.
});
</script>
 