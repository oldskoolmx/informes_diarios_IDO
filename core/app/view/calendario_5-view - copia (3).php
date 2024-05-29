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

  if (count($contacts) > 0) :
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
    foreach ($contacts as $con) :
      $areas = $con->getItem();
      $averias = $con->getItem2();
      $tabla .= '<tr>
                            <td>' . $con->linea . '</td>
                            <td>' . $con->hora . '</td>
                            <td>';
      if ($con->clasificacion == 33) {
        $tabla .= $con->descripcion . " <span class='badge bg-danger'> Sin clasificar </span>";
      } else {
        $tabla .= $con->descripcion . " " . "<span class='badge bg-success'>" . $areas->name . "</span>" . " " . "<span class='badge bg-primary'>" . $averias->name . "</span>";
      }
      $tabla .= '</td>
                            <td>' . $con->retardo . '</td>
                            <td><b>' . $con->vueltas . '</b></td>
                            <td style="width:200px;">
                                
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal' . $con->id . '">
														        <i class="fa fa-edit"></i> Clasificar
													      </button>
                                <a href="./?action=idoall&opt=del&id=' . $con->id . '" id="item-' . $con->id . '" class="btn btn-danger btn-sm" onclick="fntDelPersona(1)"><i class="fa fa-trash"></i> Eliminar</a>
                            </td>
                        </tr>';
    endforeach;
    $tabla .= '</table>
                    </div>';
    foreach ($contacts as $con) :

      $tabla .= '<div class="modal fade" id="editModal' . $con->id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Clasificar Averia</h4>
          </div>
          <div class="modal-body">
            <form method="post" id="addproduct_' . $con->id . '" action="./?action=idoall&opt=updateLyF" role="form">
              <input type="hidden" name="_id" value="' . $con->id . '">

              <!-- primer combobox para seleccionar el area -->
              <div class="form-group">
                <label>Area Imputable</label>
                <select name="client_id" id="client_id_' . $con->id . '" required class="form-control">
                  <option value="">-- SELECCIONE AREA --</option>';
      foreach (AreasturData::getAll() as $cli) :
        $tabla .= '<option value="' . $cli->id . '">' . $cli->name . '</option>';
      endforeach;

      $tabla .= '</select>
              </div>
              <div class="form-group">
                <label>Tipo de Averia</label>
                <select name="item_id" id="item_id_' . $con->id . '" required class="form-control">
                </select>
              </div>
              <script type="text/javascript">
                jQuery(document).ready(function() {
                  jQuery("#client_id_' . $con->id . '").change(function() {
                    jQuery.get("./?action=getitems", "client_id=" + jQuery(this).val(), function(data) {
                      console.log(data);
                      jQuery("#item_id_' . $con->id . '").html(data);
                    });
                  });
                  jQuery("#item_id_' . $con->id . '").change(function() {
                    var selectedValue = jQuery(this).val();
                    jQuery("#name_' . $con->id . '").val(selectedValue);
                  });
                });
              </script>

              <div class="form-group">
                <label for="name_' . $con->id . '">Clasificacion</label>
                <input type="text" name="clasificacion" value="' . $con->clasificacion . '" class="form-control" id="name_' . $con->id . '" placeholder="Categoria" disabled>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">C L A S I F I C A R</button>
              </div>
            </form>

            <script type="text/javascript">
              jQuery(document).ready(function() {
                // Captura el evento de envío del formulario
                jQuery("#addproduct_' . $con->id . '").submit(function() {
                  // Habilita el input antes de enviar el formulario
                  jQuery("#name_' . $con->id . '").prop("disabled", false);
                });
              });
            </script>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>';

    endforeach;

  else :
    $tabla .= '<p class="alert alert-warning">No hay Areas.</p>';
  endif;
  return $tabla;
}

function generarContenidoPestanas($usuario)
{
  $contenidoPestanas = '';

  // Definir las pestañas que se mostrarán según el valor de $usuario
  $pestanasMostrar = [];
  if ($usuario == 1) {
    $pestanasMostrar = [1, 3, 4, 12];
  } elseif ($usuario == 2) {
    $pestanasMostrar = [2, 5, 6, 'B'];
  } elseif ($usuario == 3) {
    $pestanasMostrar = [7, 8, 9, 'A'];
  } elseif ($usuario == 4) {
    $pestanasMostrar = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 12];
  }

  foreach ($pestanasMostrar as $index => $linea) {
    $lineaContacts = IdoAllData::getAllLyF($linea, $_GET["fecha"]);
    $tabId = "linea" . $linea;
    $tabLabel = "Linea " . $linea;

    $contenidoPestanas .= '<div class="tab-pane fade' . ($index == 0 ? ' show active' : '') . '" id="' . $tabId . '" role="tabpanel" aria-labelledby="' . $tabId . '-tab">';
    $contenidoPestanas .= generarTabla($lineaContacts);
    $contenidoPestanas .= '</div>';
  }

  return $contenidoPestanas;
}

$usuario = Core::$user->gerencias;
$contenidoPestanas = generarContenidoPestanas($usuario);
?>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h1 class=""><b>I D O </b> | Informes Diarios de Operacion</h1>
            <?php echo Core::$user->name;
            echo $fecha = $_GET["fecha"]; ?>
            <a href="./?view=idos_clasificados&opt=all" class="btn btn-primary">Clasificados</a>
          </div>
          <div class="card-body">
            <div class="container mt-2">
              <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <?php
                $pestanasMostrar = [];
                if ($usuario == 1) {
                  $pestanasMostrar = [1, 3, 4, 12];
                } elseif ($usuario == 2) {
                  $pestanasMostrar = [2, 5, 6, 'B'];
                } elseif ($usuario == 3) {
                  $pestanasMostrar = [7, 8, 9, 'A'];
                } elseif ($usuario == 4) {
                  $pestanasMostrar = [1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 12];
                }
                // Función para obtener el nombre de la imagen
                function obtenerNombreImagen($linea)
                {
                  return is_numeric($linea) ? 'L' . $linea : 'L' . strtoupper($linea);
                }


                $primeraPestana = true; // Marcar la primera pestaña visible como activa

                foreach ($pestanasMostrar as $linea) {
                  $nombreImagen = obtenerNombreImagen($linea);
                  $imagenSrc = "dist/img/{$nombreImagen}.png";
                  // prueba para saber el tab
                  $currentTab = isset($_GET['tab']) ? $_GET['tab'] : '';
                ?>
                  <li class="nav-item">
                    <a class="nav-link<?php echo ($primeraPestana ? ' active' : ''); ?>" id="linea<?php echo $linea; ?>-tab" data-toggle="pill" href="#linea<?php echo $linea; ?>" role="tab" aria-controls="linea<?php echo $linea; ?>" aria-selected="<?php echo ($primeraPestana ? 'true' : 'false'); ?>">
                      <img src="<?php echo $imagenSrc; ?>" alt="Linea <?php echo $linea; ?>" style="height: 30px; width: auto;">
                    </a>
                  </li>
                <?php
                  $primeraPestana = false; // Solo la primera pestaña visible debe ser activa
                }
                ?>
              </ul>
              <div class="tab-content mt-4" id="custom-tabs-three-tabContent">
                <?php echo $contenidoPestanas; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Incluye jQuery y Bootstrap JavaScript (necesarios para los tabs) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Incluye DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>