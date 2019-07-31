<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
</head>
<style>
body{
	font-family:arial;
	font-size:12px;
	}

.header {
color:#666;
margin: 0 auto;
overflow:hidden;
}

.header h1 {
float: right !important;
margin: 30px 20px !important;
font-size: 24px !important;
text-transform:uppercase !important;
color:rgb(78, 77, 78) !important;
}

.header .logo {
float: left;
margin: 15px 20px;
}  
	
h3 {
    font-size: 14px;
	text-align:center;
	margin:0;
  padding:8px 0px;
}	

h4 {
  font-size: 14px;
  width: 100%;
  border-bottom: 1px solid #000;
	padding:8px 0px;
	margin: 10px 0px;
}	


.formulario{
    margin-top: 10px;
    overflow: hidden;
    clear: both;
	}	
	
.col-1{
	width: 20%;
	float:left;
	}

.col-2{
	width: 30%;
	float:left;	
	}

.col-3{
  width: 50%;
  float:left; 
  }

.col-4{
  width: 25%;
  float:left; 
  }

.col-5{
  width: 100%;
  clear:both;
  }  
	
table{
	border: 1px #CCCCCC solid;
	font-size:11px;
	width: 100%;
	clear:both;
}

table tr{
	border: 1px #CCCCCC solid;
}

table th{
	border: 1px #CCCCCC solid;
padding: 8px 8px;
font-weight: 700;
text-align:left;
}

table td{
	border: 1px #CCCCCC solid;
padding: 5px 0px 10px 5px;
}

i{
  text-decoration: underline;
  font-weight: bold;
}

</style>
<body onload="setTimeout('window.print();',1000);">


<?php
include('controllers/connection.php');
include('controllers/functions.php');

@$rut = $_REQUEST['rut'];
@$id = $_REQUEST['id'];

$query = mysql_query("SELECT * FROM personas WHERE rut = '$rut'");
$row = mysql_fetch_array($query);

$rut_full = $row['rut']."-".$row['vrut'];
$nombres = $row['nombres'];
$apellido_paterno = $row['apellidopaterno'];
$apellido_materno = $row['apellidomaterno'];
$direccion = $row['nombre_calle'];
$numero = $row['numdirec'];
$depto = $row['depto'];
$fono = $row['fono'];
$fecha_nacimiento = fecha_esp($row['fecha_nacimiento']);

$query2 = mysql_query("SELECT prevision, detalle_llamado, observacion, DATE_FORMAT(ag_fecha, '%d-%m-%Y %H:%i') 
                        AS fecha_ingreso, movil, DATE_FORMAT(hora_inicio, '%H:%i') AS hora_inicio, DATE_FORMAT(hora_termino, '%H:%i') AS hora_termino,
                        observacion_medico
                        FROM ag_medico_paciente WHERE id = '".$id."'");
$row2 = mysql_fetch_array($query2);

$prevision = $row2['prevision'];
$detalle_llamado = $row2['detalle_llamado'];
$observacion = $row2['observacion'];
$fecha_ingreso = $row2['fecha_ingreso'];
 
$movil = $row2['movil'];
$hora_inicio = $row2['hora_inicio'];
$hora_termino = $row2['hora_termino'];
$observacion_medico = $row2['observacion_medico'];

?>

<div class="header">
  <div class="logo">
    <img src="img/logo-lf.png" alt=""/>
    </div>
    <h1>FICHA DE ATENCIÓN</h1>
</div>

<div class="formulario">
<h3 style="float: left;"> Fecha Atención: <?php echo date('d-m-Y H:i', strtotime($fecha_ingreso)); ?></h3>
<h3 style="float: right;"> Atención N° <?php echo @$id; ?></h3>
</div>    
    
<h4>Datos Vecino</h4>
    
    <div class="formulario">
      <div class="col-1">R.U.T</div>
      <div class="col-2">:
        <strong><?php echo @$rut_full; ?>
      </strong></div>
      <div class="col-1">Nombres</div>
      <div class="col-2">:          
        <strong><?php echo @$nombres ?>
      </strong></div>
   </div>

    <div class="formulario">
      <div class="col-1">Apellido Paterno</div>
      <div class="col-2">:
        <strong><?php echo @$apellido_paterno; ?></strong>
    </div>
      <div class="col-1">Apellido Materno</div>
      <div class="col-2">:          
        <strong><?php echo @$apellido_materno ?>
      </strong></div>
   </div>

    <div class="formulario">      
       <div class="col-1">Fecha Nacimiento</div>
        <div class="col-2">:
          <strong><?php echo @$fecha_nacimiento ?></strong>
        </div>
      <div class="col-1">Edad</div>
      <div class="col-2">:          
        <strong><?php echo edad(@$fecha_nacimiento); ?></strong>
      </div>
   </div>  

   <!-- Inicio Dirección y Número -->

    <div class="formulario">      
       <div class="col-1">Dirección</div>
        <div class="col-2">:
          <strong><?php echo @$direccion; ?></strong>
        </div>
      <div class="col-1">Número</div>
      <div class="col-2">:          
        <strong><?php echo @$numero; ?></strong>
      </div>
   </div>    

    <div class="formulario">      
       <div class="col-1">Teléfono</div>
        <div class="col-2">:
          <strong><?php echo @$fono; ?></strong>
        </div>
   </div>         
          
<h4>Datos Atención</h4>      

    <div class="formulario">
    <div class="col-1">Detalle Llamado</div>
    <div class="col-3">:
      <?php echo @$detalle_llamado; ?>
      </div>                        
    </div>       

    <div class="formulario">      
       <div class="col-1">Movil</div>
        <div class="col-2">:
          <strong><?php echo @$movil; ?></strong>
        </div>
      <div class="col-1">Hora inicio</div>
      <div class="col-2">:          
        <strong><?php echo @$hora_inicio; ?></strong>
      </div>
   </div>  
            
    <div class="formulario">
    <div class="col-1">Observación Médico</div>
    <div class="col-3">:
      <?php echo @$observacion_medico; ?>
      </div>                        
    </div>    
         
    <div class="formulario">      
      <div class="col-1">Hora termino</div>
      <div class="col-2">:          
        <strong><?php echo @$hora_termino; ?></strong>
      </div>
   </div>  

</body>
</html>