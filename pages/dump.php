<?php
include_once '../controllers/connection.php';
	$sql = "SELECT * FROM students";
	$response = $conn -> query($sql);
	while($row = $response -> fetch_assoc()){
		// $array = array("{'\"results\"'}" => $row);
		echo(json_encode($row, JSON_FORCE_OBJECT));
	}
?>