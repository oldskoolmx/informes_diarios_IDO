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
<?php //if(isset($_GET["opt"]) && $_GET["opt"]=="all"): 
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
									Contenido del panel...
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
													<td><?php echo $user->id_gerencia; ?></td>
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