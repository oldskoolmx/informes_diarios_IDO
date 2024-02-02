<?php

include "connection.php";

$sql = "insert into event (date_at,title,description) value (\"$_POST[date_at]\",\"$_POST[title]\",\"$_POST[description]\")";

$con->query($sql);
header("Location: index.php");

?>