<?php


if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	
	$grupo=$_GET["g"];
	$per = new InterData();
	$per->fecha = $_POST["Fecha"];
	$per->id_linea = $_POST["Linea_id"];
	$per->tren = $_POST["Tren"];
	$per->modelo = $_POST["Modelo"];
	$per->motriz = $_POST["Motriz"];
	$per->evento = $_POST["Evento_id"];
	$per->retardo = $_POST["Retardo"];
	//$per->clasificacion = $_POST["Retardo"];
	$per->id_area = $_POST["Area_id"];
	$per->add();
	Core::redir("./?view=inter&opt=all&g=$grupo");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){
	$grupo=$_GET["g"];
	$per = InterData::getById($_POST["_id"]);
	$per->name = $_POST["name"];
	$per->lastname = $_POST["lastname"];
	$per->address = $_POST["address"];
	$per->phone = $_POST["phone"];
	$per->email = $_POST["email"];
	$per->update();
	Core::redir("./?view=inter&opt=all&g=$grupo");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$grupo=$_GET["g"];
	$per = InterData::getById($_GET["id"]);
	$per->del();
	Core::redir("./?view=inter&opt=all&g=$grupo");

}
?>