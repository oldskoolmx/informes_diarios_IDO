<!-- Content Header (Page header) -->
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
<!-- /.content-header -->

<?php
if (isset($_GET["opt"]) && $_GET["opt"] == "all") :
	$contacts = DocusData::getAll();
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class=""><b>D O C U M E N T O S </b><?php //echo $gerencia; 
																	?></h1>
							<a href="./?view=tester&opt=new" class="btn btn-primary">R E G I S T R A R</a>
						</div>
						<div class="card-body">
							<?php if (count($contacts) > 0) : ?>
								<div>
									<table class="table table-striped table-bordered table-hover datatable responsive">
										<thead>
											<th>N. Oficio</th>
											<th>F. Elaboracion</th>
											<th>F. Recepcion</th>
											<th>F. Atencion</th>
											<th>Solicitud</th>
											<th>N. Registro</th>
											<th>N. Folio</th>
											<th>Estado</th>
											<th>Dias Faltantes</th>


											<th>Acciones</th>
										</thead>
										<?php foreach ($contacts as $con) :
											$item  = $con->getClasificaciones();
											//$usuario  = $con->getRegistro(); 
										?>
											<tr>
												<td><b>
														<?php echo $con->r_n_oficio; ?>
													</b>
												</td>
												<td><?php echo $con->r_f_e_oficio; ?></td>
												<td><?php echo $con->r_f_r_oficio; ?></td>
												<td><?php echo $con->r_f_atencion; ?></td>
												<td><?php echo $con->r_solicitud; ?></td>
												<td><?php echo $con->d_n_registro; ?></td>
												<td><?php echo $con->d_n_folio; ?></td>



												<td><b>
														<?php if ($item->id == 1) :  ?>
															<span class="badge bg-danger"><?php echo $item->name; ?></span>
														<?php elseif ($item->id == 2) : ?>
															<span class="badge bg-success"><?php echo $item->name; ?></span>
														<?php else : ?>
															<span class="badge bg-warning"><?php echo $item->name; ?></span>
														<?php endif; ?>
													</b>
												</td>

												<td>
													<b>

														<?php

														$now = strtotime($con->d_f_compromiso);
														$date = strtotime($con->r_f_atencion);

														$diff_in_days = floor(($now - $date) / (60 * 60 * 24));
														echo $diff_in_days . ' Dias';

														?>
													</b>

												</td>





												<td style="width:190px; ">
													<a href="./?view=tester&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
													<a href="./?action=docus&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
													<script type="text/javascript">
														$("#item-<?php echo $con->id; ?>").click(function(e) {
															e.preventDefault();
															x = confirm("Seguro desea eliminar este elemento?");
															if (x) {
																window.location = "./?action=documentos&opt=del&id=<?php echo $con->id; ?>";
															}
														});
													</script>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								</div>

							<?php else : ?>
								<p class="alert alert-warning">No hay Documentos registrados.</p>
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
			<form method="post" action="./?action=docus&opt=add" enctype="multipart/form-data" role="form">
				<div class="row">
					<div class="col-6">

						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title"><b> R E M I T E N T E</b></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>

							</div>
							<div class="card-body">

								<?php $fechahoy = date('Y-m-d'); ?>

								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">NÚMERO DE OFICIO</label>
									<input type="text" name="r_n_oficio" id="lastname" class="form-control" placeholder="INGRESA EL NUMERO DE OFICIO" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA DE ELABORACIÓN DEL OFICIO</label>
									<input type="date" name="r_f_e_oficio" id="name" class="form-control" placeholder="DD/MM/AAAA" max="<?= $fechahoy ?>" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA DE RECEPCION DEL OFICIO</label>
									<input type="date" name="r_f_r_oficio" id="name" class="form-control" placeholder="DD/MM/AAAA" max="<?= $fechahoy ?>" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA DE ATENCION</label>
									<input type="date" name="r_f_atencion" id="name" class="form-control" placeholder="DD/MM/AAAA" max="<?= $fechahoy ?>" required>

								</div>
								<div class="col-md-12 mb-3">
									<label>S O L I C I T U D </label>
									<textarea class="form-control" rows="3" name="r_solicitud" placeholder="INGRESE LA SOLICITUD"></textarea>
								</div>

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



							</div>
						</div>

						<!-- /.card -->

					</div>
					<div class="col-6">
						<div class="card card-secondary">
							<div class="card-header">
								<h3 class="card-title"><b>D E S T I N A T A R I O</b></h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">


								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">NUMERO DE REGISTRO</label>
									<input type="text" name="d_n_registro" id="name" class="form-control" placeholder="INGRESE EL AREA A TURNAR" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">NUMERO DE FOLIO</label>
									<input type="text" name="d_n_folio" id="name" class="form-control" placeholder="INGRESE EL AREA A TURNAR" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA COMPROMISO</label>
									<input type="date" name="d_f_compromiso" id="name" class="form-control" placeholder="DD/MM/AAAA" min="<?= $fechahoy ?>" required>

								</div>

								<div class="col-md-12 mb-3">
									<label>I N S T R U C C I O N E S</label>
									<textarea class="form-control" rows="3" name="d_instrucciones" placeholder="INGRESE LAS INSTRUCCIONES"></textarea>
								</div>


								<div class="col-md-12 mb-3">
									<label for="exampleInputFile">Ingrese el Archivo</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="filename" id="exampleInputFile" lang="es">
											<label class="custom-file-label" for="exampleInputFile">Seleccionar Archivo</label>
										</div>
										<div class="input-group-append">
											<span class="input-group-text">Subir</span>
										</div>
									</div>
								</div>
								<!-- <div class="col-md-12">
									<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Agregar</button>
									<a href="./?view=docus&opt=all" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
								</div> -->


							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>

				</div>
				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Agregar</button>
						<a href="./?view=docus&opt=all" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
						<div><br></div>

					</div>
				</div>
			</form>
		</div>


	</section>

	<!-- seccion para modificar los documentos registrados	 -->
