<?php include('header.php');
include('controllers/functions.php');
?>

<?php
if(isset($_POST['guardar'])){  

	$movil = $_REQUEST['movil'];
    $medico = $_REQUEST['medico'];
        
	if(!isset($error)){            
       
        $query = mysql_query("SELECT * FROM ag_medico_movil WHERE medico = '$medico'");

        if(mysql_num_rows($query) > 0) {
        	echo "<div id='alerta' class='info'><div><a id='cerrar' title='Cerrar'>x</a></div>El médico ya esta asinado a otro móvil o no hay medicos disponibles para asginar.</div>"; 
		}else{
	  		$query2 = mysql_query("UPDATE ag_medico_movil
                    SET medico='$medico'
                    WHERE id_movil = '$movil'")  or die(mysql_error());
		    
			if($query2) { //si esta ok se registra al nuevo usuario  
			    $_SESSION['mensaje'] = "exito";
			    echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>El médico ha sido asingado correctamente al movil</div>"; 
		 
			}else {    //si ocurre error se arroja mensaje
			    echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Ha ocurrido un error y no se pudo registrar al vecino</div>"; 
			} 
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
?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Móviles
</div>    
    
<h3>Móviles</h3>

    <?php
    $query = mysql_query("SELECT id_movil, medico FROM ag_medico_movil");

    while($row = mysql_fetch_array($query)){
    ?>
	<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">              
	    <div class="form-group">
	    	<label class="control-label col-sm-1">Móvil <?php echo $row['id_movil'] ?></label>
	    	<div class="col-sm-3">
	    	<input type="hidden" name="movil" id="movil" value="<?php echo $row['id_movil']; ?>">
			<select class="input-select" name="medico" id="medico">
				<option>Seleccionar Médico</option>
				<?php
				$query2 = mysql_query("SELECT id_user, nombre FROM usuarios WHERE perfil = '99'");
				while($row2 = mysql_fetch_array($query2)){
				?>
				<option value="<?php echo $row2['id_user']; ?>" <?php if($row['medico'] === $row2['id_user']){ echo "selected"; echo " style='background-color:green; color:#fff;'";}?>><?php echo $row2['nombre']; ?></option>
				<?php
				}
				?>
			</select>
		    </div>
		    <div class="col-sm-2">
				<button type="submit" class="btn btn-primary" name="guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Asingar a Móvil <?php echo $row['id_movil']; ?></button>
			</div>
 			<div class="col-sm-1">
				<a href="quitar-medico.php?m=<?php echo $row['id_movil']; ?>" class="btn btn-danger" name="guardar"><span class="glyphicon glyphicon-remove"></span> Quitar a Médico</a>
			</div>
	    </div>
	</form>    
    <?php
	}
    ?>

<script>
$(document).ready(function(){

  $("#fecha_desde").datepicker({dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: '2018:'});
  $("#fecha_hasta").datepicker({dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: '2018:'});

});
</script>

<?php include('footer.php')?>