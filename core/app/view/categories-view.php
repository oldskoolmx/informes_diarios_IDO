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
<?php if(isset($_GET["opt"]) && $_GET["opt"]=="all"):
$contacts = CategoryData::getAll();
	?>
    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Lineas</h1> <?php $prueba = Core::$user->name; echo $prueba;?>
									<a href="./?view=categories&opt=new" class="btn btn-secondary">Nueva Linea</a>
								</div>
								<div class="card-body">
									<?php if(count($contacts)>0):?>
										<div>
										<table class="table table-bordered datatable">
											<thead>
												<th>Linea</th>
												<th>Gerencias</th>
												<th>Acciones</th>
											</thead>
											<?php foreach($contacts as $con):
												$item  = $con->getItem();
												?>
												<tr>
													<td><?php echo $con->name; ?></td>
													<td><?php echo $item->name; ?></td>

													<td style="width:200px; ">
														<a href="./?view=categories&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
														<a href="./?action=categories&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
														<script type="text/javascript">
															$("#item-<?php echo $con->id; ?>").click(function(e){
																e.preventDefault();
																x = confirm("Seguro desea eliminar este elemento?");
																if(x){
																	window.location = "./?action=categories&opt=del&id=<?php echo $con->id; ?>";
																}
															});
														</script>
													</td>
												</tr>
											<?php endforeach ;?>
										</table>
									</div>

									<?php else:?>
										<p class="alert alert-warning">No hay Lineas.</p>
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
									<h1 class="">Nueva Linea</h1>
									<a href="./?view=categories&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
								</div>
								<div class="card-body">

<form method="post" action="./?action=categories&opt=add">
  <div class="mb-3">
    <label for="name" class="form-label">Linea</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="Ingresa la Linea" required>
  </div>
  <div class="col-md-12 mb-3">
										<label for="area_atencion" class="form-label">Gerencia</label>
												<?php
													$cats = GerenciasData::getAll();
												?>
												<?php if(count($cats)>0):?>
													<select name="Gerencia_id" class="form-control" required>
														<option value="">-- Seleccione la Gerencia --</option>
													<?php foreach($cats as $cat):?>
														<option value="<?=$cat->id;?>"><?=$cat->name;?></option>
												<?php endforeach;?>
												</select>
												<?php endif;?>
									</div> 


  <button type="submit" class="btn btn-primary">Agregar</button>
</form>
								</div>
							</div>

						</div>
					</div>
</div>
</section>

<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$con = CategoryData::getById($_GET["id"]);
	?>
    <section class="content">
      <div class="container-fluid">
					<div class="row">
						<div class="col-12">

							<div class="card">
								<div class="card-header">
									<h1 class="">Editar Linea</h1>
									<a href="./?view=categories&opt=all" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Regresar</a>
								</div>
								<div class="card-body">

<form method="post" action="./?action=categories&opt=update">
	<input type="hidden" name="_id" value="<?php echo $con->id; ?>">
  <div class="mb-3">
    <label for="name" class="form-label">Linea</label>
    <input type="text" name="name" class="form-control" value="<?php echo $con->name; ?>" id="name" placeholder="Ingresa la Linea" required>
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