<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "edit") :
	$con = DocusData::getById($_GET["id"]);
?>
	<section class="content">
		<div class="container-fluid">
			<form method="post" action="./?action=docus&opt=update" enctype="multipart/form-data" role="form">
				<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
				<div class="row">

					<div class="col-6">

						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title"><b> R E M I T E N T E</b></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>

							</div>
							<div class="card-body">

								<?php $fechahoy = date('Y-m-d'); ?>

								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">NÚMERO DE OFICIO</label>
									<input type="text" name="r_n_oficio" id="lastname" class="form-control" value="<?php echo $con->r_n_oficio; ?>" placeholder="INGRESA EL NUMERO DE OFICIO" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA DE ELABORACIÓN DEL OFICIO</label>
									<input type="date" name="r_f_e_oficio" id="name" class="form-control" value="<?php echo $con->r_f_e_oficio; ?>" placeholder="DD/MM/AAAA" max="<?= $fechahoy ?>" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA DE RECEPCION DEL OFICIO</label>
									<input type="date" name="r_f_r_oficio" id="name" class="form-control" value="<?php echo $con->r_f_r_oficio; ?>" placeholder="DD/MM/AAAA" max="<?= $fechahoy ?>" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA DE ATENCION</label>
									<input type="date" name="r_f_atencion" id="name" class="form-control" value="<?php echo $con->r_f_atencion; ?>" placeholder="DD/MM/AAAA" max="<?= $fechahoy ?>" required>

								</div>
								<div class="col-md-12 mb-3">
									<label>S O L I C I T U D </label>
									<textarea class="form-control" rows="3" name="r_solicitud" placeholder="INGRESE LA SOLICITUD"><?php echo $con->r_solicitud; ?></textarea>
								</div>

								<div class="col-md-12 mb-3">
									<label for="exampleInputFile">OFICIO ESCANEADO</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="r_filename" id="exampleInputFile" lang="es">
											<label class="custom-file-label" for="exampleInputFile"><?php echo $con->r_filename;
																									?></label>
										</div>
										<div class="input-group-append">
											<span class="input-group-text">Subir</span>
										</div>
									</div>
								</div>



							</div>
						</div>

						<!-- /.card -->

					</div>
					<div class="col-6">
						<div class="card card-secondary">
							<div class="card-header">
								<h3 class="card-title"><b>D E S T I N A T A R I O</b></h3>

								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
							</div>
							<div class="card-body">


								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">NUMERO DE REGISTRO</label>
									<input type="text" name="d_n_registro" id="name" class="form-control" value="<?php echo $con->d_n_registro; ?>" placeholder="INGRESE EL AREA A TURNAR" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">NUMERO DE FOLIO</label>
									<input type="text" name="d_n_folio" id="name" class="form-control" value="<?php echo $con->d_n_folio; ?>" placeholder="INGRESE EL AREA A TURNAR" required>

								</div>
								<div class="col-md-12 mb-3">
									<label for="name" class="form-label">FECHA COMPROMISO</label>
									<input type="date" name="d_f_compromiso" id="name" class="form-control" value="<?php echo $con->d_f_compromiso; ?>" placeholder="DD/MM/AAAA" min="<?= $fechahoy ?>" required>

								</div>

								<div class="col-md-12 mb-3">
									<label>I N S T R U C C I O N E S</label>
									<textarea class="form-control" rows="3" name="d_instrucciones" placeholder="INGRESE LAS INSTRUCCIONES"><?php echo $con->d_instrucciones; ?></textarea>
								</div>


								<div class="col-md-12 mb-3">
									<label for="exampleInputFile">Ingrese el Archivo</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="filename" id="exampleInputFile" lang="es">
											<label class="custom-file-label" for="exampleInputFile"><?php echo $con->filename; ?></label>
										</div>
										<div class="input-group-append">
											<span class="input-group-text">Subir</span>
										</div>
									</div>
								</div>
								<!-- <div class="col-md-12">
									<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Agregar</button>
									<a href="./?view=docus&opt=all" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
								</div> -->


							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>

				</div>
				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-success">Actualizar</button>
						<!-- <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Editar</button> -->
						<a href="./?view=docus&opt=all" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
						<div><br></div>

					</div>
				</div>
			</form>
		</div>
	</section>
