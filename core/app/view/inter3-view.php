
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
$contacts = InterData::getAll();
	?>
	

    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Interrupciones</h1>
									<a href="./?view=inter&opt=new" class="btn btn-secondary">Nueva Interrupcion</a>
								</div>
								<div class="card-body">
									<?php if(count($contacts)>0):?>
										<div>
										<table class="table table-striped table-bordered datatable ">
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
												<th>Acciones</th>
											</thead>
											<?php foreach($contacts as $con):?>
												<tr>
													<td><?php echo $con->fecha; ?></td>
													<td><?php echo $con->id_linea; ?></td>
													<td><?php echo $con->tren; ?></td>
													<td><?php echo $con->modelo; ?></td>
													<td><?php echo $con->motriz; ?></td>
													<td><?php echo $con->evento; ?></td>
													<td><?php echo $con->retardo; ?></td>
													<td><?php echo $con->clasificacion; ?></td>
													<td><?php echo $con->id_area; ?></td>
													<td style="width:190px; ">
														<a href="./?view=inter&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
														<a href="./?action=inter&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
														<script type="text/javascript">
															$("#item-<?php echo $con->id; ?>").click(function(e){
																e.preventDefault();
																x = confirm("Seguro desea eliminar este elemento?");
																if(x){
																	window.location = "./?action=inter&opt=del&id=<?php echo $con->id; ?>";
																}
															});
														</script>
													</td>
												</tr>
											<?php endforeach ;?>
										</table>
									</div>

									<?php else:?>
										<p class="alert alert-warning">No hay Interrupciones registradas.</p>
									<?php endif;?>
								</div>

								
							</div>

						</div>
					</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Nueva Interrupcion</h1>
									<a href="./?view=inter&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
								</div>
								<div class="card-body">

									<form class="row g-3" method="post" action="./?action=inter&opt=add">
									<div class="col-md-6 mb-3">
										<label for="name" class="form-label">Fecha</label>
										<input type="date" name="Fecha" id="name" class="form-control" placeholder="DD/MM/AAAA" required>
										
									</div>
									<div class="col-md-6 mb-3">
										<label for="area_atencion" class="form-label">Linea</label>
												<?php
													$cats = CategoryData::getAll();
												?>
												<?php if(count($cats)>0):?>
													<select name="Linea_id" class="form-control" required>
														<option value="">-- Seleccione la Linea --</option>
													<?php foreach($cats as $cat):?>
														<option value="<?=$cat->id;?>"><?=$cat->name;?></option>
												<?php endforeach;?>
												</select>
												<?php endif;?>
									</div> 
									<div class="col-md-6 mb-3">
										<label for="lastname" class="form-label">Numero de Tren</label>
										<input type="text" name="Tren" id="lastname" class="form-control" placeholder="Numero de TREN" required >
									</div>
									<div class="col-md-6 mb-3">
										<label for="exampleInputEmail1" class="form-label">Modelo</label>
										<input type="text" name="Modelo" id="address" class="form-control" placeholder="Modelo de TREN"  required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="exampleInputEmail1" class="form-label">Motriz </label>
										<input type="text" name="Motriz" class="form-control" placeholder="Numero de MOTRIZ" required>

									</div>
									<div class="col-md-6 mb-3">
										<label for="area_atencion" class="form-label">Tipo de Evento</label>
												<?php
													$cats = EventosData::getAll();
												?>
												<?php if(count($cats)>0):?>
													<select name="Evento_id" class="form-control" required>
														<option value="">-- Seleccione el Evento --</option>
													<?php foreach($cats as $cat):?>
														<option value="<?=$cat->id;?>"><?=$cat->name;?></option>
												<?php endforeach;?>
												</select>
												<?php endif;?>
									</div> 
									<div class="col-md-6 mb-3">
										<label for="exampleInputEmail1" class="form-label">Retardo en Minutos</label>
										<input type="text" name="Retardo" id="phone" class="form-control" placeholder="Numero de Minutos"  required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="area_atencion" class="form-label">Area de Atencion</label>
												<?php
													$cats = AreasData::getAll();
												?>
												<?php if(count($cats)>0):?>
													<select name="Area_id" class="form-control" required>
														<option value="">-- Area de Atencion --</option>
													<?php foreach($cats as $cat):?>
														<option value="<?=$cat->id;?>"><?=$cat->name;?></option>
												<?php endforeach;?>
												</select>
												<?php endif;?>
									</div> 
									<div class="col-md-12">
									<button type="submit" class="btn btn-primary">Agregar</button>
									</div>
									</form>
								</div>
							</div>

						</div>
					</div>
</div>
</section>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$con = InterData::getById($_GET["id"]);
	?>
    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Editar Contacto</h1>
									<a href="./?view=inter&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
								</div>
								<div class="card-body">

<form method="post" action="./?action=inter&opt=update">
	<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
  <div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control" value="<?php echo $con->name; ?>" id="name" placeholder="Nombre">
  </div>
  <div class="mb-3">
    <label for="lastname" class="form-label">Apellidos</label>
    <input type="text" name="lastname" id="lastname" class="form-control"  value="<?php echo $con->lastname; ?>" placeholder="Apellidos" >
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Direccion</label>
    <input type="text" name="address" id="address" class="form-control" value="<?php echo $con->address; ?>" placeholder="Direccion" >
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email </label>
    <input type="email" name="email" class="form-control" value="<?php echo $con->email; ?>" placeholder="Email">

  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Telefono</label>
    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $con->phone; ?>" placeholder="Telefono" >
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

