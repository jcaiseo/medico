<?php include('header.php');
include('controllers/functions.php');
?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Exportar Atenciones
</div>    
    
<h3>Exportar Atenciones Cancelada</h3>

  <form action="exportar-atenciones-cancelada.php" method="get" class="form-horizontal" enctype="multipart/form-data">              
     
              
            <div class="form-group">
                <label class="control-label col-sm-1">Desde</label>
                <div class="col-sm-2">
                <input class="input-text" name="fecha_desde" id="fecha_desde"/> 
                </div>
            </div>
                
            <div class="form-group">  
                <label class="control-label col-sm-1">Hasta</label>
                <div class="col-sm-2">
                 <input class="input-text" name="fecha_hasta" id="fecha_hasta"/> 
                </div>
            </div>

            <br />    
            
            <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
             <button type="submit" class="btn btn-primary" name="guardar"><span class="glyphicon glyphicon-floppy-disk"></span> Consultar</button>
            </div>
        </div>

    </form>


<script>
$(document).ready(function(){
	$("#datos").hide();
	
	$("#mas").click(function() {	  
		  $("#datos").slideToggle("fast");				
	});

  $("#fecha_desde").datepicker({dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: '2018:'});
  $("#fecha_hasta").datepicker({dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: '2018:'});

});
</script>

<?php include('footer.php')?>