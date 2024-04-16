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


<?php if (isset($_GET["opt"]) && $_GET["opt"] == "all") :

	$contacts = IdoAllData::getAll();
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">

							<h1 class=""><b>I D O </b> | Informes Diarios de Operacion</h1>
							<?php //$prueba = Core::$user->name; echo $prueba; 
							?>
							<a href="./?view=idoall&opt=new" class="btn btn-primary">Nueva Area</a>
						</div>
						<div class="card-body">
							<?php if (count($contacts) > 0) : ?>
								<div>
									<table class="table table-bordered datatable">
										<thead>
											<th>Linea</th>
											<th>Hora</th>
											<th>Descripcion</th>
											<th>Retardo</th>
											<th>V. Perdidas</th>
											<th>Acciones</th>
										</thead>
										<?php foreach ($contacts as $con) : ?>
											<tr>
												<td><?php echo $con->linea; ?></td>
												<td><?php echo $con->hora; ?></td>
												<td><?php echo $con->descripcion; ?></td>
												<td><?php echo $con->retardo; ?></td>
												<td><b><?php echo $con->vueltas; ?></b></td>

												<td style="width:200px; ">
													<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $con->id; ?>">
														<i class="fa fa-edit"></i> Clasificar
													</button>
													<a href="./?view=idoall&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
													<a href="./?action=idoall&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>" class="btn btn-danger btn-sm" onclick="fntDelPersona(1)"><i class="fa fa-trash"></i> Eliminar</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								</div>
								<?php foreach ($contacts as $con) :
								?>
									<!-- Ventana Modal -->
									<div class="modal fade" id="editModal<?php echo $con->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Clasificar Averia</h4>
												</div>
												<div class="modal-body">
													<form method="post" id="addproduct" action="./?action=idoall&opt=update" role="form">
														<input type="hidden" name="_id" value="<?php echo $con->id; ?>">

														<!-- primer combobox para seleccionar el area -->
														<div class="form-group">
															<label>Areas</label>
															<select name="client_id" id="client_id_<?php echo $con->id; ?>" required class="form-control">
																<option value="">-- SELECCIONE AREA --</option>
																<?php foreach (AreasturData::getAll() as $cli) : ?>
																	<option value="<?php echo $cli->id; ?>"><?php echo $cli->name; ?></option>
																<?php endforeach; ?>
															</select>
														</div>
														<div class="form-group">
															<label>Averia</label>
															<select name="item_id" id="item_id_<?php echo $con->id; ?>" required class="form-control">
															</select>
														</div>
														<script type="text/javascript">
															jQuery(document).ready(function() {
																jQuery("#client_id_<?php echo $con->id; ?>").change(function() {
																	jQuery.get("./?action=getitems", "client_id=" + jQuery("#client_id_<?php echo $con->id; ?>").val(), function(data) {
																		console.log(data);
																		jQuery("#item_id_<?php echo $con->id; ?>").html(data);
																	});
																});
															});
														</script>
														<div class="form-group">
															<label for="inputEmail1">Categoria</label>
															<input type="text" name="clasificacion" value="<?php echo $con->clasificacion; ?>" class="form-control" id="name" placeholder="Categoria">
														</div>
														<div class="form-group">
															<button type="submit" class="btn btn-primary">C L A S I F I C A R</button>
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
												</div>
											</div>
										</div>
									</div>

								<?php endforeach; ?>
							<?php else : ?>
								<p class="alert alert-warning">No hay Areas.</p>
							<?php endif; ?>
						</div>
					</div>

				</div>




			</div>
		</div>
	</section>
