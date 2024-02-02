<!DOCTYPE html>
<html>
<head>
	<title>Eventos - Evilnapsis</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
  <script src="js/plotly.min.js"></script>

	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <script src="jspdf/dist/jspdf.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./">EVENTOS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./">INICIO</a></li>

      </ul>


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">

<div class="row">
<div class="col-md-12">

<h1>Reporte de Eventos</h1>
<a href="./new-event.html" class="btn btn-default">Nuevo Evento</a>
<br><br>
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2">Inicio</label>
    <input type="date" name="start" class="form-control" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">Email</label>
    <input type="date" name="end" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-info">Buscar</button>
</form>
<br><br>

<?php if(isset($_GET["start"]) && isset($_GET["end"])):
include "connection.php";
$sql = "select *,count(*) as cx from event where date_at>=\"$_GET[start]\" and date_at<=\"$_GET[end]\" group by date_at";
$query  = $con->query($sql);
$data = array();
while($r = $query->fetch_object()){
  $data[] = $r;
}
//print_r($data);
?>
<div class="panel panel-default">
  <div class="panel-heading">Grafica</div>
  <div class="panel-body">
<div id="chart"></div>

<table class="table table-bordered">
  <thead>
    <th>Fecha</th>
    <th>Cantidad</th>
  </thead>
<?php foreach($data as $d):?>
  <tr>
    <td><?php echo $d->date_at;?></td>
    <td><?php echo $d->cx;?></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
</div>

<script>
var data1 = {
  x: [
  <?php foreach($data as $d):?>
  "<?php echo $d->date_at; ?>",
  <?php endforeach; ?>
  ],
  y: [
  <?php foreach($data as $d):?>
  "<?php echo $d->cx; ?>",
  <?php endforeach; ?>
  ],
//  text: ['Text A', 'Text B', 'Text C'],
  //textposition: 'top',
  type: 'scatter',
  name:'Datos 1',
  line:{ width: 5, color:'red',dash:'solid'},
  marker:{ size: 10, color:'blue'}
};

var data = [data1];

Plotly.newPlot('chart', data,{title:'Grafica de Eventos'});
</script>
<?php endif;?>

</div>

</div>

</div>


</body>
</html>