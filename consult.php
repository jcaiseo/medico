<?php include('header.php');
include('controllers/functions.php');

if(isset($_POST['consultar'])) {
	if(empty($_POST['rut'])) { 
		$error[] = "El campo <b>RUT</b> es requerido.";			  
	}
	elseif($_POST['digito'] === "") {
		$error[] = "El <b>Digito Verificador</b> es requerido."; 
	}
	elseif(validarRUT($_POST['rut']) != strtoupper($_POST['digito'])) {
		$error[] = "El <b>RUT</b> ingresado no es valido."; 
	}

	if(!isset($error)){
	
	$rut_full = $_POST['rut']."-".strtoupper($_POST['digito']);

	$rut = $_POST['rut'];
	$digito = $_POST['digito'];
	
	$query = mysql_query("SELECT rut FROM personas WHERE rut = '$rut' AND vrut = '$digito'"); 
	
		if(mysql_num_rows($query) > 0) { 
			echo "<script>window.location.href = 'editar-vecino.php?rut=".$rut_full."';</script>";	  						
		}else {
			echo "<script>window.location.href = 'agregar-vecino.php?rut=".$rut_full."';</script>";
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

if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'exito'){
		echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>Atención ingresada correctamente.</div>"; 
		unset($_SESSION['mensaje']);
	}
?>

<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Registrar Vecino
</div>

	<h3>Registrar Vecino</h3>
    
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-horizontal">
 		
        <div class="form-group">
        	<label class="control-label col-md-2">R.U.T (11111111-1)</label>
        <div class="col-md-3">
        <input type="text" name="rut" id="rut" class="input-text rut" maxlength="8" autocomplete="off"/> - <input type="text" name="digito" id="digito" class="input-text digito" maxlength="1" autocomplete="off"/>
        </div>
        </div>
        
        <div class="form-group">
                <div class="col-sm-2"></div>
    	        <div class="col-sm-3"><input type="submit" name="consultar" class="btn btn-primary" value="Consultar" /></div>
        </div>   


       <p class="light">Si el usuario no existe en la base de datos deber&aacute; crearlo</p>
    </form>

<?php include('footer.php')?>