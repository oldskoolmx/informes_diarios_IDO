<?php

if (isset($_GET["opt"]) && $_GET["opt"] == "add") {

	//$grupo = $_GET["g"];
	$per = new DocusData();

	foreach ($_POST as $k => $v) {
		$per->$k = $v;
		# code...
	}

	$alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code = "";
	for ($i = 0; $i < 11; $i++) {
		$code .= $alphabeth[rand(0, strlen($alphabeth) - 1)];
	}
	$per->short_name = $code;

	$handle = new Upload($_FILES['filename']);
	if ($handle->uploaded) {
		$url = "admin/storage/products/";
		$handle->Process($url);

		$per->filename = $handle->file_dst_name;
	}


	/* $per_r = new DocusData();

	foreach ($_POST as $k => $v) {
		$per_r->$k = $v;
		# code...
	} */


	$alphabeth_r = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code_r = "";
	for ($j = 0; $j < 11; $j++) {
		$code_r .= $alphabeth_r[rand(0, strlen($alphabeth_r) - 1)];
	}
	$per->r_short_name = $code_r;

	$handle_r = new Upload($_FILES['r_filename']);
	if ($handle_r->uploaded) {
		$url_r = "admin/storage/products/";
		$handle_r->Process($url_r);

		$per->r_filename = $handle_r->file_dst_name;
	}


	$per->r_n_oficio = $_POST["r_n_oficio"];
	$per->r_f_e_oficio = $_POST["r_f_e_oficio"];
	$per->r_f_r_oficio = $_POST["r_f_r_oficio"];
	//$per->r_f_r_oficio = $_POST["r_f_r_oficio"];
	$per->r_f_atencion = $_POST["r_f_atencion"];
	$per->r_solicitud = $_POST["r_solicitud"];

	$per->d_n_registro = $_POST["d_n_registro"];
	$per->d_n_folio = $_POST["d_n_folio"];
	$per->d_f_compromiso = $_POST["d_f_compromiso"];
	$per->d_instrucciones = $_POST["d_instrucciones"];
	//$per->d_n_registro = $_POST["d_n_registro"];
	//$per->clasificacion = $_POST["Retardo"];
	/*$per->n_oficio = $_POST["n_oficio"];
	$per->id_usuario = $_POST["id_usuario"];
	$per->observaciones = $_POST["observaciones"];
	$per->id_estado = $_POST["id_estado"];*/

	$per->add();
	Core::redir("./?view=docus&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "update") {
	//$grupo = $_GET["g"];
	$per = DocusData::getById($_POST["_id"]);
	/* $per->name = $_POST["name"];
	$per->lastname = $_POST["lastname"];
	$per->address = $_POST["address"];
	$per->phone = $_POST["phone"];
	$per->email = $_POST["email"]; */
	foreach ($_POST as $k => $v) {
		$per->$k = $v;
		# code...
	}

	$alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code = "";
	for ($i = 0; $i < 11; $i++) {
		$code .= $alphabeth[rand(0, strlen($alphabeth) - 1)];
	}
	$per->short_name = $code;

	$handle = new Upload($_FILES['filename']);
	if ($handle->uploaded) {
		$url = "admin/storage/products/";
		$handle->Process($url);

		$per->filename = $handle->file_dst_name;
	}


	$alphabeth_r = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code_r = "";
	for ($j = 0; $j < 11; $j++) {
		$code_r .= $alphabeth_r[rand(0, strlen($alphabeth_r) - 1)];
	}
	$per->r_short_name = $code_r;

	$handle_r = new Upload($_FILES['r_filename']);
	if ($handle_r->uploaded) {
		$url_r = "admin/storage/products/";
		$handle_r->Process($url_r);

		$per->r_filename = $handle_r->file_dst_name;
	}

	$per->r_n_oficio = $_POST["r_n_oficio"];
	$per->r_f_e_oficio = $_POST["r_f_e_oficio"];
	$per->r_f_r_oficio = $_POST["r_f_r_oficio"];
	//$per->r_f_r_oficio = $_POST["r_f_r_oficio"];
	$per->r_f_atencion = $_POST["r_f_atencion"];
	$per->r_solicitud = $_POST["r_solicitud"];

	$per->d_n_registro = $_POST["d_n_registro"];
	$per->d_n_folio = $_POST["d_n_folio"];
	$per->d_f_compromiso = $_POST["d_f_compromiso"];
	$per->d_instrucciones = $_POST["d_instrucciones"];


	/* $per->update(); ?>
	<script>
		Swal.fire({
			title: '¡Éxito!',
			text: 'Se ha agregado correctamente el nuevo elemento.',
			icon: 'success',
			confirmButtonText: 'Aceptar'
		}).then(function() {
			window.location = './?view=docus&opt=all';
		});
	</script> */
	$per->update();

	/* echo "<script>
		Swal.fire({
			title: 'Good job!',
			text: 'You clicked the button!',
			icon: 'success'
		});
		</script>";
	// Si se agregó correctamente, mostrar una alerta
	Core::sweetalert(); */
	echo "<script>alert('Editado Correctamente');</script>";
	echo "<script>
		Swal.fire({
			title: 'Good job!',
			text: 'You clicked the button!',
			icon: 'success'
		});
		</script>";
	Core::redir("./?view=docus&opt=all");
} else if (isset($_GET["opt"]) && $_GET["opt"] == "del") {
	//$grupo = $_GET["g"];
	$per = DocusData::getById($_GET["id"]);
	$per->del();
	Core::redir("./?view=docus&opt=all");
}