<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "new") : ?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class="">Nuevo Larin</h1>
							<a href="./?view=idoall&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
						</div>
						<div class="card-body">

							<form method="post" action="./?action=idoall&opt=add">
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">Linea</label>
									<input type="text" name="linea" class="form-control" id="name" placeholder="Ingresa la Linea" required>
								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">Hora</label>
									<input type="text" name="hora" id="lastname" class="form-control" placeholder="INGRESA LA HORA" required>
								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">Descripcion</label>
									<input type="text" name="descripcion" id="lastname" class="form-control" placeholder="INGRESA LA DESCRIPCION" required>
								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">Retardo</label>
									<input type="text" name="retardo" id="lastname" class="form-control" placeholder="INGRESA EL RETARDO" required>
								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">Fecha</label>
									<input type="date" name="fecha" id="lastname" class="form-control" placeholder="INGRESA LA FECHA" required>
								</div>

								<!-- <button type="submit" class="btn btn-primary" onclick="fntAddPersona(id)">Agregar</button> -->
								<button type="submit" class="btn btn-primary ">Agregar</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "edit") :
	$con = IdoAllData::getById($_GET["id"]);
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class="">Clasificar Averia</h1>
							<a href="./?view=areastur&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
						</div>
						<div class="card-body">

							<form method="post" action="./?action=idoall&opt=update">
								<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
								<div class="form-group">
									<label>Areas</label>
									<select name="client_id" id="client_id" required class="form-control">
										<option value="">-- SELECCIONE AREA --</option>
										<?php foreach (AreasturData::getAll() as $cli) : ?>
											<option value="<?php echo $cli->id; ?>"><?php echo $cli->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label>Averia</label>
									<select name="item_id" id="item_id" required class="form-control">

									</select>
								</div>
								<script type="text/javascript">
									jQuery(document).ready(function() {
										jQuery("#client_id").change(function() {
											jQuery.get("./?action=getitems", "client_id=" + jQuery("#client_id").val(), function(data) {
												console.log(data);
												jQuery("#item_id").html(data);
											});

										});
									});
								</script>
								<div class="mb-3">
									<label for="name" class="form-label">Clasificacion</label>
									<input type="text" name="clasificacion" class="form-control" value="<?php echo $con->clasificacion; ?>" id="name" placeholder="Ingresa la Area" required>
								</div>


								<button type="submit" class="btn btn-success">Actualizar</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "allF") :
	$contacts = IdoAllData::getByFecha($_GET["fecha"]);
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card card-primary card-outline">
						<div class="card-header">

							<h1 class=""><b>I D O </b> | Informes Diarios de Operacion</h1>
							<?php //$prueba = $_GET["fecha"];	echo $prueba;
							?>
							<a href="./?view=idoall&opt=new" class="btn btn-primary">Nueva Area</a>
						</div>
						<div class="card-body">
							<?php if (count($contacts) > 0) : ?>
								<div>
									<table class="table table-bordered datatable">
										<thead>
											<th>Linea</th>
											<th>Hora</th>
											<th>Descripcion</th>
											<th>Retardo</th>
											<th>Clasificacion</th>
											<th>Accion</th>
										</thead>
										<?php foreach ($contacts as $con) : ?>
											<tr>
												<td><?php echo $con->linea; ?></td>
												<td><?php echo $con->hora; ?></td>
												<td><?php echo $con->descripcion; ?></td>
												<td><?php echo $con->retardo; ?></td>
												<td><?php echo $con->clasificacion; ?></td>
												<td style="width:150px; ">
													<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $con->id; ?>">
														<i class="fa fa-edit"></i>Clasificar
													</button>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								</div>
								<?php foreach ($contacts as $con) : ?>
									<!-- Ventana Modal -->
									<div class="modal fade" id="editModal<?php echo $con->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Clasificar Averia</h4>
												</div>
												<div class="modal-body">
													<form method="post" id="addproduct" action="./?action=idoall&opt=updateC" role="form">
														<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
														<div class="form-group">
															<label for="inputEmail1">Tipo de Averia</label>
															<input type="text" name="clasificacion" value="<?php echo $con->clasificacion; ?>" class="form-control" id="name" placeholder="Ingresa la Clasificaion">
														</div>
														<div class="form-group">
															<button type="submit" class="btn btn-primary">C L A S I F I C A R</button>
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">C E R R A R</button>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<p class="alert alert-warning">No hay Areas.</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php endif; ?>