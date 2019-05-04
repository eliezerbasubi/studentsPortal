<?php 
	$connection_error="Sorry we could not connect you";
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $db= "student_portal";

    $conn = mysqli_connect($localhost,$username,$password,$db) or die($connection_error);
    
 ?>