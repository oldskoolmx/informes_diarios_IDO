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
if (isset($_GET["opt"]) && $_GET["opt"] == "all") :
	$contacts = AreasturData::getAll();
?>

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class=""><b>A R E A S </b></h1>
							<a href="./?view=areastur&opt=new" class="btn btn-primary">Nueva Area</a>
						</div>
						<div class="card-body">
							<?php if (count($contacts) > 0) : ?>
								<div>
									<table class="table table-bordered datatable">
										<thead>
											<th>Area</th>
											<th>Acciones</th>
										</thead>
										<tbody>
											<?php foreach ($contacts as $con) : ?>
												<tr>
													<td><?php echo $con->name; ?></td>
													<td style="width:200px;">
														<button type="button" class="btn btn-warning btn-sm edit-area-btn" data-toggle="modal" data-target="#editAreaModal" data-area-id="<?php echo $con->id; ?>">
															<i class="fa fa-edit"></i> Editar
														</button>
														<a href="./?action=areastur&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>" class="btn btn-danger btn-sm" onclick="fntDelPersona(1)"><i class="fa fa-trash"></i> Eliminar</a>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							<?php else : ?>
								<p class="alert alert-warning">No hay Areas.</p>
							<?php endif; ?>
						</div>
					</div>
					<?php //$con = AreasturData::getById($_GET["id"]); 
					?>
					<div class="modal fade" id="editAreaModal" tabindex="-1" role="dialog" aria-labelledby="editAreaModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="editAreaModalLabel">Editar Area</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="./?action=areastur&opt=update" method="post">
										<!-- <input type="hidden" name="area_id" id="editAreaId" value=""> -->
										<input type="hidden" name="_id" id="editAreaId" value="<?php echo $con->id; ?>">
										<div class="form-group">
											<label for="areaName">Nombre del Area:</label>
											<input type="text" class="form-control" id="areaName" name="name" required>
										</div>
										<button type="submit" class="btn btn-primary">Guardar Cambios</button>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

	<script>
		$(document).ready(function() {
			// Handle edit area button click
			$('.edit-area-btn').click(function() {
				var areaId = $(this).data('areaId');
				$('#editAreaId').val(areaId);

				var areaName = $(this).closest('tr').find('td:first').text();
				$('#areaName').val(areaName);
			});
		});
	</script>
<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "new") : ?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class="">Nueva Area</h1>
							<a href="./?view=areastur&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
						</div>
						<div class="card-body">

							<form method="post" action="./?action=areastur&opt=add">
								<div class="mb-3">
									<label for="name" class="form-label">Nombre de la area</label>
									<input type="text" name="name" class="form-control" id="name" placeholder="Ingresa la Area" required>
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
	$con = AreasturData::getById($_GET["id"]);
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class="">Editar Area</h1>
							<a href="./?view=areastur&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
						</div>
						<div class="card-body">

							<form method="post" action="./?action=areastur&opt=update">
								<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
								<div class="mb-3">
									<label for="name" class="form-label">Area</label>
									<input type="text" name="name" class="form-control" value="<?php echo $con->name; ?>" id="name" placeholder="Ingresa la Area" required>
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