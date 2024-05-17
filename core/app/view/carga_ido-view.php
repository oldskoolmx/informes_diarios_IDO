<?php

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
							if (isset($_POST['action']) && $_POST['action'] == "upload") {
								// Cargamos el fichero
								$archivo = $_FILES['excel']['name'];
								$destino = "cop_" . $archivo; // Le agregamos un prefijo para identificar el archivo cargado
								if (copy($_FILES['excel']['tmp_name'], $destino)) {
									echo "Archivo Cargado Con Éxito";

									require_once('importar/Classes/PHPExcel.php');
									require_once('importar/Classes/PHPExcel/Reader/Excel2007.php');
									$objReader = new PHPExcel_Reader_Excel2007();
									$objPHPExcel = $objReader->load($destino);

									// Asignamos la hoja de Excel activa
									$objPHPExcel->setActiveSheetIndex(0);

									// Variables para capturar la fecha de la primera fila
									$fecha_reserva = null;

									// Rellenamos el arreglo con los datos del archivo xlsx que ha sido subido
									$filas = $objPHPExcel->getActiveSheet()->getHighestRow();

									for ($i = 2; $i <= $filas; $i++) {
										$_DATOS_EXCEL[$i]['linea'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
										$hora = PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue());
										$hora_1 = gmdate("H:i:s", $hora);
										$_DATOS_EXCEL[$i]['hora'] = $hora_1;
										$texto = $_DATOS_EXCEL[$i]['descripcion'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
										$_DATOS_EXCEL[$i]['retardo'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
										$fecha = PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue());
										$fecha_1 = gmdate("Y-m-d", $fecha);
										$_DATOS_EXCEL[$i]['fecha'] = $fecha_1;
										$_DATOS_EXCEL[$i]['clasificacion'] = 33;
										$_DATOS_EXCEL[$i]['client_id'] = 33;
										$_DATOS_EXCEL[$i]['item_id'] = 17;
										$_DATOS_EXCEL[$i]['clasificado'] = "NO";

										// Guardar la fecha de la primera fila
										if ($i == 2) {
											$fecha_reserva = $fecha_1;
										}

										$_DATOS_EXCEL[$i]['created_at'] = date("Y-m-d H:i:s");
										$_DATOS_EXCEL[$i]['id_usuario'] = 1;
										$_DATOS_EXCEL[$i]['id_estado'] = 1;

										$posicionPierde = strpos($texto, "Pierde");
										$subcadena = substr($texto, $posicionPierde);
										if (preg_match("/[\d\.]+ vueltas/", $subcadena, $matches)) {
											$vueltasPerdidas = preg_replace('/[^0-9.]/', '', $matches[0]);
											$_DATOS_EXCEL[$i]['vueltas'] = $vueltasPerdidas;
										} else {
											$_DATOS_EXCEL[$i]['vueltas'] = 0;
										}
										$_DATOS_EXCEL[$i]['activo'] = 1;
									}

									$errores = 0;
									foreach ($_DATOS_EXCEL as $campo => $valor) {
										$sql = "INSERT INTO idos (linea, hora, descripcion, retardo, fecha,clasificacion,client_id,item_id, clasificado,created_at, id_usuario, id_estado, vueltas, activo) VALUES ('";
										foreach ($valor as $campo2 => $valor2) {
											$valor2 = mysqli_real_escape_string($con, $valor2);
											$campo2 == "activo" ? $sql .= $valor2 . "');" : $sql .= $valor2 . "','";
										}
										$result = mysqli_query($con, $sql);
										if (!$result) {
											echo "Error al insertar registro " . $campo;
											$errores += 1;
										}
									}

									echo "<hr><div class='col-xs-12'>
                                        <div class='form-group'>
                                        <strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>
                                        </div>
                                    </div>";

									// Insertar la reserva en tb_reservas usando la fecha capturada
									$sqlReserva = "INSERT INTO tb_reservas (id_usuario, name, tipo_servicio, f_cita, h_cita, title, start, end, color, created_at, updated_at) VALUES (2, 'IDO $fecha_reserva', 'prueba IDO', '$fecha_reserva', '10:00', 'IDO $fecha_reserva', '$fecha_reserva', '$fecha_reserva', 'blue', NOW(), NOW())";
									$resultReserva = mysqli_query($con, $sqlReserva);
									if (!$resultReserva) {
										echo "Error al insertar la reserva.";
										$errores++;
									}

									// Borramos el archivo que está en el servidor con el prefijo cop_
									unlink($destino);
								} else {
									echo "Error Al Cargar el Archivo";
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $con->close(); ?>
</section>