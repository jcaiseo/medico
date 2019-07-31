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
	}
	
h3 {
    font-size: 16px;
	text-align:center;
	margin:0;
	padding:0;
}	

h4 {
    font-size: 14px;
	text-align:center;
	padding:0;
	margin: 10px 0px;
}	

p{
	line-height:20px;}

.formulario2{
    padding: 5px 0px 0px 5px;
    margin-top: 5px;
    overflow: hidden;
    width: 700px;
    clear: both;
	text-align:justify;
	}	
	
.col-2{
	width: 150px;
	float:left;
	}

.col-5{
	width: 500px;
	float:right;	
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

@media print
{
      .page-break  { display:block; page-break-before:always; }

}
</style>
<body onload="setTimeout('window.print();',1000);">


<?php
include('controllers/connection.php');
include('controllers/functions.php');

$edad_desde = $_REQUEST['edad_desde'];
$edad_hasta = $_REQUEST['edad_hasta'];

$fecha_desde = fecha_rev($_REQUEST['fecha_desde']);
$fecha_hasta = fecha_rev($_REQUEST['fecha_hasta']);

?>  

<?php
$query = mysql_query("SELECT personas.nombres AS nombres, personas.apellidopaterno AS paterno, personas.apellidomaterno AS materno,
					    personas.rut AS rut_a,
					    IF ((SELECT COUNT(*) FROM ag_medico_carta WHERE ag_medico_carta.rut = rut_a) > 0, '1', '0') AS existe
						FROM ag_medico_paciente, personas
						WHERE ag_medico_paciente.rut = personas.rut
						AND ag_medico_paciente.estado = 2 
						AND TIMESTAMPDIFF(YEAR,personas.fecha_nacimiento,CURDATE()) BETWEEN ".$edad_desde." AND ".$edad_hasta."
						AND ag_medico_paciente.ag_fecha BETWEEN '".$fecha_desde."' AND DATE_ADD('".$fecha_hasta."', INTERVAL 1 DAY)");

						
while($row = mysql_fetch_array($query)){
	
	if($row['existe'] != 1){	
	
	mysql_query("INSERT INTO ag_medico_carta (rut) VALUES ('".$row['rut_a']."')");							
?>
<h3 style="text-align:center"><img src="img/logo-lf.png" alt=""/></h3>

<p align="right" style="margin-top:-100px;"><img src="img/hurtado.jpg" alt=""/></p>

<div class="formulario2">
<p>Señor/a <?php echo $row['nombres']; ?></p>
<p>Estimado/a <?php echo $row['nombres']." ".$row['paterno']." ".$row['materno']; ?></p>
<p>He tomado  conocimiento que en los últimos días Ud., o alguien de su familia, ha tenido la  oportunidad de atenderse con nuestro servicio de Médico a Domicilio.</p>
<p>Junto con desearle  que se sienta mejor, y esperando que le hayamos podido ayudar, quiero  agradecerle que haya hecho uso de este nuevo beneficio que tenemos en La  Florida.</p>
<p><strong>Estamos orgullosos de ser la única comuna de Chile que  ha implementado este servicio en favor de sus vecinos</strong>. A través de éste,   no solo esperamos traer alivio al dolor y a la enfermedad, sino que por  sobre todo, entregarle dignidad a los hombres y mujeres de La Florida.</p>
<p>Vivimos una época en  que todos hablan de desigualdad, pero muy pocos   hacen algo por superarla. Por eso, llevarle salud a nuestros habitantes  a sus casas es un hecho concreto, y no palabras. Así creemos se construye, de  verdad, una sociedad más justa.</p>
<p>Por lo mismo déjeme  pedirle tres cosas:<br>
  En primer lugar, <strong>no nos dé las gracias por esta atención  médica</strong>. La Florida financia este y otros programas con los aportes y los  impuestos de todos, también con el suyo. <strong>Usted  no le debe nada ni a la Municipalidad ni al Alcalde. Es lo justo, Ud. y su  familia lo merecen</strong>.</p>
<p>En segundo lugar, <strong>ayúdenos a que más gente conozca el  programa Médico a Domicilio</strong>. Cuéntele a amigos y vecinos que llamando al  1416, las 24 horas del día, de Lunes a Domingo, sin importar la edad del  paciente, en La Florida los médicos van a su casa. Queremos que este programa  llegue a todos lados, que nadie que lo necesite deje de recibirlo. Ayúdenos, y  cuéntele a todos.</p>
<p>Por último, <strong>si tiene algún comentario o critica al  servicio que nos permita corregir y mejorar, le dejo mi correo electrónico:  alcalde@laflorida.cl</strong>  Valoro  profundamente su opinión sincera.</p>
<p>Dios bendiga a Ud. y  a su Familia.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center">Rodolfo  Carter Fernández<br>
  Alcalde </p>
</div>

<div class="page-break"></div>

<?php
	}
}
?>

</body>
</html>