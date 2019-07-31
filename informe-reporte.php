<?php include('header.php');
include('controllers/functions.php');

$fecha_desde = fecha_rev($_REQUEST['fecha_desde']);
$fecha_hasta = fecha_rev($_REQUEST['fecha_hasta']);

?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Estadisticas e Informe
</div>    
    
<h3>Estadisticas e Informe <a href="print-informe.php?fecha_desde=<?php echo $fecha_desde; ?>&fecha_hasta=<?php echo $fecha_hasta; ?>" target="_blank"><span class="pull-right glyphicon glyphicon-print"></span></a></h3>
<br />
<p style="font-size:18px;" class="text-center"><b>Desde: <?php echo $_REQUEST['fecha_desde']; ?> - Hasta: <?php echo $_REQUEST['fecha_hasta']; ?></b></p>
<br />


<?php

$query = mysql_query("SELECT count(*) AS cantidad, prevision 
						FROM `ag_medico_paciente` 
						WHERE estado = 2 
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)
						GROUP BY prevision");
						

$query2 = mysql_query("SELECT count(*) AS cantidad, prevision 
						FROM `ag_medico_paciente` 
						WHERE estado = 2 
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)
						GROUP BY prevision");
												
						
?>

<div class="row">

    <div class="col-sm-3">
        <table id="table" cellspacing="0">
          <tr>
          <th colspan="99">Atenciones por Prevision</th>
          </tr>
          <tr>
          <th>Prevision</th>
          <th>Cantidad</th>
          </tr>
          <?php
		  $suma = array();
          if(mysql_num_rows($query) > 0){
             while($row = mysql_fetch_array($query)){
				  array_push($suma, $row['cantidad']);	  
          ?>   
          <tr>
          <td><?php echo strtoupper($row['prevision']); ?></td>
          <td><?php echo $row['cantidad']; ?></td>
          </tr>
          <?php	    
             }
		  ?>
          <tr>
          <th><b>TOTAL</b></th>
          <th><b><?php echo array_sum($suma); ?></b></th>
          </tr>        
          <?php	 
          }else{
          ?>
          <tr>
          <td colspan="99">No existe información</td>
          </tr>  
          <?php
          }
          ?>
        
        </table> 
    </div>    
    
    <div class="col-sm-9">

          <?php
          if(mysql_num_rows($query2) > 0){
             while($row2 = mysql_fetch_array($query2)){
                $data[] = "['".strtoupper($row2['prevision'])."',".$row2['cantidad']."]"; 
             }
          }else{
         		$data[] = "['No existe Informacion',0";   
          }
          ?>    
    
		<script type="text/javascript">
        $(function () {
            // Create the chart
            $('#container1').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Atenciones por Prevision'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
				yAxis: {
					title: {
						text: 'Valores'
					}
				},
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Cantidad: <b>{point.y}</b>'
                },
                series: [{
                    name: "Pendiente",
                    colorByPoint: true,
                    data: [<?php echo join($data, ','); ?>]
                }]
            });
        });
        </script> 
        
        <div id="container1">
        </div>  
    </div>
</div>

<br>


<?php

$query3 = mysql_query("SELECT count(*) AS cantidad, zona 
						FROM `ag_medico_paciente` 
						WHERE estado = 2 
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)
						GROUP BY zona");
						

$query4 = mysql_query("SELECT count(*) AS cantidad, zona 
						FROM `ag_medico_paciente` 
						WHERE estado = 2 
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)
						GROUP BY zona");
																		
						
?>

<div class="row">

    <div class="col-sm-3">
        <table id="table" cellspacing="0">
          <tr>
          <th colspan="99">Atenciones por Zona</th>
          </tr>
          <tr>
          <th>Zona</th>
          <th>Cantidad</th>
          </tr>
          <?php
		  $suma2 = array();
		  
          if(mysql_num_rows($query3) > 0){
             while($row3 = mysql_fetch_array($query3)){
			 array_push($suma2, $row3['cantidad']);	  
          ?>   
          <tr>
          <td><?php echo strtoupper($row3['zona']); ?></td>
          <td><?php echo $row3['cantidad']; ?></td>
          </tr>
          <?php
             }
		  ?>
          <tr>
          <th><b>TOTAL</b></th>
          <th><b><?php echo array_sum($suma2); ?></b></th>
          </tr>        
          <?php	 	 
          }else{
          ?>
          <tr>
          <td colspan="99">No existe información</td>
          </tr>  
          <?php
          }
          ?>
        
        </table> 
    </div>    
    
    <div class="col-sm-9">

          <?php
          if(mysql_num_rows($query4) > 0){
             while($row4 = mysql_fetch_array($query4)){
                $data2[] = "['".strtoupper($row4['zona'])."',".$row4['cantidad']."]"; 
             }
          }else{
         		$data2[] = "['No existe Informacion',0";   
          }
          ?>    
    
		<script type="text/javascript">
        $(function () {
            // Create the chart
            $('#container2').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Atenciones por Zona'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
				yAxis: {
					title: {
						text: 'Valores'
					}
				},
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Cantidad: <b>{point.y}</b>'
                },
                series: [{
                    name: "Pendiente",
                    colorByPoint: true,
                    data: [<?php echo join($data2, ','); ?>]
                }]
            });
        });
        </script> 
        
        <div id="container2">
        </div>  
    </div>
</div>

<br>

<?php

$query5 = mysql_query("SELECT count(ag_medico_paciente.id) AS cantidad, personas.sexo AS sexo
						FROM ag_medico_paciente, personas
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.estado = 2
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)
						GROUP BY personas.sexo ");
						
