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
								<input type="hidden" name="view" value="repfechas">
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



							<?php
							if (isset($_GET["start_at"]) && $_GET["start_at"] != "" && isset($_GET["finish_at"]) && $_GET["finish_at"] != "") {
								$users = OperationData::getByRange($_GET["start_at"], $_GET["finish_at"]); ?>

								<!-- // si hay usuarios
								//$_SESSION["report_data"] = $users; -->
								<!-- <div class="card-body"> -->
								<?php if (count($users) > 0) { ?>

									<div>

										<table class="table table-striped  table-bordered table-hover datatableR ">
											<thead>
												<th>Fecha</th>
												<th>Linea</th>
												<th>No. Tren</th>
												<th>Modelo</th>
												<th>Motriz</th>
												<th>Evento</th>
												<th>Retardo</th>
												<th>Clasificacion</th>
												<th>Area</th>

											</thead>
											<?php
											$total = 0;
											foreach ($users as $user) :
												$item  = $user->getItem();
												$evento  = $user->getEvento();
												$area  = $user->getArea();
												//$client  = $user->getClient();
												//$book = $item->getBook();
											?>
												<tr>
													<td><?php echo $user->fecha; ?></td>
													<td><?php echo $item->name; ?></td>
													<td><?php echo $user->tren; ?></td>
													<td><?php echo $user->modelo; ?></td>
													<td><?php echo $user->motriz; ?></td>
													<td><?php echo $evento->name; ?></td>
													<td><?php echo $user->retardo; ?></td>
													<td><?php echo $user->clasificacion; ?></td>
													<td><?php echo $area->name; ?></td>
													<!-- <td style="width:190px; ">
														<a href="./?view=inter&opt=edit&id=<?php //echo $user->id; 
																							?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
														<a href="./?action=inter&opt=del&id=<?php //echo $user->id; 
																							?>" id="item-<? php // echo $user->id; 
																											?>"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
														<script type="text/javascript">
															$("#item-<?php //echo $user->id; 
																		?>").click(function(e){
																e.preventDefault();
																x = confirm("Seguro desea eliminar este elemento?");
																if(x){
																	window.location = "./?action=inter&opt=del&id=<?php //echo $user->id; 
																													?>";
																}
															});
														</script>
													</td> -->
												</tr>
											<?php endforeach; ?>
										</table>

									</div>
								<?php
								} else {
									echo "<p class='alert alert-danger'>No hay datos.</p>";
								} ?>
								<!-- </div> -->
							<?php } else {
								echo "<p class='alert alert-warning'>Debes de ingresar un rango de fechas!!!!!!!</p>";
							}


							?>



						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php //endif; 
?>