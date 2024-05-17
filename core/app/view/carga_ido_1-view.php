<?php

function connect()
{
	$con = new mysqli("localhost", "root", "", "ido");
	if ($con->connect_error) {
		die("Error de conexión: " . $con->connect_error);
	}
	$con->set_charset("utf8");
	return $con;
}

$con = connect();

?>



<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
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

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h1 class=""><b>CARGA DE IDO</b></h1>
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

							if (isset($action) && $action == "upload") {
								if (isset($_FILES['excel'])) {
									$archivo = $_FILES['excel']['name'];
									$destino = "cop_" . $archivo;

									if (move_uploaded_file($_FILES['excel']['tmp_name'], $destino)) {
										echo "Archivo cargado exitosamente";
									} else {
										echo "Error al cargar el archivo";
									}

									if (file_exists($destino)) {
										require_once('importar/Classes/PHPExcel.php');
										require_once('importar/Classes/PHPExcel/Reader/Excel2007.php');

										$objReader = new PHPExcel_Reader_Excel2007();
										$objPHPExcel = $objReader->load($destino);
										$objPHPExcel->setActiveSheetIndex(0);

										$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

										$sql = "INSERT INTO idos (linea, hora, descripcion, retardo, fecha, created_at, id_usuario, id_estado, vueltas, activo) VALUES ";
										$errores = 0;

										for ($i = 2; $i <= $filas; $i++) {
											$linea = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
											$hora = gmdate("H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue()));
											$descripcion = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
											$retardo = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
											$fecha = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue()));

											$sql .= "('$linea', '$hora', '$descripcion', '$retardo', '$fecha', NOW(), 1, 1, 0, 1),";

											$result = mysqli_query($con, $sql);
											if (!$result) {
												$errores++;
											}
										}

										$sqlReserva = "INSERT INTO tb_reservas (`id`, `id_usuario`, `name`, `tipo_servicio`, `f_cita`, `h_cita`, `title`, `start`, `end`, `color`, `created_at`, `updated_at`) VALUES
										(2, 2, 'ido 11/03/2024', 'prueba IDO', '2024-03-11', '10:00', 'IDO 11 Marzo', '2024-03-11', '2024-03-11', 'blue', '2024-03-27 20:30:23', '2024-03-27 20:30:23')";
										$resultReserva = mysqli_query($con, $sqlReserva);
										if (!$resultReserva) {
											$errores++;
										}

										if ($errores == 0) {
											echo "<hr><div class='col-xs-12'>
                                                    <div class='form-group'>
                                                        <strong><center>ARCHIVO IMPORTADO CON ÉXITO, $filas REGISTROS</center></strong>
                                                    </div>
                                                </div>";
										} else {
											echo "Error al insertar registros";
										}

										unlink($destino); // Borra el archivo cargado
									} else {
										echo "Primero debes cargar el archivo con extensión .xlsx";
									}
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
							if (isset($action) && $action == "upload") {
								echo '<table border="1" class="table">';
								echo '<thead>';
								echo '<tr>';
								echo '<th>Linea</th>';
								echo '<th>Hora</th>';
								echo '<th>Descripcion</th>';
								echo '<th>Retardo</th>';
								echo '<th>Fecha</th>';
								echo '</tr>';
								echo '</thead>';
								echo '<tbody>';

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
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $con->close(); ?>
</section>