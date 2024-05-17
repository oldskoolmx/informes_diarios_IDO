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
							<h1 class=""><b>CARGA DE I D O</b></h1>
							<a href="./?view=cargaido&opt=new" class="btn btn-primary">Nuevo I D O</a>
						</div>
						<div class="card-body">
							<?php if (count($contacts) > 0) : ?>
								<div>
									AKI VAN LOS BOTONES
								</div>
							<?php else : ?>
								<p class="alert alert-warning">No hay Areas.</p>
							<?php endif; ?>
						</div>
					</div>
					<?php //$con = AreasturData::getById($_GET["id"]); 
					?>

				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "new") : ?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class=""><b>Importar I D O </b></h1>
							<a href="./?view=cargaido&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
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
								<div class="col-md-12 mb-3">
									<label for="exampleInputFile">OFICIO ESCANEADO</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="r_filename" id="exampleInputFile" lang="es">
											<label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
										</div>
										<div class="input-group-append">
											<span class="input-group-text">Subir</span>
										</div>
									</div>
								</div>
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