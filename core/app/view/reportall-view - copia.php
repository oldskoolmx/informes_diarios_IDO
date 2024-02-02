<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>DataTables</h1>
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
<!-- /.content-header -->
<?php $contacts = InterData::getAllRep();
	  $contactsT = InterData::getAllRepT();	
?>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h1>Reportes</h1>
						<br>
					</div>
					<div class="card-body">
						<div>


							<form>
								<input type="hidden" name="view" value="report">
								<div class="form-group">
									<div class="col-lg-6">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">INICIO
												</span>

											</div>
											<input type="date" name="start_at" value="<?php if (isset($_GET["start_at"]) && $_GET["start_at"] != "") {
																							echo $_GET["start_at"];
																						} ?>" class="form-control" placeholder="Palabra clave" required>

										</div>
										<!-- /input-group -->
									</div>
									<!-- /.col-lg-6 -->
									<div class="col-lg-6">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">FIN
												</span>

											</div>
											<input type="date" name="finish_at" value="<?php if (isset($_GET["finish_at"]) && $_GET["finish_at"] != "") {
																							echo $_GET["finish_at"];
																						} ?>" class="form-control" placeholder="Palabra clave" required>
										</div><!-- /input-group -->
									</div>
									<div class="col-lg-3 mb-3">
										<button class="btn btn-primary btn-block">Procesar</button><!-- /input-group -->
									</div>
									<!-- /.col-lg-6 -->
								</div>
							</form>
							<div class="card">
								<div class="panel-heading">
									<h3 class="panel-title">Título del panel</h3>
								</div>
								<div class="card-body">
									Contenido del panel...
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Título del panel</h3>
								</div>
								<div class="card-body">

									<!-- prueba de tabla  -->
									<div class="row container">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table table-striped  table-bordered table-hover">
													<thead>
														<tr>
															<th colspan="11"> Interrupciones</th>
														</tr>
														<tr>
															<th rowspan="2" scope="col">Linea</th>
															<th colspan="2">DE 01:00 A 05:00</th>
															<th colspan="2">DE 05:01 A 15:00</th>
															<th colspan="2">DE 15:01 A 30:00</th>
															<th colspan="2">MAS DE 30:01</th>
															<th colspan="2">TOTAL</th>
														</tr>
														<tr>
															<th>EVENTOS</th>
															<th>RETARDOS (min)</th>
															<th>EVENTOS</th>
															<th>RETARDOS (min)</th>
															<th>EVENTOS</th>
															<th>RETARDOS (min)</th>
															<th>EVENTOS</th>
															<th>RETARDOS (min)</th>
															<th>EVENTOS</th>
															<th>RETARDOS (min)</th>
														</tr>
													</thead>

													<?php foreach ($contacts as $con) :
														$linea  = $con->getLinea();
													?>
														<tbody>
															<tr>
																<td><?php echo $linea->name; ?></td>
																<td><?php echo $con->uno_a_4; ?></td>
																<td><?php echo $con->uno; ?></td>
																<td><?php echo $con->cinco_a_14; ?></td>
																<td><?php echo $con->cinco; ?></td>
																<td><?php echo $con->quince_a_29; ?></td>
																<td><?php echo $con->quince; ?></td>
																<td><?php echo $con->mas_de_30; ?></td>
																<td><?php echo $con->mas; ?></td>
																<td><?php echo $con->T_eventos; ?></td>
																<td><?php echo $con->T_retardos; ?></td>
															</tr>
														</tbody>
													<?php endforeach; ?>
													<?php foreach ($contactsT as $con) :
													?>	
													<tfoot>
														<tr>
																<td>TOTAL</td>
																<td><?php echo $con->uno_a_4; ?></td>
																<td><?php echo $con->uno; ?></td>
																<td><?php echo $con->cinco_a_14; ?></td>
																<td><?php echo $con->cinco; ?></td>
																<td><?php echo $con->quince_a_29; ?></td>
																<td><?php echo $con->quince; ?></td>
																<td><?php echo $con->mas_de_30; ?></td>
																<td><?php echo $con->mas; ?></td>
																<td><?php echo $con->T_eventos; ?></td>
																<td><?php echo $con->T_retardos; ?></td>
														</tr>
													</tfoot>
													<?php endforeach; ?>		
												</table>
											</div>

										</div>

									</div>

								</div>
							</div>
							<?php
							if (isset($_GET["start_at"]) && $_GET["start_at"] != "" && isset($_GET["finish_at"]) && $_GET["finish_at"] != "") {
								$users = OperationData::getByRange1($_GET["start_at"], $_GET["finish_at"]);
								if (count($users) > 0) {
									// si hay usuarios
									//$_SESSION["report_data"] = $users;
							?>
									<div class="panel panel-default">
										<div class="panel-heading">
											Reportes</div>
										<table class="table table-bordered table-hover">
											<thead>
												<th>Fecha</th>
												<th>Linea</th>
												<th>Gerencia</th>
												<th>Tren</th>
											</thead>
											<?php
											$total = 0;
											foreach ($users as $user) {
												$item  = $user->getItem();
												//$client  = $user->getClient();
												//$book = $item->getBook();
											?>
												<tr>
													<td><?php echo $user->fecha; ?></td>
													<td><?php echo $item->name; ?></td>
													<td><?php echo $user->gerencia; ?></td>
													<td><?php echo $user->tren; ?></td>
												</tr>
											<?php

											}
											echo "</table>";
											?>
									<?php
								} else {
									echo "<p class='alert alert-danger'>No hay datos.</p>";
								}
							} else {
								echo "<p class='alert alert-warning'>Debes de ingresar un rango de fechas!!!!!!!</p>";
							}


									?>


									</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php //endif; 
?>