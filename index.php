<?php 
	session_start();
	require_once 'controllers/functions.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Portal Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<?php include 'pages/header.php'; ?>
	<div class="outter">
		<div class="inner">
			<div class="content">
				<?php 
					echo '<form method="POST" action="'.loginUser($conn).'">
					<h3 class="logText"><span>Log</span>In</h3><br>
					<input type="text" name="username" required="Cannot be empty" placeholder="Enter your username" class="textField"><br><br>
					<input type="password" name="password" required="Cannot be empty" placeholder="Enter your password" class="textField">

					<br><br>
					<input type="submit" name="login_btn" value="Login" class="login">
				</form>';
				 ?>
			</div>
		</div>
	</div>
	<?php include 'pages/footer.php'; ?>


	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript">
		
		 $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
		    $(".alert-danger").slideUp(500);
		});
	</script>
</body>
</html>