<?php

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){

	$per = new EventosData();
	$per->name = $_POST["name"];
    /*if($per->name==""){
        echo "<div class='alert alert-danger'>No Area Selected</div>";
    }*/	
	$per->add();
	?>
<script type="text/javascript">

Swal.fire(
  'Good job!',
  'You clicked the button!',
  'success'
);

</script>	

	<?php
	Core::redir("./?view=eventos&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="update"){

	$per = EventosData::getById($_POST["_id"]);
	$per->name = $_POST["name"];
	$per->update();
	Core::redir("./?view=eventos&opt=all");
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$per = EventosData::getById($_GET["id"]);
	$per->del();
	Core::redir("./?view=eventos&opt=all");

}
?>