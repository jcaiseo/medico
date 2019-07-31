<?php include('header.php');
include('controllers/functions.php');

if(isset($_POST['consultar'])) {
	
	if(!isset($error)){
	
	$nombre = $_POST['nombre'];
	$paterno = $_POST['paterno'];
	$materno = $_POST['materno'];
	
		echo "<script>window.location.href = 'registro-nombre.php?nombre=".$nombre."&paterno=".$paterno."&materno=".$materno."';</script>";					
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
    <a href="consult.php">Inicio</a> > Buscar Paciente por Nombre
</div>

	<h3>Buscar Paciente por Nombre</h3>
    
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal">
 		
        <div class="form-group">
        	<label class="control-label col-md-2">Nombre</label>
        <div class="col-md-3">
        <input type="text" name="nombre" id="nombre" class="input-text" /> 
        </div>
        </div>

        <div class="form-group">
        	<label class="control-label col-md-2">Apellido Paterno</label>
        <div class="col-md-3">
        <input type="text" name="paterno" id="paterno" class="input-text"/> 
        </div>
        </div>
        
        <div class="form-group">
        	<label class="control-label col-md-2">Apellido Materno</label>
        <div class="col-md-3">
        <input type="text" name="materno" id="materno" class="input-text"/> 
        </div>
        </div>                
        
        <div class="form-group">
                <div class="col-sm-2"></div>
    	        <div class="col-sm-3"><input type="submit" name="consultar" class="btn btn-primary" value="Consultar" /></div>
        </div>   


       <p class="light">Si el usuario no existe en la base de datos deber&aacute; crearlo</p>
    </form>

<?php include('footer.php')?>