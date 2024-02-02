<?php

if (isset($_GET["opt"]) && $_GET["opt"] == "add") {

	$per = new ClasificacionesData();
	$per->name = $_POST["name"];
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
	Core::redir("./?view=clasificaciones&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "update") {

	$per = ClasificacionesData::getById($_POST["_id"]);
	$per->name = $_POST["name"];
	$per->update();
	Core::redir("./?view=clasificaciones&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
	$per = ClasificacionesData::getById($_GET["id"]);
	$per->del();
	Core::redir("./?view=clasificaciones&opt=all");
}
?>