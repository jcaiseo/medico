<?php include('header.php');
include('controllers/functions.php');
include('controllers/connection.php');
?>

<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Pacientes Medico
</div>

<h3>Listado de Pacientes</h3>

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

       $("#pacientes").load( "controllers/pacientes-medico.php?m=<?php echo $id_user; ?>" ); 
      setInterval(function() { // Do this
           $("#pacientes").load( "controllers/pacientes-medico.php?m=<?php echo $id_user; ?>"); 
      }, 1000); // Every one secon 
});	
</script>
   
   <div id="pacientes" style="max-height: 400px; overflow-x: none; overflow-y: scroll;">
   </div>
   
<?php include('footer.php')?>