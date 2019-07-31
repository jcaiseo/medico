<?php include('header.php');
include('controllers/functions.php');
include('controllers/connection.php');

	$query = mysql_query("SELECT count(ag_medico_paciente.id) AS cantidad
						FROM ag_medico_paciente
						WHERE ag_medico_paciente.estado = '3'") or die(mysql_error());
	
	$row = mysql_fetch_array($query);	
?>

<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Pacientes Cancelado
</div>

<h3>Listado de Pacientes Cancelado <span class="pull-right">Cantidad: <?php echo $row['cantidad']; ?></span></h3>

<?php
	if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'exito'){
		echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>La informacion a sido actualizada correctamente.</div>"; 
		unset($_SESSION['mensaje']);	
	}
	if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'eliminado'){
		echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Se ha eliminado la solicitud.</div>"; 
		unset($_SESSION['mensaje']);	
	}	
?>

<script>
$(document).ready(function() { 

       $("#pacientes").load( "controllers/pacientes-cancelado.php" ); 
      setInterval(function() { // Do this
           $("#pacientes").load( "controllers/pacientes-cancelado.php" ); 
      }, 1000); // Every one secon 
});	
</script>
   
   <div id="pacientes" style="max-height: 400px; overflow-x: none; overflow-y: scroll;">
   </div>
   
<?php include('footer.php')?>