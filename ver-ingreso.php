<?php include('header.php');
include('controllers/functions.php');
include('controllers/connection.php');
?>

<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Talleres
</div>

<?php
  if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'exito'){
    echo "<div id='alerta' class='exito'><div><a id='cerrar' title='Cerrar'>x</a></div>La informacion a sido actualizada correctamente.</div>"; 
    unset($_SESSION['mensaje']);  
  }
  if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] === 'eliminado'){
    echo "<div id='alerta' class='error'><div><a id='cerrar' title='Cerrar'>x</a></div>Se ha eliminado el registro.</div>"; 
    unset($_SESSION['mensaje']);  
  } 

@$id = $_REQUEST['id'];

$query = mysql_query("SELECT * FROM talleres WHERE id_taller = '$id'");
$row = mysql_fetch_array($query);

$taller = $row['taller'];
$lugar = $row['lugar'];
$dia = $row['dia'];
$hora = $row['hora'];

$query2 = mysql_query("SELECT ag_taller_profesor.id AS id_pf, personas.rut AS rut, personas.vrut AS vrut,
                       personas.nombres AS nombres, personas.apellidopaterno AS apellidopaterno, 
                       personas.apellidomaterno AS apellidomaterno, personas.rut AS nombre_calle,
                       personas.numdirec AS numdirec
                       FROM ag_taller_profesor, personas  
                       WHERE ag_taller_profesor.rut = personas.rut
                       AND ag_taller_profesor.id_taller = '$id'");

$row2 = mysql_fetch_array($query2);

$id_pf = $row2['id_pf'];
$nombres_p = $row2['nombres'];
$apellido_paterno_p = $row2['apellidopaterno'];
$apellido_materno_p = $row2['apellidomaterno'];

?>

<h3>Taller: <?php echo strtoupper($taller); ?> - <?php echo strtoupper($lugar); ?></h3>
  
<div class="form-horizontal">  
  <div class="form-group">
      <label class="control-label col-sm-2">Lugar</label>
      <div class="col-sm-3">
        <input class="input-text readonly" name="rut" id="rut" value="<?php echo strtoupper($lugar); ?>" readonly=""> 
      </div>   
   </div>

  <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Día</label>
      <div class="col-sm-3">          
        <input class="input-text" name="nombres" id="nombres" value="<?php echo strtoupper($dia); ?>" readonly="">  
      </div>  
      <label class="control-label col-sm-2">Hora</label>
      <div class="col-sm-3">
        <input class="input-text readonly" name="rut" id="rut" value="<?php echo strtoupper($hora); ?>" readonly=""> 
      </div>
   </div>

  <div class="form-group">
      <label class="control-label col-sm-2">Profesor</label>
      <div class="col-sm-5">
        <input class="input-text readonly" name="rut" id="rut" value="<?php echo strtoupper($nombres_p.' '.$apellido_paterno_p.' '.$apellido_materno_p); ?>" readonly=""> 
      </div>
      <div class="col-sm-3">          
         <a class="btn btn-primary" href="eliminar-profesor.php?id=<?php echo $id_pf; ?>">Eliminar Profesor</a> 
      </div>     
   </div>   
</div>

<h4>Datos Vecinos</h4>
    
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th>RUT</th>
    <th>Nombres</th>
    <th>Apellidos</th>
    <th>Domicilio</th>
    <th>Fecha Inscrip.</th>
    <th>Email</th>
    <th>Teléfono</th>    
    <th></th>
  </tr>
  <?php

$query3 = mysql_query("SELECT ag_taller_alumno.id AS id_ag, personas.rut AS rut, personas.vrut AS vrut,
                       personas.nombres AS nombres, personas.apellidopaterno AS apellidopaterno, 
                       personas.apellidomaterno AS apellidomaterno, personas.nombre_calle AS nombre_calle,
                       personas.numdirec AS numdirec, ag_taller_alumno.ag_fecha AS ag_fecha,
                       personas.email AS email,  personas.fono AS fono, personas.fono_2 AS fono_2     
                       FROM ag_taller_alumno, personas 
                       WHERE ag_taller_alumno.rut = personas.rut
                       AND ag_taller_alumno.id_taller = '$id'");

while($row3 = mysql_fetch_array($query3)){
  ?>
  <tr>
    <td><?php echo $row3['rut']."-".$row3['vrut']; ?></td>
    <td><?php echo $row3['nombres']; ?></td>  
    <td><?php echo $row3['apellidopaterno'].' '.$row3['apellidomaterno']; ?></td>  
    <td><?php echo $row3['nombre_calle'].' '.$row3['numdirec']; ?></td>
    <td><?php echo $row3['ag_fecha']; ?></td>
    <td><?php echo $row3['email']; ?></td>
    <td><?php echo $row3['fono']." - ".$row3['fono_2']; ?></td>   
    <td><a href="editar-vecino2.php?rut=<?php echo $row3['rut']."-".$row3['vrut']; ?>" target="_blank"><span class="glyphicon glyphicon-pencil"></span></a><a href="eliminar-alumno.php?id=<?php echo $row3['id_ag']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>                 
  </tr>
  <?php
}
  ?>
</table>

<?php include('footer.php')?>