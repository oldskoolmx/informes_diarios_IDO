<form method="post" id="addproduct" action="./?action=idoall&opt=update" role="form">
    <input type="hidden" name="_id" value="<?php echo $con->id; ?>">

    <!-- primer combobox para seleccionar el area -->
    <div class="form-group">
        <label>Areas</label>
        <select name="client_id" id="client_id_<?php echo $con->id; ?>" required class="form-control">
            <option value="">-- SELECCIONE AREA --</option>
            <?php foreach (AreasturData::getAll() as $cli) : ?>
                <option value="<?php echo $cli->id; ?>"><?php echo $cli->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Averia</label>
        <select name="item_id" id="item_id_<?php echo $con->id; ?>" required class="form-control">
        </select>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery("#client_id_<?php echo $con->id; ?>").change(function() {
                jQuery.get("./?action=getitems", "client_id=" + jQuery("#client_id_<?php echo $con->id; ?>").val(), function(data) {
                    console.log(data);
                    jQuery("#item_id_<?php echo $con->id; ?>").html(data);
                });
            });

        });
    </script>




    <div class="form-group">
        <label for="inputEmail1">Clasificacion</label>
        <input type="text" name="clasificacion" value="<?php echo $con->clasificacion; ?>" class="form-control" id="name" placeholder="Categoria" disabled>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">C L A S I F I C A R</button>
    </div>
</form>