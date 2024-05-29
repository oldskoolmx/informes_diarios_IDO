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

	Core::redir("./?view=idoall&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "update") {

	$per = IdoAllData::getById($_POST["_id"]);
	$per->client_id = $_POST["client_id"];
	$per->item_id = $_POST["item_id"];
	$per->clasificacion = $_POST["clasificacion"];
	$per->update();
	Core::redir("./?view=idoall&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "updateC") {

	$per = IdoAllData::getById($_POST["_id"]);
	$per->clasificacion = $_POST["clasificacion"];
	$fecha = $per->fecha;
	$per->update();
	Core::redir("./?view=idoall&opt=allF&fecha=$fecha");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {

	$per = IdoAllData::getById($_GET["id"]);
	$per->delClas();
	Core::redir("./?view=idoall&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "updateF") {

	$per = IdoAllData::getById($_POST["_id"]);
	$per->client_id = $_POST["client_id"];
	$per->item_id = $_POST["item_id"];
	$per->clasificacion = $_POST["clasificacion"];
	$fecha = $per->fecha;
	$per->update();
	Core::redir("./?view=idoall&opt=allD&fecha=$fecha");
} /* else if (isset($_GET["opt"]) && $_GET["opt"] == "updateLyF") {

	// Obtener el valor del parámetro 'tab' para saber en qué pestaña estamos
	$currentTab = isset($_GET['tab']) ? $_GET['tab'] : '';

	$per = IdoAllData::getById($_POST["_id"]);
	$per->client_id = $_POST["client_id"];
	$per->item_id = $_POST["item_id"];
	$per->clasificacion = $_POST["clasificacion"];
	$fecha = $per->fecha;
	$per->update();
	//Core::redir("./?view=calendario_5&opt=allD&fecha=$fecha");
	Core::redir("./?view=calendario_5&opt=allD&fecha=$fecha");
} */ else if (isset($_GET["opt"]) && $_GET["opt"] == "updateLyF") {

	// Obtener el valor del parámetro 'tab' para saber en qué pestaña estamos
	$currentTab = isset($_GET['tab']) ? $_GET['tab'] : '';

	$per = IdoAllData::getById($_POST["_id"]);
	$per->client_id = $_POST["client_id"];
	$per->item_id = $_POST["item_id"];
	$per->clasificacion = $_POST["clasificacion"];
	$fecha = $per->fecha;
	$per->update();
	// Redirigir incluyendo el parámetro 'tab'
	Core::redir("./?view=calendario_5&opt=allD&fecha=$fecha&tab=$currentTab");
}
