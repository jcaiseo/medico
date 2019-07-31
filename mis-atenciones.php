<?php include('header.php');
include('controllers/functions.php');
?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Mis Atenciones
</div>

<?php

$id_user = $_REQUEST['id_user'];
$fecha_desde = fecha_rev($_REQUEST['fecha_desde']);
$fecha_hasta = fecha_rev($_REQUEST['fecha_hasta']);
   
$query = mysql_query("SELECT ag_medico_paciente.id AS id,
                      personas.rut AS rut,
                      CONCAT(personas.nombres,' ', personas.apellidopaterno,' ',personas.apellidomaterno) AS persona,
                      CONCAT(personas.nombre_calle,' ', personas.numdirec) AS direccion,
                      DATE_FORMAT(ag_medico_paciente.ag_fecha, '%Y-%m-%d') AS fecha_atencion,
                      ag_medico_paciente.detalle_llamado AS detalle_llamado,
                      DATE_FORMAT(personas.fecha_nacimiento, '%d-%m-%Y') AS fecha_nacimiento,
                      personas.sexo AS sexo,
                      (SELECT CASE WHEN ag_medico_paciente.estado = '0' THEN 'ingresado'
                      WHEN ag_medico_paciente.estado ='1' THEN 'eliminado'
                      WHEN ag_medico_paciente.estado ='2' THEN 'finalizado'
                      WHEN ag_medico_paciente.estado ='3' THEN 'cancelado'
                      END) AS estado
                      FROM ag_medico_paciente, personas
                      WHERE ag_medico_paciente.rut = personas.rut
                      AND ag_medico_paciente.id_user = '$id_user'
                      AND ag_medico_paciente.ag_fecha >= '$fecha_desde' AND ag_medico_paciente.ag_fecha <= DATE_ADD('$fecha_hasta', INTERVAL 1 DAY)
                      ORDER BY ag_medico_paciente.id DESC") or die(mysql_error());
                          //seleccionamos la informacion de la base de datos y de la tabla.   

?>

<h3>Mis Atenciones: Desde <?php echo $fecha_desde; ?> - Hasta <?php echo $fecha_hasta; ?></h3>

 <table id="table" class="tabla display" cellspacing="0" width="100%">
    <thead>
    <tr>
    <th>ID</th>
    <th>RUT</th>
    <th>PACIENTE</th>
    <th>DIRECCION</th>
    <th>FECHA ATENCION</th>
    <th>DETALLE</th>   
    <th>EDAD</th>
    <th>SEXO</th>
    <th>ESTADO</th>                           
  </tr> 
  </thead>
  <tbody>

<?php

    if(mysql_num_rows($query) > 0){
    while ($row = mysql_fetch_array($query)){
    ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['rut']; ?></td>
      <td><?php echo $row['persona']; ?></td>
      <td><?php echo $row['direccion']; ?></td>
      <td><?php echo $row['fecha_atencion']; ?></td>
      <td><?php echo $row['detalle_llamado']; ?></td>
      <td><?php echo edad($row['fecha_nacimiento']); ?></td>
      <td><?php echo $row['sexo']; ?></td>  
      <td><?php echo $row['estado']; ?></td>      
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
  </table>   

<?php include('footer.php')?>           