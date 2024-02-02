<?php


if (isset($_GET["opt"]) && $_GET["opt"] == "add") {

	//$grupo = $_GET["g"];
	$per = new DocumentosData();
	$per->n_turno = $_POST["n_turno"];
	$per->f_e_turno = $_POST["f_e_turno"];
	$per->f_e_oficio = $_POST["f_e_oficio"];
	$per->asunto = $_POST["asunto"];
	$per->id_area = $_POST["id_area"];
	$per->instrucciones = $_POST["instrucciones"];
	$per->f_respuesta = $_POST["f_respuesta"];
	//$per->clasificacion = $_POST["Retardo"];
	$per->n_oficio = $_POST["n_oficio"];
	$per->id_usuario = $_POST["id_usuario"];
	$per->observaciones = $_POST["observaciones"];
	$per->id_estado = $_POST["id_estado"];
	$per->add();
	Core::redir("./?view=documentos&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "update") {
	$grupo = $_GET["g"];
	$per = DocumentosData::getById($_POST["_id"]);
	$per->name = $_POST["name"];
	$per->lastname = $_POST["lastname"];
	$per->address = $_POST["address"];
	$per->phone = $_POST["phone"];
	$per->email = $_POST["email"];
	$per->update();
	Core::redir("./?view=documentos&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
	//$grupo = $_GET["g"];
	$per = DocumentosData::getById($_GET["id"]);
	$per->del();
	Core::redir("./?view=documentos&opt=all");
}