<?php
elseif (isset($_GET["opt"]) && $_GET["opt"] == "allP") :
	$contacts = DocusData::getAllP();
?>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">

					<div class="card">
						<div class="card-header">
							<h1 class=""><b>D O C U M E N T O S </b><?php //echo $gerencia; 
																	?></h1>
							<a href="./?view=tester&opt=new" class="btn btn-primary">R E G I S T R A R</a>
						</div>
						<div class="card-body">
							<?php if (count($contacts) > 0) : ?>
								<div>
									<table class="table table-striped table-bordered table-hover datatable responsive">
										<thead>
											<th>N. Oficio</th>
											<th>F. Elaboracion</th>
											<th>F. Recepcion</th>
											<th>F. Atencion</th>
											<th>Solicitud</th>
											<th>N. Registro</th>
											<th>N. Folio</th>
											<th>Estado</th>
											<th>Dias Faltantes</th>


											<th>Acciones</th>
										</thead>
										<?php foreach ($contacts as $con) :
											$item  = $con->getClasificaciones();
											//$usuario  = $con->getRegistro(); 
										?>
											<tr>
												<td><b>
														<?php echo $con->r_n_oficio; ?>
													</b>
												</td>
												<td><?php echo $con->r_f_e_oficio; ?></td>
												<td><?php echo $con->r_f_r_oficio; ?></td>
												<td><?php echo $con->r_f_atencion; ?></td>
												<td><?php echo $con->r_solicitud; ?></td>
												<td><?php echo $con->d_n_registro; ?></td>
												<td><?php echo $con->d_n_folio; ?></td>



												<td><b>
														<?php if ($item->id == 1) :  ?>
															<span class="badge bg-danger"><?php echo $item->name; ?></span>
														<?php elseif ($item->id == 2) : ?>
															<span class="badge bg-success"><?php echo $item->name; ?></span>
														<?php else : ?>
															<span class="badge bg-warning"><?php echo $item->name; ?></span>
														<?php endif; ?>
													</b>
												</td>

												<td>
													<b>

														<?php

														$now = strtotime($con->d_f_compromiso);
														$date = strtotime($con->r_f_atencion);

														$diff_in_days = floor(($now - $date) / (60 * 60 * 24));
														echo $diff_in_days . ' Dias';

														?>
													</b>

												</td>





												<td style="width:190px; ">
													<a href="./?view=documentos&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
													<a href="./?action=documentos&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
													<script type="text/javascript">
														$("#item-<?php echo $con->id; ?>").click(function(e) {
															e.preventDefault();
															x = confirm("Seguro desea eliminar este elemento?");
															if (x) {
																window.location = "./?action=documentos&opt=del&id=<?php echo $con->id; ?>";
															}
														});
													</script>
												</td>
											</tr>
										<?php endforeach; ?>
									</table>
								</div>

							<?php else : ?>
								<p class="alert alert-warning">No hay Documentos registrados.</p>
							<?php endif; ?>
						</div>


					</div>

				</div>
			</div>
		</div>
	</section>
<?php endif; ?>