
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
<?php if(isset($_GET["opt"]) && $_GET["opt"]=="all"):

//$grupo=$_GET["g"];
$contacts = InterData::getAll();

	?>
	

    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Reportes </h1>
									<!-- <a href="./?view=inter&opt=new" class="btn btn-secondary">Nueva Interrupcion</a> -->
									
								</div>
								<div class="card-body">
									
									<div class="row">
										<div class="col-lg-6">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">Inicio
													</span>
													
												</div>
												<input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
											</div>
											<!-- /input-group -->
										</div>
										<!-- /.col-lg-6 -->
										<div class="col-lg-6">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">Fin
													</span>
													
												</div>
												<input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
											</div><!-- /input-group -->
										</div>
										<div class="col-lg-3 mb-3">
										<a href="./?view=report&opt=new" class="btn btn-secondary">Procesar</a><!-- /input-group -->
										</div>
										<!-- /.col-lg-6 -->
									</div>
									<!-- /.row -->
		<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):
									
										if(isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){
											$users = OperationData::getByRange($_GET["start_at"],$_GET["finish_at"]);
												if(count($users)>0){
													// si hay usuarios
													//$_SESSION["report_data"] = $users;
													?>
													<div class="panel panel-default">
													<div class="panel-heading">
													Reportes</div>
													<table class="table table-bordered table-hover">
													<thead>
													<th>Ejemplar</th>
													<th>Titulo</th>
													<th>Cliente</th>
													<th>Fecha</th>
													</thead>
													<?php
													$total = 0;
													foreach($users as $user){
														$item  = $user->getItem();
														$client  = $user->getClient();
														$book = $item->getBook();
														?>
														<tr>
														<td><?php echo $item->code; ?></td>
														<td><?php echo $book->title; ?></td>
														<td><?php echo $client->name." ".$client->lastname; ?></td>
														<td><?php echo $user->returned_at; ?></td>
														</tr>
														<?php

													}
													echo "</table>";
													?>
													<?php
												}else{
													echo "<p class='alert alert-danger'>No hay datos.</p>";
												}
												}else{
													echo "<p class='alert alert-danger'>Debes seleccionar un rango de fechas.</p>";
												}


									?>	
								
								

								</div>

								
							</div>

						</div>
					</div>
</div>
</section>


<?php endif; ?>

