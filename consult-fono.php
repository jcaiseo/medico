<?php include('header.php');
include('controllers/functions.php');

if(isset($_POST['consultar'])) {
	
	if(empty($_POST['fono'])) { 
		$error[] = "El campo <b>Teléfono</b> es requerido.";			  
	}

	if(!isset($error)){
	
	$fono = $_POST['fono'];
	
		echo "<script>window.location.href = 'registro-fono.php?fono=".$fono."';</script>";					
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

if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'exito'){
		echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>Solicitud ingresada correctamente.</div>"; 
		unset($_SESSION['mensaje']);
	}
?>

<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Buscar Paciente por Teléfono
</div>

	<h3>Buscar Paciente por Teléfono</h3>
    
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal">
 		
        <div class="form-group">
        	<label class="control-label col-md-2">Teléfono</label>
        <div class="col-md-3">
        <input type="text" name="fono" id="fono" class="input-text"/>
        </div>
        </div>
        
        <div class="form-group">
                <div class="col-sm-2"></div>
    	        <div class="col-sm-3"><input type="submit" name="consultar" class="btn btn-primary" value="Consultar" /></div>
        </div>   


       <p class="light">Si el usuario no existe en la base de datos deber&aacute; crearlo</p>
    </form>

<?php include('footer.php')?>