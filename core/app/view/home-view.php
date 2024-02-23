    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Dashboard</h1> -->
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
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo count(DocumentosData::getAll()); ?></h3>

                <p><b>D O C U M E N T O S</b></p>
              </div>
              <div class="icon">
                <i class="fas fa-folder-open"></i>
                <!-- <i class="fa-solid fa-folder-open"></i> -->
              </div>
              <a href="./?view=inter&opt=all&g=g" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count(DocumentosData::getAllA()); ?></h3>

                <p><b>A T E N D I D O S </b></p>
              </div>
              <div class="icon">
                <i class="fa fa-thumbs-up"></i>
              </div>
              <a href="./?view=inter&opt=all&g=g" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo count(DocumentosData::getAllS()); ?></h3>

                <p><b>S I N - A T E N D E R</b></p>
              </div>
              <div class="icon">
                <!-- <i class="fa fa-users"></i> -->
                <i class="fas fa-laptop-code"></i>
                <!-- <i class="fa-solid fa-laptop-code"></i> -->
                <!-- <i class="fas fa-file-lines"></i> -->
                <!-- <ion-icon class="close-circle-outline"></ion-icon> -->
              </div>
              <a href="./?view=inter&opt=all&g=g" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo count(DocumentosData::getAllP()); ?></h3>

                <p><b>P E N D I E N T E S</b></p>
              </div>
              <div class="icon">
                <i class="fas fa-keyboard"></i>
                <!-- <i class="ion ion-pie-graph"></i> -->
              </div>
              <a href="./?view=documentos&opt=all" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-indigo">
              <div class="inner">
                <h3><?php echo count(DocumentosData::getAllS()); ?></h3>

                <p><b>C A N C E L A D O </b></p>
              </div>
              <div class="icon">
                <i class="fas fa-file-code"></i>
                <!-- <i class="fa-solid fa-rectangle-xmark"></i> -->
              </div>
              <a href="./?view=inter&opt=all&g=g" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3><?php echo count(DocumentosData::getAllP()); ?></h3>

                <p><b>P R E S T A M O</b></p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-pie-graph"></i> -->
                <i class="fas fa-wallet"></i>
              </div>
              <a href="./?view=documentos&opt=all" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <?php ?>
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  <b>D O C U M E N T O S</b>
                </h3>

              </div><!-- /.card-header -->
              <div class="card-body">

                <canvas id="chartjs-dashboard-line" style="height:300px;">
                </canvas>


              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->


          </section>

          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-calendar-alt mr-1"></i>
                  <b>D O C U M E N T O S </b>
                </h3>

              </div><!-- /.card-header -->
              <div class="card-body table-responsive">

                <?php
                $contacts = DocumentosData::getAllToDay();
                if (count($contacts) > 0) : ?>
                  <div>
                    <table class="table table-striped table-bordered table-hover datatable ">
                      <thead>
                        <th>N. Turno y Oficio</th>
                        <th>F. Turno</th>
                        <th>F. Oficio</th>
                        <th>Asunto</th>
                        <th>F. Respuesta</th>
                        <th>Registro</th>
                        <th>Clasificacion</th>

                        <th>Acciones</th>

                      </thead>

                      <?php foreach ($contacts as $con) :
                        $item  = $con->getClasificaciones();
                        $usuario  = $con->getRegistro(); ?>
                        <tr>
                          <td><?php echo $con->n_turno; ?></td>
                          <td><?php echo $con->f_e_turno; ?></td>
                          <td><?php echo $con->f_e_oficio; ?></td>
                          <td><?php echo $con->asunto; ?></td>
                          <td><?php echo $con->f_respuesta; ?></td>
                          <td><?php echo $usuario->name; ?></td>


                          <td>
                            <?php if ($item->id == 1) :  ?>
                              <span class="badge bg-danger"><?php echo $item->name; ?></span>
                            <?php elseif ($item->id == 2) : ?>
                              <span class="badge bg-success"><?php echo $item->name; ?></span>
                            <?php else : ?>
                              <span class="badge bg-warning"><?php echo $item->name; ?></span>
                            <?php endif; ?>
                          </td>


                          <td style="width:190px; ">
                            <a href="./?view=documentos&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                            <a href="./?action=documentos&opt=del&id=<?php echo $con->id; ?>" id="item-<?php echo $con->id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
                            <script type="text/javascript">
                              $("#item-<?php echo $con->id; ?>").click(function(e) {
                                e.preventDefault();
                                x = confirm("Seguro desea eliminar este elemento?");
                                if (x) {
                                  window.location = "./?action=documentos&opt=del&id=<?php echo $con->id; ?>";
                                }
                              });
                            </script>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </table>
                  </div>

                <?php else : ?>





                  <div class="info-box mb-3 bg-warning">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text"><?php echo $fecha_actual = date("d-m-Y"); ?></span>
                      <span class="info-box-number">NO HAY DOCUMENTOS REGISTRADOS</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                <?php endif; ?>


              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->


          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>


    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-line"), {
          type: "line",
          data: {
            labels: [
              <?php
              $start  = time() - (60 * 60 * 26 * 30);
              for ($i = $start; $i <= time(); $i += (60 * 60 * 24)) : ?> "<?php echo date('d-m-Y', $i); ?>",
              <?php endfor; ?>

            ],
            datasets: [{
              label: "Atendidos",
              fill: true,
              backgroundColor: gradient,
              borderColor: "#3B7DDD",
              data: [
                <?php
                $start  = time() - (60 * 60 * 26 * 30);
                for ($i = $start; $i <= time(); $i += (60 * 60 * 24)) : ?>
                  <?php echo (DocumentosData::getByDate(date('Y-m-d', $i))->cnt); ?>,
                <?php endfor; ?>
              ],
            }]
          },
          options: {
            maintainAspectRatio: false,
            legend: {
              display: false
            },
            tooltips: {
              intersect: true
            },
            hover: {
              intersect: true
            },
            plugins: {
              filler: {
                propagate: true
              }
            },
            scales: {
              xAxes: [{
                reverse: true,
                gridLines: {
                  color: "rgba(0,0,0,0.0)"
                }
              }],
              yAxes: [{
                ticks: {
                  stepSize: 1000
                },
                display: true,
                borderDash: [3, 3],
                gridLines: {
                  color: "rgba(0,0,0,0.0)"
                }
              }]
            }
          }
        });
      });
    </script>