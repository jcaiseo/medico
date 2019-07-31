<?php session_start();
include('connection.php'); 
?>

 <table id="table" class="tabla display" cellspacing="0" width="100%">
    <thead>
   	<tr>
		<th width="80px">ID</th>
		<th>RUT</th>		
		<th>NOMBRE</th>
		<th>USUARIO</th>
		<th width="100px"></th>     	                   
	</tr>	
	</thead>
	<tbody>
<?php
    //$rut = $_REQUEST['rut'];
	
	$query = mysql_query("SELECT * FROM usuarios WHERE perfil = 99") or die(mysql_error());
							  //seleccionamos la informacion de la base de datos y de la tabla. 

    if(mysql_num_rows($query) > 0){
		while ($row = mysql_fetch_array($query)){
		?>
		<tr>
			<td><?php echo $row['id_user']; ?></td>
			<td><?php echo $row['rut']; ?></td>			
			<td><?php echo $row['nombre']; ?></td>
			<td><?php echo $row['user']; ?></td>
			<td>
				<a href="editar-medico.php?id=<?php echo $row['id_user']; ?>" target="_blank">
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
				<a href="eliminar-medico.php?id=<?php echo $row['id_user']; ?>" onclick="return confirm('Esta seguro que desea eliminar N ° <?php echo $row['id_user']; ?>')" title="Eliminar" >
					<span class="glyphicon glyphicon-remove"></span>
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