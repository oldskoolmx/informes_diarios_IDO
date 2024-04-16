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
	$contacts = ClasificacionesData::getAll();
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class=""><b> A V E R I A S </b></h1> <?php //$prueba = Core::$user->name; echo $prueba; 
																		?>
							<a href="./?view=clasificaciones&opt=new" class="btn btn-primary">Nueva Averias</a>
						</div>
						<div class="card-body">
							<?php if (count($contacts) > 0) : ?>
								<div>
									<table class="table table-bordered datatable">
										<thead>
											<th>Area</th>
											<th>Averia</th>

											<th>Acciones</th>
										</thead>
										<?php foreach ($contacts as $con) :
											$areas = $con->getItem();
										?>
											<tr>
												<td><?php echo $areas->name; ?></td>
												<td><?php echo $con->name; ?></td>

												<td style="width:200px; ">
													<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $con->id; ?>">
														<i class="fa fa-edit"></i>Editar
													</button>
													<a href="./?action=clasificaciones&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>" class="btn btn-danger btn-sm" onclick="fntDelPersona(1)"><i class="fa fa-trash"></i> Eliminar</a>
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
													<h4 class="modal-title" id="myModalLabel">Editar Categria</h4>
												</div>
												<div class="modal-body">
													<form method="post" id="addproduct" action="./?action=clasificaciones&opt=update" role="form">
														<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
														<div class="form-group">
															<label for="inputEmail1">Categoria</label>
															<input type="text" name="name" value="<?php echo $con->name; ?>" class="form-control" id="name" placeholder="Categoria">
														</div>
														<div class="form-group">
															<button type="submit" class="btn btn-primary">Actualizar Categria</button>
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
								<p class="alert alert-warning">No hay Clasificaciones.</p>
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
							<h1 class=""><b> C L A S I F I C A C I O N </b></h1>
							<a href="./?view=clasificaciones&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
						</div>
						<div class="card-body">

							<form method="post" action="./?action=clasificaciones&opt=add">

								<div class="mb-3">
									<label for="area_atencion" class="form-label">Area de Atencion</label>
									<?php
									$cats = AreasturData::getAll();
									?>
									<?php if (count($cats) > 0) : ?>
										<select name="client_id" class="form-control" required>
											<option value="">- - S E L E C C I O N E - -</option>
											<?php foreach ($cats as $cat) : ?>
												<option value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
											<?php endforeach; ?>
										</select>
									<?php endif; ?>
								</div>



								<div class="mb-3">
									<label for="name" class="form-label">Averia</label>
									<input type="text" name="name" class="form-control" id="name" placeholder="Ingresa la Clasificacion" required>
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
	$con = ClasificacionesData::getById($_GET["id"]);
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class="">Editar Clasificacion</h1>
							<a href="./?view=clasificaciones&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
						</div>
						<div class="card-body">

							<form method="post" action="./?action=clasificaciones&opt=update">
								<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
								<div class="mb-3">
									<label for="name" class="form-label">Clasificacion</label>
									<input type="text" name="name" class="form-control" value="<?php echo $con->name; ?>" id="name" placeholder="Ingresa la Clasificacion" required>
								</div>


								<button type="submit" class="btn btn-success">Actualizar</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
<?php endif; ?>