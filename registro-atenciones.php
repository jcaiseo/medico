<?php include('header.php');
include('controllers/functions.php');

@$rut_full = $_REQUEST['rut'];

    $new_rut = explode("-", $rut_full);
    $rut = $new_rut[0];
    $digito = $new_rut[1];

	$query = mysql_query("SELECT * FROM personas WHERE rut = '".$rut."' AND vrut ='".$digito."'");
	$row = mysql_fetch_array($query);
	
	$nombre = $row['nombres'];
  $apellido_paterno = $row['apellidopaterno'];
  $apellido_materno = $row['apellidomaterno'];
	$direccion = $row['nombre_calle'];
	$numero = $row['numdirec'];
	$depto = $row['depto'];
  $referencia_direc = $row['referenciadir'];
  $nombre_comuna = $row['nombre_comuna'];
	$email = $row['email']; 
	$telefono = $row['fono'];
	$telefono2 = $row['fono_2'];
  $uv = $row['unidad_v'];
  @$fecha_nac = fecha_esp($row['fecha_nacimiento']);
  $sexo = $row['sexo'];    
?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Registrar Paciente
</div>    
    
<h4>Datos Vecino<span class="pull-right glyphicon glyphicon-plus" id="mas" title="Ver Datos Vecino" style="cursor: pointer;"></span></h4>
   
 <div class="form-horizontal">
    
    <div class="form-group">
      <label class="control-label col-sm-2">R.U.T</label>
      <div class="col-sm-3">
        <input class="input-text readonly"  name="rut" id="rut" value="<?php echo @$rut_full; ?>" disabled/> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Nombres</label>
      <div class="col-sm-3">          
         <input class="input-text"  name="nombres" id="nombres" value="<?php echo @$nombre ?>" disabled/> 
      </div>     
   </div>

     <div class="form-group">
      <label class="control-label col-sm-2">Apellido Paterno</label>
      <div class="col-sm-3">
         <input class="input-text"  name="apellido_paterno" id="apellido_materno" value="<?php echo @$apellido_paterno ?>" disabled/> 
      </div>
      <label class="control-label col-sm-2" for="pwd">Apellido Materno</label>
      <div class="col-sm-3">          
         <input class="input-text"  name="apellido_materno" id="apellido_materno" value="<?php echo @$apellido_materno ?>" disabled/> 
      </div>     
   </div>   
  
  </div>  
   <!-- Inicio Dirección y Número -->

  <div id="datos" class="form-horizontal">   
    
        <div class="form-group">      
             <label class="control-label col-sm-2">Dirección</label>
            <div class="col-sm-3">
             <input class="input-text" name="direccion" id="direccion" value="<?php echo @$direccion ?>" disabled/> 
            </div> 
             <label class="control-label col-sm-2">Número</label>
            <div class="col-sm-1">
             <input class="input-text" name="numero" id="numero" value="<?php echo @$numero ?>" disabled/> 
            </div>    
        </div>
            
        <div class="form-group">                    
             <label class="control-label col-sm-2">Depto.</label>
            <div class="col-sm-3">
             <input class="input-text" name="depto" id="depto" value="<?php echo @$depto ?>" disabled/> 
            </div>
            <label class="control-label col-sm-2">Unidad Vecinal</label>
          <div class="col-sm-1">
           <input class="input-text" name="uv" id="uv" value="<?php echo @$uv ?>" disabled/> 
            </div>        
        </div>

        <div class="form-group">      
           <label class="control-label col-sm-2">Referecia Direc.</label>
            <div class="col-sm-3">
             <input class="input-text" name="referencia_direc" id="referencia_direc" value="<?php echo @$referencia_direc ?>" disabled/> 
            </div> 
           <label class="control-label col-sm-2">Comuna</label>
            <div class="col-sm-3">
           <input class="input-text" name="nombre_comuna" id="nombre_comuna" value="<?php echo @$nombre_comuna ?>" disabled/> 
            </div>    
        </div>      

        <div class="form-group">
             <label class="control-label col-sm-2">Teléfono 1</label>
            <div class="col-sm-3">
            <input class="input-text" name="telefono" id="telefono" value="<?php echo @$telefono ?>" disabled/> 
            </div>
             <label class="control-label col-sm-2">Teléfono 2</label>
            <div class="col-sm-3">
            <input class="input-text" name="telefono2" id="telefono2" value="<?php echo @$telefono2 ?>" disabled/> 
            </div>              
        </div>

        <div class="form-group">
             <label class="control-label col-sm-2">Email</label>
            <div class="col-sm-3">
           <input class="input-text" name="email" id="email" value="<?php echo @$email ?>" disabled/> 
            </div>       
        </div>

        <div class="form-group">
           <label class="control-label col-sm-2">Fecha Nacimiento/Edad</label>
            <div class="col-sm-2">
          <input class="input-text" name="fecha_nac" id="fecha_nac" value="<?php echo @$fecha_nac ?>" disabled/> 
            </div>
            <div class="col-sm-1">
          <input class="input-text readonly" name="edad" id="edad" value="<?php echo edad(@$fecha_nac); ?>" disabled/> 
            </div>
          
          <label class="control-label col-sm-2">Sexo</label>
            <div class="col-sm-3">
              <select class="input-select" name="sexo" id="sexo" disabled>
                    <option value="0" selected>Seleccione Opción</option>
                    <option <?php if(@$sexo === 'Masculino') { echo "selected"; } ?> value="Masculino">Masculino</option>
                  <option <?php if(@$sexo === 'Femenino') { echo "selected"; } ?> value="Femenino">Femenino</option>
                </select>
            </div>
        </div>                     
       <!-- <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-7">
            <a href="editar-vecino.php?rut=<?php echo $rut; ?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-floppy-disk"></span> Editar</a>
            </div>
        </div>-->
        
    </div>      
  
        
