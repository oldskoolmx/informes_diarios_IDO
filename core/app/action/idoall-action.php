<?php

if (isset($_GET["opt"]) && $_GET["opt"] == "add") {

	$per = new IdoAllData();
	$per->linea = $_POST["linea"];
	$per->hora = $_POST["hora"];
	$per->descripcion = $_POST["descripcion"];
	$per->retardo = $_POST["retardo"];
	$per->fecha = $_POST["fecha"];
	/*if($per->name==""){
        echo "<div class='alert alert-danger'>No Area Selected</div>";
    }*/
	$per->add();
?>
	<script type="text/javascript">
		Swal.fire(
			'Good job!',
			'You clicked the button!',
			'success'
		);
	</script>

<?php
	Core::redir("./?view=idoall&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "update") {

	$per = IdoAllData::getById($_POST["_id"]);
	$per->clasificacion = $_POST["name"];
	$per->update();
	Core::redir("./?view=idoall&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
	$per = IdoAllData::getById($_GET["id"]);
	$per->del();
	Core::redir("./?view=clasificaciones&opt=all");
}
?>