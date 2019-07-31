<?php include('header.php');
include('controllers/functions.php');
include('controllers/connection.php');
?>

<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Médicos
</div>

<h3>Listado de Médicos</h3>

<?php
	if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'exito'){
		echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>La informacion a sido actualizada correctamente.</div>"; 
			unset($_SESSION['mensaje']);	
	}
	if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'eliminado'){
		echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Se ha eliminado correctamente.</div>"; 
			unset($_SESSION['mensaje']);	
	}	
?>

<script>
$(document).ready(function() { 

       $("#medicos").load( "controllers/medicos.php" ); 
      setInterval(function() { // Do this
           $("#medicos").load( "controllers/medicos.php" ); 
      }, 1000); // Every one secon 
});	
</script>
   
   <div id="medicos" style="max-height: 400px; overflow-x: none; overflow-y: scroll;">
   </div>
   
<?php include('footer.php')?>