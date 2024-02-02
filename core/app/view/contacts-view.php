
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
$contacts = PersonData::getAll();
	?>
	

    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Interrupciones</h1>
									<a href="./?view=contacts&opt=new" class="btn btn-secondary">Nueva Interrupcion</a>
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
													<td><?php echo $con->name." ".$con->lastname; ?></td>
													<td><?php echo $con->address; ?></td>
													<td><?php echo $con->phone; ?></td>
													<td><?php echo $con->email; ?></td>
													<td><?php echo $con->name." ".$con->lastname; ?></td>
													<td><?php echo $con->address; ?></td>
													<td><?php echo $con->phone; ?></td>
													<td><?php echo $con->email; ?></td>
													<td><?php echo $con->email; ?></td>
													<td style="width:190px; ">
														<a href="./?view=contacts&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
														<a href="./?action=contacts&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
														<script type="text/javascript">
															$("#item-<?php echo $con->id; ?>").click(function(e){
																e.preventDefault();
																x = confirm("Seguro desea eliminar este elemento?");
																if(x){
																	window.location = "./?action=contacts&opt=del&id=<?php echo $con->id; ?>";
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
									<a href="./?view=contacts&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
								</div>
								<div class="card-body">

									<form class="row g-3" method="post" action="./?action=contacts&opt=add">
									<div class="col-md-6 mb-3">
										<label for="name" class="form-label">Fecha</label>
										<input type="date" name="name" id="name" class="form-control" placeholder="dd/mm/aaaa" required>
										
									</div>
									<div class="col-md-6 mb-3">
										<label for="area_atencion" class="form-label">Area de Atencion</label>
												<?php
													$cats = KindData::getAll();
												?>
												<?php if(count($cats)>0):?>
													<select name="kind_id" class="form-control" required>
														<option value="">-- Area de Atencion --</option>
													<?php foreach($cats as $cat):?>
														<option value="<?=$cat->id;?>"><?=$cat->name;?></option>
												<?php endforeach;?>
												</select>
												<?php endif;?>
									</div> 
									<div class="col-md-6 mb-3">
										<label for="lastname" class="form-label">Linea</label>
										<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Apellidos" required >
									</div>
									<div class="col-md-6 mb-3">
										<label for="exampleInputEmail1" class="form-label">Numero de Tren</label>
										<input type="text" name="address" id="address" class="form-control" placeholder="Numero de Tren"  required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="exampleInputEmail1" class="form-label">Motriz </label>
										<input type="email" name="email" class="form-control" placeholder="Email" required>

									</div>
									<div class="col-md-6 mb-3">
										<label for="exampleInputEmail1" class="form-label">Evento</label>
										<input type="text" name="phone" id="phone" class="form-control" placeholder="Tipo de Evento"  required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="exampleInputEmail1" class="form-label">Retardo en Minutos</label>
										<input type="text" name="phone" id="phone" class="form-control" placeholder="Tipo de Evento"  required>
									</div>
									<div class="col-md-6 mb-3">
										<label for="area_atencion" class="form-label">Area de Atencion</label>
												<?php
													$cats = KindData::getAll();
												?>
												<?php if(count($cats)>0):?>
													<select name="kind_id" class="form-control" required>
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
$con = PersonData::getById($_GET["id"]);
	?>
    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Editar Contacto</h1>
									<a href="./?view=contacts&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
								</div>
								<div class="card-body">

<form method="post" action="./?action=contacts&opt=update">
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

