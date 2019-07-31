<?php session_start();
include('connection.php'); 
include('functions.php'); 
?>

 <table id="table" class="tabla display" cellspacing="0" width="1420px">
	<thead style="top: 0; display: block; position: sticky;">
   	<tr>
        <th width="40px">ID</th>
        <th width="80px">USUARIO</th>		
        <th width="110px">PACIENTE</th>
        <th width="57px">EDAD</th>		
        <th width="120px">DIRECCION</th>
        <th width="170px">ACLARATORIA</th>
        <th width="90px">TELÉFONO</th>
        <th width="270px">DETALLE LLAMADO</th>
        <th width="75px">ZONA</th>			
        <th width="75px">INGRESO</th>
        <th width="60px">HORA</th>
        <th width="65px">MOVIL</th>
        <th width="60px">INICIO</th>
        <th width="60px">TERM.</th>
        <th width="55px">DURAC.</th>
        <th width="80px"></th>                       
	</tr>	
	</thead>
	</thead>
	<tbody style="display: block;">
<?php
    //$rut = $_REQUEST['rut'];
	
	$query = mysql_query("SELECT ag_medico_paciente.id AS id_registro,
						CONCAT(personas.nombres,' ', personas.apellidopaterno,' ',personas.apellidomaterno) AS persona,
						CONCAT(personas.rut,'-',personas.vrut) AS rut,
						DATE_FORMAT(personas.fecha_nacimiento, '%d-%m-%Y') AS fecha_nacimiento,						
						CONCAT(personas.nombre_calle,' ', personas.numdirec) AS direccion,
						personas.referenciadir AS aclaratoria,
						personas.fono AS fono,
						ag_medico_paciente.detalle_llamado AS detalle_llamado,
						ag_medico_paciente.prioridad AS prioridad,
						DATE_FORMAT(ag_medico_paciente.ag_fecha, '%d-%m-%Y') AS fecha_ingreso,
						DATE_FORMAT(ag_medico_paciente.ag_fecha, '%H:%i') AS hora_ingreso,
						ag_medico_paciente.movil AS movil,
						usuarios.user AS user,
						DATE_FORMAT(ag_medico_paciente.hora_inicio, '%H:%i') AS hora_inicio,	
						DATE_FORMAT(ag_medico_paciente.hora_termino, '%H:%i') AS hora_termino,
						ag_medico_paciente.observacion_medico AS observacion_medico,	
						TIME_TO_SEC(TIMEDIFF(DATE_SUB(now(), INTERVAL 1 HOUR), ag_medico_paciente.ag_fecha)) AS diferencia,
						(SELECT CASE WHEN diferencia <= TIME_TO_SEC('01:30:00') THEN 'success'
						WHEN  diferencia > TIME_TO_SEC('01:30:00') && diferencia < TIME_TO_SEC('02:00:00') THEN 'warning'
						ELSE  'danger' END) AS color,
						(SELECT CASE WHEN hora_inicio !='0000-00-00 00:00:00' && movil!='' THEN 'primary'
						END) AS proceso,
						TIMEDIFF(ag_medico_paciente.hora_termino, ag_medico_paciente.hora_inicio) AS duracion,
						ag_medico_paciente.zona AS zona
						FROM ag_medico_paciente, personas, usuarios
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.id_user = usuarios.id_user						
						AND ag_medico_paciente.estado = '2'
						ORDER BY ag_medico_paciente.id ASC") or die(mysql_error());
							  //seleccionamos la informacion de la base de datos y de la tabla. 

    if(mysql_num_rows($query) > 0){
		while ($row = mysql_fetch_array($query)){
		?>
		<tr>
			<td width="40px"><?php echo $row['id_registro']; ?></td>
			<td width="80px"><?php echo $row['user']; ?></td>
			<td width="110px"><?php echo $row['persona']; ?></td>
			<td width="57px"><?php echo edad($row['fecha_nacimiento']); ?></td>			
			<td width="120px"><?php echo $row['direccion']; ?></td>
			<td width="170px"><?php echo $row['aclaratoria']; ?></td>
			<td width="90px"><?php echo $row['fono']; ?></td>
			<td width="270px">
				<?php if($row['prioridad'] === "1"){ ?>
				<span class="label label-danger">prioridad</span> 
				<?php } ?>
				<?php echo strtoupper($row['detalle_llamado']); ?>
			</td>
			<td width="75px"><?php echo $row['zona']; ?></td>			
			<td width="75px"><?php echo $row['fecha_ingreso']; ?></td>
			<td width="60px"><?php echo $row['hora_ingreso']; ?></td>			
			<td width="65px"><?php echo $row['movil']; ?></td>
			<td width="60px"><?php echo $row['hora_inicio']; ?></td>
			<td width="60px"><?php echo $row['hora_termino']; ?></td>
			<td width="55px"><?php echo $row['duracion']; ?></td>
			<td width="80px">
            	<a href="ver-vecino.php?rut=<?php echo $row['rut']; ?>" target="_blank" title="Ver Vecino">
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
                
                <?php if($_SESSION['perfil'] === "0"){ ?>
				<a href="agregar-informacion.php?id=<?php echo $row['id_registro']; ?>&rut=<?php echo $row['rut']; ?>" target="_blank" title="Agregar información">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
				<?php } ?>
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