$query6 = mysql_query("SELECT count(ag_medico_paciente.id) AS cantidad, personas.sexo AS sexo
						FROM ag_medico_paciente, personas
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.estado = 2
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)
						GROUP BY personas.sexo ");
																								
?>

<div class="row">

    <div class="col-sm-3">
        <table id="table" cellspacing="0">
          <tr>
          <th colspan="99">Atenciones por Genero</th>
          </tr>
          <tr>
          <th>Genero</th>
          <th>Cantidad</th>
          </tr>
          <?php
		  $suma3 = array();
          if(mysql_num_rows($query5) > 0){
             while($row5 = mysql_fetch_array($query5)){
			 array_push($suma3, $row5['cantidad']);	 
          ?>   
          <tr>
          <td><?php echo strtoupper($row5['sexo']); ?></td>
          <td><?php echo $row5['cantidad']; ?></td>
          </tr>
          <?php
             }
		  ?>
          <tr>
          <th><b>TOTAL</b></th>
          <th><b><?php echo array_sum($suma3); ?></b></th>
          </tr>        
          <?php	 	 
          }else{
          ?>
          <tr>
          <td colspan="99">No existe información</td>
          </tr>  
          <?php
          }
          ?>
        
        </table> 
    </div>    
    
    <div class="col-sm-9">

          <?php
          if(mysql_num_rows($query6) > 0){
             while($row6 = mysql_fetch_array($query6)){
                $data3[] = "['".strtoupper($row6['zona'])."',".$row6['cantidad']."]"; 
             }
          }else{
         		$data3[] = "['No existe Informacion',0";   
          }
          ?>    
    
		<script type="text/javascript">
        $(function () {
            // Create the chart
            $('#container3').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Atenciones por Genero'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
				yAxis: {
					title: {
						text: 'Valores'
					}
				},
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Cantidad: <b>{point.y}</b>'
                },
                series: [{
                    name: "Pendiente",
                    colorByPoint: true,
                    data: [<?php echo join($data3, ','); ?>]
                }]
            });
        });
        </script> 
        
        <div id="container3">
        </div>  
    </div>
</div>

<br>

<?php

$query7 = mysql_query("SELECT SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN 0 AND 17 , 1, 0)) AS menor,
						SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN 18 AND 29, 1, 0)) AS joven,
						SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN 30 AND 59, 1, 0)) AS adulto,
						SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) >= 60, 1, 0)) AS adulto_mayor
						FROM ag_medico_paciente, personas
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.estado = 2
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)");
						
$query8 = mysql_query("SELECT SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN 0 AND 17 , 1, 0)) AS menor,
						SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN 18 AND 29, 1, 0)) AS joven,
						SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN 30 AND 59, 1, 0)) AS adulto,
						SUM(IF (TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) >= 60, 1, 0)) AS adulto_mayor
						FROM ag_medico_paciente, personas
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.estado = 2
						AND ag_medico_paciente.ag_fecha >= '".$fecha_desde."' AND ag_medico_paciente.ag_fecha <=  DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)");				
																								
?>

<div class="row">

    <div class="col-sm-3">
        <table id="table" cellspacing="0">
          <tr>
          <th colspan="99">Atenciones por Edad</th>
          </tr>
          <tr>
          <th>Edad</th>
          <th>Cantidad</th>
          </tr>
          <?php
		  $suma4 = array();
          if(mysql_num_rows($query7) > 0){
             $row7 = mysql_fetch_array($query7);
			 			 
			 array_push($suma4, $row7['menor'], $row7['joven'], $row7['adulto'], $row7['adulto_mayor']);
          ?>   
          <tr>
          <td>0 a 17</td>
          <td><?php echo $row7['menor']; ?></td>
          </tr>
          <tr>
          <td>18 a 29</td>
          <td><?php echo $row7['joven']; ?></td>
          </tr>
          <tr>
          <td>30 a 59</td>
          <td><?php echo $row7['adulto']; ?></td>
          </tr>
          <tr>
          <td>60 o más</td>
          <td><?php echo $row7['adulto_mayor']; ?></td>
          </tr>                              
          <tr>
          <th><b>TOTAL</b></th>
          <th><b><?php echo array_sum($suma4); ?></b></th>
          </tr>        
          <?php			  
          }else{
          ?>
          <tr>
          <td colspan="99">No existe información</td>
          </tr>  
          <?php
          }
          ?>
        
        </table> 
    </div>    
    
    <div class="col-sm-9">

          <?php
          if(mysql_num_rows($query8) > 0){
			  
             	$row8 = mysql_fetch_array($query8);
				
                $data4[] = "['0 a 17',".$row8['menor']."]";
				$data4[] .= "['18 a 29',".$row8['joven']."]"; 
				$data4[] .= "['30 a 59',".$row8['adulto']."]"; 
				$data4[] .= "['60 o más',".$row8['adulto_mayor']."]";  
				
          }else{
         		$data4[] = "['No existe Informacion',0";   
          }
          ?>    
    
		<script type="text/javascript">
        $(function () {
            // Create the chart
            $('#container4').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Atenciones por Edad'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
				yAxis: {
					title: {
						text: 'Valores'
					}
				},
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Cantidad: <b>{point.y}</b>'
                },
                series: [{
                    name: "Pendiente",
                    colorByPoint: true,
                    data: [<?php echo join($data4, ','); ?>]
                }]
            });
        });
        </script> 
        
        <div id="container4">
        </div>  
    </div>
</div>

<?php include('footer.php')?>