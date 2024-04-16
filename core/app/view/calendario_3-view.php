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
function generarTabla($contacts)
{
  $tabla = '';
  if (count($contacts) > 0) {
    $tabla .= '<div class="table-responsive">
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
      $tabla .= '<tr>
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
    $tabla .= '</table>
                </div>';
  } else {
    $tabla .= '<p class="alert alert-warning">No hay Areas.</p>';
  }
  return $tabla;
}

function generarContenidoPestanas()
{
  $contenidoPestanas = '';
  // Pestaña Linea 1
  $linea1Contacts = IdoAllData::getAllL(1);
  $contenidoPestanas .= '<div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">';
  $contenidoPestanas .= generarTabla($linea1Contacts);
  $contenidoPestanas .= '</div>';

  // Pestaña Linea 2
  $linea2Contacts = IdoAllData::getAllL(2);
  $contenidoPestanas .= '<div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">';
  $contenidoPestanas .= generarTabla($linea2Contacts);
  // Puedes agregar contenido adicional aquí, como otra tabla o cualquier otro elemento HTML
  $contenidoPestanas .= '</div>';

  // Pestaña Linea 3
  $linea3Contacts = IdoAllData::getAllL(3);
  $contenidoPestanas .= '<div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">';
  $contenidoPestanas .= generarTabla($linea3Contacts);
  // Puedes agregar contenido adicional aquí, como otra tabla o cualquier otro elemento HTML
  $contenidoPestanas .= '</div>';
  // Pestaña Linea 4


  return $contenidoPestanas;
}

// Uso:
$contenidoPestanas = generarContenidoPestanas();
?>

<div class="container mt-5">
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
  </ul>
  <div class="tab-content" id="custom-tabs-three-tabContent">
    <?php echo $contenidoPestanas; ?>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings2" data-toggle="tab">Settings 2</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <?php echo $contenidoPestanas; ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-danger">
                      10 Feb. 2014
                    </span>
                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-envelope bg-primary"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                      </div>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-user bg-info"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                      <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-comments bg-warning"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                      </div>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-success">
                      3 Jan. 2014
                    </span>
                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                      </div>
                    </div>
                  </div>
                  <!-- END timeline item -->
                  <div>
                    <i class="far fa-clock bg-gray"></i>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName2" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="settings2">
                <?php echo $contenidoPestanas; ?>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>