<?php include('header.php');
include('controllers/functions.php');

@$fono = $_REQUEST['fono'];
?>
    
<div class="breadcrum">
    <a href="consult.php">Inicio</a> > Resultado Búsqueda por Teléfono
</div>    
    
<h4>Resultado Búsqueda por Teléfono</h4>
  
<table id="table" class="tabla display" cellspacing="0" width="100%">
    <thead>
    <tr>
      <th>RUT</th>
      <th>NOMBRES</th>
      <th>APELLIDO PAT.</th>
      <th>APELLIDO MAT.</th>
      <th>CALLE</th>
      <th>NUMERO</th>
      <th>ACLARATORIOA</th>
      <th>COMUNA</th>
      <th>EMAIL</th>
      <th>FONO</th>
      <th>FONO 2</th>
      <th>UV</th>
      <th>FECHA NAC</th>
      <th>SEXO</th>
      <th></th>                       
  </tr> 
  </thead>
  <tbody>
<?php
    //$rut = $_REQUEST['rut'];
  
	$query = mysql_query("SELECT * FROM personas WHERE fono LIKE '%".$fono."%' OR fono_2 LIKE '%".$fono."%'");
	
    if(mysql_num_rows($query) > 0){
    while ($row = mysql_fetch_array($query)){
    ?>
    <tr>
      <td><?php echo $row['rut'].'-'.$row['vrut']; ?></td>
      <td><?php echo $row['nombres'];?></td>
      <td><?php echo $row['apellidopaterno'];?></td>
      <td><?php echo $row['apellidomaterno'];?></td>
      <td><?php echo $row['nombre_calle'];?></td>
      <td><?php echo $row['numdirec'];?></td>
      <td><?php echo $row['referenciadir'];?></td>
      <td><?php echo $row['nombre_comuna'];?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['fono'];?></td>
      <td><?php echo $row['fono_2'];?></td>
      <td><?php echo $row['unidad_v'];?></td>
      <td><?php echo fecha_esp($row['fecha_nacimiento']);?></td>
      <td><?php echo $row['sexo']; ?></td>
      <td>
        <a href="registro-atenciones.php?rut=<?php echo $row['rut'].'-'.$row['vrut']; ?>" title="Registro de Atenciones" target="_blank">
          <span class="glyphicon glyphicon-eye-open"></span>
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
</table>

<?php include('footer.php')?>