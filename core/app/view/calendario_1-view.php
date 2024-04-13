<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Calendario</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Calendario</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<?php
$contacts = IdoAllData::getAll(); ?>

<?php
function mostrarTabla($contacts)
{
  if (count($contacts) > 0) {
    echo '<div class="table-responsive">
                <table class="table table-striped table-bordered table-hover datatable" style="width:100%">
                    <thead>
                        <th>Linea</th>
                        <th>Hora</th>
                        <th>Descripcion</th>
                        <th>Retardo</th>
                        <th>V. Perdidas</th>
                        <th>Acciones</th>
                    </thead>';
    foreach ($contacts as $con) {
      echo '<tr>
                    <td>' . $con->linea . '</td>
                    <td>' . $con->hora . '</td>
                    <td>' . $con->descripcion . '</td>
                    <td>' . $con->retardo . '</td>
                    <td><b>' . $con->vueltas . '</b></td>
                    <td style="width:200px;">
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal_' . $con->id . '">
                            <i class="fa fa-edit"></i> Clasificar
                        </button>
                        <a href="./?action=idoall&opt=del&id=' . $con->id . '" id="item-' . $con->id . '" class="btn btn-danger btn-sm" onclick="fntDelPersona(1)"><i class="fa fa-trash"></i> Eliminar</a>
                    </td>
                </tr>';
    }
    echo '</table>
            </div>';
    foreach ($contacts as $con) {
      echo '<div class="modal fade" id="editModal_' . $con->id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Clasificar Averia</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="addproduct" action="./?action=idoall&opt=update" role="form">
                                    <input type="hidden" name="_id" value="' . $con->id . '">
                                    <div class="form-group">
                                        <label for="inputEmail1">Categoria</label>
                                        <input type="text" name="clasificacion" value="' . $con->clasificacion . '" class="form-control" id="name" placeholder="Categoria">
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
                </div>';
    }
  } else {
    echo '<p class="alert alert-warning">No hay Areas.</p>';
  }
}

// Uso:
$contacts = IdoAllData::getAll();
//mostrarTabla($contacts);
?>





<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Linea 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Linea 2</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Linea 3</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Linea 4</a>
                </li>
              </ul>
            </div>
            <div class="card-body">


              <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                  <?php

                  if (count($contacts) > 0) : ?>
                    <div>
                      <table class="table table-striped table-bordered table-hover datatable  ">
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
                              <!-- <a href="./?view=idoall&opt=edit&id=<?php //echo $con->id; 
                                                                        ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a> -->
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
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                  <?php
                  //$contacts = IdoAllData::getAll();
                  mostrarTabla($contacts);
                  ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                  Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                </div>
                <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                  Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.

                  <?php
                  // $contacts = IdoAllData::getAll();
                  if (count($contacts) > 0) : ?>
                    <div>
                      <table class="table table-striped table-bordered table-hover datatable  ">
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
                              <!-- <a href="./?view=idoall&opt=edit&id=<?php //echo $con->id; 
                                                                        ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a> -->
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
            <!-- /.card -->
          </div>
        </div>

      </div>
      <!-- /.col -->

      <!-- /.col -->
    </div>


    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->