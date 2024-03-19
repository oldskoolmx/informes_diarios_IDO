<?php

require_once('connect.php');
$ReadSql = "SELECT * FROM `idos`";
$res = mysqli_query($con, $ReadSql);
include("header.php");
?>
<div style="width: 100%; height: 10px; clear: both;"></div>
<h2>Mantenimiento de IDO insertados </h2>
<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>linea</th>
			<th>Hora</th>
			<th>Descripcion</th>
			<th>Retardo</th>
			<th>Fecha</th>
			<th>Clasificacion</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		while ($r = mysqli_fetch_assoc($res)) {
			$i++;
		?>
			<tr>
				<th scope="row"><?php echo $i; ?></th>
				<td><?php echo $r['linea']; ?></td>
				<td><?php echo $r['hora']; ?></td>
				<td><?php echo $r['descripcion']; ?></td>
				<td><?php echo $r['retardo']; ?></td>
				<td><?php echo $r['fecha']; ?></td>
				<td><?php echo $r['clasifiacion']; ?></td>


			</tr>
		<?php } ?>
	</tbody>
</table>
</div>
</div>




<?php include("footer.php"); ?>