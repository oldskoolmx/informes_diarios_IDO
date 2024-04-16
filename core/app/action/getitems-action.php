<?php
$items = ClasificacionesData::getAllByClient($_GET["client_id"]);
?>
<?php if (count($items) > 0) : ?>
	<option value="">-- SELECCIONE --</option>
	<?php foreach ($items as $i) :
	?>
		<option value="<?php echo $i->id; ?>"><?php echo $i->name; ?></option>
	<?php endforeach; ?>
<?php else : ?>
	<option value="">-- NO HAY DATOS --</option>
<?php endif; ?>