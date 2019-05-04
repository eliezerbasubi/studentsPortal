<?php 
session_start();
	if (isset($_POST['logout'])) {
			session_destroy();
			unset($_SESSION['regno']);
			unset($_SESSION['fname']);
			unset($_SESSION['midname']);
			require_once 'session_checker.php';
		}
 ?>