<h4>Registro de Atenciones</h4>
  
<table id="table" class="tabla display" cellspacing="0" width="100%">
    <thead>
    <tr>
    <th width="80px">ID</th>
    <th>USUARIO</th>
    <th>INGRESO</th>
    <th>MOVIL</th>
    <th>HORA INICIO</th>
    <th>HORA TERMINO</th>
	<th>DETALLE LLAMADO</th>    
    <th>ESTADO</th>
    <th width="100px"></th>                          
  </tr> 
  </thead>
  <tbody>
<?php
    //$rut = $_REQUEST['rut'];
  
  $query = mysql_query("SELECT ag_medico_paciente.id AS id_registro,
            DATE_FORMAT(ag_medico_paciente.ag_fecha, '%d-%m-%Y %H:%i') AS fecha_ingreso,
            ag_medico_paciente.movil AS movil,
            DATE_FORMAT(ag_medico_paciente.hora_inicio, '%H:%i') AS hora_inicio,
            DATE_FORMAT(ag_medico_paciente.hora_termino, '%H:%i') AS hora_termino,
            (SELECT CASE WHEN ag_medico_paciente.estado = '0' THEN 'ingresado'
            WHEN ag_medico_paciente.estado ='1' THEN 'eliminado'
            WHEN ag_medico_paciente.estado ='2' THEN 'finalizado'
            WHEN ag_medico_paciente.estado ='3' THEN 'cancelado'
            END) AS estado,
			usuarios.user AS user,			
			ag_medico_paciente.detalle_llamado AS detalle_llamado			
            FROM ag_medico_paciente, personas, usuarios
            WHERE ag_medico_paciente.rut = personas.rut
			AND ag_medico_paciente.id_user = usuarios.id_user
            AND ag_medico_paciente.estado != '1'
            AND ag_medico_paciente.rut = '$rut'
            ORDER BY ag_medico_paciente.id DESC") or die(mysql_error());
                //seleccionamos la informacion de la base de datos y de la tabla. 

    if(mysql_num_rows($query) > 0){
    while ($row = mysql_fetch_array($query)){
    ?>
    <tr>
      <td><?php echo $row['id_registro']; ?></td>
      <td><?php echo $row['user']; ?></td>
      <td><?php echo $row['fecha_ingreso']; ?></td>
      <td><?php echo $row['movil']; ?></td>
      <td><?php echo $row['hora_inicio']; ?></td>
      <td><?php echo $row['hora_termino']; ?></td>
      <td><?php echo strtoupper($row['detalle_llamado']); ?></td>
      <td><?php echo $row['estado']; ?></td>
      <td>
        <a href="imprimir-atencion.php?id=<?php echo $row['id_registro']; ?>&rut=<?php echo $rut; ?>"" title="Imprimir" target="_blank">
          <span class="glyphicon glyphicon-print"></span>
        </a>
      </td> 
    </tr>
    <?php 
    } 
  }else{
  ?>
  <tr>
    <td colspan="99">No hay registros.</td>
  </tr> 
  <?php
}
?>
  </tbody>  
</table>

<script>
$(document).ready(function(){
  $("#datos").hide();
  
  $("#mas").click(function() {    
      $("#datos").slideToggle("fast");        
  });
});
</script>

<?php include('footer.php')?>