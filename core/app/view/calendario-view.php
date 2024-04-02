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

$thejson = null;
$events = ReservasData::getEvery();


foreach ($events as $event) {
  $thejson[] = array("title" => $event->title,  "url" => "./?view=idoall&opt=allF&fecha=" . $event->f_cita, "start" => $event->f_cita . "T" . $event->h_cita, "color" => $event->color);
  //$thejson[] = array("title" => $event->title,  "url" => "./?view=idoall&opt=all" . $event->f_cita, "start" => $event->f_cita . "T" . $event->h_cita, "color" => $event->color);
}

?>

<!-- FullCallendar -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar1');
    var calendar1 = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      locale: 'es',
      defaultDate: '<?php echo date('Y-m-d'); ?>',
      editable: true,
      selectable: true,
      allDaySlot: false,

      events: <?php echo json_encode($thejson); ?>,

      dateClick: function(info) {
        var a = info.dateStr;
        const fechaComoCadena = a;
        var numeroDia = new Date(fechaComoCadena).getDay();
        // alert(numeroDia);
        if (numeroDia == "5") {
          alert("No hay atencion en este dia");
        }
      },
    });
    calendar1.render();
  });
</script>




<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- /.col -->
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header" data-background-color="blue">
            <h4 class="title"><b>I D O</b> | Informes Diarios de Operacion</h4>
          </div>
          <div class="card-body p-0">
            <!-- THE CALENDAR -->
            <div id="calendar1"></div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->