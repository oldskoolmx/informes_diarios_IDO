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

  // Generar pestañas para cada línea
  for ($i = 1; $i <= 12; $i++) {
    if ($i == 10) {
      $linea = 'A';
    } elseif ($i == 11) {
      $linea = 'B';
    } else {
      $linea = $i;
    }

    $lineaContacts = IdoAllData::getAllL($linea);
    $tabId = "linea" . $linea;
    $tabLabel = "Linea " . $linea;

    $contenidoPestanas .= '<div class="tab-pane fade' . ($i == 1 ? ' show active' : '') . '" id="' . $tabId . '" role="tabpanel" aria-labelledby="' . $tabId . '-tab">';
    $contenidoPestanas .= generarTabla($lineaContacts);
    $contenidoPestanas .= '</div>';
  }


  return $contenidoPestanas;
}

// Uso:
$contenidoPestanas = generarContenidoPestanas();
?>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">

            <h1 class=""><b>I D O </b> | Informes Diarios de Operacion</h1>
            <?php $prueba = Core::$user->name;
            echo $prueba;

            ?>
            <a href="./?view=idos_clasificados&opt=all" class="btn btn-primary">Clasificados</a>
          </div>



          <div class="card-body">
            <div class="container mt-2">
              <?php
              $usuario = Core::$user->gerencias;
              echo $usuario;
              ?>
              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                  if ($i == 10) {
                    $linea = 'A';
                  } elseif ($i == 11) {
                    $linea = 'B';
                  } else {
                    $linea = $i;
                  }

                  // Condiciones para mostrar las pestañas según el valor de $usuario
                  if ($usuario == 1 && in_array($linea, [1, 3, 4, 12])) {
                    $mostrar = true;
                  } elseif ($usuario == 2 && in_array($linea, [2, 5, 6, 'B'])) {
                    $mostrar = true;
                  } elseif ($usuario == 4) {
                    $mostrar = true;
                  } else {
                    $mostrar = false;
                  }

                  if ($mostrar) {
                ?>
                    <li class="nav-item">
                      <a class="nav-link<?php echo ($i == 1 ? ' active' : ''); ?>" id="linea<?php echo $linea; ?>-tab" data-toggle="pill" href="#linea<?php echo $linea; ?>" role="tab" aria-controls="linea<?php echo $linea; ?>" aria-selected="<?php echo ($i == 1 ? 'true' : 'false'); ?>">Linea <?php echo $linea; ?></a>
                    </li>
                <?php
                  }
                }
                ?>
              </ul>
              <div class="tab-content mt-4" id="custom-tabs-three-tabContent">
                <?php echo $contenidoPestanas; ?>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="container mt-2">
              <?php
              $usuario = Core::$user->gerencias;
              echo $usuario;

              // Definir qué pestañas mostrar según el valor de $usuario
              $pestanasMostrar = [];
              if ($usuario == 1) {
                $pestanasMostrar = [1, 3, 4, 12];
              } elseif ($usuario == 2) {
                $pestanasMostrar = [2, 5, 6, 'B'];
              } elseif ($usuario == 4) {
                $pestanasMostrar = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 12];
              }
              ?>

              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <?php
                $primeraPestana = true; // Marcar la primera pestaña visible como activa

                foreach ($pestanasMostrar as $linea) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link<?php echo ($primeraPestana ? ' active' : ''); ?>" id="linea<?php echo $linea; ?>-tab" data-toggle="pill" href="#linea<?php echo $linea; ?>" role="tab" aria-controls="linea<?php echo $linea; ?>" aria-selected="<?php echo ($primeraPestana ? 'true' : 'false'); ?>">Linea <?php echo $linea; ?></a>
                  </li>
                <?php
                  $primeraPestana = false; // Solo la primera pestaña visible debe ser activa
                }
                ?>
              </ul>

              <div class="tab-content mt-4" id="custom-tabs-three-tabContent">
                <?php
                $primeraPestana = true; // Resetear para el contenido de las pestañas

                foreach ($pestanasMostrar as $linea) {
                ?>
                  <div class="tab-pane fade show<?php echo ($primeraPestana ? ' active' : ''); ?>" id="linea<?php echo $linea; ?>" role="tabpanel" aria-labelledby="linea<?php echo $linea; ?>-tab">
                    <?php echo $contenidoPestanas; ?>
                  </div>
                <?php
                  $primeraPestana = false; // Solo la primera pestaña visible debe ser activa
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