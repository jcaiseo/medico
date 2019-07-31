<?php
include('controllers/connection.php');
include('controllers/functions.php');  

$edad_desde = $_REQUEST['edad_desde'];
$edad_hasta = $_REQUEST['edad_hasta'];

$fecha_desde = fecha_rev($_REQUEST['fecha_desde']);
$fecha_hasta = fecha_rev($_REQUEST['fecha_hasta']);

$filename = "Listado_para_cartas_".fecha_esp($fecha_desde)."_a_".fecha_esp($fecha_hasta);     

$query = mysql_query("SELECT personas.rut AS rut,
                        personas.vrut AS vrut,
						personas.nombres AS nombres, 
						personas.apellidopaterno AS paterno, 
						personas.apellidomaterno AS materno,
						DATE_FORMAT(personas.fecha_nacimiento, '%d-%m-%Y') AS fecha_nacimiento,
					    CONCAT(personas.nombre_calle,' ', personas.numdirec) AS direccion,
						personas.sexo AS sexo,
					    personas.rut AS rut_a,
					    IF ((SELECT COUNT(*) FROM ag_medico_carta WHERE ag_medico_carta.rut = rut_a) > 0, '1', '0') AS existe
						FROM ag_medico_paciente, personas
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.estado = 2 
						AND TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN ".$edad_desde." AND ".$edad_hasta."
						AND ag_medico_paciente.ag_fecha BETWEEN '".$fecha_desde."' AND DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)");
                          //seleccionamos la informacion de la base de datos y de la tabla.   

header("Content-Type: application/xls;");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
?>

<meta http-equiv="Content-Type" content="charset=utf-8" />

 <table id="table" class="tabla display" cellspacing="0" width="100%">
    <thead>
    <tr>
    <!--<th>rut</th>
    <th>digito</th>-->
    <th>nombres</th>
    <th>apellido_paterno</th>
    <th>apellido_materno</th>
    <th>direccion</th>
    <th>edad</th>
    <th>sexo</th>                         
  </tr> 
  </thead>
  <tbody>
<?php

    mysql_query("INSERT INTO ag_medico_carta_genera (fecha_generacion, fecha_desde, fecha_hasta, edad_desde, edad_hasta) 
	             VALUES (NOW(), '".$fecha_desde."', '".$fecha_hasta."', '".$edad_desde."', '".$edad_hasta."')");	
	
	$id_generar = mysql_insert_id();	

    if(mysql_num_rows($query) > 0){
    while ($row = mysql_fetch_array($query)){
		
		if($row['existe'] != 1){	
	
		mysql_query("INSERT INTO ag_medico_carta (id_generar, rut) VALUES ('".$id_generar."','".$row['rut_a']."')");			
    ?>
    <tr>
      <!--<td><?php echo $row['rut']; ?></td>
      <td><?php echo $row['vrut']; ?></td>-->
      <td><?php echo $row['nombres']; ?></td>
      <td><?php echo $row['paterno']; ?></td>
      <td><?php echo $row['materno']; ?></td>
      <td><?php echo $row['direccion']; ?></td>
      <td><?php echo edad($row['fecha_nacimiento']); ?></td>
      <td><?php echo $row['sexo']; ?></td>      
    </tr> 
    <?php 
		}
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