<?php
include('controllers/connection.php');
include('controllers/functions.php');  

$fecha_desde = fecha_rev($_REQUEST['fecha_desde']);
$fecha_hasta = fecha_rev($_REQUEST['fecha_hasta']);

$filename = "Atenciones_".fecha_esp($fecha_desde)."_a_".fecha_esp($fecha_hasta);     

$query = mysql_query("SELECT personas.nombres AS nombres,
					  personas.apellidopaterno AS apellidopaterno,
					  personas.apellidomaterno AS apellidomaterno,
					  personas.sexo AS sexo,
                      CONCAT(personas.nombre_calle,' ', personas.numdirec) AS direccion,
                      DATE_FORMAT(ag_medico_paciente.ag_fecha, '%Y-%m-%d') AS fecha_atencion,
                      ag_medico_paciente.detalle_llamado AS detalle_llamado,
                      DATE_FORMAT(personas.fecha_nacimiento, '%d-%m-%Y') AS fecha_nacimiento
                      FROM ag_medico_paciente, personas, usuarios
                      WHERE ag_medico_paciente.rut = personas.rut
                      AND ag_medico_paciente.id_user = usuarios.id_user
                      AND ag_medico_paciente.ag_fecha >= '$fecha_desde' AND ag_medico_paciente.ag_fecha <= DATE_ADD('$fecha_hasta', INTERVAL 1 DAY)
                      ORDER BY ag_medico_paciente.id DESC") or die(mysql_error());
                          //seleccionamos la informacion de la base de datos y de la tabla.   

header("Content-Type: application/xls;");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
?>

<meta http-equiv="Content-Type" content="charset=utf-8" />

 <table id="table" class="tabla display" cellspacing="0" width="100%">
    <thead>
    <tr>
    <th>nombres</th>
    <th>apellido_paterno</th>
    <th>apellido_materno</th>
    <th>sexo</th>
    <th>direccion</th>
    <th>fecha_atencion</th>
    <th>detalle_llamado</th>   
    <th>edad</th>                         
  </tr> 
  </thead>
  <tbody>
<?php

    if(mysql_num_rows($query) > 0){
    while ($row = mysql_fetch_array($query)){
    ?>
    <tr>
      <td><?php echo $row['nombres']; ?></td>
      <td><?php echo $row['apellidopaterno']; ?></td>
      <td><?php echo $row['apellidomaterno']; ?></td>
      <td><?php echo $row['sexo']; ?></td>
      <td><?php echo $row['direccion']; ?></td>
      <td><?php echo $row['fecha_atencion']; ?></td>
      <td><?php echo strtoupper($row['detalle_llamado']); ?></td>
      <td><?php echo edad($row['fecha_nacimiento']); ?></td>      
    </tr> 
    <?php 
    } 
  }else{
  ?>
  <tr>
    <td colspan="5">No hay registros.</td>
  </tr> 
  <?php
}
?>
  </tbody>            