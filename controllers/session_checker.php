<?php 
	session_start();
	if (!isset($_SESSION['regno']) || !isset($_SESSION['fname']) || !isset($_SESSION['midname'])) {
		header("Location: ../index.php");
	}
 ?>