<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<!-- <h1>DataTables 1</h1> -->
				<div class="date" style="font-size:28px;">
					<b><span id="weekDay" class="weekDay"></span>,
						<span id="day" class="day"></span> de
						<span id="month" class="month"></span> del
						<span id="year" class="year"></span></b>
				</div>
				<div class="clock" style="font-size:24px;">
					<span id="hours" class="hours"></span> :
					<span id="minutes" class="minutes"></span> :
					<span id="seconds" class="seconds"></span>
				</div>

			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">DataTables</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<?php

/* function connect()
{
	return new mysqli("localhost", "root", "", "ido");
}
$con = connect();

// AGREGANDO CHARSET UTF8
if (!$con->set_charset("utf8")) {
	printf("Error al cargar el conjunto de caracteres utf8: %s\n", $con->error);
	exit();
} else {
	//printf("Conjunto de caracteres actual: %s\n", $db->character_set_name());
} */

function connect()
{
	$con = new mysqli("localhost", "root", "", "ido");
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	$con->set_charset("utf8");
	return $con;
}

$con = connect();
?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">

				<div class="card">
					<div class="card-header">
						<h1 class=""><b>CARGA DE I D O</b></h1>

					</div>
					<div class="card-body">

						<div>

							<h2>Cargar e importar archivo</h2>
							<form name="importa" method="post" action="" enctype="multipart/form-data">
								<div class="col-xs-4">
									<div class="form-group">
										<input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="excel">
									</div>
								</div>
								<div class="col-xs-2">
									<input class="btn btn-default btn-file" type='submit' name='enviar' value="Importar" />
								</div>
								<input type="hidden" value="upload" name="action" />
								<input type="hidden" value="usuarios" name="mod">
								<input type="hidden" value="masiva" name="acc">
							</form>

							<!-- PROCESO DE CARGA Y PROCESAMIENTO DEL EXCEL-->
							<?php
							extract($_POST);
							if (isset($_POST['action'])) {
								$action = $_POST['action'];
							}

							if (isset($action) == "upload") {
								//cargamos el fichero
								$archivo = $_FILES['excel']['name'];
								$tipo = $_FILES['excel']['type'];
								$destino = "cop_" . $archivo; //Le agregamos un prefijo para identificarlo el archivo cargado
								if (copy($_FILES['excel']['tmp_name'], $destino)) echo "Archivo Cargado Con Éxito";
								else echo "Error Al Cargar el Archivo";

								if (file_exists("cop_" . $archivo)) {
									/** Llamamos las clases necesarias PHPEcel */
									require_once('importar/Classes/PHPExcel.php');
									require_once('importar/Classes/PHPExcel/Reader/Excel2007.php');
									// Cargando la hoja de excel
									$objReader = new PHPExcel_Reader_Excel2007();
									$objPHPExcel = $objReader->load("cop_" . $archivo);
									$objFecha = new PHPExcel_Shared_Date();
									// Asignamon la hoja de excel activa
									$objPHPExcel->setActiveSheetIndex(0);

									// Importante - conexión con la base de datos 


									// Rellenamos el arreglo con los datos  del archivo xlsx que ha sido subido

									$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
									$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

									//Creamos un array con todos los datos del Excel importado
									for ($i = 2; $i <= $filas; $i++) {
										$_DATOS_EXCEL[$i]['linea'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
										//$_DATOS_EXCEL[$i]['hora'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();

										$hora = PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue());
										$hora_1 = gmdate("H:i:s", $hora);
										$_DATOS_EXCEL[$i]['hora'] = $hora_1;



										$texto = $_DATOS_EXCEL[$i]['descripcion'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
										$_DATOS_EXCEL[$i]['retardo'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();

										$fecha = PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue());
										$fecha_1 = gmdate("Y-m-d", $fecha);
										$_DATOS_EXCEL[$i]['fecha'] = $fecha_1;


										//$_DATOS_EXCEL[$i]['fecha'] = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
										$_DATOS_EXCEL[$i]['created_at'] = date("Y-m-d H:i:s");
										/*$_DATOS_EXCEL[$i]['updated_at'] = date("Y-m-d H:i:s");*/
										$_DATOS_EXCEL[$i]['id_usuario'] = 1;
										$_DATOS_EXCEL[$i]['id_estado'] = 1;
										//$_DATOS_EXCEL[$i]['email'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

										// funcion para guardar las vueltas perdidas
										$posicionPierde = strpos($texto, "Pierde");
										$subcadena = substr($texto, $posicionPierde);
										if (preg_match("/[\d\.]+ vueltas/", $subcadena, $matches)) {
											// Extraer solo el número de vueltas encontrado
											$vueltasPerdidas = preg_replace('/[^0-9.]/', '', $matches[0]);
											// Imprimir el resultado
											$_DATOS_EXCEL[$i]['vueltas'] = $vueltasPerdidas;
										} else {
											// Si no se encuentra ninguna coincidencia
											$vueltasPerdidas = 0;
											$_DATOS_EXCEL[$i]['vueltas'] = $vueltasPerdidas;
										}
										$_DATOS_EXCEL[$i]['activo'] = 1;
									}
									$errores = 0;


									foreach ($_DATOS_EXCEL as $campo => $valor) {
										$sql = "INSERT INTO idos  (linea,hora,descripcion,retardo,fecha,created_at,id_usuario,id_estado,vueltas,activo)  VALUES ('";
										foreach ($valor as $campo2 => $valor2) {
											// Escapar comillas simples en el valor antes de insertarlo en la base de datos
											$valor2 = mysqli_real_escape_string($con, $valor2);

											$campo2 == "activo" ? $sql .= $valor2 . "');" : $sql .= $valor2 . "','";
										}


										$result = mysqli_query($con, $sql);
										if (!$result) {
											echo "Error al insertar registro " . $campo;
											$errores += 1;
										}
									}
									/////////////////////////////////////////////////////////////////////////	
									echo "<hr> <div class='col-xs-12'>
    									<div class='form-group'>";
									echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
									echo "</div>
						</div>  ";

									$sqlReserva = "INSERT INTO tb_reservas ( id_usuario, name, tipo_servicio, f_cita, h_cita, title, start, end, color, created_at, updated_at) VALUES
										( 2, 'ido 11/03/2024', 'prueba IDO', '2024-03-11', '10:00', 'IDO 11 Marzo', '2024-03-11', '2024-03-11', 'blue', '2024-03-27 20:30:23', '2024-03-27 20:30:23')";
									$resultReserva = mysqli_query($con, $sqlReserva);
									if (!$resultReserva) {
										$errores++;
									}
									//Borramos el archivo que esta en el servidor con el prefijo cop_
									unlink($destino);
								}
								//si por algun motivo no cargo el archivo cop_ 
								else {
									echo "Primero debes cargar el archivo con extencion .xlsx";
								}
							}
							?>
							<?php
							if (isset($action)) {
								$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
							}
							if (isset($filas)) {
								$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
							}
							if (isset($filas)) {
								$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
							}

							//echo 'getHighestColumn() =  [' . $columnas . ']<br/>';
							//echo 'getHighestRow() =  [' . $filas . ']<br/>';
							if (isset($action) == "upload") {
								echo '<table border="1" class="table">';
								echo '<thead>';
								echo '<tr>';
								echo '<th>Linea</th>';
								echo '<th>Hora</th>';
								echo '<th>Descripcion</th>';
								echo '<th>Retardo</th>';
								echo '<th>Fecha</th>';


								echo '</tr> ';
								echo '</thead> ';
								echo '<tbody> ';

								$count = 0;
								foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
									$count++;
									$cellIterator = $row->getCellIterator();
									$cellIterator->setIterateOnlyExistingCells(false);
									echo '<tr>';
									foreach ($cellIterator as $cell) {
										if (!is_null($cell)) {
											$value = $cell->getCalculatedValue();
											echo '<td>';
											echo $value . ' ';
											echo '</td>';
										}
									}
									echo '</tr>';
								}
								echo '</tbody>';
								echo '</table>';
							}
							echo '</div>';
							//include("footer.php");
							?>
						</div>

					</div>
				</div>


			</div>
		</div>
	</div>
	<?php $con->close(); ?>
</section>