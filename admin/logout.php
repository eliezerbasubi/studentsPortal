<?php 
session_start();
	if (isset($_POST['logout'])) {
			session_destroy();
			unset($_SESSION['admin_name']);
			require_once 'session_checker.php';
		}
 ?>