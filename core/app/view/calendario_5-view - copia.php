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

<!-- <!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pestañas con datos de líneas</title> -->
<!-- Agrega los estilos de Bootstrap -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body> -->



<div class="container mt-5">
  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
    <?php for ($i = 1; $i <= 12; $i++) { ?>
      <?php
      if ($i == 10) {
        $linea = 'A';
      } elseif ($i == 11) {
        $linea = 'B';
      } else {
        $linea = $i;
      }
      ?>
      <li class="nav-item">
        <a class="nav-link<?php echo ($i == 1 ? ' active' : ''); ?>" id="linea<?php echo $linea; ?>-tab" data-toggle="pill" href="#linea<?php echo $linea; ?>" role="tab" aria-controls="linea<?php echo $linea; ?>" aria-selected="<?php echo ($i == 1 ? 'true' : 'false'); ?>">Linea <?php echo $linea; ?></a>
      </li>
    <?php } ?>
  </ul>
  <div class="tab-content" id="custom-tabs-three-tabContent">
    <?php echo $contenidoPestanas; ?>
  </div>
</div>


<!-- Agrega los scripts de Bootstrap -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html> -->