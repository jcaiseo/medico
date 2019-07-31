<?php session_start();
include('connection.php'); 


if (@$_REQUEST['function'] === "pacientes"){

    //$rut = $_REQUEST['rut'];
	
	$query = mysql_query("SELECT ag_medico_paciente.id AS id_registro,
						CONCAT(personas.nombres,' ', personas.apellidopaterno,' ',personas.apellidomaterno) AS persona,
						CONCAT(personas.nombre_calle,' ', personas.numdirec) AS direccion,
						personas.referenciadir AS aclaratoria,
						DATE_FORMAT(ag_medico_paciente.ag_fecha, '%d-%m-%Y') AS fecha_ingreso,
						DATE_FORMAT(ag_medico_paciente.ag_fecha, '%H:%i') AS hora_ingreso,
						ag_medico_paciente.movil AS movil,
						DATE_FORMAT(ag_medico_paciente.hora_inicio, '%H:%i') AS hora_inicio,	
						TIME_TO_SEC(TIMEDIFF(DATE_SUB(now(), INTERVAL 1 HOUR), ag_medico_paciente.ag_fecha)) AS diferencia,
						(SELECT CASE WHEN diferencia <= TIME_TO_SEC('00:15:00') THEN 'success'
						WHEN  diferencia > TIME_TO_SEC('00:15:00') && diferencia < TIME_TO_SEC('00:30:00') THEN 'warning'
						ELSE  'danger' END) AS color
						FROM ag_medico_paciente, personas
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.estado != '2'
						ORDER BY ag_medico_paciente.id") or die(mysql_error());
							  //seleccionamos la informacion de la base de datos y de la tabla. 

   while ($row = mysql_fetch_array($query)){
 
   $array['data'][] = $row;

	}
	echo json_encode($array);

}

if (@$_REQUEST['function'] === "pacientes_finalizado"){

    //$rut = $_REQUEST['rut'];
	
	$query = mysql_query("SELECT ag_medico_paciente.id AS id_registro,
						  CONCAT(personas.nombres,' ', personas.apellidopaterno,' ',personas.apellidomaterno) AS persona,
						  CONCAT(personas.nombre_calle,' ', personas.numdirec) AS direccion,
						  personas.referencia_dir AS aclaratoria,
						  FORMAT(ag_medico_paciente.ag_fecha, '%d-%m-%Y') AS fecha_ingreso,
						  FORMAT(ag_medico_paciente.ag_fecha, '%H:%i') AS hora_ingreso,
						  ag_medico_paciente.movil AS movil
						  ag_medico_paciente.hora_inicio AS hora_inicio,
						  ag_medico_paciente.hora_termino AS hora_termino
						  FROM ag_medico_paciente, personas
						  WHERE ag_medico_paciente.rut = personas.rut
						  ag_medico_paciente.estado = '2'
						  ORDER BY ag_medico_paciente.id") or die(mysql_error());
							  //seleccionamos la informacion de la base de datos y de la tabla. 
					  
   while ($row = mysql_fetch_array($query)){
 
   $array['data'][] = $row;

	}
	echo json_encode($array);

}
?>