<?php session_start();
include('connection.php'); 
include('functions.php'); 
?>

 <table id="table" class="tabla display" cellspacing="0" width="1420px">
    <thead style="top: 0; display: block; position: sticky;">
   	<tr>
        <th width="40px">ID</th>
        <th width="80px">USUARIO</th>		
        <th width="120px">PACIENTE</th>
        <th width="60px">EDAD</th>		
        <th width="100px">DIRECCION</th>
        <th width="120px">ACLARATORIA</th>
        <th width="90px">TELÉFONO</th>
        <th width="250px">DETALLE LLAMADO</th>
        <th width="80px">VIGENCIA</th>
        <th width="80px">ZONA</th>			
        <th width="80px">INGRESO</th>
        <th width="80px">HORA</th>
        <th width="80px">MOVIL</th>
        <th width="80px">INICIO</th>
        <th width="80px"></th>                 
	</tr>	
	</thead>
	<tbody style="display: block;">
<?php
    $id_user = $_REQUEST['m'];
	
	$query = mysql_query("SELECT ag_medico_paciente.id AS id_registro,
						CONCAT(personas.nombres,' ', personas.apellidopaterno,' ',personas.apellidomaterno) AS persona,
						personas.rut AS rut,
						DATE_FORMAT(personas.fecha_nacimiento, '%d-%m-%Y') AS fecha_nacimiento,						
						CONCAT(personas.nombre_calle,' ', personas.numdirec) AS direccion,
						personas.referenciadir AS aclaratoria,
						personas.fono AS fono,
						ag_medico_paciente.detalle_llamado AS detalle_llamado,
						ag_medico_paciente.prioridad AS prioridad,
						usuarios.user AS user,
						DATE_FORMAT(ag_medico_paciente.ag_fecha, '%d-%m-%Y') AS fecha_ingreso,
						DATE_FORMAT(ag_medico_paciente.ag_fecha, '%H:%i') AS hora_ingreso,
						ag_medico_paciente.movil AS movil,
						DATE_FORMAT(ag_medico_paciente.hora_inicio, '%H:%i') AS hora_inicio,	
						TIME_TO_SEC(TIMEDIFF(DATE_SUB(now(), INTERVAL 1 HOUR), ag_medico_paciente.ag_fecha)) AS diferencia,
						(SELECT CASE WHEN diferencia <= TIME_TO_SEC('01:30:00') THEN 'success'
						WHEN  diferencia > TIME_TO_SEC('01:30:00') && diferencia < TIME_TO_SEC('02:00:00') THEN 'warning'
						ELSE  'danger' END) AS color,
						(SELECT CASE WHEN hora_inicio!='0000-00-00 00:00:00' && movil!='' THEN 'primary'
						END) AS proceso,
						ag_medico_paciente.zona AS zona
						FROM ag_medico_paciente, personas, usuarios, ag_medico_movil
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.id_user = usuarios.id_user
						AND ag_medico_paciente.estado != '1'
						AND ag_medico_paciente.estado != '2'
						AND ag_medico_paciente.estado != '3'
						AND ag_medico_paciente.movil = ag_medico_movil.id_movil
						AND ag_medico_movil.medico = '$id_user'
						ORDER BY ag_medico_paciente.id ASC") or die(mysql_error());
							  //seleccionamos la informacion de la base de datos y de la tabla. 

    if(mysql_num_rows($query) > 0){
		while ($row = mysql_fetch_array($query)){
		?>
		<tr>
			<td width="40px"><?php echo $row['id_registro']; ?></td>
			<td width="80px"><?php echo $row['user']; ?></td>			
			<td width="120px"><?php echo $row['persona']; ?></td>
			<td width="60px"><?php echo edad($row['fecha_nacimiento']); ?></td>			
			<td width="100px"><?php echo $row['direccion']; ?></td>
			<td width="120px"><?php echo $row['aclaratoria']; ?></td>
			<td width="90px"><?php echo $row['fono']; ?></td>
			<td width="250px">
				<?php if($row['prioridad'] === "1"){ ?>
				<span class="label label-danger">prioridad</span> 
				<?php } ?>
				<?php echo strtoupper($row['detalle_llamado']); ?></td>
			<td width="80px">
				<?php if($row['proceso'] == 'primary'){ ?>
				<span class="label label-<?php echo $row['proceso']; ?>">en proceso</span>
				<?php }else{ ?>
				<span class="label label-<?php echo $row['color']; ?>"><?php echo $row['color']; ?></span>
				<?php } ?>	
			</td>
			<td width="80px"><?php echo $row['zona']; ?></td>			
			<td width="80px"><?php echo $row['fecha_ingreso']; ?></td>	
			<td width="80px"><?php echo $row['hora_ingreso']; ?></td>
			<td width="80px"><?php echo $row['movil']; ?></td>
			<td width="80px"><?php echo $row['hora_inicio']; ?></td>
			<td width="80px">
				
				<a href="agregar-informacion.php?id=<?php echo $row['id_registro']; ?>&rut=<?php echo $row['rut']; ?>" target="_blank" title="Agregar información">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
				<a href="https://www.google.com/maps/search/<?php echo $row['direccion']; ?>, La Florida" target="_blank" title="Georeferencia">
					<span class="glyphicon glyphicon-map-marker"></span>
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