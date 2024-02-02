<?php

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){

	$per = new PersonData();
	$per->name = $_POST["name"];
	$per->lastname = $_POST["lastname"];
	$per->address = $_POST["address"];
	$per->phone = $_POST["phone"];
	$per->email = $_POST["email"];
	$per->add();
	Core::redir("./?view=contacts&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){

	$per = PersonData::getById($_POST["_id"]);
	$per->name = $_POST["name"];
	$per->lastname = $_POST["lastname"];
	$per->address = $_POST["address"];
	$per->phone = $_POST["phone"];
	$per->email = $_POST["email"];
	$per->update();
	Core::redir("./?view=contacts&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$per = PersonData::getById($_GET["id"]);
	$per->del();
	Core::redir("./?view=contacts&opt=all");

}
?>