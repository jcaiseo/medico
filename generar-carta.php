<?php include('header.php');
include('controllers/functions.php');

?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Generar Cartas 
</div>    
    
<h3>Generar Cartas</h3>
   
<form action="print-carta.php" method="get" class="form-horizontal">

<div class="form-group">
<label class="control-label col-sm-1">Edad Desde</label>
  <div class="col-sm-1">					
<input name="edad_desde" autocomplete="off"  type="number" class="input-text" value="0"/>
</div>
<label class="control-label col-sm-1">Edad Hasta</label>
  <div class="col-sm-1">					
<input name="edad_hasta" autocomplete="off"  type="number" class="input-text" value="99"/>
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-1">Fecha Desde</label>
  <div class="col-sm-2">					
<input id="fecha1" name="fecha_desde" autocomplete="off"  type="text" class="input-text" placeholder="00-00-0000"/>
</div>
</div>

<div class="form-group">
<label class="control-label col-sm-1">Fecha Hasta</label>
  <div class="col-sm-2">					
<input id="fecha2" name="fecha_hasta" autocomplete="off"  type="text" class="input-text" placeholder="00-00-0000"/>
</div>
</div>

<div class="form-group">

</div>

<div class="form-group">
  <div class="col-sm-2">
  </div> 
  <div class="col-sm-2">	
   <button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search"></span> Consultar</button>
 </div> 
</div>

</form>

<script>
$(function() {
 $( "#fecha1" ).datepicker({dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: '2018:'});
 $( "#fecha2" ).datepicker({dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true,yearRange: '2018:'});
});
</script>   

<?php include('footer.php')?>